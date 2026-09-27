<?php

declare(strict_types=1);

/**
 * Global footer — shared by the public and admin layouts.
 */
?>
<footer class="border-t border-white/10 bg-slate-950">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-4 py-8 sm:flex-row sm:px-6 lg:px-8">
        <p class="text-sm text-slate-400">
            &copy; <?php require BASE_PATH . '/resources/views/components/shared/date.php'; ?>
            <span class="font-semibold text-white">Cine<span class="text-cyan-400">Vault</span></span>
            . Your Movie Collection.
        </p>
        <div class="flex items-center gap-3 text-xs uppercase tracking-[0.2em] text-slate-500">
            <span>Fictional Archive</span>
            <span>&middot;</span>
            <span>CSRF Lab</span>
        </div>
    </div>
</footer>
