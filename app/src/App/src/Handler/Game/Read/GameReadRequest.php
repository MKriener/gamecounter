<?php

declare(strict_types=1);

namespace App\Handler\Game\Read;

class GameReadRequest
{
    public function __construct(
        private readonly string $name,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
