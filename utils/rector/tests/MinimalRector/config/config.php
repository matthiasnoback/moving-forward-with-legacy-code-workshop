<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Utils\Rector\MinimalRector;

return RectorConfig::configure()
    ->withImportNames()
    ->withRules([
        // Register the Rector rule we want to test
        MinimalRector::class
    ]);
