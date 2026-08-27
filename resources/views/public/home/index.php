<?php

declare(strict_types=1);

/**
 * Home page — rendered as a child of the public layout.
 * Composed of the sections found in `public/home/components/`.
 *
 * @var string $title
 * @var string $message
 */

$homeSections = BASE_PATH . '/resources/views/public/home/components/';

require $homeSections . 'hero.php';
require $homeSections . 'features.php';
require $homeSections . 'cta.php';
?>
