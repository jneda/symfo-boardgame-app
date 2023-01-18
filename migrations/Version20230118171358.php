<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118171358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE board_game (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, player_count VARCHAR(15) NOT NULL, duration_minutes INT NOT NULL, min_age INT NOT NULL, publication_date DATE NOT NULL, description LONGTEXT NOT NULL, contents LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board_game_category (board_game_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_63A0CC23AC91F10A (board_game_id), INDEX IDX_63A0CC2312469DE2 (category_id), PRIMARY KEY(board_game_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE board_game_category ADD CONSTRAINT FK_63A0CC23AC91F10A FOREIGN KEY (board_game_id) REFERENCES board_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE board_game_category ADD CONSTRAINT FK_63A0CC2312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE board_game_category DROP FOREIGN KEY FK_63A0CC23AC91F10A');
        $this->addSql('ALTER TABLE board_game_category DROP FOREIGN KEY FK_63A0CC2312469DE2');
        $this->addSql('DROP TABLE board_game');
        $this->addSql('DROP TABLE board_game_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
