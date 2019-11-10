<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108103208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_file_user DROP FOREIGN KEY FK_F3CAD9354089F3EE');
        $this->addSql('DROP INDEX IDX_F3CAD9354089F3EE ON rh_file_user');
        $this->addSql('ALTER TABLE rh_file_user DROP rh_user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_file_user ADD rh_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_file_user ADD CONSTRAINT FK_F3CAD9354089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
        $this->addSql('CREATE INDEX IDX_F3CAD9354089F3EE ON rh_file_user (rh_user_id)');
    }
}
