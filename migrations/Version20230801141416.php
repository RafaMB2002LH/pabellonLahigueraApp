<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801141416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bicicleta DROP FOREIGN KEY FK_5E05AF27C9211093');
        $this->addSql('DROP INDEX UNIQ_5E05AF27C9211093 ON bicicleta');
        $this->addSql('ALTER TABLE bicicleta DROP reserva_spinning_id');
        $this->addSql('ALTER TABLE reserva_spinning DROP FOREIGN KEY FK_7E27AC0D2B6C1A2');
        $this->addSql('DROP INDEX IDX_7E27AC0D2B6C1A2 ON reserva_spinning');
        $this->addSql('ALTER TABLE reserva_spinning DROP bicicleta_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bicicleta ADD reserva_spinning_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bicicleta ADD CONSTRAINT FK_5E05AF27C9211093 FOREIGN KEY (reserva_spinning_id) REFERENCES reserva_spinning (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E05AF27C9211093 ON bicicleta (reserva_spinning_id)');
        $this->addSql('ALTER TABLE reserva_spinning ADD bicicleta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reserva_spinning ADD CONSTRAINT FK_7E27AC0D2B6C1A2 FOREIGN KEY (bicicleta_id) REFERENCES bicicleta (id)');
        $this->addSql('CREATE INDEX IDX_7E27AC0D2B6C1A2 ON reserva_spinning (bicicleta_id)');
    }
}
