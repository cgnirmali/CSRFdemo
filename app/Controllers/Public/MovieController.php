<?php

declare(strict_types=1);

namespace App\Controllers\Public;

use App\Core\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(): void
    {
        $search = trim((string) ($_GET['search'] ?? ''));
        $genre = trim((string) ($_GET['genre'] ?? ''));

        $this->view('layouts/public-layout', [
            'title' => 'Movies',
            'content' => $this->render('public/movies/index', [
                'movies' => Movie::filtered($search !== '' ? $search : null, $genre !== '' ? $genre : null),
                'genres' => Movie::genres(),
                'search' => $search,
                'genre' => $genre,
            ]),
        ]);
    }

    public function show(string $slug): void
    {
        $movie = Movie::findBySlug($slug);

        if ($movie === null) {
            http_response_code(404);
            echo 'Movie not found';
            return;
        }

        $this->view('layouts/public-layout', [
            'title' => (string) $movie['title'],
            'content' => $this->render('public/movies/show', [
                'movie' => $movie,
            ]),
        ]);
    }
}
