<?php

declare(strict_types=1);

/** @var bool $isProtected */
?>
<section class="bg-[#050b16] px-4 py-20 text-white sm:px-6 lg:px-8">
    <div class="mx-auto max-w-6xl">
        <div class="mb-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="mb-3 inline-flex rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">
                    Security Lab
                </p>
                <h1 class="text-4xl font-black tracking-tight sm:text-5xl">CSRF Security Lab</h1>
                <p class="mt-4 max-w-2xl text-lg text-slate-300">
                    Press Change status while logged into the student portal. That updates only the CSRF demo status. It does not delete assignments, log students out, or read the portal token.
                </p>
            </div>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/resources/views/public/components/csrf-classroom-notice.php'; ?>

<section class="bg-[#050b16] px-4 pb-20 text-white sm:px-6 lg:px-8">
    <div class="mx-auto max-w-6xl">
        <div class="rounded-[30px] border border-slate-200 bg-white p-6 text-slate-800 shadow-xl">
            <h2 class="text-2xl font-black">Why can't CineVault simply read the LMS CSRF token?</h2>
            <div class="mt-6 space-y-3 text-base leading-7 text-slate-600">
                <div class="flex items-center gap-3"><span class="font-semibold text-slate-900">CineVault</span><span class="text-slate-400">↓</span></div>
                <div class="flex items-center gap-3"><span class="font-semibold text-slate-900">Different origin</span><span class="text-slate-400">↓</span></div>
                <div class="flex items-center gap-3"><span class="font-semibold text-slate-900">Browser same-origin restrictions</span><span class="text-slate-400">↓</span></div>
                <div class="flex items-center gap-3"><span class="font-semibold text-slate-900">Cannot read the student-portal page or token</span><span class="text-slate-400">↓</span></div>
                <div class="flex items-center gap-3"><span class="font-semibold text-slate-900">No legitimate CSRF token on this site</span><span class="text-slate-400">↓</span></div>
                <div class="flex items-center gap-3"><span class="font-semibold text-slate-900">Protected portal rejects a request without its own token</span></div>
            </div>

            <div class="mt-8 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-amber-900">
                <strong>Important:</strong> The browser may still attach an LMS session cookie to a request aimed at the LMS. That is not the same as CineVault reading or stealing the CSRF token. This page only explains that difference.
            </div>
        </div>
    </div>
</section>
