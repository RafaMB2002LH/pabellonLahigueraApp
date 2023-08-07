<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801120842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_spinning ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reserva_spinning ADD CONSTRAINT FK_7E27AC0DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_7E27AC0DDB38439E ON reserva_spinning (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_spinning DROP FOREIGN KEY FK_7E27AC0DDB38439E');
        $this->addSql('DROP INDEX IDX_7E27AC0DDB38439E ON reserva_spinning');
        $this->addSql('ALTER TABLE reserva_spinning DROP usuario_id');
    }
}
