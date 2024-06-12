<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Laminas\Diactoros\ServerRequestFactory;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$serverRequest = ServerRequestFactory::fromGlobals();

$controller = new IndexController();
$response = $controller->doRun($serverRequest);
foreach ($response->getHeaders() as $header => $value) {
    header($header . ': ' . $value);
}
echo $response->getContent();
