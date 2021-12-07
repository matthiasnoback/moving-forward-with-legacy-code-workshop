<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$controller = new IndexController();
list($body, $headers) = $controller->doRun($request);
foreach ($headers as $key => $value) {
    header($key . ': ' . $value);
}
echo $body;
