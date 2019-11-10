<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108160924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, bicea_admin_id INT DEFAULT NULL, project_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2FB3D0EED9E6DAE7 (bicea_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_rh_user (project_id INT NOT NULL, rh_user_id INT NOT NULL, INDEX IDX_82B6CE61166D1F9C (project_id), INDEX IDX_82B6CE614089F3EE (rh_user_id), PRIMARY KEY(project_id, rh_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EED9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE project_rh_user ADD CONSTRAINT FK_82B6CE61166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_rh_user ADD CONSTRAINT FK_82B6CE614089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project_rh_user DROP FOREIGN KEY FK_82B6CE61166D1F9C');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_rh_user');
    }
}
