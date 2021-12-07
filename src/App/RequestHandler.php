<?php
declare(strict_types=1);

namespace App;

use App\Controller\IndexController;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controller = new IndexController();
        list($body, $headers) = $controller->doRun($request);

        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse()->withBody(
            (new StreamFactory())->createStream($body)
        );
        foreach ($headers as $key => $value) {
            $response = $response->withHeader($key, $value);
        }

        return $response;
    }
}
