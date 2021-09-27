<?php
declare(strict_types=1);

use App\DB;

require __DIR__ . '/vendor/autoload.php';

DB::dropDb();
DB::importFile(__DIR__ . '/resources/db_structure.sql');
DB::importFile(__DIR__ . '/resources/development_fixtures.sql');
