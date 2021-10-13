<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Utils\Rector\CaptureControllerOutputRector;
use Utils\Rector\CollectHeadersRector;
use Utils\Rector\ReplaceExitWithReturnRector;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/utils',
        __DIR__ . '/public',
    ]);

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $services = $containerConfigurator->services();
//
//    $services->set(ReplaceExitWithReturnRector::class);
//    $services->set(CaptureControllerOutputRector::class);
//    $services->set(CollectHeadersRector::class);
//    $services->set(ReturnTypeFromStrictTypedCallRector::class);
};
