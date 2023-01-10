<?php

/**
 * Timber: Configuration for Timber.
 */

class BristolFurs extends Timber\Site
{
	/** Enable Timber support in the theme */
	public function __construct()
	{
		add_action("after_setup_theme", [$this, "theme_supports"]);
		add_filter("timber/context", [$this, "add_to_context"]);
		add_filter("timber/twig", [$this, "add_to_twig"]);
		add_action("init", [$this, "register_post_types"]);
		add_action("init", [$this, "register_taxonomies"]);
		parent::__construct();
	}

	/** Register any custom post types */
	public function register_post_types()
	{
	}

	/** Register any custom taxonomies */
	public function register_taxonomies()
	{
	}

	/**
	 * Add global context entries (basically, constants).
	 * $context['stuff'] will become accessible in templateas as {{ stuff }}.
	 */
	public function add_to_context($context)
	{
		// Main navigation bar
		$context["primary_navigation"] = new Timber\Menu("primary", [
			"depth" => 1,
		]);

		return $context;
	}

	/**
	 * Theme supports toggles/config. Same as you'd have in vanilla WordPress.
	 */
	public function theme_supports()
	{
		/** Let WP manage page titles automatically */
		add_theme_support("title-tag");

		/** Enable support for featured images on posts and pages */
		add_theme_support("post-thumbnails");

		/** Enable content managed nav menus */
		add_theme_support("menus");

		/** Disable WP admin bar — it's just a bit annoying */
		add_filter("show_admin_bar", "__return_false");

		/** Disable WordPress's custom emoji that exists for some reason */
		remove_action("wp_head", "print_emoji_detection_script", 7);
		remove_action("wp_print_styles", "print_emoji_styles");

		/** Disable oEmbed — we don't need it */
		add_filter("embed_oembed_discover", "__return_false");
		remove_filter("oembed_dataparse", "wp_filter_oembed_result", 10);
		remove_action("wp_head", "wp_oembed_add_discovery_links");
		remove_action("wp_head", "wp_oembed_add_host_js");
		if (function_exists("disable_embeds_rewrites")) {
			add_filter("rewrite_rules_array", "disable_embeds_rewrites");
		}
	}

	/**
	 * Add custom filters and functions to the Twig interpreter
	 */
	public function add_to_twig($twig)
	{
		return $twig;
	}
}

new BristolFurs();
