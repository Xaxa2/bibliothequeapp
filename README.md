# librarie_app

Creer ton projet avec les nom symfony dans le dossier app/
pour avoir app/symfony

### Requirements
---

- PHP 8.3
- Symfony 7.2
- Apache 2.4
- MySQL 5.7
- Composer 2

### Usage
---

### Installation
---

```
git clone git@github.com:user/librarie_app.git
$ cd librarie_app

# or start docker containers
$ make docker-run

# install dependencies
$ make docker-exec apache bash
$ composer install

# create migrations
$ make migrate

# load fixtures
$ make fixtures

server running on http://localhost:8010
```

### Configuration
---

### Pipeline
Configuration à venir

## —— Static analysis ✨ —————————————————————————————————————————————————      - name: Run PHP-CS-Fixer        
run: 
php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php -v --dry-run  

    - name: Run PHPStan        
run: 
php vendor/bin/phpstan analyse --configuration=phpstan.dist.neon

---

```yaml
make fixtures # load fixtures
make quality # run quality checks
make translations-lint # check translations
make phpunit # run unit tests
```

### Authors
---

- Xavier
