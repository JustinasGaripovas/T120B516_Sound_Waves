<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029203756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sound_package ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sound_package ADD CONSTRAINT FK_DC5AE6EA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_DC5AE6EA12469DE2 ON sound_package (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sound_package DROP FOREIGN KEY FK_DC5AE6EA12469DE2');
        $this->addSql('DROP INDEX IDX_DC5AE6EA12469DE2 ON sound_package');
        $this->addSql('ALTER TABLE sound_package DROP category_id');
    }
}
