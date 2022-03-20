<?php

declare(strict_types=1);

namespace App\Handler\Game\Update;

use DateTime;

class GamePlayedRequest
{
    public function __construct(
        private readonly string $name,
        private readonly ?int $played,
        private readonly DateTime $playedLast,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlayed(): ?int
    {
        return $this->played;
    }

    public function getPlayedLast(): DateTime
    {
        return $this->playedLast;
    }
}
