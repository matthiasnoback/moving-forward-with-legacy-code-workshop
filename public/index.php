<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$controller = new IndexController();
$controller->doRun();
