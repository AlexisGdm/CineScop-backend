<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327121122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
{
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalog (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1B2C32477E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, score INT DEFAULT NULL, review LONGTEXT DEFAULT NULL, INDEX IDX_D88926227E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_activity DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', role VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, birth_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', movies_seen INT DEFAULT NULL, series_seen INT DEFAULT NULL, badge_progress INT DEFAULT NULL, INDEX IDX_8D93D649F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_badge (user_id INT NOT NULL, badge_id INT NOT NULL, INDEX IDX_1C32B345A76ED395 (user_id), INDEX IDX_1C32B345F7A2C2FC (badge_id), PRIMARY KEY(user_id, badge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE catalog ADD CONSTRAINT FK_1B2C32477E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926227E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalog DROP FOREIGN KEY FK_1B2C32477E3C61F9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7E3C61F9');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926227E3C61F9');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345A76ED395');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345F7A2C2FC');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE catalog');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_badge');
    }
}
