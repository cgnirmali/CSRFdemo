<?php

declare(strict_types=1);

namespace App\Middleware;

/**
 * GuestMiddleware — "only for visitors who are NOT logged in".
 *
 * Attach to login/register pages so an already-logged-in user
 * gets sent back home instead:
 *   $router->get('/login', 'Auth\AuthController@showLogin')->middleware('guest');
 */
class GuestMiddleware extends Middleware
{
    public function handle(): void
    {
        if (!empty($_SESSION['user_id'])) {
            redirect('/');
        }
    }
}
