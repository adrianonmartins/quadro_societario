<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324121541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE socios_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE socios (id INT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE empresas ADD socios_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE empresas ADD CONSTRAINT FK_70DD49A548A1A28F FOREIGN KEY (socios_id) REFERENCES socios (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_70DD49A548A1A28F ON empresas (socios_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE empresas DROP CONSTRAINT FK_70DD49A548A1A28F');
        $this->addSql('DROP SEQUENCE socios_id_seq CASCADE');
        $this->addSql('DROP TABLE socios');
        $this->addSql('DROP INDEX IDX_70DD49A548A1A28F');
        $this->addSql('ALTER TABLE empresas DROP socios_id');
    }
}
