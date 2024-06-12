<?php

declare(strict_types=1);

namespace App\Controller;

use App\ControllerResponse;
use App\DB;
use App\Output;
use Psr\Http\Message\ServerRequestInterface;

final class IndexController
{
    public function doRun(ServerRequestInterface $request): ControllerResponse
    {
        return Output::captureAndCollectHeaders(function (ControllerResponse $response) use ($request) {
            $environment = getenv('APPLICATION_ENV') ?: 'development';

            $response->addHeader('Content-Type: text/html');
            $response->addHeader('X-Php-Env: ' . $environment);

            $username = $request->getQueryParams()['username'] ?? 'world'; ?><html lang="en">
            <body>
            <p>Environment: <?php echo htmlspecialchars($environment, ENT_QUOTES); ?></p>
            <p>Hello, <?php echo htmlspecialchars((string) $username, ENT_QUOTES); ?>!</p>
            <form action="/" method="get">
                <label for="username">Your name:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars((string) $username, ENT_QUOTES); ?>">
                <button type="submit">Send</button>
            </form>
            <?php
            $result = DB::connection()->executeQuery('SELECT * FROM users');
            foreach ($result->fetchAllAssociative() as $record) {
                var_dump($record);
            } ?>
            </body>
            </html>
            <?php
        });
    }
}
