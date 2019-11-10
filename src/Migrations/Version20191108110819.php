<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108110819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A964F1F4EE');
        $this->addSql('DROP INDEX IDX_D9E59A964F1F4EE ON rh_function');
        $this->addSql('ALTER TABLE rh_function CHANGE created_by_admin_id bicea_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A9D9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('CREATE INDEX IDX_D9E59A9D9E6DAE7 ON rh_function (bicea_admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A9D9E6DAE7');
        $this->addSql('DROP INDEX IDX_D9E59A9D9E6DAE7 ON rh_function');
        $this->addSql('ALTER TABLE rh_function CHANGE bicea_admin_id created_by_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A964F1F4EE FOREIGN KEY (created_by_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('CREATE INDEX IDX_D9E59A964F1F4EE ON rh_function (created_by_admin_id)');
    }
}
