<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([__DIR__ . '/src', __DIR__ . '/test', __DIR__ . '/utils', __DIR__ . '/public', ])
    ->withRootFiles()
    ->withPreparedSets(codeQuality: true)
    ->withPhpSets(php82: true)
    ->withImportNames()
    ->withRules([
        // e.g. \Utils\Rector\AddServerRequestArgumentRector::class
    ]);
