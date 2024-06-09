<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
            __DIR__ . '/src',
            __DIR__ . '/test',
            __DIR__ . '/utils',
            __DIR__ . '/public',
            __DIR__ . '/rector.php',
            __DIR__ . '/setup_db.php',
            __DIR__ . '/ecs.php',
        ]
    )
    ->withImportNames()
    ->withRules([
        // e.g. \Utils\Rector\AddServerRequestArgumentRector::class
    ]);
