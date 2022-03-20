<?php

declare(strict_types=1);

namespace App\Handler\Game;

use DateTime;
use JsonSerializable;

class GameResponse implements JsonSerializable
{
    public function __construct(
        private readonly string $name,
        private readonly int $played,
        private readonly string $description,
        private readonly int $playerMin,
        private readonly int $playerMax,
        private readonly int $startAge,
        private readonly DateTime $playedLast,
    ) {
    }

    public static function createFromGame(Game $game): self
    {
        return new self(
            $game->getName(),
            $game->getPlayed(),
            $game->getDescription(),
            $game->getPlayerMin(),
            $game->getPlayerMax(),
            $game->getStartAge(),
            $game->getPlayedLast(),
        );
    }

    /**
     * @return array<string, string|int>
     */
    public function jsonSerialize(): array
    {
        return [
            'name'        => $this->name,
            'played'      => $this->played,
            'description' => $this->description,
            'playerMin'   => $this->playerMin,
            'playerMax'   => $this->playerMax,
            'playedLast'  => $this->playedLast->format('Y-m-d'),
            'startAge'    => $this->startAge,
        ];
    }
}
