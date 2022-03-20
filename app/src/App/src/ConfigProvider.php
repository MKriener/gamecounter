<?php

declare(strict_types=1);

namespace App;

use App\Database\ConnectionFactory;
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
use Doctrine\DBAL\Connection;
use Laminas\InputFilter\InputFilterPluginManager;
use Psr\Container\ContainerInterface;

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
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Connection::class              => ConnectionFactory::class,
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
