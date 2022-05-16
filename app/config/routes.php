<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\Helper\BodyParams\BodyParamsMiddleware;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->post(
        '/api/game/create',
        [
            BodyParamsMiddleware::class,
            App\Handler\Game\Create\GameCreateMiddleware::class,
            App\Handler\Game\Create\GameCreateHandler::class,
        ],
        'api.game.create'
    );
    $app->put(
        '/api/game/played',
        [
            BodyParamsMiddleware::class,
            App\Handler\Game\Update\GamePlayedMiddleware::class,
            App\Handler\Game\Update\GamePlayedHandler::class,
        ],
        'api.game.played'
    );
    $app->put(
        '/api/game/update',
        [
            BodyParamsMiddleware::class,
            App\Handler\Game\Update\GameUpdateMiddleware::class,
            App\Handler\Game\Update\GameUpdateHandler::class,
        ],
        'api.game.update'
    );
    $app->post(
        '/api/games/read',
        [
            BodyParamsMiddleware::class,
            App\Handler\Game\Read\GamesReadMiddleware::class,
            App\Handler\Game\Read\GamesReadHandler::class,
        ],
        'api.games.read'
    );
    $app->get(
        '/api/game/{game}',
        [
            App\Handler\Game\Read\GameReadHandler::class,
        ],
        'api.game.read'
    );
    $app->delete(
        '/api/game/{game}',
        [
            App\Handler\Game\Delete\GameDeleteHandler::class,
        ],
        'api.game.delete'
    );
};
