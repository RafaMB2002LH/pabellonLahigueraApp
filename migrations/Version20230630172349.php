<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230630172349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD nombre VARCHAR(255) NOT NULL, ADD apellidos VARCHAR(255) NOT NULL, ADD dni VARCHAR(255) NOT NULL, ADD edad INT NOT NULL, ADD sexo VARCHAR(10) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D7F8F253B ON usuario (dni)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2265B05D7F8F253B ON usuario');
        $this->addSql('ALTER TABLE usuario DROP nombre, DROP apellidos, DROP dni, DROP edad, DROP sexo');
    }
}
