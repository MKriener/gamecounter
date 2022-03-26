<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'migrations' => [
            'table_storage' => [
                'table_name' => 'doctrine_migration_versions',
                'version_column_name' => 'version',
                'version_column_length' => 1024,
                'executed_at_column_name' => 'executed_at',
                'execution_time_column_name' => 'execution_time',
            ],

            'migrations_paths' => [
                'Migrations' => './src/Migrations',
            ],

            'all_or_nothing' => false,
            'transactional' => true,
            'check_database_platform' => true,
            'organize_migrations' => 'none',
            'connection' => null,
            'em' => null,
        ],
        'connection' => [
            'params' => [
                'driver' => 'pdo_mysql',
                'url' => getenv('DATABASE_URL'),
            ],
        ],
    ],
];
