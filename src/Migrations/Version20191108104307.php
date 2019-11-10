<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108104307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C2046FAAB740');
        $this->addSql('DROP TABLE rh_file_user');
        $this->addSql('DROP INDEX IDX_14A8C2046FAAB740 ON rh_user');
        $this->addSql('ALTER TABLE rh_user DROP rh_file_user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rh_file_user (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, caption VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE rh_user ADD rh_file_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C2046FAAB740 FOREIGN KEY (rh_file_user_id) REFERENCES rh_file_user (id)');
        $this->addSql('CREATE INDEX IDX_14A8C2046FAAB740 ON rh_user (rh_file_user_id)');
    }
}
