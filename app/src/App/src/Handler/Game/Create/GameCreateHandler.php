<?php

declare(strict_types=1);

namespace App\Handler\Game\Create;

use App\Handler\Game\Game;
use App\Handler\Game\GamePersister;
use App\Handler\Game\GameRepository;
use DateTime;
use DateTimeZone;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

class GameCreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly GamePersister $gamePersister,
        private readonly GameRepository $gameRepository
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $gameRequest = $request->getAttribute(GameCreateRequest::class);

        assert($gameRequest instanceof GameCreateRequest);

        $currentTime = new DateTime('now', new DateTimeZone('UTC'));

        $game = new Game(
            $gameRequest->getName(),
            $gameRequest->getDescription(),
            $gameRequest->getPlayerMin(),
            $gameRequest->getPlayerMax(),
            $gameRequest->getStartAge(),
            $gameRequest->getPlayed(),
            $currentTime,
            $currentTime,
            $currentTime,
        );

        $gameSearched = $this->gameRepository->findByName($gameRequest->getName());

        if ($gameSearched === null) {
            return new JsonResponse(['Game still exists']);
        }

        $this->gamePersister->persist(
            $game
        );

        return new JsonResponse(['Created Game']);
    }
}
