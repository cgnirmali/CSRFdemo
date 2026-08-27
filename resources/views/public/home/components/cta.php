<?php

declare(strict_types=1);

/**
 * Home — Call-to-action section.
 * Rendered by `resources/views/public/home/index.php`.
 */
?>
<section class="mx-auto max-w-7xl px-6 pb-20">
    <div class="flex flex-col items-center justify-between gap-6 rounded-3xl bg-linear-to-r from-primary to-accent px-8 py-10 text-center sm:flex-row sm:text-left">
        <div>
            <h2 class="text-2xl font-bold text-white">Ready to find the perfect gift?</h2>
            <p class="mt-2 text-sm text-white/80">
                Start browsing the shop or jump into the admin dashboard.
            </p>
        </div>

        <div class="flex shrink-0 flex-wrap items-center justify-center gap-3">
            <a href="/admin" class="rounded-full bg-white px-6 py-2.5 text-sm font-semibold text-primary shadow transition hover:opacity-90">
                Open Admin
            </a>
            <a href="/shop" class="rounded-full border border-white/40 bg-white/10 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20">
                Browse Shop
            </a>
        </div>
    </div>
</section>
