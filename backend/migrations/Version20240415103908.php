<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415103908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE my_lists (id UUID NOT NULL, owner_user_id_id UUID NOT NULL, name VARCHAR(255) NOT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64E02D61CFECFC4A ON my_lists (owner_user_id_id)');
        $this->addSql('COMMENT ON COLUMN my_lists.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN my_lists.owner_user_id_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE my_lists_user (my_lists_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(my_lists_id, user_id))');
        $this->addSql('CREATE INDEX IDX_8ECFF14FAF74DCD4 ON my_lists_user (my_lists_id)');
        $this->addSql('CREATE INDEX IDX_8ECFF14FA76ED395 ON my_lists_user (user_id)');
        $this->addSql('COMMENT ON COLUMN my_lists_user.my_lists_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN my_lists_user.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE my_lists ADD CONSTRAINT FK_64E02D61CFECFC4A FOREIGN KEY (owner_user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE my_lists_user ADD CONSTRAINT FK_8ECFF14FAF74DCD4 FOREIGN KEY (my_lists_id) REFERENCES my_lists (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE my_lists_user ADD CONSTRAINT FK_8ECFF14FA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE my_lists DROP CONSTRAINT FK_64E02D61CFECFC4A');
        $this->addSql('ALTER TABLE my_lists_user DROP CONSTRAINT FK_8ECFF14FAF74DCD4');
        $this->addSql('ALTER TABLE my_lists_user DROP CONSTRAINT FK_8ECFF14FA76ED395');
        $this->addSql('DROP TABLE my_lists');
        $this->addSql('DROP TABLE my_lists_user');
    }
}
