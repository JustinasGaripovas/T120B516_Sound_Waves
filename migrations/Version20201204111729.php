<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204111729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751D46931BB');
        $this->addSql('DROP INDEX IDX_32993751D46931BB ON score');
        $this->addSql('ALTER TABLE score ADD sound_package_id_id INT DEFAULT NULL, DROP soung_package_id_id');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751C5145BC2 FOREIGN KEY (sound_package_id_id) REFERENCES sound_package (id)');
        $this->addSql('CREATE INDEX IDX_32993751C5145BC2 ON score (sound_package_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751C5145BC2');
        $this->addSql('DROP INDEX IDX_32993751C5145BC2 ON score');
        $this->addSql('ALTER TABLE score ADD soung_package_id_id INT NOT NULL, DROP sound_package_id_id');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751D46931BB FOREIGN KEY (soung_package_id_id) REFERENCES sound_package (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_32993751D46931BB ON score (soung_package_id_id)');
    }
}
