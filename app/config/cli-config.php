<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\Connection;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Psr\Container\ContainerInterface;

$container = require __DIR__ . '/../config/container.php';
assert($container instanceof ContainerInterface);

$conn = $container->get(Connection::class);
$config = $container->get('config')['doctrine']['migrations'];

return DependencyFactory::fromConnection(new ConfigurationArray($config), new ExistingConnection($conn));