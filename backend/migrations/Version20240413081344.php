<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413081344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE list_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE my_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE list_item (id INT NOT NULL, list_item_id INT NOT NULL, list_id UUID NOT NULL, name VARCHAR(255) NOT NULL, is_checked BOOLEAN NOT NULL, cost DOUBLE PRECISION DEFAULT NULL, change_user UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE my_list (id INT NOT NULL, list_id UUID NOT NULL, name VARCHAR(255) NOT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, owner_user_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" ALTER COLUMN "id" TYPE uuid USING "id"::uuid;');
        $this->addSql('ALTER TABLE "my_list" ALTER COLUMN "id" TYPE uuid USING "id"::uuid;');
        $this->addSql('ALTER TABLE "list_fields" ALTER COLUMN "id" TYPE uuid USING "id"::uuid;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE list_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE my_list_id_seq CASCADE');
        $this->addSql('DROP TABLE list_item');
        $this->addSql('DROP TABLE my_list');
    }
}
