<?php
declare(strict_types=1);

namespace App;

use App\Controller\IndexController;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controller = new IndexController();
        $response = $controller->doRun($request);

        return new Response((new StreamFactory())->createStream($response['body']), 200, $response['headers']);
    }
}
