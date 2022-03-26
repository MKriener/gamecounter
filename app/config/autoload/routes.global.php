<?php

declare(strict_types=1);

return [
    'dependencies' => [
        //..
        'invokables' => [
            /* ... */
            // Comment out or remove the following line:
            Mezzio\Router\RouterInterface::class => Mezzio\Router\FastRouteRouter::class,
            /* ... */
        ],
        'factories' => [
            /* ... */
            // Add this line; the specified factory now creates the router instance:
            Mezzio\Router\RouterInterface::class => Mezzio\Router\FastRouteRouterFactory::class,
            /* ... */
        ],
    ],

    // Add the following to enable caching support:
    'router' => [
        'fastroute' => [
            // Enable caching support:
            'cache_enabled' => true,
            // Optional (but recommended) cache file path:
            'cache_file'    => 'data/cache/fastroute.php.cache',
        ],
    ],
];
