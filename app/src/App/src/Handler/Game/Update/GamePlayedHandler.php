<?php

declare(strict_types=1);

namespace App\Handler\Game\Update;

use App\Handler\Game\Game;
use App\Handler\Game\GamePersister;
use App\Handler\Game\GameRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;
use function sprintf;

class GamePlayedHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly GamePersister $gamePersister,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $gamePlayedRequest = $request->getAttribute(GamePlayedRequest::class);

        assert($gamePlayedRequest instanceof GamePlayedRequest);

        $game = $this->gameRepository->findByName($gamePlayedRequest->getName());

        if ($game === null) {
            return new JsonResponse([sprintf('Could not found game %s', $gamePlayedRequest->getName())]);
        }

        $gameToIncrement = new Game(
            $game->getName(),
            $game->getDescription(),
            $game->getPlayerMin(),
            $game->getPlayerMax(),
            $game->getStartAge(),
            $gamePlayedRequest->getPlayed(),
            $gamePlayedRequest->getPlayedLast(),
            $game->getCreatedAt(),
            $game->getUpdatedAt(),
        );

        $this->gamePersister->incrementPlayed($gameToIncrement);

        return new JsonResponse(['Incremented']);
    }
}
