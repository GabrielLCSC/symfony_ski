<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324080405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64927C2E161');
        $this->addSql('DROP INDEX UNIQ_8D93D64927C2E161 ON user');
        $this->addSql('ALTER TABLE user DROP station_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD station_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64927C2E161 FOREIGN KEY (station_id_id) REFERENCES station (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64927C2E161 ON user (station_id_id)');
    }
}
