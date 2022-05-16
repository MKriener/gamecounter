<?php

declare(strict_types=1);

namespace App\Handler\Game\Update;

use DateTime;

class GameUpdateRequest
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly int $playerMin,
        private readonly int $playerMax,
        private readonly int $startAge,
        private readonly int $played,
        private readonly DateTime $playedLast
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
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

    public function getPlayed(): int
    {
        return $this->played;
    }

    public function getPlayedLast(): DateTime
    {
        return $this->playedLast;
    }
}
