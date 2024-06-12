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
        $controllerResponse = $controller->doRun($request);

        $response = (new ResponseFactory())->createResponse()->withBody(
            (new StreamFactory())->createStream($controllerResponse->getContent())
        );

        foreach ($controllerResponse->getHeaders() as $header => $value) {
            $response = $response->withHeader($header, $value);
        }

        return $response;
    }
}
