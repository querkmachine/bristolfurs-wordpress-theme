<?php

/**
 * The index.php file is basically a fallback used if all other templates for
 * the given page type are missing. The WP template hierarchy sure is a thing.
 * https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png
 *
 * Anyway, no pages on the site should actually use this. Hopefully.
 * See front-page.php for the actual homepage template.
 */

$context = Timber::context();

Timber::render("page.twig", $context);
