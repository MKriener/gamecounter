<?php

declare(strict_types=1);

namespace App\Handler\Game;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

class GameRemover
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function removedByName(string $gameName): void
    {
        $this->connection->executeQuery(
            <<<'SQL'
                DELETE FROM games WHERE `name` = :name                         
                SQL,
            [
                'name' => $gameName,
            ],
            [
                'name' => Types::STRING,
            ]
        );
    }
}
