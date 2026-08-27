<?php

declare(strict_types=1);

/**
 * Register — Form section.
 * Rendered by `resources/views/auth/register/index.php`.
 * Uses the global base input, checkbox and button components.
 */

$svgUser = '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>';

$svgMail = '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>';

$svgLock = '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>';

$base = BASE_PATH . '/resources/views/components/base/';

$errors = $errors ?? [];
?>
<section class="mx-auto max-w-md px-6 py-10">
    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <?php if ($errors !== []): ?>
            <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <ul class="list-inside list-disc space-y-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="/register" class="space-y-5">
            <?= csrf_field() ?>

            <?php
            $inputType = 'text';
            $inputName = 'name';
            $inputLabel = 'Full name';
            $inputPlaceholder = 'Jane Doe';
            $inputValue = old('name');
            $inputAutocomplete = 'name';
            $inputRequired = true;
            $inputLeadingIcon = $svgUser;
            require $base . 'input.php';
            ?>

            <?php
            $inputType = 'email';
            $inputName = 'email';
            $inputLabel = 'Email';
            $inputPlaceholder = 'you@example.com';
            $inputValue = old('email');
            $inputAutocomplete = 'email';
            $inputRequired = true;
            $inputLeadingIcon = $svgMail;
            require $base . 'input.php';
            ?>

            <?php
            $inputType = 'password';
            $inputName = 'password';
            $inputLabel = 'Password';
            $inputPlaceholder = 'Create a password';
            $inputValue = '';
            $inputAutocomplete = 'new-password';
            $inputRequired = true;
            $inputLeadingIcon = $svgLock;
            require $base . 'input.php';
            ?>

            <?php
            $inputType = 'password';
            $inputName = 'password_confirmation';
            $inputLabel = 'Confirm password';
            $inputPlaceholder = 'Repeat your password';
            $inputValue = '';
            $inputAutocomplete = 'new-password';
            $inputRequired = true;
            $inputLeadingIcon = $svgLock;
            require $base . 'input.php';
            ?>

            <?php
            $checkboxName = 'terms';
            $checkboxLabel = 'I agree to the Terms & Privacy Policy';
            $checkboxRequired = true;
            require $base . 'checkbox.php';
            ?>

            <?php
            $buttonLabel = 'Create account';
            $buttonType = 'submit';
            $buttonSize = 'lg';
            $buttonFullWidth = true;
            require $base . 'button.php';
            ?>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Already have an account?
            <a href="/login" class="font-semibold text-primary transition hover:opacity-80">
                Sign in
            </a>
        </p>
    </div>
</section>
