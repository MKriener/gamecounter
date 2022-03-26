#!/usr/bin/env php
<?php

use Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$container = require __DIR__ . '/../config/container.php';
assert($container instanceof ContainerInterface);

exit($container->get(Application::class)->run());