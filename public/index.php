<?php

declare(strict_types=1);

use App\RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Symfony\Component\ErrorHandler\Debug;

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
