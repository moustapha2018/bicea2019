<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122212945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bu_category ADD bicea_admin_id INT DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD comment VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE bu_category ADD CONSTRAINT FK_BDDA98C6D9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('CREATE INDEX IDX_BDDA98C6D9E6DAE7 ON bu_category (bicea_admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bu_category DROP FOREIGN KEY FK_BDDA98C6D9E6DAE7');
        $this->addSql('DROP INDEX IDX_BDDA98C6D9E6DAE7 ON bu_category');
        $this->addSql('ALTER TABLE bu_category DROP bicea_admin_id, DROP description, DROP comment, DROP created_at');
    }
}
