<?php

declare(strict_types=1);

namespace App\Handler\Game;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

class GamePersister
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function persist(Game $game): void
    {
        $this->connection->executeQuery(
            <<<'SQL'
                INSERT INTO games (
                   `name`, 
                   played, 
                   played_last, 
                   player_min, 
                   player_max, 
                   start_age, 
                   `description`, 
                   created_at, 
                   updated_at                
                ) VALUES (
                  :name,
                  :played,
                  :playedLast,
                  :playerMin,        
                  :playerMax,
                  :startAge,
                  :description,
                   CURRENT_TIMESTAMP,       
                   CURRENT_TIMESTAMP       
                ) ON DUPLICATE KEY UPDATE 
                    played = :played,
                    played_last = :playedLast,
                    player_min = :playerMin,
                    player_max = :playerMax,
                    start_age = :startAge,
                    `description` = :description,
                    updated_at = UTC_TIMESTAMP                                          
                SQL,
            [
                'name'         => $game->getName(),
                'played'       => $game->getPlayed(),
                'playedLast'   => $game->getPlayedLast(),
                'playerMin'    => $game->getPlayerMin(),
                'playerMax'    => $game->getPlayerMax(),
                'startAge'     => $game->getStartAge(),
                'description' => $game->getDescription(),
            ],
            [
                'name'         => Types::STRING,
                'played'       => Types::INTEGER,
                'playedLast'   => Types::DATE_MUTABLE,
                'playerMin'    => Types::INTEGER,
                'playerMax'    => Types::INTEGER,
                'startAge'     => Types::INTEGER,
                'description'  => Types::STRING,
            ]
        );
    }

    public function incrementPlayed(Game $game): void
    {
        $this->connection->executeQuery(
            <<<'SQL'
                UPDATE games 
                SET played = played + :played,
                    played_last = :playedLast,
                    updated_at = UTC_TIMESTAMP
                WHERE name = :name
                SQL,
            [
                'name' => $game->getName(),
                'playedLast' => $game->getPlayedLast(),
                'played' => $game->getPlayed(),
            ],
            [
                'name' => Types::STRING,
                'playedLast' => Types::DATE_MUTABLE,
                'played' => Types::INTEGER,
            ]
        );
    }
}
