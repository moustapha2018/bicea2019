<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123212922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bu_customer_order (id INT AUTO_INCREMENT NOT NULL, bu_customer_id INT DEFAULT NULL, bu_article_id INT DEFAULT NULL, bicea_admin_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, number_order VARCHAR(255) NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FBBFE0B0AD2E4AB6 (bu_customer_id), INDEX IDX_FBBFE0B0A76A187B (bu_article_id), INDEX IDX_FBBFE0B0D9E6DAE7 (bicea_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bu_customer_order ADD CONSTRAINT FK_FBBFE0B0AD2E4AB6 FOREIGN KEY (bu_customer_id) REFERENCES bu_customer (id)');
        $this->addSql('ALTER TABLE bu_customer_order ADD CONSTRAINT FK_FBBFE0B0A76A187B FOREIGN KEY (bu_article_id) REFERENCES bu_article (id)');
        $this->addSql('ALTER TABLE bu_customer_order ADD CONSTRAINT FK_FBBFE0B0D9E6DAE7 FOREIGN KEY (bicea_admin_id) REFERENCES bicea_admin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bu_customer_order');
    }
}
