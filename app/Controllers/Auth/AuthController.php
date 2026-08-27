<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\User;

/**
 * AuthController — sample controller demonstrating the full flow:
 *
 *   Controller (this file)
 *     ├── uses helpers:      csrf_verify(), redirect(), flash(), flash_get(), old()
 *     ├── uses Model:        User::findByEmail(), User::register()
 *     └── renders views:     auth/login/index, auth/register/index
 *
 * Routes (see routes/web.php):
 *   GET  /login     → showLogin     (guest middleware)
 *   POST /login     → login         (guest middleware)
 *   GET  /register  → showRegister  (guest middleware)
 *   POST /register  → register      (guest middleware)
 *   POST /logout    → logout        (auth middleware)
 */
class AuthController extends Controller
{
    /**
     * Show the login form (GET /login).
     */
    public function showLogin(): void
    {
        $this->view('layouts/public-layout', [
            'title'   => 'Login',
            'content' => $this->render('auth/login/index', [
                'errors' => flash_get('errors', []), // flash messages from a failed attempt
            ]),
        ]);

        // Old input was already read by the old() helper in the form → clear it.
        unset($_SESSION['_old']);
    }

    /**
     * Handle the login form submit (POST /login).
     */
    public function login(): void
    {
        csrf_verify(); // protect the POST

        $email    = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        $errors = [];
        if ($email === '' || $password === '') {
            $errors[] = 'Email and password are required.';
        }

        try {
            $user = User::findByEmail($email);
        } catch (\PDOException $e) {
            $errors[] = 'Database not reachable. Check your .env DB settings and import database/schema.sql.';
            $user = null;
        }

        // Compare the submitted password with the stored hash.
        if ($user !== null && password_verify($password, (string) $user['password'])) {
            $_SESSION['user_id']   = (int) $user['id'];
            $_SESSION['user_name'] = (string) $user['name'];

            redirect('/admin');
        }

        // Wrong credentials (or missing user) → show a generic error.
        $errors[] = 'These credentials do not match our records.';
        flash('errors', $errors);
        $_SESSION['_old'] = ['email' => $email]; // repopulate the email field

        redirect('/login');
    }

    /**
     * Show the registration form (GET /register).
     */
    public function showRegister(): void
    {
        $this->view('layouts/public-layout', [
            'title'   => 'Register',
            'content' => $this->render('auth/register/index', [
                'errors' => flash_get('errors', []),
            ]),
        ]);

        unset($_SESSION['_old']);
    }

    /**
     * Handle the registration form submit (POST /register).
     */
    public function register(): void
    {
        csrf_verify();

        $name     = trim((string) ($_POST['name'] ?? ''));
        $email    = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $confirm  = (string) ($_POST['password_confirmation'] ?? '');

        $errors = [];
        if ($name === '' || $email === '' || $password === '') {
            $errors[] = 'All fields are required.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters.';
        }
        if ($password !== $confirm) {
            $errors[] = 'Passwords do not match.';
        }

        if ($errors !== []) {
            flash('errors', $errors);
            $_SESSION['_old'] = ['name' => $name, 'email' => $email];
            redirect('/register');
        }

        try {
            // Make sure the email isn't already taken.
            if (User::findByEmail($email) !== null) {
                flash('errors', ['An account with this email already exists.']);
                $_SESSION['_old'] = ['name' => $name, 'email' => $email];
                redirect('/register');
            }

            // Store the user with a HASHED password (never store plain text!).
            $id = User::register([
                'name'       => $name,
                'email'      => $email,
                'password'   => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // Log them in immediately.
            $_SESSION['user_id']   = (int) $id;
            $_SESSION['user_name'] = $name;

            redirect('/admin');
        } catch (\PDOException $e) {
            flash('errors', ['Database not reachable. Check your .env DB settings and import database/schema.sql.']);
            $_SESSION['_old'] = ['name' => $name, 'email' => $email];
            redirect('/register');
        }
    }

    /**
     * Log out and return home (POST /logout).
     */
    public function logout(): void
    {
        csrf_verify();

        // Clear everything and destroy the session.
        $_SESSION = [];
        session_destroy();

        redirect('/');
    }
}
