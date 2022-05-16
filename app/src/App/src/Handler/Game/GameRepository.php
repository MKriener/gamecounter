<?php

declare(strict_types=1);

namespace App\Handler\Game;

use DateTime;
use DateTimeZone;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

use function array_map;

class GameRepository
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function findByName(string $gameName): ?Game
    {
        $result = $this->connection->fetchAssociative(
            <<<'SQL'
                SELECT * FROM games WHERE `name` = :name                         
                SQL,
            [
                'name' => $gameName,
            ],
            [
                'name' => Types::STRING,
            ]
        );

        return $result === false ? null : $this->hydrate($result);
    }

    /**
     * @return list<Game>
     */
    public function getAll(): array
    {
        $results = $this->connection->fetchAllAssociative(
            <<<'SQL'
                SELECT * FROM games ORDER BY name
                SQL
        );

        return array_map(fn (array $result) => $this->hydrate($result), $results);
    }

    /**
     * @param mixed[] $result
     */
    private function hydrate(array $result): Game
    {
        return new Game(
            $result['name'],
            $result['description'],
            $result['player_min'],
            $result['player_max'],
            $result['start_age'],
            $result['played'],
            $result['played_last'] === null ? null : new DateTime($result['played_last'], new DateTimeZone('UTC')),
            new DateTime($result['created_at'], new DateTimeZone('UTC')),
            new DateTime($result['updated_at'], new DateTimeZone('UTC')),
        );
    }
}
