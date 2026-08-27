<?php

declare(strict_types=1);

/**
 * Home — Hero section.
 * Rendered by `resources/views/public/home/index.php`.
 *
 * @var string $title
 * @var string $message
 */
?>
<section class="bg-linear-to-br from-indigo-50 via-white to-pink-50">
    <div class="mx-auto flex min-h-[70vh] max-w-7xl flex-col items-center justify-center px-6 text-center">
        <span class="rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-primary">
            Gift Vibe MVC
        </span>

        <h1 class="mt-6 text-5xl font-extrabold tracking-tight text-secondary sm:text-6xl">
            <?= htmlspecialchars($message) ?>
        </h1>

        <p class="mt-5 max-w-xl text-lg text-slate-500">
            Your Core PHP MVC app is running with layouts, global components, and Tailwind CSS v4.
        </p>

        <p class="mt-3 text-sm text-slate-400">
            Controller &rarr; public-layout (navbar + footer) &rarr; home/index
        </p>
    </div>
</section>
