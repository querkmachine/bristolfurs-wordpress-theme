<?php

/** For debugging */
define("WP_DEBUG", true);
error_reporting(E_ALL);

/**
 * Timber: Ensure Timber is loaded and available as a global class. If it isn't,
 * render a whole bunch of warnings instead.
 */

if (!class_exists("Timber")) {
	add_action("admin_notices", function () {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' .
			esc_url(admin_url("plugins.php#timber")) .
			'">' .
			esc_url(admin_url("plugins.php")) .
			"</a></p></div>";
	});

	add_filter("template_include", function ($template) {
		return get_stylesheet_directory() . "/static/error.html";
	});
	return;
}

/** Timber: Configure views directory. */
Timber::$dirname = ["views"];
Timber::$autoescape = false;

/**
 * Load in the rest of our configurations files.
 */

require "functions/navigation-menus.php";
require "functions/timber-config.php";
