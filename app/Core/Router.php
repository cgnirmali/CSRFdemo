<?php

declare(strict_types=1);

namespace App\Core;

use App\Middleware\Middleware;

/**
 * Minimal HTTP router.
 * Registers routes and dispatches a request to a controller action,
 * running any attached middleware first.
 *
 * Usage:
 *   $router->get('/', 'HomeController@index');
 *   $router->get('/admin', 'Admin\DashboardController@index')->middleware('auth');
 */
class Router
{
    /** @var array<string, array<string, string>> */
    private array $routes = [];

    /** @var array<string, array<string, list<string>>> Route middleware (FQCNs) */
    private array $routeMiddleware = [];

    /** Alias → middleware class name. Add your own here. */
    private array $middlewareAliases = [
        'auth'  => \App\Middleware\AuthMiddleware::class,
        'guest' => \App\Middleware\GuestMiddleware::class,
    ];

    /** Method/path of the route added last (for ->middleware() chaining). */
    private ?string $lastMethod = null;
    private ?string $lastPath   = null;

    public function get(string $path, string $handler): static
    {
        return $this->add('GET', $path, $handler);
    }

    public function post(string $path, string $handler): static
    {
        return $this->add('POST', $path, $handler);
    }

    /**
     * Attach middleware to the route that was just registered.
     * Accepts aliases ('auth', 'guest') or full class names.
     */
    public function middleware(string ...$middleware): static
    {
        if ($this->lastMethod === null || $this->lastPath === null) {
            throw new \LogicException('middleware() must be chained right after a route.');
        }

        foreach ($middleware as $name) {
            $this->routeMiddleware[$this->lastMethod][$this->lastPath][] = $this->middlewareAliases[$name] ?? $name;
        }

        return $this;
    }

    private function add(string $method, string $path, string $handler): static
    {
        $path = rtrim($path, '/') ?: '/';

        $this->routes[$method][$path] = $handler;
        $this->lastMethod = $method;
        $this->lastPath   = $path;

        return $this;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = rtrim(parse_url($uri, PHP_URL_PATH) ?: '/', '/') ?: '/';

        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        // 1) Run the route middleware before the controller.
        foreach ($this->routeMiddleware[$method][$path] ?? [] as $middlewareClass) {
            if (!class_exists($middlewareClass)) {
                http_response_code(500);
                echo "Middleware not found: {$middlewareClass}";
                return;
            }

            /** @var Middleware $instance */
            $instance = new $middlewareClass();
            $instance->handle();
        }

        // 2) Instantiate the controller and call the action.
        [$controller, $action] = explode('@', $handler);
        $controllerClass = "App\\Controllers\\{$controller}";

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo "Controller not found: {$controllerClass}";
            return;
        }

        $instance = new $controllerClass();

        if (!method_exists($instance, $action)) {
            http_response_code(500);
            echo "Action not found: {$controller}@{$action}";
            return;
        }

        $instance->{$action}();
    }
}
