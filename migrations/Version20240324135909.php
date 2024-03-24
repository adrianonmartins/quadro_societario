<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324135909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresas DROP CONSTRAINT fk_70dd49a548a1a28f');
        $this->addSql('DROP INDEX idx_70dd49a548a1a28f');
        $this->addSql('ALTER TABLE empresas DROP socios_id');
        $this->addSql('ALTER TABLE socios ADD empresas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE socios ADD CONSTRAINT FK_62EAC1FC602B00EE FOREIGN KEY (empresas_id) REFERENCES empresas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_62EAC1FC602B00EE ON socios (empresas_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE empresas ADD socios_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE empresas ADD CONSTRAINT fk_70dd49a548a1a28f FOREIGN KEY (socios_id) REFERENCES socios (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_70dd49a548a1a28f ON empresas (socios_id)');
        $this->addSql('ALTER TABLE socios DROP CONSTRAINT FK_62EAC1FC602B00EE');
        $this->addSql('DROP INDEX IDX_62EAC1FC602B00EE');
        $this->addSql('ALTER TABLE socios DROP empresas_id');
    }
}
