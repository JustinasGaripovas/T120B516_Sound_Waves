<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007151422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sound_file (id INT AUTO_INCREMENT NOT NULL, sound_package_id INT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C6EA4C8E41AE7C1A (sound_package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sound_package (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, sound_package_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DC5AE6EAB03A8386 (created_by_id), INDEX IDX_DC5AE6EA41AE7C1A (sound_package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password_encoded VARCHAR(255) NOT NULL, role JSON DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sound_file ADD CONSTRAINT FK_C6EA4C8E41AE7C1A FOREIGN KEY (sound_package_id) REFERENCES sound_package (id)');
        $this->addSql('ALTER TABLE sound_package ADD CONSTRAINT FK_DC5AE6EAB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sound_package ADD CONSTRAINT FK_DC5AE6EA41AE7C1A FOREIGN KEY (sound_package_id) REFERENCES sound_package (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sound_file DROP FOREIGN KEY FK_C6EA4C8E41AE7C1A');
        $this->addSql('ALTER TABLE sound_package DROP FOREIGN KEY FK_DC5AE6EA41AE7C1A');
        $this->addSql('ALTER TABLE sound_package DROP FOREIGN KEY FK_DC5AE6EAB03A8386');
        $this->addSql('DROP TABLE sound_file');
        $this->addSql('DROP TABLE sound_package');
        $this->addSql('DROP TABLE user');
    }
}
