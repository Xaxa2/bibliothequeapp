# --------------------------------#
# Makefile for the "make" command
# --------------------------------#

DOCKER_DEV= docker compose

## ----- Docker dev -----
docker-run: ## docker run
	$(DOCKER_DEV) up -d

docker-ps: ## docker ps
	$(DOCKER_DEV) ps

docker-build: ## docker build
	$(DOCKER_DEV) up --force-recreate --build -d

docker-stop: ## docker stop
	$(DOCKER_DEV) stop

docker-exec: ## docker exec
	$(DOCKER_DEV) exec apache bash

docker-cpi: ## docker exec
	$(DOCKER_DEV) exec apache composer install

docker-restart: ## docker restart
	$(DOCKER_DEV) restart

docker-down: ## docker down
	$(DOCKER_DEV) down

## ----- Project code Quality -----

php-cs-fixer: ## php-cs-fixer
	$(DOCKER_DEV) exec apache vendor/bin/php-cs-fixer fix src

twig-cs-fixer: ## twig-cs-fixer
	$(DOCKER_DEV) exec apache vendor/bin/twig-cs-fixer lint --fix templates

phpstan: ## phpstan
	$(DOCKER_DEV) exec apache vendor/bin/phpstan analyse src --configuration=phpstan.neon

## ----- Project -----
init: ## Initialize the project
	$(DOCKER_DEV) exec apache composer install

migrate: ## execute migrations
	$(DOCKER_DEV) exec apache bin/console doctrine:migrations:migrate

shell: ## Enter to apache container
	$(DOCKER_DEV) exec apache bash

docker-compile: ## clean cache/delete assets and compile new assets
	$(DOCKER_DEV) exec apache sh -c 'php bin/console cache:clear && rm -rf public/assets/* && php bin/console asset-map:compile'

quality: ## Exécute php-cs-fixer, twig-cs-fixer, phpstan, et les linters Symfony
	$(DOCKER_DEV) exec apache vendor/bin/php-cs-fixer fix src && \
	$(DOCKER_DEV) exec apache vendor/bin/twig-cs-fixer lint --fix templates && \
	$(DOCKER_DEV) exec apache vendor/bin/phpstan analyse src --configuration=phpstan.neon && \
	$(DOCKER_DEV) exec apache php bin/console lint:twig templates && \
	$(DOCKER_DEV) exec apache php bin/console lint:yaml config && \
	$(DOCKER_DEV) exec apache php bin/console lint:yaml translations && \
	$(DOCKER_DEV) exec apache php bin/console lint:container

translations-lint: ## Vérifie les traductions manquantes
	$(DOCKER_DEV) exec apache bash -c '\
		OUTPUT1="$$(php bin/console debug:translation en --only-missing)"; \
		OUTPUT2="$$(php bin/console debug:translation fr --only-missing)"; \
		echo -e "\nphp bin/console debug:translation en --only-missing\n\n$$OUTPUT1"; \
		echo -e "\nphp bin/console debug:translation fr --only-missing\n\n$$OUTPUT2"; \
		OUTPUT="$$OUTPUT1 $$OUTPUT2"; \
		if echo "$$OUTPUT" | grep -q "missing"; then \
			echo -e "\n\033[30;41m Warning: Missing translations found! \033[0m\n"; \
		else \
			echo -e "\n\033[30;42m No missing translations. \033[0m\n"; \
		fi; \
		exit 0'

translations: ## Affiche les traductions manquantes sans échouer
	-$(DOCKER_DEV) exec apache php bin/console debug:translation en --only-missing || true
	-$(DOCKER_DEV) exec apache php bin/console debug:translation fr --only-missing || true

phpunit: ## phpunit
    $(DOCKER_DEV) exec apache vendor/bin/phpunit --colors=always --coverage-html reports/

fixtures: ## load doctrine fixtures
	$(DOCKER_DEV) exec apache bin/console doctrine:fixtures:load

## ----- Help -----
help: ## Display this help
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'