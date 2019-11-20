<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120204342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_contract ADD bicea_admin_id INT DEFAULT NULL, ADD rh_user_id INT DEFAULT NULL, CHANGE end_date end_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rh_contract ADD CONSTRAINT FK_2EBF67CDD9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE rh_contract ADD CONSTRAINT FK_2EBF67CD4089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
        $this->addSql('CREATE INDEX IDX_2EBF67CDD9E6DAE7 ON rh_contract (bicea_admin_id)');
        $this->addSql('CREATE INDEX IDX_2EBF67CD4089F3EE ON rh_contract (rh_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_contract DROP FOREIGN KEY FK_2EBF67CDD9E6DAE7');
        $this->addSql('ALTER TABLE rh_contract DROP FOREIGN KEY FK_2EBF67CD4089F3EE');
        $this->addSql('DROP INDEX IDX_2EBF67CDD9E6DAE7 ON rh_contract');
        $this->addSql('DROP INDEX IDX_2EBF67CD4089F3EE ON rh_contract');
        $this->addSql('ALTER TABLE rh_contract DROP bicea_admin_id, DROP rh_user_id, CHANGE end_date end_date VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
