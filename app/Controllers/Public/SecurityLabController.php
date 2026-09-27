<?php

declare(strict_types=1);

namespace App\Controllers\Public;

use App\Core\Controller;

class SecurityLabController extends Controller
{
    public function index(): void
    {
        $isProtected = classroom_csrf_protected();

        $this->view('layouts/public-layout', [
            'title' => 'CSRF Security Lab',
            'content' => $this->render('public/security-lab/index', [
                'isProtected' => $isProtected,
            ]),
        ]);
    }
}
