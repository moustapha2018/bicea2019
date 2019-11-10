<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107231448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A9B03A8386');
        $this->addSql('DROP INDEX IDX_D9E59A9B03A8386 ON rh_function');
        $this->addSql('ALTER TABLE rh_function CHANGE created_by_id rh_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A94089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
        $this->addSql('CREATE INDEX IDX_D9E59A94089F3EE ON rh_function (rh_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A94089F3EE');
        $this->addSql('DROP INDEX IDX_D9E59A94089F3EE ON rh_function');
        $this->addSql('ALTER TABLE rh_function CHANGE rh_user_id created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A9B03A8386 FOREIGN KEY (created_by_id) REFERENCES rh_user (id)');
        $this->addSql('CREATE INDEX IDX_D9E59A9B03A8386 ON rh_function (created_by_id)');
    }
}
