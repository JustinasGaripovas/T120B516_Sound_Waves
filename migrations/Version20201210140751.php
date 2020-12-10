<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210140751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score ADD sound_file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375191F9F813 FOREIGN KEY (sound_file_id) REFERENCES sound_package (id)');
        $this->addSql('CREATE INDEX IDX_3299375191F9F813 ON score (sound_file_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_3299375191F9F813');
        $this->addSql('DROP INDEX IDX_3299375191F9F813 ON score');
        $this->addSql('ALTER TABLE score DROP sound_file_id');
    }
}
