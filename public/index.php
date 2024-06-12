<?php

declare(strict_types=1);

use App\RequestHandler;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$serverRequest = ServerRequestFactory::fromGlobals();

$handler = new RequestHandler();
$response = $handler->handle($serverRequest);

(new SapiEmitter())->emit($response);
