<?php
/**
 * Legacy: категория catalog-cat → /shop (с фильтром product_cat при совпадении slug).
 *
 * @package computex-cond
 */

if (function_exists('computex_cond_redirect_legacy_catalog_template_bootstrap')) {
	computex_cond_redirect_legacy_catalog_template_bootstrap();
}

$legacy_term = get_queried_object();
$redirect_url = function_exists('computex_cond_get_catalog_cat_redirect_url')
	? computex_cond_get_catalog_cat_redirect_url($legacy_term)
	: home_url('/shop/');

wp_safe_redirect($redirect_url, 301);
exit;
