<?php

declare(strict_types=1);

/** @var array $movies */
/** @var bool $isProtected */
$featured = array_slice($movies ?? [], 0, 6);
$isProtected = (bool) ($isProtected ?? classroom_csrf_protected());
?>
<section class="relative isolate overflow-hidden bg-[#050b16] text-white">
    <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('<?= e(asset('images/backdrops/hero-cinematic-1.svg')) ?>');"></div>
    <div class="absolute inset-0 bg-linear-to-r from-[#050b16] via-[#050b16]/85 to-[#050b16]/55"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
        <div class="max-w-3xl">
            <span class="inline-flex rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-cyan-300">
                CineVault
            </span>
            <h1 class="mt-6 text-5xl font-black tracking-tight sm:text-6xl lg:text-7xl">
                Cinematic Stories.<br>
                <span class="text-cyan-300">One Place.</span>
            </h1>
            <p class="mt-6 max-w-xl text-lg text-slate-200 sm:text-xl">
                Explore our fictional movie collection.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/movies" class="rounded-full bg-cyan-400 px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/25 transition hover:bg-cyan-300">
                    Explore Movies
                </a>
                <a href="/movies?genre=Action+%2F+Thriller" class="rounded-full border border-white/15 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                    Trending Now
                </a>
            </div>
        </div>

        <div class="mt-12 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Archive</p>
                <p class="mt-3 text-3xl font-black text-white">12</p>
                <p class="mt-1 text-sm text-slate-300">Fictional titles</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Quality</p>
                <p class="mt-3 text-3xl font-black text-white">4K</p>
                <p class="mt-1 text-sm text-slate-300">Demo download streams</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Focus</p>
                <p class="mt-3 text-3xl font-black text-white">CSRF</p>
                <p class="mt-1 text-sm text-slate-300">Security education</p>
            </div>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/resources/views/public/components/csrf-classroom-notice.php'; ?>

<section class="bg-[#0b1220] px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300">Trending Movies</p>
                <h2 class="mt-3 text-3xl font-black text-white sm:text-4xl">Freshly added to the vault</h2>
            </div>
            <a href="/movies" class="hidden rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10 sm:inline-flex">
                View all
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($featured as $movie): ?>
                <article class="group overflow-hidden rounded-[28px] border border-white/10 bg-[#111827] shadow-lg shadow-black/20 transition duration-300 hover:-translate-y-1 hover:border-cyan-400/30">
                    <div class="overflow-hidden">
                        <img src="<?= e($movie['poster_image'] ?? '/assets/images/default-poster.svg') ?>" alt="<?= e($movie['title']) ?> poster" class="h-[360px] w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="space-y-4 p-5">
                        <div class="flex items-center justify-between text-xs uppercase tracking-[0.18em] text-slate-300">
                            <span><?= e($movie['release_year']) ?></span>
                            <span class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-2 py-1 text-[10px] font-semibold text-cyan-200">
                                ★ <?= e(number_format((float) ($movie['rating'] ?? 0), 1)) ?>
                            </span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white"><?= e($movie['title']) ?></h3>
                            <p class="mt-2 text-sm text-slate-400"><?= e($movie['genre']) ?> &middot; <?= e($movie['duration']) ?></p>
                        </div>
                        <a href="/movies/<?= e($movie['slug']) ?>" class="inline-flex items-center rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-cyan-300">
                            View Details
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="bg-slate-950 px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl rounded-[32px] border border-cyan-400/20 bg-gradient-to-r from-cyan-500/10 via-slate-900 to-slate-950 p-8 sm:p-10">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300">Vault Note</p>
                <h2 class="mt-3 text-3xl font-black text-white">CineVault is a fictional archive for demonstration and learning.</h2>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="/security-lab" class="rounded-full bg-cyan-400 px-5 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                    Open Security Lab
                </a>
                <a href="/movies" class="rounded-full border border-white/15 bg-white/5 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">
                    Browse collection
                </a>
            </div>
        </div>
    </div>
</section>
