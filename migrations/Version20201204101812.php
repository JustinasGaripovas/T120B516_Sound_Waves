<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204101812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, score INT NOT NULL, INDEX IDX_329937519D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sound_file (id INT AUTO_INCREMENT NOT NULL, sound_package_id INT NOT NULL, filename VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C6EA4C8E41AE7C1A (sound_package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sound_package (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, level INT NOT NULL, filename VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DC5AE6EAB03A8386 (created_by_id), INDEX IDX_DC5AE6EA12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937519D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sound_file ADD CONSTRAINT FK_C6EA4C8E41AE7C1A FOREIGN KEY (sound_package_id) REFERENCES sound_package (id)');
        $this->addSql('ALTER TABLE sound_package ADD CONSTRAINT FK_DC5AE6EAB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sound_package ADD CONSTRAINT FK_DC5AE6EA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE profile ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0F9D86650F ON profile (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sound_package DROP FOREIGN KEY FK_DC5AE6EA12469DE2');
        $this->addSql('ALTER TABLE sound_file DROP FOREIGN KEY FK_C6EA4C8E41AE7C1A');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F9D86650F');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937519D86650F');
        $this->addSql('ALTER TABLE sound_package DROP FOREIGN KEY FK_DC5AE6EAB03A8386');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE sound_file');
        $this->addSql('DROP TABLE sound_package');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_8157AA0F9D86650F ON profile');
        $this->addSql('ALTER TABLE profile DROP user_id_id');
    }
}
