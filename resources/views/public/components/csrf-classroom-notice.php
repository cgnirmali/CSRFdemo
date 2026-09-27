<?php

declare(strict_types=1);

/** @var bool $isProtected */

$csrfNoticeTitle = $isProtected
    ? 'Unauthorized action blocked'
    : 'Lab mode: CSRF check is off';
$csrfNoticeBody = $isProtected
    ? 'CSRF validation failed (no valid token from this site).'
    : 'Another site cannot read your token, but this portal would not reject a request that has your session and no token.';
$csrfNoticeHint = $isProtected
    ? 'The token stays on the student portal. Change status sends no token, so Round 2 leaves the portal status Safe.'
    : 'Change status does not read the portal token. With the check off, the portal accepts the request and the demo status becomes Attacked.';
$lmsStatusUrl = lms_status_url();
?>
<section class="bg-[#0b1220] px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl rounded-[32px] border <?= $isProtected ? 'border-emerald-400/30 bg-emerald-500/10' : 'border-amber-400/30 bg-amber-500/10' ?> p-6 sm:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] <?= $isProtected ? 'text-emerald-300' : 'text-amber-300' ?>">
                    Classroom CSRF notice
                </p>
                <h2 class="mt-3 text-3xl font-black text-white"><?= e($csrfNoticeTitle) ?></h2>
            </div>
            <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide <?= $isProtected ? 'bg-emerald-400 text-slate-950' : 'bg-amber-400 text-slate-950' ?>">
                <?= $isProtected ? 'Round 2 · Protected' : 'Round 1 · CSRF check off' ?>
            </span>
        </div>
        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-100"><?= e($csrfNoticeBody) ?></p>
        <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-300"><?= e($csrfNoticeHint) ?></p>
        <?php if ($lmsStatusUrl !== ''): ?>
            <form method="post" action="<?= e($lmsStatusUrl) ?>" target="csrf-demo-result" class="mt-6" id="csrf-demo-form">
                <button type="submit" class="rounded-full bg-white px-5 py-3 text-sm font-bold text-slate-950 transition hover:bg-cyan-300">
                    Change status
                </button>
            </form>
            <iframe name="csrf-demo-result" title="Student portal status update" class="hidden h-0 w-0 border-0"></iframe>
            <p id="csrf-demo-sent" class="mt-4 hidden text-sm font-medium text-cyan-200">Request sent. This page stays on Cine Vault. Open the student portal to see the status.</p>
            <script>
                document.getElementById('csrf-demo-form')?.addEventListener('submit', function () {
                    document.getElementById('csrf-demo-sent')?.classList.remove('hidden');
                });
            </script>
        <?php endif; ?>
        <p class="mt-4 text-xs text-slate-400">Change status only updates the student-portal CSRF demo status. It does not delete assignments, log students out, or read the portal token.</p>
    </div>
</section>
