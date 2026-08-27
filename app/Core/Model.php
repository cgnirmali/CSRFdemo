<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Model — a tiny base model (no full ORM, just the essentials).
 *
 * Subclasses only need to set $table (and optionally $primaryKey).
 * Every method below is an example you can copy and extend.
 *
 * Usage (from a controller):
 *   $user = (new User())->find(1);
 *   $users = (new User())->where('active', 1);
 *   (new User())->create(['name' => 'Jane', ...]);
 */
abstract class Model
{
    /** Table name — MUST be set by the child class. */
    protected string $table = '';

    /** Primary key column name. */
    protected string $primaryKey = 'id';

    public function getTable(): string
    {
        return $this->table;
    }

    /** SELECT * FROM table */
    public function all(): array
    {
        $stmt = Database::connection()->query("SELECT * FROM {$this->table}");

        return $stmt->fetchAll();
    }

    /** Find one row by primary key, or null. */
    public function find(int|string $id): ?array
    {
        $stmt = Database::connection()->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1"
        );
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    /** WHERE column = value → all matching rows. */
    public function where(string $column, mixed $value): array
    {
        $stmt = Database::connection()->prepare(
            "SELECT * FROM {$this->table} WHERE {$column} = :value"
        );
        $stmt->execute(['value' => $value]);

        return $stmt->fetchAll();
    }

    /** WHERE column = value → first match or null. */
    public function firstWhere(string $column, mixed $value): ?array
    {
        $rows = $this->where($column, $value);

        return $rows[0] ?? null;
    }

    /** INSERT ... and return the new row id. */
    public function create(array $data): int|false
    {
        $columns     = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $stmt = Database::connection()->prepare(
            "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})"
        );
        $stmt->execute($data);

        return (int) Database::connection()->lastInsertId();
    }

    /** UPDATE by primary key → true on success. */
    public function update(int|string $id, array $data): bool
    {
        $sets = implode(', ', array_map(
            static fn (string $col): string => "{$col} = :{$col}",
            array_keys($data)
        ));

        $data[$this->primaryKey] = $id;

        $stmt = Database::connection()->prepare(
            "UPDATE {$this->table} SET {$sets} WHERE {$this->primaryKey} = :{$this->primaryKey}"
        );

        return $stmt->execute($data);
    }

    /** DELETE by primary key → true on success. */
    public function delete(int|string $id): bool
    {
        $stmt = Database::connection()->prepare(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
