<?php

declare(strict_types=1);

/** @var array $movies */
/** @var array $genres */
/** @var string $search */
/** @var string $genre */
?>
<section class="bg-[#070b17] text-white">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="mb-3 inline-flex rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">
                    CineVault Archive
                </p>
                <h1 class="text-4xl font-black tracking-tight sm:text-5xl">Explore the collection</h1>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-200">
                <?= count($movies) ?> titles available
            </div>
        </div>

        <form method="get" action="/movies" class="mb-10 grid gap-4 rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur sm:grid-cols-2 xl:grid-cols-4">
            <label class="block text-sm text-slate-300">
                <span class="mb-2 block font-medium text-slate-200">Search</span>
                <input type="text" name="search" value="<?= e($search) ?>" placeholder="Search titles or genres" class="w-full rounded-xl border border-white/10 bg-[#0f172a] px-3 py-2.5 text-white placeholder:text-slate-400 focus:border-cyan-400 focus:outline-none">
            </label>

            <label class="block text-sm text-slate-300">
                <span class="mb-2 block font-medium text-slate-200">Genre</span>
                <select name="genre" class="w-full rounded-xl border border-white/10 bg-[#0f172a] px-3 py-2.5 text-white focus:border-cyan-400 focus:outline-none">
                    <option value="">All genres</option>
                    <?php foreach ($genres as $option): ?>
                        <option value="<?= e($option) ?>" <?= $option === $genre ? 'selected' : '' ?>><?= e($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <div class="flex items-end gap-3">
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-cyan-400 px-4 py-2.5 font-semibold text-slate-900 transition hover:bg-cyan-300">
                    Apply
                </button>
            </div>

            <div class="flex items-end">
                <a href="/movies" class="inline-flex w-full items-center justify-center rounded-xl border border-white/10 bg-transparent px-4 py-2.5 font-semibold text-slate-200 transition hover:bg-white/5">
                    Clear
                </a>
            </div>
        </form>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <?php foreach ($movies as $movie): ?>
                <?php $poster = $movie['poster_image'] ?? '/assets/images/default-poster.svg'; ?>
                <article class="group overflow-hidden rounded-3xl border border-white/10 bg-[#111827] shadow-lg shadow-black/20 transition duration-300 hover:-translate-y-1 hover:border-cyan-400/30">
                    <div class="overflow-hidden">
                        <img src="<?= e($poster) ?>" alt="<?= e($movie['title']) ?> poster" class="h-[360px] w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="space-y-4 p-5">
                        <div class="flex items-center justify-between gap-3 text-xs uppercase tracking-[0.18em] text-slate-300">
                            <span><?= e($movie['year'] ?? $movie['release_year']) ?></span>
                            <span class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-2 py-1 text-[10px] font-semibold text-cyan-200">
                                ★ <?= e(number_format((float) ($movie['rating'] ?? 0), 1)) ?>
                            </span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">
                                <?= e($movie['title']) ?>
                            </h2>
                            <p class="mt-2 text-sm text-slate-400"><?= e($movie['genre']) ?></p>
                        </div>
                        <a href="/movies/<?= e($movie['slug']) ?>" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-cyan-300">
                            View Details
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
