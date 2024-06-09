<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([__DIR__ . '/src', __DIR__ . '/test', __DIR__ . '/utils', __DIR__ . '/public'])
    ->withRootFiles()
    ->withPreparedSets(psr12: true, symplify: true, controlStructures: true,);
