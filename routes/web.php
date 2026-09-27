<?php

declare(strict_types=1);

/**
 * Web routes.
 * @var App\Core\Router $router
 */

/* Public */
$router->get('/', 'Public\HomeController@index');
$router->get('/movies', 'Public\MovieController@index');
$router->get('/movies/{slug}', 'Public\MovieController@show');
$router->get('/security-lab', 'Public\SecurityLabController@index');
$router->get('/base', 'Public\BaseController@index');

/* Auth — only for guests (you can't visit these while logged in) */
$router->get('/login', 'Auth\AuthController@showLogin')->middleware('guest');
$router->post('/login', 'Auth\AuthController@login')->middleware('guest');

$router->get('/register', 'Auth\AuthController@showRegister')->middleware('guest');
$router->post('/register', 'Auth\AuthController@register')->middleware('guest');

$router->post('/logout', 'Auth\AuthController@logout')->middleware('auth');

/* Admin — requires login (demo of the 'auth' middleware) */
$router->get('/admin', 'Admin\DashboardController@index')->middleware('auth');
