<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Utils\Rector\Rector\AddServerRequestArgumentRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(AddServerRequestArgumentRector::class);
    $rectorConfig->importNames();
};
