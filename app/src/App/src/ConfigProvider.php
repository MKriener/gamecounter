<?php

declare(strict_types=1);

namespace App;

use App\Database\ConnectionFactory;
use App\Handler\Authorization\AuthenticationMiddleware;
use App\Handler\Authorization\UserRepository;
use App\Handler\Game\Create\GameCreateHandler;
use App\Handler\Game\Create\GameCreateInputFilter;
use App\Handler\Game\Create\GameCreateMiddleware;
use App\Handler\Game\Delete\GameDeleteHandler;
use App\Handler\Game\GameNameInputFilter;
use App\Handler\Game\GamePersister;
use App\Handler\Game\GameRemover;
use App\Handler\Game\GameRepository;
use App\Handler\Game\Read\GameReadHandler;
use App\Handler\Game\Read\GameReadMiddleware;
use App\Handler\Game\Read\GamesReadInputFilter;
use App\Handler\Game\Read\GamesReadMiddleware;
use App\Handler\Game\Read\GamesReadHandler;
use App\Handler\Game\Update\GamePlayedHandler;
use App\Handler\Game\Update\GamePlayedInputFilter;
use App\Handler\Game\Update\GamePlayedMiddleware;
use App\Handler\Game\Update\GameUpdateHandler;
use App\Handler\Game\Update\GameUpdateInputFilter;
use App\Handler\Game\Update\GameUpdateMiddleware;
use App\Handler\PingHandler;
use Doctrine\DBAL\Connection;
use Laminas\InputFilter\InputFilterPluginManager;
use Psr\Container\ContainerInterface;
use Whoops\Handler\Handler;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return mixed[]
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                PingHandler::class => PingHandler::class,
                UserRepository::class => UserRepository::class,
            ],
            'factories'  => [
                Connection::class              => ConnectionFactory::class,

                GameCreateMiddleware::class => static fn (ContainerInterface $container) => new GameCreateMiddleware(
                        $container->get(InputFilterPluginManager::class)->get(GameCreateInputFilter::class)
                ),
                GameCreateHandler::class => static fn (ContainerInterface $container) => new GameCreateHandler(
                        $container->get(GamePersister::class),
                        $container->get(GameRepository::class),
                ),
                GamePlayedMiddleware::class => static fn (ContainerInterface $container) => new GamePlayedMiddleware(
                    $container->get(InputFilterPluginManager::class)->get(GamePlayedInputFilter::class)
                ),
                GamePlayedHandler::class => static fn (ContainerInterface $container) => new GamePlayedHandler(
                    $container->get(GameRepository::class),
                    $container->get(GamePersister::class),
                ),
                GameUpdateMiddleware::class => static fn (ContainerInterface $container) => new GameUpdateMiddleware(
                    $container->get(InputFilterPluginManager::class)->get(GameUpdateInputFilter::class)
                ),
                GameUpdateHandler::class => static fn (ContainerInterface $container) => new GameUpdateHandler(
                    $container->get(GameRepository::class),
                    $container->get(GamePersister::class),
                ),
                GamesReadHandler::class => static fn (ContainerInterface $container) => new GamesReadHandler(
                    $container->get(GameRepository::class)
                ),
                GamesReadMiddleware::class => static fn (ContainerInterface $container) => new GamesReadMiddleware(
                    $container->get(InputFilterPluginManager::class)->get(GamesReadInputFilter::class)
                ),
                GameReadHandler::class => static fn(ContainerInterface $container) => new GameReadHandler(
                    $container->get(GameRepository::class)
                ),
                GameDeleteHandler::class => static fn(ContainerInterface $container) => new GameDeleteHandler(
                    $container->get(GameRemover::class)
                ),
                GamePersister::class => static fn (ContainerInterface $container) => new GamePersister(
                        $container->get(Connection::class)
                ),
                GameRepository::class => static fn(ContainerInterface $container) => new GameRepository(
                    $container->get(Connection::class)
                ),
                GameRemover::class => static fn(ContainerInterface $container) => new GameRemover(
                    $container->get(Connection::class)
                ),
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return mixed[]
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
