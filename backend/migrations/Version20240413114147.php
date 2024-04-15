<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413114147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER COLUMN "id" TYPE uuid USING \'36310515-fa3d-4ed4-abbc-cfb9a3fad966\'');
        $this->addSql('ALTER TABLE "my_list" ALTER COLUMN "id" TYPE uuid USING \'36310515-fa3d-4ed4-abbc-cfb9a3fad966\'');
        $this->addSql('ALTER TABLE "list_item" ALTER COLUMN "id" TYPE uuid USING \'36310515-fa3d-4ed4-abbc-cfb9a3fad966\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
