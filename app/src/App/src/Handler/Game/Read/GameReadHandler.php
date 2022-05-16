<?php

declare(strict_types=1);

namespace App\Handler\Game\Read;

use App\Handler\Game\GameRepository;
use App\Handler\Game\GameResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function sprintf;
use function strlen;

class GameReadHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly GameRepository $gameRepository
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $game = $request->getAttribute('game');

        if (strlen($game) === 0) {
            return new JsonResponse('Game should not be blank');
        }

        $game = $this->gameRepository->findByName($game);

        if ($game === null) {
            return new JsonResponse(sprintf('Could not find game "%s".', $game));
        }

        return new JsonResponse(GameResponse::createFromGame($game));
    }
}
