<?php

declare(strict_types=1);

/**
 * Global helper functions — loaded once in public/index.php.
 *
 * These are plain PHP functions you can call anywhere in the app:
 * controllers, views, components, models, middleware...
 *
 * Available functions:
 *   env($key, $default)      → read a .env value        (config())
 *   e($value)                → escape HTML output
 *   redirect($path)          → send a Location header + stop
 *   url($path)               → prefix a path with APP_URL
 *   csrf_token() / csrf_field() / csrf_verify()
 *   old($key)                → previous form input
 *   flash($key, $value) / flash_get($key)
 */

/* ------------------------------------------------------------
 * Config
 * ---------------------------------------------------------- */

if (!function_exists('env')) {
    /**
     * Read a value from .env (falls back to real env vars, then $default).
     */
    function env(string $key, mixed $default = null): mixed
    {
        return \App\Core\Config::get($key, $default);
    }
}

/* ------------------------------------------------------------
 * Output / escaping
 * ---------------------------------------------------------- */

if (!function_exists('e')) {
    /**
     * Escape a value for safe HTML output (prevents XSS).
     */
    function e(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

/* ------------------------------------------------------------
 * HTTP helpers
 * ---------------------------------------------------------- */

if (!function_exists('redirect')) {
    /**
     * Redirect to another path and stop execution.
     */
    function redirect(string $path): never
    {
        header('Location: ' . $path);
        exit;
    }
}

if (!function_exists('url')) {
    /**
     * Build a full URL from the APP_URL in .env.
     */
    function url(string $path = ''): string
    {
        return rtrim((string) env('APP_URL', ''), '/') . '/' . ltrim($path, '/');
    }
}

/* ------------------------------------------------------------
 * CSRF protection (simple token in session)
 * ---------------------------------------------------------- */

if (!function_exists('csrf_token')) {
    /**
     * Get (or create) the CSRF token for this session.
     */
    function csrf_token(): string
    {
        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf'];
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Hidden input to put inside every <form method="post">.
     */
    function csrf_field(): string
    {
        return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
    }
}

if (!function_exists('csrf_verify')) {
    /**
     * Verify the submitted _token against the session token.
     * Stops with 419 if it doesn't match.
     */
    function csrf_verify(): void
    {
        $token = $_POST['_token'] ?? '';

        if (!is_string($token) || !hash_equals($_SESSION['_csrf'] ?? '', $token)) {
            http_response_code(419);
            exit('CSRF token mismatch.');
        }
    }
}

/* ------------------------------------------------------------
 * Old input & flash messages
 * ---------------------------------------------------------- */

if (!function_exists('old')) {
    /**
     * Get a previously submitted input value (after a redirect back).
     */
    function old(string $key, mixed $default = ''): mixed
    {
        return $_SESSION['_old'][$key] ?? $default;
    }
}

if (!function_exists('flash')) {
    /**
     * Store a message to show on the next request.
     */
    function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }
}

if (!function_exists('flash_get')) {
    /**
     * Read + clear a flash message.
     */
    function flash_get(string $key, mixed $default = null): mixed
    {
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);

        return $value;
    }
}
