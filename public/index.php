<?php

declare(strict_types=1);

use App\RequestHandler;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Symfony\Component\ErrorHandler\Debug;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

// See https://docs.laminas.dev/laminas-httphandlerrunner/usage/
$runner = new RequestHandlerRunner(
    new RequestHandler(),
    new SapiEmitter(),
    [ServerRequestFactory::class, 'fromGlobals'],
    fn (Throwable $throwable) => throw $throwable
);
$runner->run();
