<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108000552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C20464F1F4EE');
        $this->addSql('DROP INDEX IDX_14A8C20464F1F4EE ON rh_user');
        $this->addSql('ALTER TABLE rh_user CHANGE created_by_admin_id bicea_amin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C204A2B6E675 FOREIGN KEY (bicea_amin_id) REFERENCES bicea_admin (id)');
        $this->addSql('CREATE INDEX IDX_14A8C204A2B6E675 ON rh_user (bicea_amin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C204A2B6E675');
        $this->addSql('DROP INDEX IDX_14A8C204A2B6E675 ON rh_user');
        $this->addSql('ALTER TABLE rh_user CHANGE bicea_amin_id created_by_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C20464F1F4EE FOREIGN KEY (created_by_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('CREATE INDEX IDX_14A8C20464F1F4EE ON rh_user (created_by_admin_id)');
    }
}
