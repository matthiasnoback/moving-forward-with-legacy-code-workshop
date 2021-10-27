<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB;

final class IndexController
{
    public function doRun()
    {
        $environment = getenv('APPLICATION_ENV') ?: 'development';

        header('Content-Type: text/html');

        $username = $_GET['username'] ?? 'world';

        ?><html lang="en">
        <body>
        <p>Environment: <?php echo htmlspecialchars($environment, ENT_QUOTES); ?></p>
        <p>Hello, <?php echo htmlspecialchars($username, ENT_QUOTES); ?>!</p>
        <form action="/" method="get">
            <label for="username">Your name:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES); ?>">
            <button type="submit">Send</button>
        </form>
        <?php
        $result = DB::connection()->executeQuery('SELECT * FROM users');
        foreach ($result->fetchAllAssociative() as $record) {
            var_dump($record);
        }
        ?>
        </body>
        </html>
        <?php

        exit;
    }
}
