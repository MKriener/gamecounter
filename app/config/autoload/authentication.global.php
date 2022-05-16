<?php

declare(strict_types=1);

use App\Handler\Authorization\UserRepository;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\Basic\BasicAccess;
use Mezzio\Authentication\UserRepositoryInterface;

return [
    'dependencies' => [
        'aliases' => [
            // Use the default PdoDatabase user repository. This assumes
            // you have configured that service correctly.
            UserRepositoryInterface::class => UserRepository::class,

            // Tell mezzio-authentication to use the BasicAccess
            // adapter:
            AuthenticationInterface::class => BasicAccess::class,
        ],
    ],
    'authentication' => [
        'realm' => 'api',
    ],
];
