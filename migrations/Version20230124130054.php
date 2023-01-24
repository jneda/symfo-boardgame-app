<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124130054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_board_game (user_id INT NOT NULL, board_game_id INT NOT NULL, INDEX IDX_5EDAAE43A76ED395 (user_id), INDEX IDX_5EDAAE43AC91F10A (board_game_id), PRIMARY KEY(user_id, board_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_board_game ADD CONSTRAINT FK_5EDAAE43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_board_game ADD CONSTRAINT FK_5EDAAE43AC91F10A FOREIGN KEY (board_game_id) REFERENCES board_game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_board_game DROP FOREIGN KEY FK_5EDAAE43A76ED395');
        $this->addSql('ALTER TABLE user_board_game DROP FOREIGN KEY FK_5EDAAE43AC91F10A');
        $this->addSql('DROP TABLE user_board_game');
    }
}
