<?php

declare(strict_types=1);

/**
 * Register page — rendered as a child of the public layout.
 * Composed of the sections found in `auth/register/components/`.
 */

$registerSections = BASE_PATH . '/resources/views/auth/register/components/';

require $registerSections . 'header.php';
require $registerSections . 'form.php';
?>
