<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825130626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE space_scientist_entity DROP CONSTRAINT fk_e234b06221bdb235');
        $this->addSql('ALTER TABLE delivery_entity DROP CONSTRAINT fk_1039bde6f624b39d');
        $this->addSql('ALTER TABLE mars_scientist_entity DROP CONSTRAINT fk_de0d557c21bdb235');
        $this->addSql('ALTER TABLE earth_scientist_entity DROP CONSTRAINT fk_8b4a89421bdb235');
        $this->addSql('DROP SEQUENCE space_research_station_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE delivery_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE space_scientist_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE expedition_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mars_research_station_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE earth_scientist_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE earth_resarch_station_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_entity_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE delivery_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE earth_research_station_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE earth_scientist_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE expedition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mars_research_station_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE space_research_station_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE space_scientist_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE delivery (id INT NOT NULL, sender_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3781EC10F624B39D ON delivery (sender_id)');
        $this->addSql('CREATE TABLE earth_research_station (id INT NOT NULL, need_help BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE earth_scientist (id INT NOT NULL, station_id INT NOT NULL, name VARCHAR(32) NOT NULL, surname VARCHAR(64) NOT NULL, password VARCHAR(255) NOT NULL, apikey VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EF2A11E321BDB235 ON earth_scientist (station_id)');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, creation_date DATE NOT NULL, storage_location VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE expedition (id INT NOT NULL, creator_id INT NOT NULL, creation_date DATE NOT NULL, planned_start_date DATE NOT NULL, is_finished BOOLEAN NOT NULL, is_started BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_692907E61220EA6 ON expedition (creator_id)');
        $this->addSql('CREATE TABLE mars_research_station (id INT NOT NULL, need_help BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, category VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE space_research_station (id INT NOT NULL, need_help BOOLEAN NOT NULL, oxygen_percentage DOUBLE PRECISION NOT NULL, days_at_orbit INT NOT NULL, mass DOUBLE PRECISION NOT NULL, energy_waste DOUBLE PRECISION NOT NULL, accumulator_percentage DOUBLE PRECISION NOT NULL, position DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE space_scientist (id INT NOT NULL, station_id INT NOT NULL, name VARCHAR(32) NOT NULL, surname VARCHAR(64) NOT NULL, apikey VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C8D6042421BDB235 ON space_scientist (station_id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10F624B39D FOREIGN KEY (sender_id) REFERENCES space_scientist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE earth_scientist ADD CONSTRAINT FK_EF2A11E321BDB235 FOREIGN KEY (station_id) REFERENCES earth_research_station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expedition ADD CONSTRAINT FK_692907E61220EA6 FOREIGN KEY (creator_id) REFERENCES mars_scientist_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE space_scientist ADD CONSTRAINT FK_C8D6042421BDB235 FOREIGN KEY (station_id) REFERENCES space_research_station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE space_research_station_entity');
        $this->addSql('DROP TABLE product_entity');
        $this->addSql('DROP TABLE space_scientist_entity');
        $this->addSql('DROP TABLE expedition_entity');
        $this->addSql('DROP TABLE earth_scientist_entity');
        $this->addSql('DROP TABLE event_entity');
        $this->addSql('DROP TABLE mars_research_station_entity');
        $this->addSql('DROP TABLE delivery_entity');
        $this->addSql('DROP TABLE earth_resarch_station');
        $this->addSql('ALTER TABLE mars_scientist_entity DROP CONSTRAINT FK_DE0D557C21BDB235');
        $this->addSql('ALTER TABLE mars_scientist_entity ADD apikey VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mars_scientist_entity ADD CONSTRAINT FK_DE0D557C21BDB235 FOREIGN KEY (station_id) REFERENCES mars_research_station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE earth_scientist DROP CONSTRAINT FK_EF2A11E321BDB235');
        $this->addSql('ALTER TABLE mars_scientist_entity DROP CONSTRAINT FK_DE0D557C21BDB235');
        $this->addSql('ALTER TABLE space_scientist DROP CONSTRAINT FK_C8D6042421BDB235');
        $this->addSql('ALTER TABLE delivery DROP CONSTRAINT FK_3781EC10F624B39D');
        $this->addSql('DROP SEQUENCE delivery_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE earth_research_station_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE earth_scientist_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE expedition_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mars_research_station_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE space_research_station_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE space_scientist_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE space_research_station_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE delivery_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE space_scientist_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE expedition_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mars_research_station_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE earth_scientist_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE earth_resarch_station_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE space_research_station_entity (id INT NOT NULL, need_help BOOLEAN NOT NULL, oxygen_percentage DOUBLE PRECISION NOT NULL, days_at_orbit INT NOT NULL, mass DOUBLE PRECISION NOT NULL, energy_waste DOUBLE PRECISION NOT NULL, accumulator_percentage DOUBLE PRECISION NOT NULL, "position" DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_entity (id INT NOT NULL, category VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE space_scientist_entity (id INT NOT NULL, station_id INT NOT NULL, name VARCHAR(32) NOT NULL, surname VARCHAR(64) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_e234b06221bdb235 ON space_scientist_entity (station_id)');
        $this->addSql('CREATE TABLE expedition_entity (id INT NOT NULL, creator_id INT NOT NULL, finished_by_id INT DEFAULT NULL, creation_date DATE NOT NULL, planned_start_date DATE NOT NULL, is_finished BOOLEAN NOT NULL, is_started BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_d887357261220ea6 ON expedition_entity (creator_id)');
        $this->addSql('CREATE INDEX idx_d88735724a12cc70 ON expedition_entity (finished_by_id)');
        $this->addSql('CREATE TABLE earth_scientist_entity (id INT NOT NULL, station_id INT NOT NULL, name VARCHAR(32) NOT NULL, surname VARCHAR(64) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_8b4a89421bdb235 ON earth_scientist_entity (station_id)');
        $this->addSql('CREATE TABLE event_entity (id INT NOT NULL, creation_date DATE NOT NULL, storage_location VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mars_research_station_entity (id INT NOT NULL, need_help BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE delivery_entity (id INT NOT NULL, sender_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_1039bde6f624b39d ON delivery_entity (sender_id)');
        $this->addSql('CREATE TABLE earth_resarch_station (id INT NOT NULL, need_help BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE space_scientist_entity ADD CONSTRAINT fk_e234b06221bdb235 FOREIGN KEY (station_id) REFERENCES space_research_station_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expedition_entity ADD CONSTRAINT fk_d887357261220ea6 FOREIGN KEY (creator_id) REFERENCES mars_scientist_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expedition_entity ADD CONSTRAINT fk_d88735724a12cc70 FOREIGN KEY (finished_by_id) REFERENCES mars_scientist_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE earth_scientist_entity ADD CONSTRAINT fk_8b4a89421bdb235 FOREIGN KEY (station_id) REFERENCES earth_resarch_station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE delivery_entity ADD CONSTRAINT fk_1039bde6f624b39d FOREIGN KEY (sender_id) REFERENCES space_scientist_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE earth_research_station');
        $this->addSql('DROP TABLE earth_scientist');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE expedition');
        $this->addSql('DROP TABLE mars_research_station');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE space_research_station');
        $this->addSql('DROP TABLE space_scientist');
        $this->addSql('ALTER TABLE mars_scientist_entity DROP CONSTRAINT fk_de0d557c21bdb235');
        $this->addSql('ALTER TABLE mars_scientist_entity DROP apikey');
        $this->addSql('ALTER TABLE mars_scientist_entity ADD CONSTRAINT fk_de0d557c21bdb235 FOREIGN KEY (station_id) REFERENCES mars_research_station_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
