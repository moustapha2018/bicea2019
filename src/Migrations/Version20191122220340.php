<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122220340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bu_article (id INT AUTO_INCREMENT NOT NULL, bicea_admin_id INT DEFAULT NULL, bu_category_id INT DEFAULT NULL, article_name VARCHAR(255) NOT NULL, unit_price DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_9FFC0AD3D9E6DAE7 (bicea_admin_id), INDEX IDX_9FFC0AD32CFD14A7 (bu_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bu_article ADD CONSTRAINT FK_9FFC0AD3D9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
        $this->addSql('ALTER TABLE bu_article ADD CONSTRAINT FK_9FFC0AD32CFD14A7 FOREIGN KEY (bu_category_id) REFERENCES bu_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bu_article');
    }
}
