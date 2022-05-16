<?php

declare(strict_types=1);

namespace App\Handler\Game\Read;

use App\Handler\Game\Game;
use App\Handler\Game\GameRepository;
use App\Handler\Game\GameResponse;
use App\Handler\Game\GamesResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function array_map;
use function assert;

class GamesReadHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly GameRepository $gameRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $gamesRequest = $request->getAttribute(GamesReadRequest::class);

        assert($gamesRequest instanceof GamesReadRequest);

        $games = $this->gameRepository->getAll();

        $gameResponses = array_map(static fn (Game $game): GameResponse => GameResponse::createFromGame($game), $games);

        return new JsonResponse(new GamesResponse(...$gameResponses));
    }
}
