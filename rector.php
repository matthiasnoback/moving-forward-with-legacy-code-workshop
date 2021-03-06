<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/test',
        __DIR__ . '/utils',
        __DIR__ . '/public',
        __DIR__ . '/rector.php',
        __DIR__ . '/setup_db.php',
        __DIR__ . '/ecs.php',
    ]);
    $parameters->set(Option::SKIP, [
        __DIR__ . '/test/Test/Browser/IndexTest.php', // because of a trait that can't be loaded
    ]);

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $services = $containerConfigurator->services();
    // $services->set(\Utils\Rector\AddServerRequestArgumentRector::class);
};
