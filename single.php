<?php

$context = Timber::context();
$timber_post = Timber::query_post();

Timber::render("post.twig", $context);
