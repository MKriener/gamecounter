<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220326174408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CG-1-crud-games create games table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
                CREATE TABLE games (
                    `name` VARCHAR(255) NOT NULL,
                    played INTEGER NOT NULL DEFAULT 0,
                    played_last DATE NULL DEFAULT NULL,
                    player_min INTEGER NOT NULL,
                    player_max INTEGER NOT NULL,
                    start_age INTEGER NOT NULL,
                    `description` TINYTEXT,
                    created_at DATETIME NOT NULL ,
                    updated_at DATETIME NOT NULL,
                    UNIQUE INDEX (`name`),
                    PRIMARY KEY(`name`)
                ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
                SQL
        );
    }
}
