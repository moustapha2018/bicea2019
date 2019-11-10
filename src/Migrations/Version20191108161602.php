<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108161602 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pr_task (id INT AUTO_INCREMENT NOT NULL, bicea_admin_id INT DEFAULT NULL, rh_user_id INT DEFAULT NULL, task_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FE97FFBCD9E6DAE7 (bicea_admin_id), INDEX IDX_FE97FFBC4089F3EE (rh_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pr_task ADD CONSTRAINT FK_FE97FFBCD9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE pr_task ADD CONSTRAINT FK_FE97FFBC4089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pr_task');
    }
}
