<?php
declare(strict_types=1);

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

final class DB
{
    private static ?Connection $connection = null;

    public static function importFile(string $filePathname): void
    {
        $sql = file_get_contents($filePathname);
        $queries = array_filter(
            array_map('trim', explode(';', $sql))
        );
        foreach ($queries as $query) {
            self::connection()->executeQuery($query);
        }
    }

    public static function connection(): Connection
    {
        if (self::$connection === null) {
            self::$connection = DriverManager::getConnection(
                [
                    'driver' => 'pdo_sqlite',
                    'path' => self::sqliteDbFile()
                ]
            );
        }

        return self::$connection;
    }

    public static function dropDb(): void
    {
        if (self::$connection instanceof Connection) {
            self::$connection->close();
            self::$connection = null;
        }

        $dbFile = self::sqliteDbFile();
        if (file_exists($dbFile)) {
            unlink($dbFile);
        }
    }

    private static function sqliteDbFile(): string
    {
        $environment = getenv('APPLICATION_ENV') ?: 'development';

        return __DIR__ . '/../../var/' . $environment . '.sqlite';
    }
}
