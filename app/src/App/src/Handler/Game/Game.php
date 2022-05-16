<?php

declare(strict_types=1);

namespace App\Handler\Game;

use DateTime;

class Game
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly int $playerMin,
        private readonly int $playerMax,
        private readonly int $startAge,
        private readonly int $played,
        private readonly ?DateTime $playedLast,
        private readonly DateTime $createdAt,
        private readonly DateTime $updatedAt,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlayed(): int
    {
        return $this->played;
    }

    public function getPlayedLast(): DateTime
    {
        return $this->playedLast;
    }

    public function getPlayerMin(): int
    {
        return $this->playerMin;
    }

    public function getPlayerMax(): int
    {
        return $this->playerMax;
    }

    public function getStartAge(): int
    {
        return $this->startAge;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
