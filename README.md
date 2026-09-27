# CineVault — fictional movie platform with CSRF lab

CineVault is a framework-free PHP MVC app transformed from the base demo into a fictional movie-download style platform with a controlled security lab for local CSRF demonstrations.

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
| `Models/`        | One class per database table                    | `User.php`, `Movie.php`       |

## Configuration (.env)

Copy `.env.example` to `.env` and edit it. Values are read with
`Config::get('KEY')` or the global `env('KEY')` helper.

```
DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS  → PDO connection (app/Core/Database.php)
APP_URL, APP_DEBUG, SESSION_NAME             → app-level settings
SESSION_SECURE                               → set true when serving over HTTPS
CSRF_PROTECTION_ENABLED                     → fallback lab mode if LMS_ENV_PATH is unset
LMS_ENV_PATH                                → local path to the LMS .env so CineVault can show the matching Round 1 / Round 2 notice
```

## Movie routes

```php
$router->get('/', 'Public\HomeController@index');
$router->get('/movies', 'Public\MovieController@index');
$router->get('/movies/{slug}', 'Public\MovieController@show');
$router->get('/security-lab', 'Public\SecurityLabController@index');
```

## Sample auth flow (login / register)

The sample auth flow remains intact and protected by the existing CSRF helpers:
- `csrf_token()`
- `csrf_field()`
- `csrf_verify()`
- `hash_equals()` comparison

To try it:
1. Import `database/schema.sql` into MySQL.
2. Make sure `.env` DB settings match your MySQL.
3. Visit `/register` to create a user, then use `/login`.
4. The app remains behind the existing `auth` / `guest` middleware flow.

> A logged-in student can press Change status on CineVault. That button posts
> to the student portal and, when the portal’s CSRF check is off, sets the
> dashboard status to Attacked. It does not delete assignments, log the student
> out, or read the portal token.
