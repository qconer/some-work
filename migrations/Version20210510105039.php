<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510105039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_set_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_choice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, game_set_id INT NOT NULL, winner VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C6DCEA0D0 ON game (game_set_id)');
        $this->addSql('CREATE TABLE game_set (id INT NOT NULL, start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, finish TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, game_count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player_choice (id INT NOT NULL, game_id INT DEFAULT NULL, choice VARCHAR(255) NOT NULL, player_side VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5EABCC4CE48FD905 ON player_choice (game_id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6DCEA0D0 FOREIGN KEY (game_set_id) REFERENCES game_set (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_choice ADD CONSTRAINT FK_5EABCC4CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player_choice DROP CONSTRAINT FK_5EABCC4CE48FD905');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C6DCEA0D0');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_set_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_choice_id_seq CASCADE');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_set');
        $this->addSql('DROP TABLE player_choice');
    }
}
