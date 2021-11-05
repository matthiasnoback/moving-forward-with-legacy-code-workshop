<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(
        Option::PATHS,
        [
            __DIR__ . '/src',
            __DIR__ . '/test',
            __DIR__ . '/utils',
            __DIR__ . '/public',
            __DIR__ . '/rector.php',
            __DIR__ . '/setup_db.php',
            __DIR__ . '/ecs.php',
        ]
    );

    $parameters->set(
        Option::SKIP,
        [
            // Because it makes no sense ;) (well, I just need assertEquals())
            PhpUnitStrictFixer::class,
        ]
    );

    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::SYMPLIFY);
};
