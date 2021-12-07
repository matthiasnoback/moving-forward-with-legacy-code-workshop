<?php

declare(strict_types=1);

use App\RequestHandler;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$request = ServerRequestFactory::fromGlobals();

$requestHandler = new RequestHandler();
$response = $requestHandler->handle($request);

(new SapiEmitter())->emit($response);
