<?php
return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => getenv('DATABASE_URL'),
    ],
];