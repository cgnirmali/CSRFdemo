<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Database — a tiny PDO wrapper.
 *
 * The connection is created lazily: nothing happens until you
 * actually call Database::connection(). Credentials come from
 * the .env file via Config.
 *
 * Usage:
 *   $pdo = Database::connection();                 // PDO instance (shared)
 *   $pdo->query('SELECT * FROM users');            // raw queries
 *   Database::connection()->prepare(...);          // prepared statements
 */
class Database
{
    private static ?PDO $pdo = null;

    /**
     * Get the shared PDO connection (singleton).
     */
    public static function connection(): PDO
    {
        if (self::$pdo === null) {
            $host    = (string) Config::get('DB_HOST', '127.0.0.1');
            $port    = (string) Config::get('DB_PORT', '3306');
            $name    = (string) Config::get('DB_NAME', '');
            $user    = (string) Config::get('DB_USER', 'root');
            $pass    = (string) Config::get('DB_PASS', '');
            $charset = (string) Config::get('DB_CHARSET', 'utf8mb4');

            $dsn = "mysql:host={$host};port={$port};dbname={$name};charset={$charset}";

            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throw on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // rows as arrays
                PDO::ATTR_EMULATE_PREPARES   => false,                  // real prepared statements
            ]);
        }

        return self::$pdo;
    }
}
