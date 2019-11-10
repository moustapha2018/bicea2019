<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107221516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bicea_admin (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, login_admin VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, head_office VARCHAR(255) NOT NULL, login_company VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, paid TINYINT(1) NOT NULL, activity_sector VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rh_function (id INT AUTO_INCREMENT NOT NULL, created_by_admin_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, function_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, dd VARCHAR(255) NOT NULL, INDEX IDX_D9E59A964F1F4EE (created_by_admin_id), INDEX IDX_D9E59A9B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rh_user (id INT AUTO_INCREMENT NOT NULL, created_by_admin_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, login_user VARCHAR(255) NOT NULL, contract VARCHAR(255) NOT NULL, passport VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_14A8C20464F1F4EE (created_by_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A964F1F4EE FOREIGN KEY (created_by_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A9B03A8386 FOREIGN KEY (created_by_id) REFERENCES rh_user (id)');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C20464F1F4EE FOREIGN KEY (created_by_admin_id) REFERENCES bicea_admin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A964F1F4EE');
        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C20464F1F4EE');
        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A9B03A8386');
        $this->addSql('DROP TABLE bicea_admin');
        $this->addSql('DROP TABLE rh_function');
        $this->addSql('DROP TABLE rh_user');
    }
}
