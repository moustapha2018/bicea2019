<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191110174141 extends AbstractMigration
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
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, bicea_admin_id INT DEFAULT NULL, project_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2FB3D0EED9E6DAE7 (bicea_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_rh_user (project_id INT NOT NULL, rh_user_id INT NOT NULL, INDEX IDX_82B6CE61166D1F9C (project_id), INDEX IDX_82B6CE614089F3EE (rh_user_id), PRIMARY KEY(project_id, rh_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pr_task (id INT AUTO_INCREMENT NOT NULL, bicea_admin_id INT DEFAULT NULL, rh_user_id INT DEFAULT NULL, task_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FE97FFBCD9E6DAE7 (bicea_admin_id), INDEX IDX_FE97FFBC4089F3EE (rh_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rh_function (id INT AUTO_INCREMENT NOT NULL, bicea_admin_id INT DEFAULT NULL, function_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D9E59A9D9E6DAE7 (bicea_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rh_user (id INT AUTO_INCREMENT NOT NULL, rh_function_id INT DEFAULT NULL, bicea_amin_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, login_user VARCHAR(255) NOT NULL, contract VARCHAR(255) NOT NULL, passport VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, is_project_manager TINYINT(1) NOT NULL, is_accountant TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_14A8C204CC26FB8C (rh_function_id), INDEX IDX_14A8C204A2B6E675 (bicea_amin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EED9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE project_rh_user ADD CONSTRAINT FK_82B6CE61166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_rh_user ADD CONSTRAINT FK_82B6CE614089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pr_task ADD CONSTRAINT FK_FE97FFBCD9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE pr_task ADD CONSTRAINT FK_FE97FFBC4089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A9D9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C204CC26FB8C FOREIGN KEY (rh_function_id) REFERENCES rh_function (id)');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C204A2B6E675 FOREIGN KEY (bicea_amin_id) REFERENCES bicea_admin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EED9E6DAE7');
        $this->addSql('ALTER TABLE pr_task DROP FOREIGN KEY FK_FE97FFBCD9E6DAE7');
        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A9D9E6DAE7');
        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C204A2B6E675');
        $this->addSql('ALTER TABLE project_rh_user DROP FOREIGN KEY FK_82B6CE61166D1F9C');
        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C204CC26FB8C');
        $this->addSql('ALTER TABLE project_rh_user DROP FOREIGN KEY FK_82B6CE614089F3EE');
        $this->addSql('ALTER TABLE pr_task DROP FOREIGN KEY FK_FE97FFBC4089F3EE');
        $this->addSql('DROP TABLE bicea_admin');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_rh_user');
        $this->addSql('DROP TABLE pr_task');
        $this->addSql('DROP TABLE rh_function');
        $this->addSql('DROP TABLE rh_user');
    }
}
