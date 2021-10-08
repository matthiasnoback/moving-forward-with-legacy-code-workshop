<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Utils\Rector\CaptureControllerOutputRector;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $services = $containerConfigurator->services();
    $services->set(CaptureControllerOutputRector::class);
    $services->set(ReturnTypeFromStrictTypedCallRector::class);

};
