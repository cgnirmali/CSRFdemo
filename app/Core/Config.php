<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Config — loads key/value pairs from the .env file (and real env vars)
 * and exposes them through Config::get() / the global env() helper.
 *
 * How it works:
 *   .env is a plain text file with one `KEY=VALUE` per line.
 *   Lines starting with "#" are comments and are ignored.
 *   Values wrapped in quotes have the quotes stripped.
 *
 * Usage:
 *   Config::get('DB_HOST')                 → "127.0.0.1"
 *   Config::get('DB_HOST', '127.0.0.1')    → falls back if missing
 *   env('APP_NAME')                        → same as Config::get()
 */
class Config
{
    /** @var array<string, string> Parsed values from .env */
    private static array $items = [];

    private static bool $loaded = false;

    /**
     * Parse the .env file once (subsequent calls are no-ops).
     */
    public static function load(?string $path = null): void
    {
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;

        $path ??= BASE_PATH . '/.env';

        if (!is_file($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines ?: [] as $line) {
            $line = trim($line);

            // Skip comments and malformed lines.
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key   = trim($key);
            $value = trim($value);

            // Strip surrounding quotes: "value" or 'value' → value
            if (strlen($value) >= 2
                && (($value[0] === '"' && $value[strlen($value) - 1] === '"')
                    || ($value[0] === "'" && $value[strlen($value) - 1] === "'"))) {
                $value = substr($value, 1, -1);
            }

            self::$items[$key] = $value;
        }
    }

    /**
     * Get a config value (checks .env, then real environment variables).
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::load();

        if (array_key_exists($key, self::$items)) {
            return self::$items[$key];
        }

        $env = getenv($key);
        if ($env !== false) {
            return $env;
        }

        return $default;
    }

    /**
     * Return every loaded value (useful for debugging).
     *
     * @return array<string, string>
     */
    public static function all(): array
    {
        self::load();

        return self::$items;
    }
}
