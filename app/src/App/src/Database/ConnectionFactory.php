<?php

declare(strict_types=1);

namespace App\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Psr\Container\ContainerInterface;

class ConnectionFactory
{
    public function __invoke(ContainerInterface $container): Connection
    {
        $connectionParams = (array) $container->get('config')['doctrine']['connection']['params'];

        return DriverManager::getConnection($connectionParams);
    }
}