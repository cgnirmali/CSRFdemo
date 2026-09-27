<?php

declare(strict_types=1);

/**
 * Global public navigation bar.
 * Included once inside the public layout.
 */
?>
<header class="sticky top-0 z-50 border-b border-white/10 bg-slate-950/80 backdrop-blur-xl">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="/" class="flex items-center gap-3 text-xl font-black tracking-tight text-white">
            <img src="<?= e(asset('images/cinevault-mark.svg')) ?>" alt="CineVault logo" class="h-9 w-9 rounded-lg object-cover">
            <span>Cine<span class="text-cyan-400">Vault</span></span>
        </a>

        <div class="hidden items-center gap-8 text-sm font-medium text-slate-300 md:flex">
            <a href="/" class="transition hover:text-cyan-300">Home</a>
            <a href="/movies" class="transition hover:text-cyan-300">Movies</a>
            <a href="/security-lab" class="transition hover:text-cyan-300">Security Lab</a>
            <a href="/login" class="transition hover:text-cyan-300">Login</a>
        </div>

        <div class="flex items-center gap-3">
            <a href="/movies" class="hidden rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10 sm:inline-flex">
                Explore Movies
            </a>
            <a href="/admin" class="rounded-full bg-cyan-400 px-5 py-2 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                Admin Demo
            </a>
        </div>
    </nav>
</header>
