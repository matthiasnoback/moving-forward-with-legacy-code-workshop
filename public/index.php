<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Laminas\Diactoros\ServerRequestFactory;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$serverRequest = ServerRequestFactory::fromGlobals();

$controller = new IndexController();
[$content, $headers] = $controller->doRun($serverRequest);
foreach ($headers as $header) {
    header($header);
}
echo $content;
