<?php

declare(strict_types=1);

use App\RequestHandler;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$request = ServerRequestFactory::fromGlobals();

$handler = new RequestHandler();
$response = $handler->handle($request);

$emitter = new SapiEmitter();
$emitter->emit($response);
