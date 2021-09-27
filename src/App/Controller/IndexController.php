<?php
declare(strict_types=1);

namespace App\Controller;

use App\DB;

final class IndexController
{
    public function doRun(): void
    {
        $environment = getenv('APPLICATION_ENV') ?: 'development';

        echo "<p>Environment: $environment</p>";

        echo '<p>Hello, world!</p>';

        $result = DB::connection()->executeQuery('SELECT * FROM users');
        foreach ($result->fetchAllAssociative() as $record) {
            var_dump($record);
        }
    }
}
