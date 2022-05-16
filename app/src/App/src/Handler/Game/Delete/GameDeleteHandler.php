<?php

declare(strict_types=1);

namespace App\Handler\Game\Delete;

use App\Handler\Game\GameRemover;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function strlen;

class GameDeleteHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly GameRemover $gameRemover,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $game = $request->getAttribute('game');

        if (strlen($game) === 0) {
            return new JsonResponse('Game should not be blank');
        }

        $this->gameRemover->removedByName($game);

        return new JsonResponse(['Removed game.'], 204);
    }
}
