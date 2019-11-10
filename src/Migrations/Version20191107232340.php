<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107232340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C204658E4848');
        $this->addSql('DROP INDEX IDX_14A8C204658E4848 ON rh_user');
        $this->addSql('ALTER TABLE rh_user CHANGE rhfunctions_id rh_function_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C204CC26FB8C FOREIGN KEY (rh_function_id) REFERENCES rh_function (id)');
        $this->addSql('CREATE INDEX IDX_14A8C204CC26FB8C ON rh_user (rh_function_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_user DROP FOREIGN KEY FK_14A8C204CC26FB8C');
        $this->addSql('DROP INDEX IDX_14A8C204CC26FB8C ON rh_user');
        $this->addSql('ALTER TABLE rh_user CHANGE rh_function_id rhfunctions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_user ADD CONSTRAINT FK_14A8C204658E4848 FOREIGN KEY (rhfunctions_id) REFERENCES rh_function (id)');
        $this->addSql('CREATE INDEX IDX_14A8C204658E4848 ON rh_user (rhfunctions_id)');
    }
}
