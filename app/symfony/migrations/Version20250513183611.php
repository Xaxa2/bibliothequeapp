<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513183611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE subscription ADD user_id INT DEFAULT NULL, ADD pack_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D31919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A3C664D3A76ED395 ON subscription (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A3C664D31919B217 ON subscription (pack_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D31919B217
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A3C664D3A76ED395 ON subscription
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A3C664D31919B217 ON subscription
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE subscription DROP user_id, DROP pack_id
        SQL);
    }
}
