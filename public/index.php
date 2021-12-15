<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Laminas\Diactoros\ServerRequestFactory;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$controller = new IndexController();
$request = ServerRequestFactory::fromGlobals();

$responseBody = $controller->doRun($request);
echo $responseBody;
