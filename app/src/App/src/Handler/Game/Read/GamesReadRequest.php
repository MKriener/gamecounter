<?php

declare(strict_types=1);

namespace App\Handler\Game\Read;

use DateTime;

class GamesReadRequest
{
    public function __construct(
        private readonly ?string $name,
        private readonly ?int $played,
        private readonly ?int $playerMin,
        private readonly ?int $playerMax,
        private readonly ?int $startAge,
        private readonly ?DateTime $playedLast,
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPlayed(): ?int
    {
        return $this->played;
    }

    public function getPlayerMin(): ?int
    {
        return $this->playerMin;
    }

    public function getPlayerMax(): ?int
    {
        return $this->playerMax;
    }

    public function getStartAge(): ?int
    {
        return $this->startAge;
    }

    public function getPlayedLast(): ?DateTime
    {
        return $this->playedLast;
    }
}
