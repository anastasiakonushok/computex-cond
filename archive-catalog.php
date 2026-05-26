<?php
/**
 * Legacy: архив catalog и шаблон страницы каталога → /shop.
 *
 * @package computex-cond
 */

if (function_exists('computex_cond_redirect_legacy_catalog_template_bootstrap')) {
	computex_cond_redirect_legacy_catalog_template_bootstrap();
}

$redirect_url = function_exists('computex_cond_get_shop_url')
	? computex_cond_get_shop_url()
	: home_url('/shop/');

wp_safe_redirect($redirect_url, 301);
exit;
