<?php

declare(strict_types=1);

/** @var array $movie */
$movie = $movie ?? [];
$backdrop = $movie['backdrop_image'] ?? '/assets/images/hero/hero-cinematic-1.svg';
$poster = $movie['poster_image'] ?? '/assets/images/default-poster.svg';
$year = (string) ($movie['release_year'] ?? '');
$genre = (string) ($movie['genre'] ?? '');
$duration = (string) ($movie['duration'] ?? '');
$rating = number_format((float) ($movie['rating'] ?? 0), 1);
?>
<section class="relative overflow-hidden bg-[#050b16] text-white">
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('<?= e($backdrop) ?>');"></div>
    <div class="absolute inset-0 bg-linear-to-r from-[#050b16] via-[#050b16]/90 to-[#050b16]/40"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[320px_1fr] lg:items-end">
            <div class="rounded-[32px] border border-white/10 bg-white/5 p-3 shadow-2xl shadow-black/30 backdrop-blur-sm">
                <img src="<?= e($poster) ?>" alt="<?= e($movie['title'] ?? 'Movie poster') ?>" class="h-[480px] w-full rounded-[24px] object-cover">
            </div>

            <div>
                <span class="inline-flex rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">
                    Featured title
                </span>
                <h1 class="mt-5 text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl">
                    <?= e(strtoupper((string) ($movie['title'] ?? ''))); ?>
                </h1>
                <div class="mt-5 flex flex-wrap items-center gap-3 text-sm text-slate-200">
                    <span class="font-semibold text-white"><?= e($year) ?></span>
                    <span class="text-slate-400">/</span>
                    <span><?= e($genre) ?></span>
                    <span class="text-slate-400">/</span>
                    <span><?= e($duration) ?></span>
                    <span class="text-slate-400">/</span>
                    <span class="text-cyan-300">★ <?= e($rating) ?></span>
                </div>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-200">
                    <?= e((string) ($movie['description'] ?? '')) ?>
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <button type="button" data-trailer-button class="rounded-full bg-cyan-400 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                        Watch Trailer
                    </button>
                    <button type="button" data-download-button class="rounded-full border border-white/15 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Download Movie
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Genre</p>
            <p class="mt-3 text-2xl font-bold text-slate-900"><?= e($genre) ?></p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Runtime</p>
            <p class="mt-3 text-2xl font-bold text-slate-900"><?= e($duration) ?></p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rating</p>
            <p class="mt-3 text-2xl font-bold text-slate-900">★ <?= e($rating) ?></p>
        </div>
    </div>
</section>

<div class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/75 p-4" data-download-modal>
    <div class="w-full max-w-lg rounded-[28px] border border-white/10 bg-[#0f172a] p-6 text-white shadow-2xl">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">Preparing Download...</p>
                <h3 class="mt-3 text-2xl font-bold">Movie: <?= e((string) ($movie['title'] ?? '')) ?></h3>
            </div>
            <button type="button" data-close-download class="rounded-full border border-white/10 px-3 py-1.5 text-sm text-slate-300 hover:bg-white/5">Close</button>
        </div>

        <div class="mt-6 space-y-3 rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-200">
            <div class="flex items-center justify-between"><span>Movie</span><span class="font-semibold text-white"><?= e((string) ($movie['title'] ?? '')) ?></span></div>
            <div class="flex items-center justify-between"><span>Quality</span><span class="font-semibold text-white">1080p</span></div>
            <div class="flex items-center justify-between"><span>File Size</span><span class="font-semibold text-white">2.4 GB</span></div>
            <div class="flex items-center justify-between"><span>Format</span><span class="font-semibold text-white">Fictional Demo</span></div>
        </div>

        <button type="button" data-start-download class="mt-6 w-full rounded-full bg-cyan-400 px-6 py-3 font-semibold text-slate-950 transition hover:bg-cyan-300">
            Start Download
        </button>
    </div>
</div>

<script>
(function () {
    const downloadModal = document.querySelector('[data-download-modal]');
    const downloadButton = document.querySelector('[data-download-button]');
    const closeDownload = document.querySelector('[data-close-download]');
    const startDownload = document.querySelector('[data-start-download]');
    const trailerButton = document.querySelector('[data-trailer-button]');

    if (downloadButton) {
        downloadButton.addEventListener('click', function () {
            downloadModal.classList.remove('hidden');
            downloadModal.classList.add('flex');
        });
    }

    if (closeDownload) {
        closeDownload.addEventListener('click', function () {
            downloadModal.classList.add('hidden');
            downloadModal.classList.remove('flex');
        });
    }

    if (startDownload) {
        startDownload.addEventListener('click', function () {
            startDownload.textContent = 'Demo download request initiated.';
            startDownload.disabled = true;
            startDownload.classList.add('opacity-80');
        });
    }

    if (trailerButton) {
        trailerButton.addEventListener('click', function () {
            alert('Fictional trailer preview ready: this is a demo-only experience.');
        });
    }
})();
</script>
