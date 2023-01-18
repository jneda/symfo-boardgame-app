<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117082126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE board_game_category (board_game_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_63A0CC23AC91F10A (board_game_id), INDEX IDX_63A0CC2312469DE2 (category_id), PRIMARY KEY(board_game_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE board_game_category ADD CONSTRAINT FK_63A0CC23AC91F10A FOREIGN KEY (board_game_id) REFERENCES board_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE board_game_category ADD CONSTRAINT FK_63A0CC2312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE board_game_category DROP FOREIGN KEY FK_63A0CC23AC91F10A');
        $this->addSql('ALTER TABLE board_game_category DROP FOREIGN KEY FK_63A0CC2312469DE2');
        $this->addSql('DROP TABLE board_game_category');
    }
}
