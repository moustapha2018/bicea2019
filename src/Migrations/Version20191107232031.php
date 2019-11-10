<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107232031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function DROP FOREIGN KEY FK_D9E59A94089F3EE');
        $this->addSql('DROP INDEX IDX_D9E59A94089F3EE ON rh_function');
        $this->addSql('ALTER TABLE rh_function DROP rh_user_id');
        $this->addSql('ALTER TABLE rh_user ADD rhfunctions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C204658E4848 FOREIGN KEY (rhfunctions_id) REFERENCES rh_function (id)');
        $this->addSql('CREATE INDEX IDX_14A8C204658E4848 ON rh_user (rhfunctions_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_function ADD rh_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_function ADD CONSTRAINT FK_D9E59A94089F3EE FOREIGN KEY (rh_user_id) REFERENCES rh_user (id)');
        $this->addSql('CREATE INDEX IDX_D9E59A94089F3EE ON rh_function (rh_user_id)');
        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C204658E4848');
        $this->addSql('DROP INDEX IDX_14A8C204658E4848 ON rh_user');
        $this->addSql('ALTER TABLE rh_user DROP rhfunctions_id');
    }
}
