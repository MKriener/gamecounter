<?php

declare(strict_types=1);

namespace App\Handler\Game;

use JsonSerializable;

use function count;

class GamesResponse implements JsonSerializable
{
    /** splat operator allows strings since 8.1 */
    /** @var array<int|string, GameResponse> */
    private array $gameResponses;

    public function __construct(GameResponse ...$gameResponses)
    {
        $this->gameResponses = $gameResponses;
    }

    /**
     * @return array<string, int|array<int|string, GameResponse>>
     */
    public function jsonSerialize(): array
    {
        return [
            'count' => count($this->gameResponses),
            'games' => $this->gameResponses,
        ];
    }
}
