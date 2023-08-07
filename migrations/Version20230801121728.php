<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801121728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_spinning ADD bicicleta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reserva_spinning ADD CONSTRAINT FK_7E27AC0D2B6C1A2 FOREIGN KEY (bicicleta_id) REFERENCES bicicleta (id)');
        $this->addSql('CREATE INDEX IDX_7E27AC0D2B6C1A2 ON reserva_spinning (bicicleta_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_spinning DROP FOREIGN KEY FK_7E27AC0D2B6C1A2');
        $this->addSql('DROP INDEX IDX_7E27AC0D2B6C1A2 ON reserva_spinning');
        $this->addSql('ALTER TABLE reserva_spinning DROP bicicleta_id');
    }
}
