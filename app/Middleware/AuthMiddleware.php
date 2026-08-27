<?php

declare(strict_types=1);

namespace App\Middleware;

/**
 * AuthMiddleware — "you must be logged in".
 *
 * Attach to routes that require a signed-in user, e.g. the admin area:
 *   $router->get('/admin', 'Admin\DashboardController@index')->middleware('auth');
 *
 * If there is no logged-in user it redirects to /login.
 */
class AuthMiddleware extends Middleware
{
    public function handle(): void
    {
        if (empty($_SESSION['user_id'])) {
            redirect('/login');
        }
    }
}
