<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191114211904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pr_task ADD rh_user_id INT DEFAULT NULL, ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pr_task ADD CONSTRAINT FK_FE97FFBC4089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
        $this->addSql('ALTER TABLE pr_task ADD CONSTRAINT FK_FE97FFBC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_FE97FFBC4089F3EE ON pr_task (rh_user_id)');
        $this->addSql('CREATE INDEX IDX_FE97FFBC166D1F9C ON pr_task (project_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pr_task DROP FOREIGN KEY FK_FE97FFBC4089F3EE');
        $this->addSql('ALTER TABLE pr_task DROP FOREIGN KEY FK_FE97FFBC166D1F9C');
        $this->addSql('DROP INDEX IDX_FE97FFBC4089F3EE ON pr_task');
        $this->addSql('DROP INDEX IDX_FE97FFBC166D1F9C ON pr_task');
        $this->addSql('ALTER TABLE pr_task DROP rh_user_id, DROP project_id');
    }
}
