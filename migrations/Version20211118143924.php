<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118143924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat ADD demande_contart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499934CED91D9 FOREIGN KEY (demande_contart_id) REFERENCES demande_contart (id)');
        $this->addSql('CREATE INDEX IDX_603499934CED91D9 ON contrat (demande_contart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499934CED91D9');
        $this->addSql('DROP INDEX IDX_603499934CED91D9 ON contrat');
        $this->addSql('ALTER TABLE contrat DROP demande_contart_id');
    }
}
