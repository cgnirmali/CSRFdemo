<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class Movie extends Model
{
    protected string $table = 'movies';

    public static function allOrdered(): array
    {
        $stmt = \App\Core\Database::connection()->query(
            'SELECT * FROM movies ORDER BY release_year DESC, title ASC'
        );

        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        return (new static())->firstWhere('slug', $slug);
    }

    public static function featured(int $limit = 6): array
    {
        $stmt = \App\Core\Database::connection()->prepare(
            'SELECT * FROM movies ORDER BY rating DESC, release_year DESC LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function genres(): array
    {
        $stmt = \App\Core\Database::connection()->query(
            "SELECT DISTINCT genre FROM movies WHERE genre IS NOT NULL AND genre <> '' ORDER BY genre ASC"
        );

        return array_map(
            static fn (array $row): string => (string) $row['genre'],
            $stmt->fetchAll()
        );
    }

    public static function filtered(?string $search = null, ?string $genre = null): array
    {
        $where = [];
        $params = [];

        if ($search !== null && trim($search) !== '') {
            $where[] = '(title LIKE :search OR description LIKE :search OR genre LIKE :search)';
            $params['search'] = '%' . trim($search) . '%';
        }

        if ($genre !== null && trim($genre) !== '') {
            $where[] = 'genre = :genre';
            $params['genre'] = trim($genre);
        }

        $sql = 'SELECT * FROM movies';
        if ($where !== []) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY rating DESC, release_year DESC, title ASC';

        $stmt = \App\Core\Database::connection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
