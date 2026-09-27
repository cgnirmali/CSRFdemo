<?php

declare(strict_types=1);

/**
 * Front controller — the single entry point for the application.
 *
 * Flow: define paths → autoloader → load routes → dispatch request.
 */

if (PHP_SAPI === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $file = __DIR__ . $requestPath;

    if ($requestPath !== '/' && is_file($file)) {
        return false;
    }
}

define('BASE_PATH', dirname(__DIR__));

/* Simple PSR-4 style autoloader for the App\ namespace (app/ folder). */
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $file = BASE_PATH . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

/**
 * Return the public URL for an asset inside public/assets/.
 */
function asset(string $path): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php')), '/');

    return $base . '/assets/' . ltrim($path, '/');
}

/* Load configuration from the .env file (see app/Core/Config.php). */
\App\Core\Config::load();

/* Load global helper functions: env, e, redirect, csrf, old, flash... */
require BASE_PATH . '/app/Helpers/helpers.php';

/* Start a session (needed for auth, CSRF and flash messages). */
session_name((string) env('SESSION_NAME', 'PHPSESSID'));

if (session_status() === PHP_SESSION_NONE) {
    $sessionSecure = filter_var(
        env('SESSION_SECURE', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        FILTER_VALIDATE_BOOLEAN,
    );

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => $sessionSecure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

$router = new App\Core\Router();

require BASE_PATH . '/routes/web.php';

$router->dispatch(
    $_SERVER['REQUEST_METHOD'] ?? 'GET',
    $_SERVER['REQUEST_URI'] ?? '/',
);
