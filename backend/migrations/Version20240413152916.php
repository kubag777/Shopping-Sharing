<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413152916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE list_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE my_list_id_seq CASCADE');
        $this->addSql('CREATE TABLE list_fields (id UUID NOT NULL, my_list_id UUID DEFAULT NULL, list_id UUID NOT NULL, name VARCHAR(255) NOT NULL, is_checked BOOLEAN NOT NULL, cost DOUBLE PRECISION DEFAULT NULL, creator_user_id UUID NOT NULL, checked_user_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E73521A6B757BAA7 ON list_fields (my_list_id)');
        $this->addSql('COMMENT ON COLUMN list_fields.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_fields.my_list_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_fields.list_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_fields.creator_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN list_fields.checked_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE list_fields ADD CONSTRAINT FK_E73521A6B757BAA7 FOREIGN KEY (my_list_id) REFERENCES my_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE list_item');
        $this->addSql('ALTER TABLE my_list DROP list_id');
        $this->addSql('ALTER TABLE my_list ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE my_list ALTER owner_user_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN my_list.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN my_list.owner_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP INDEX uniq_identifier_email');
        $this->addSql('ALTER TABLE "user" ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_UUID ON "user" (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE list_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE my_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE list_item (id UUID NOT NULL, list_item_id INT NOT NULL, list_id UUID NOT NULL, name VARCHAR(255) NOT NULL, is_checked BOOLEAN NOT NULL, cost DOUBLE PRECISION DEFAULT NULL, change_user UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE list_fields DROP CONSTRAINT FK_E73521A6B757BAA7');
        $this->addSql('DROP TABLE list_fields');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_UUID');
        $this->addSql('ALTER TABLE "user" ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN uuid TO email');
        $this->addSql('COMMENT ON COLUMN "user".id IS NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_identifier_email ON "user" (email)');
        $this->addSql('ALTER TABLE my_list ADD list_id UUID NOT NULL');
        $this->addSql('ALTER TABLE my_list ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE my_list ALTER owner_user_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN my_list.id IS NULL');
        $this->addSql('COMMENT ON COLUMN my_list.owner_user_id IS NULL');
    }
}
