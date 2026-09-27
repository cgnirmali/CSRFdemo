<?php

declare(strict_types=1);

namespace App\Controllers\Public;

use App\Core\Controller;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index(): void
    {
        $movies = Movie::featured(6);

        $this->view('layouts/public-layout', [
            'title'   => 'CineVault',
            'content' => $this->render('public/home/index', [
                'title'   => 'CineVault',
                'movies'  => $movies,
                'isProtected' => classroom_csrf_protected(),
            ]),
        ]);
    }
}
