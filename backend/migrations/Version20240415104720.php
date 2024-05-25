<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415104720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE list_field (id UUID NOT NULL, list_id_id UUID NOT NULL, create_user_id UUID NOT NULL, check_user_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, is_checked BOOLEAN NOT NULL, cost DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E73521A6A6D70A54 ON list_field (list_id_id)');
        $this->addSql('CREATE INDEX IDX_E73521A685564492 ON list_field (create_user_id)');
        $this->addSql('CREATE INDEX IDX_E73521A6E1729D15 ON list_field (check_user_id)');
        $this->addSql('COMMENT ON COLUMN list_field.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_field.list_id_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_field.create_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_field.check_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE list_field ADD CONSTRAINT FK_E73521A6A6D70A54 FOREIGN KEY (list_id_id) REFERENCES my_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE list_field ADD CONSTRAINT FK_E73521A685564492 FOREIGN KEY (create_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE list_field ADD CONSTRAINT FK_E73521A6E1729D15 FOREIGN KEY (check_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE list_field DROP CONSTRAINT FK_E73521A6A6D70A54');
        $this->addSql('ALTER TABLE list_field DROP CONSTRAINT FK_E73521A685564492');
        $this->addSql('ALTER TABLE list_field DROP CONSTRAINT FK_E73521A6E1729D15');
        $this->addSql('DROP TABLE list_field');
    }
}
