<?php
/**
 * Legacy: карточка catalog → WooCommerce (/product/… или /shop).
 *
 * @package computex-cond
 */

if (function_exists('computex_cond_redirect_legacy_catalog_template_bootstrap')) {
	computex_cond_redirect_legacy_catalog_template_bootstrap();
}

$catalog_id = get_queried_object_id();

if (!$catalog_id) {
	global $post;

	if ($post instanceof WP_Post) {
		$catalog_id = (int) $post->ID;
	}
}

$redirect_url = function_exists('computex_cond_get_catalog_post_redirect_url')
	? computex_cond_get_catalog_post_redirect_url($catalog_id)
	: home_url('/shop/');

wp_safe_redirect($redirect_url, 301);
exit;
