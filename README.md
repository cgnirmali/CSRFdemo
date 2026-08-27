# Gift Vibe — Core PHP MVC (learning base)

A tiny, framework-free MVC to learn how the pieces fit together.

## Request flow

```
public/index.php          → entry point (config, helpers, session, router)
  routes/web.php          → maps URL → Controller@method (+ middleware)
  app/Core/Router.php     → runs middleware, instantiates controller, calls action
  app/Controllers/...     → controller calls the Model + renders a View
  app/Models/...          → talks to the DB through app/Core/Database.php
  resources/views/...     → PHP templates (pages + reusable components)
```

## Folder map (app/)

| Folder           | What lives there                                | Example                       |
| ---------------- | ----------------------------------------------- | ----------------------------- |
| `Controllers/`   | Request handlers (one per page/feature)         | `Auth/AuthController.php`     |
| `Core/`          | Framework pieces                                | `Router`, `View`, `Config`, `Database`, `Model` |
| `Helpers/`       | Global functions                                | `env()`, `e()`, `redirect()`, `csrf_*()` |
| `Middleware/`    | Request guards that run before a controller     | `AuthMiddleware`, `GuestMiddleware` |
| `Models/`        | One class per database table                    | `User.php`                     |

## Configuration (.env)

Copy `.env.example` to `.env` and edit it. Values are read with
`Config::get('KEY')` or the global `env('KEY')` helper.

```
DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS  → PDO connection (app/Core/Database.php)
APP_URL, APP_DEBUG, SESSION_NAME             → app-level settings
```

## Adding a route with middleware

```php
$router->get('/admin', 'Admin\DashboardController@index')->middleware('auth');
$router->get('/login', 'Auth\AuthController@showLogin')->middleware('guest');
```

Aliases: `auth` → `AuthMiddleware`, `guest` → `GuestMiddleware`
(see `$middlewareAliases` in `app/Core/Router.php`).

## Sample auth flow (login / register)

Views in `resources/views/auth/{login,register}/` (components pattern),
handled by `app/Controllers/Auth/AuthController.php`, backed by the `User`
model and the `users` table.

To try it:
1. Import `database/schema.sql` into MySQL (creates `gift_vibe` DB + `users` table).
2. Make sure `.env` DB settings match your MySQL.
3. Visit `/register` → create an account → you land on `/admin`.

> `/admin` now runs behind the `auth` middleware — not logged in = redirected to `/login`.
