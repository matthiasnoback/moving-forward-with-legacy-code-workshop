<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Utils\Rector\CaptureControllerOutputRector;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/utils',
        __DIR__ . '/public',
    ]);

//    $containerConfigurator->import(SetList::CODE_QUALITY);

    $services = $containerConfigurator->services();

    $services->set(CaptureControllerOutputRector::class);
};
