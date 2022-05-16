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

class GameUpdateHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly GamePersister $gamePersister,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $gameUpdateRequest = $request->getAttribute(GameUpdateRequest::class);

        assert($gameUpdateRequest instanceof GameUpdateRequest);

        $game = $this->gameRepository->findByName($gameUpdateRequest->getName());

        if ($game === null) {
            return new JsonResponse([sprintf('Could not find game %s', $gameUpdateRequest->getName())]);
        }

        $gameToUpdate = new Game(
            $gameUpdateRequest->getName(),
            $gameUpdateRequest->getDescription(),
            $gameUpdateRequest->getPlayerMin(),
            $gameUpdateRequest->getPlayerMax(),
            $gameUpdateRequest->getStartAge(),
            $gameUpdateRequest->getPlayed(),
            $gameUpdateRequest->getPlayedLast(),
            $game->getCreatedAt(),
            $game->getUpdatedAt(),
        );

        $this->gamePersister->persist($gameToUpdate);

        return new JsonResponse(['Updated']);
    }
}
