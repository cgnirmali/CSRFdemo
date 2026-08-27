<?php

declare(strict_types=1);

/**
 * Login page — rendered as a child of the public layout.
 * Composed of the sections found in `auth/login/components/`.
 */

$loginSections = BASE_PATH . '/resources/views/auth/login/components/';

require $loginSections . 'header.php';
require $loginSections . 'form.php';
?>
