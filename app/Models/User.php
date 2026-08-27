<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

/**
 * User — sample model for the `users` table.
 *
 * Shows two common patterns:
 *   1. Instance methods inherited from the base Model (find, where, create...).
 *   2. Static "query builder" helpers that create a fresh instance for you.
 *
 * Usage:
 *   $user = User::findByEmail('jane@example.com');   // ?array
 *   User::register(['name' => 'Jane', 'email' => ..., 'password' => ...]);
 */
class User extends Model
{
    protected string $table = 'users';

    /**
     * Find the first user with the given email address.
     */
    public static function findByEmail(string $email): ?array
    {
        return (new static())->firstWhere('email', $email);
    }

    /**
     * Insert a new user and return the new id.
     */
    public static function register(array $data): int
    {
        return (new static())->create($data);
    }
}
