<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Utils\Rector\Rector\AddServerRequestArgumentRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig
        ->importNames();
    $rectorConfig
        ->rule(AddServerRequestArgumentRector::class);
};
