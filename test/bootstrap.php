<?php

use App\DB;

require __DIR__ . '/../vendor/autoload.php';

DB::dropDb();
DB::importFile(__DIR__ . '/../resources/db_structure.sql');
