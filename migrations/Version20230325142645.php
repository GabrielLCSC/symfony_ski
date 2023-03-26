<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325142645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lift (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, is_open TINYINT(1) NOT NULL, message VARCHAR(255) DEFAULT NULL, is_season TINYINT(1) NOT NULL, opening TIME NOT NULL, closing TIME NOT NULL, INDEX IDX_737D1E0C21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slope (id INT AUTO_INCREMENT NOT NULL, station_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, is_open TINYINT(1) NOT NULL, message VARCHAR(255) DEFAULT NULL, is_season TINYINT(1) NOT NULL, opening TIME NOT NULL, closing TIME NOT NULL, INDEX IDX_58CC458521BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lift ADD CONSTRAINT FK_737D1E0C21BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE slope ADD CONSTRAINT FK_58CC458521BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64927C2E161');
        $this->addSql('DROP INDEX UNIQ_8D93D64927C2E161 ON user');
        $this->addSql('ALTER TABLE user DROP station_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lift DROP FOREIGN KEY FK_737D1E0C21BDB235');
        $this->addSql('ALTER TABLE slope DROP FOREIGN KEY FK_58CC458521BDB235');
        $this->addSql('DROP TABLE lift');
        $this->addSql('DROP TABLE slope');
        $this->addSql('ALTER TABLE user ADD station_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64927C2E161 FOREIGN KEY (station_id_id) REFERENCES station (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64927C2E161 ON user (station_id_id)');
    }
}
