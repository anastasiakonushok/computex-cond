<?php
/**
 * computex-cond functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package computex-cond
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Общие настройки',
		'menu_title' => 'Настройка темы',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Настройка новости',
		'menu_title' => 'Настройка новости',
		'parent_slug' => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Настройки популярные бренды',
		'menu_title' => 'Настройки популярные бренды',
		'parent_slug' => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Настройки хитов продаж',
		'menu_title' => 'Настройки хитов продаж',
		'parent_slug' => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Настройки блока услуг',
		'menu_title' => 'Настройки блока услуг',
		'parent_slug' => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Описание брендов',
		'menu_title' => 'Описание брендов',
		'parent_slug' => 'theme-general-settings',
	));
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function computex_cond_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on computex-cond, use a find and replace
	 * to change 'computex-cond' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('computex-cond', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'Главное меню' => esc_html__('Primary', 'computex-cond'),
			'Меню остальных услуг' => esc_html__('Second', 'computex-cond'),
			'Меню информации' => esc_html__('Info', 'computex-cond'),
			'Меню услуг' => esc_html__('Catalog', 'computex-cond'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'computex_cond_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);

	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'computex_cond_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function computex_cond_content_width()
{
	$GLOBALS['content_width'] = apply_filters('computex_cond_content_width', 640);
}
add_action('after_setup_theme', 'computex_cond_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function computex_cond_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'computex-cond'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'computex-cond'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'computex_cond_widgets_init');

/**
 * Версия файла темы по дате изменения (автосброс кэша CSS/JS).
 */
function computex_cond_get_asset_version($relative_path)
{
	$file_path = get_template_directory() . '/' . ltrim($relative_path, '/');

	return file_exists($file_path) ? (string) filemtime($file_path) : _S_VERSION;
}

/**
 * Enqueue scripts and styles.
 */
function computex_cond_scripts()
{
	wp_enqueue_style('computex-cond-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('computex-cond-style', 'rtl', 'replace');
	wp_enqueue_style('computex-cond-swiper',  get_template_directory_uri() . '/assets/swiper/swiper-bundle.min.css');
	wp_enqueue_style('computex-cond-fancybox',  get_template_directory_uri() . '/assets/fancybox/fancybox.css');
	wp_enqueue_style(
		'computex-cond-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		computex_cond_get_asset_version('assets/css/main.css')
	);
	wp_enqueue_style(
		'computex-cond-heating',
		get_template_directory_uri() . '/assets/css/page-heating.css',
		array(),
		computex_cond_get_asset_version('assets/css/page-heating.css')
	);

	if (function_exists('WC') && computex_cond_should_enqueue_shop_cards_script()) {
		$shop_script_path = get_template_directory() . '/assets/js/woocommerce-shop.js';

		wp_enqueue_script(
			'computex-cond-woocommerce-shop',
			get_template_directory_uri() . '/assets/js/woocommerce-shop.js',
			array(),
			file_exists($shop_script_path) ? filemtime($shop_script_path) : _S_VERSION,
			true
		);
	}

	if (function_exists('is_product') && is_product()) {
		$single_script_path = get_template_directory() . '/assets/js/woocommerce-single-product.js';

		wp_enqueue_script(
			'computex-cond-woocommerce-single',
			get_template_directory_uri() . '/assets/js/woocommerce-single-product.js',
			array('jquery'),
			file_exists($single_script_path) ? filemtime($single_script_path) : _S_VERSION,
			true
		);
	}


	wp_enqueue_script('computex-cond-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('computex-cond-swiper',get_template_directory_uri() . '/assets/swiper/swiper-bundle.min.js',array(), _S_VERSION, true);
	wp_enqueue_script('computex-cond-jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('computex-cond-fancy', get_template_directory_uri() . '/assets/fancybox/fancybox.umd.js', array(), _S_VERSION, true);
	wp_enqueue_script('computex-cond-main', get_template_directory_uri() . '/assets/js/style.js', array(), _S_VERSION, true);
	// wp_enqueue_script('grin-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), _S_VERSION, true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'computex_cond_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('init', 'catalog_typ');
function catalog_typ()
{
	register_post_type('catalog', array(
		'labels' => array(
			'name' => 'Каталог',
			'singular_name' => 'Каталог',
		),
		'description' => 'Каталог кондиционеров',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'has_archive' => true, // Включение архива
		'rewrite' => array('slug' => 'catalog','with_front' => true), // Правила перезаписи
		'menu_icon' => 'dashicons-editor-ul',
		'menu_position' => 23,
		'supports' => array('title', 'thumbnail', 'editor'),
		//'rewrite' => array('slug' => 'product', 'with_front' => true)
	));
}
add_action('init', 'create_catalog_taxonomies');
function create_catalog_taxonomies()
{
	register_taxonomy('catalog-cat', 'catalog', array(
		'public' => true,
		'show_ui' => true,
		'hierarchical' => true,
		'labels' => array(
			'name' => 'Категории кондиционеров',
			'singular_name' => 'Категория кондиционеров'
		),
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'catalog-category', 'with_front' => true),
		'hierarchical' => true,
		//'rewrite' => array( 'slug' => 'products', 'hierarchical' => true, 'with_front' => true  )
	));
}


function disable_search_redirect()
{
	if (is_search()) {
		wp_redirect(home_url('/'));
		exit();
	}
}
add_action('template_redirect', 'disable_search_redirect');


// Полное отключение комментариев в WordPress
function disable_comments_post_types_support()
{
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'disable_comments_post_types_support');

// Закрыть комментарии на фронтенде
function disable_comments_status()
{
	return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Удалить вид комментариев из админпанели
function disable_comments_hide_existing_comments($comments)
{
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

// Удалить раздел комментариев из админпанели
function disable_comments_admin_menu()
{
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Перенаправление с раздела комментариев в админке
function disable_comments_admin_menu_redirect()
{
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}
}
add_action('admin_init', 'disable_comments_admin_menu_redirect');

// Удаление виджета комментариев из панели управления
function disable_comments_dashboard()
{
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

// Удалить ссылки на комментарии из панели админа
function disable_comments_admin_bar()
{
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'disable_comments_admin_bar');



// add_filter('pre_site_transient_update_core', '__return_null');


// add_filter('pre_site_transient_update_plugins', '__return_null');


// add_filter('pre_site_transient_update_themes', '__return_null');

function computex_cond_format_product_price($price)
{
	if ($price === '' || $price === null) {
		return '';
	}

	return number_format((float) $price, 2, ',', ' ') . ' BYN';
}

function computex_cond_format_savings_label($regular_price, $sale_price)
{
	$savings = max(0, (float) $regular_price - (float) $sale_price);

	if ($savings <= 0) {
		return '';
	}

	return 'Экономия ' . number_format($savings, 2, ',', ' ') . ' BYN';
}

function computex_cond_get_product_properties($product_id)
{
	$properties = array();

	if (!function_exists('get_field')) {
		return $properties;
	}

	if (function_exists('have_rows') && have_rows('svojstva', $product_id)) {
		while (have_rows('svojstva', $product_id)) {
			the_row();
			$title = get_sub_field('zagolovok');
			$value = get_sub_field('znachenie');

			if ($title !== '' && $value !== '') {
				$properties[] = array(
					'label' => $title,
					'value' => $value,
				);
			}
		}

		return $properties;
	}

	$svojstva = get_field('svojstva', $product_id);

	if (!is_array($svojstva)) {
		return $properties;
	}

	foreach ($svojstva as $item) {
		if (empty($item['zagolovok']) || !isset($item['znachenie'])) {
			continue;
		}

		$properties[] = array(
			'label' => $item['zagolovok'],
			'value' => $item['znachenie'],
		);
	}

	return $properties;
}

function computex_cond_normalize_property_label($label)
{
	$label = trim((string) $label);

	if (preg_match('/площад.*помещ|площадь\s*помещения/ui', $label)) {
		return 'Обслуживаемая площадь, м²';
	}

	return $label;
}

function computex_cond_extract_serviced_area_value($area_label)
{
	$area_label = trim((string) $area_label);

	if (preg_match('/(\d+)/u', $area_label, $matches)) {
		return $matches[1];
	}

	return $area_label;
}

function computex_cond_property_label_key($label)
{
	return mb_strtolower(trim((string) $label));
}

function computex_cond_is_area_property_label($label)
{
	return (bool) preg_match('/обслуживаем.*площад|площад.*помещ|^площад/ui', (string) $label);
}

/**
 * Парсинг textarea «Характеристики» (Инвертор: Да || Производитель: AlpicAir).
 */
function computex_cond_parse_haraktersitiki_text($text)
{
	$text = trim((string) $text);

	if ($text === '') {
		return array();
	}

	$rows = array();

	foreach (preg_split('/\s*\|\|\s*/u', $text) as $part) {
		$part = trim($part);

		if ($part === '' || !preg_match('/^([^:]+):\s*(.+)$/u', $part, $matches)) {
			continue;
		}

		$label = trim($matches[1]);
		$value = trim($matches[2]);

		if ($label === '' || $value === '') {
			continue;
		}

		$rows[] = array(
			'label' => $label,
			'value' => $value,
		);
	}

	return $rows;
}

/**
 * Характеристики из ACF textarea haraktersitiki.
 */
function computex_cond_get_product_haraktersitiki_rows($product_id)
{
	$product_id = absint($product_id);

	if (!$product_id) {
		return array();
	}

	$text = '';

	if (function_exists('get_field')) {
		$text = get_field('haraktersitiki', $product_id);
	}

	if ($text === '' || $text === null) {
		$text = get_post_meta($product_id, 'haraktersitiki', true);
	}

	return computex_cond_parse_haraktersitiki_text($text);
}

/**
 * Добавить строки характеристик без дублей по названию.
 */
function computex_cond_append_characteristic_rows(array &$properties, array &$labels_seen, array $rows, $skip_area = false)
{
	foreach ($rows as $property) {
		if ($skip_area && computex_cond_is_area_property_label($property['label'])) {
			continue;
		}

		$label = computex_cond_normalize_property_label($property['label']);
		$key = computex_cond_property_label_key($label);

		if (isset($labels_seen[$key])) {
			continue;
		}

		$labels_seen[$key] = true;
		$properties[] = array(
			'label' => $label,
			'value' => $property['value'],
		);
	}
}

/**
 * Площадь — первой строкой в списке.
 */
function computex_cond_move_area_property_first($properties)
{
	$area_index = null;

	foreach ($properties as $index => $property) {
		if (computex_cond_is_area_property_label($property['label'])) {
			$area_index = $index;
			break;
		}
	}

	if ($area_index === null || $area_index === 0) {
		return $properties;
	}

	$area_row = $properties[$area_index];
	unset($properties[$area_index]);
	array_unshift($properties, $area_row);

	return array_values($properties);
}

/**
 * Ключи характеристик для карточки в каталоге / shop (строго 6 полей).
 */
function computex_cond_get_product_card_characteristic_key_groups()
{
	return array(
		array('area'),
		array('инвертор'),
		array('производитель'),
		array('wi - fi', 'wi-fi', 'wifi'),
		array('страна производства'),
		array('класс энергоэффективности'),
	);
}

/**
 * Ключи для блока «Основные характеристики» на странице товара.
 */
function computex_cond_get_main_preview_characteristic_keys()
{
	return array(
		'производитель',
		'класс энергоэффективности',
		'инвертор',
		'wi - fi',
		'wi-fi',
		'wifi',
		'страна производства',
	);
}

/**
 * Совпадение названия характеристики с одним из допустимых ключей.
 */
function computex_cond_property_matches_characteristic_keys($label, $wanted_keys)
{
	$key = computex_cond_property_label_key($label);
	$key_compact = preg_replace('/[\s\-–—]+/u', '', $key);

	foreach ((array) $wanted_keys as $wanted) {
		$wanted_compact = preg_replace('/[\s\-–—]+/u', '', (string) $wanted);

		if ($key === $wanted || $key_compact === $wanted_compact) {
			return true;
		}
	}

	return false;
}

/**
 * Только разрешённые характеристики (для карточки shop или превью).
 */
function computex_cond_filter_characteristics_by_key_groups($properties, $key_groups)
{
	$properties = array_values((array) $properties);
	$filtered = array();
	$labels_seen = array();

	foreach ((array) $key_groups as $group) {
		if (!empty($group[0]) && $group[0] === 'area') {
			foreach ($properties as $property) {
				if (!computex_cond_is_area_property_label($property['label'])) {
					continue;
				}

				$key = computex_cond_property_label_key($property['label']);

				if (isset($labels_seen[$key])) {
					continue;
				}

				$labels_seen[$key] = true;
				$filtered[] = array(
					'label' => 'Обслуживаемая площадь, м²',
					'value' => isset($property['value']) ? $property['value'] : '',
				);
				break;
			}

			continue;
		}

		foreach ($properties as $property) {
			if (empty($property['label']) || computex_cond_is_area_property_label($property['label'])) {
				continue;
			}

			$key = computex_cond_property_label_key($property['label']);

			if (isset($labels_seen[$key])) {
				continue;
			}

			if (!computex_cond_property_matches_characteristic_keys($property['label'], $group)) {
				continue;
			}

			$labels_seen[$key] = true;
			$filtered[] = array(
				'label' => computex_cond_normalize_property_label($property['label']),
				'value' => isset($property['value']) ? $property['value'] : '',
			);
			break;
		}
	}

	return $filtered;
}

/**
 * Характеристики для карточки товара в /shop/.
 */
function computex_cond_filter_product_card_characteristics($properties)
{
	return computex_cond_filter_characteristics_by_key_groups(
		$properties,
		computex_cond_get_product_card_characteristic_key_groups()
	);
}

/**
 * Краткий список характеристик для превью на странице товара.
 */
function computex_cond_filter_preview_characteristics($properties, $max_items = 6)
{
	$key_groups = array(
		array('area'),
	);

	foreach (computex_cond_get_main_preview_characteristic_keys() as $wanted_key) {
		$key_groups[] = array($wanted_key);
	}

	$filtered = computex_cond_filter_characteristics_by_key_groups($properties, $key_groups);

	if (count($filtered) >= 3) {
		return array_slice($filtered, 0, $max_items);
	}

	return $filtered;
}

function computex_cond_get_card_display_properties($product_id, $variation_id = 0, $area_label = '')
{
	$properties = array();
	$labels_seen = array();

	foreach (computex_cond_get_product_properties($product_id) as $property) {
		if ($variation_id && computex_cond_is_area_property_label($property['label'])) {
			continue;
		}

		$label = computex_cond_normalize_property_label($property['label']);
		$key = computex_cond_property_label_key($label);

		if (isset($labels_seen[$key])) {
			continue;
		}

		$labels_seen[$key] = true;
		$properties[] = array(
			'label' => $label,
			'value' => $property['value'],
		);
	}

	if ($variation_id) {
		foreach (computex_cond_get_variation_characteristics($variation_id) as $property) {
			$key = computex_cond_property_label_key($property['label']);

			if (isset($labels_seen[$key])) {
				continue;
			}

			$labels_seen[$key] = true;
			$properties[] = $property;
		}

		if ($area_label !== '') {
			$area_value = computex_cond_extract_serviced_area_value($area_label);
			$area_inserted = false;

			foreach ($properties as $index => $property) {
				if (computex_cond_is_area_property_label($property['label'])) {
					$properties[$index]['label'] = 'Обслуживаемая площадь, м²';
					$properties[$index]['value'] = $area_value;
					$area_inserted = true;
					break;
				}
			}

			if (!$area_inserted) {
				$properties[] = array(
					'label' => 'Обслуживаемая площадь, м²',
					'value' => $area_value,
				);
			}
		}
	}

	computex_cond_append_characteristic_rows(
		$properties,
		$labels_seen,
		computex_cond_get_product_haraktersitiki_rows($product_id),
		(bool) $variation_id
	);

	return computex_cond_move_area_property_first($properties);
}

function computex_cond_get_variation_option_label($attributes, $fallback_index = 0)
{
	$attribute_key = '';
	$attribute_value = '';

	foreach ($attributes as $key => $value) {
		if ($value === '') {
			continue;
		}

		$attribute_key = $key;
		$attribute_value = $value;

		if (preg_match('/area|plosh|plosch|ploshhad|ploshad|площад/ui', $key)) {
			break;
		}
	}

	if (!$attribute_key || !$attribute_value) {
		return sprintf('Вариант %d', $fallback_index + 1);
	}

	$taxonomy = str_replace('attribute_', '', $attribute_key);
	$decoded_attribute_value = rawurldecode($attribute_value);
	$term = taxonomy_exists($taxonomy) ? get_term_by('slug', $attribute_value, $taxonomy) : false;

	if (!$term && taxonomy_exists($taxonomy)) {
		$term = get_term_by('slug', sanitize_title($decoded_attribute_value), $taxonomy);
	}

	$label = $term && !is_wp_error($term) ? $term->name : $decoded_attribute_value;

	return str_replace(array('-', '_'), ' ', $label);
}

/**
 * Реальная скидка: заполнены regular/sale, sale < regular, активная цена = sale.
 */
function computex_cond_product_is_really_on_sale($wc_product)
{
	if (!$wc_product instanceof WC_Product || !$wc_product->is_on_sale()) {
		return false;
	}

	$regular_price = $wc_product->get_regular_price('edit');
	$sale_price = $wc_product->get_sale_price('edit');

	if ($regular_price === '' || $sale_price === '') {
		return false;
	}

	$regular = (float) $regular_price;
	$sale = (float) $sale_price;
	$active = (float) $wc_product->get_price('edit');

	if ($regular <= 0 || $sale <= 0 || $sale >= $regular || $active <= 0) {
		return false;
	}

	$discount_percent = (($regular - $sale) / $regular) * 100;

	if ($discount_percent < 1) {
		return false;
	}

	// Устаревший _sale_price в meta: витрина показывает regular, а не sale.
	if (abs($active - $sale) > 0.02) {
		return false;
	}

	return true;
}

function computex_cond_get_product_price_data($wc_product)
{
	if (!$wc_product instanceof WC_Product) {
		return array(
			'current' => '',
			'current_numeric' => 0,
			'regular' => '',
			'on_sale' => false,
			'discount_percent' => 0,
			'discount_label' => '',
			'savings' => '',
		);
	}

	$on_sale = computex_cond_product_is_really_on_sale($wc_product);
	$regular = $on_sale ? (float) $wc_product->get_regular_price('edit') : 0;
	$sale = $on_sale ? (float) $wc_product->get_sale_price('edit') : 0;
	$current_price = $on_sale ? $sale : (float) $wc_product->get_price('edit');
	$discount_percent = 0;

	if ($on_sale && $regular > 0) {
		$discount_percent = (int) round((($regular - $sale) / $regular) * 100);
	}

	return array(
		'current' => computex_cond_format_product_price($current_price),
		'current_numeric' => $current_price,
		'regular' => $on_sale ? computex_cond_format_product_price($regular) : '',
		'on_sale' => $on_sale,
		'discount_percent' => $discount_percent,
		'discount_label' => $on_sale && $discount_percent > 0 ? '-' . $discount_percent . '%' : '',
		'savings' => $on_sale ? computex_cond_format_savings_label($regular, $sale) : '',
	);
}

function computex_cond_render_product_card_price_html($price_data)
{
	if (empty($price_data['current'])) {
		return '';
	}

	if (!empty($price_data['on_sale']) && !empty($price_data['regular'])) {
		$discount_label = !empty($price_data['discount_label']) ? $price_data['discount_label'] : '';
		$savings = !empty($price_data['savings']) ? $price_data['savings'] : '';

		return sprintf(
			'<div class="product-card__price product-card__price--sale" data-card-price><div class="product-card__price-row"><span class="product-card__price-current">%1$s</span><span class="product-card__price-old" aria-label="%2$s">%3$s</span></div><div class="product-card__economy" data-card-economy><span class="product-card__economy-percent" data-card-discount-percent>%4$s</span><span class="product-card__economy-value" data-card-savings>%5$s</span></div></div>',
			esc_html($price_data['current']),
			esc_attr(sprintf(__('Старая цена: %s', 'computex-cond'), $price_data['regular'])),
			esc_html($price_data['regular']),
			esc_html($discount_label),
			esc_html($savings)
		);
	}

	return sprintf(
		'<div class="product-card__price" data-card-price><span class="product-card__price-current">%s</span></div>',
		esc_html($price_data['current'])
	);
}

function computex_cond_render_product_card_badges_html($product, $price_data = null, $has_variations = false)
{
	if (!$product instanceof WC_Product) {
		return '';
	}

	$badges = array();

	if ($product->is_featured()) {
		$badges[] = '<span class="product-card__badge product-card__badge--featured">Советуем</span>';
	}

	if ($price_data && !empty($price_data['on_sale'])) {
		$sale_badge_text = !empty($price_data['discount_label']) ? $price_data['discount_label'] : 'акция';
		$badges[] = '<span class="product-card__badge product-card__badge--sale" data-card-sale-badge>' . esc_html($sale_badge_text) . '</span>';
	} elseif ($has_variations) {
		$badges[] = '<span class="product-card__badge product-card__badge--sale" data-card-sale-badge hidden style="display:none">акция</span>';
	}

	if (empty($badges)) {
		return '';
	}

	return '<div class="product-card__badges" data-card-badges>' . implode('', $badges) . '</div>';
}

/**
 * Тексты блока услуг на странице товара (значения по умолчанию).
 */
function computex_cond_get_product_service_defaults()
{
	return array(
		'guarantee' => 'Гарантия до 5 лет на оборудование. После установки действует гарантия на кондиционер и выполненные монтажные работы.',
		'installment' => 'Рассрочка до 12 месяцев. Подскажем доступные варианты оплаты на кондиционер и монтаж.',
		'installation' => 'Профессиональный монтаж кондиционера: установка, проверка работы и консультация по управлению.',
	);
}

/**
 * Тексты гарантии, рассрочки и монтажа: meta товара → ACF Options → defaults.
 */
function computex_cond_get_product_service_texts($product_id = 0)
{
	$product_id = absint($product_id);
	$defaults = computex_cond_get_product_service_defaults();

	$guarantee = $product_id ? (string) get_post_meta($product_id, 'tekst_pro_garantiyu', true) : '';
	$installment = $product_id ? (string) get_post_meta($product_id, 'tekst_pro_rassrochku', true) : '';
	$installation = $product_id ? (string) get_post_meta($product_id, 'tekst_pro_montazh', true) : '';

	if (function_exists('get_field')) {
		if ($guarantee === '') {
			$guarantee = (string) get_field('tekst_pro_garantiyu', 'option');
		}

		if ($installment === '') {
			$installment = (string) get_field('tekst_pro_rassrochku', 'option');
		}

		if ($installation === '') {
			$installation = (string) get_field('tekst_pro_montazh', 'option');
		}
	}

	if (trim($guarantee) === '') {
		$guarantee = $defaults['guarantee'];
	}

	if (trim($installment) === '') {
		$installment = $defaults['installment'];
	}

	if (trim($installation) === '') {
		$installation = $defaults['installation'];
	}

	return array(
		'guarantee' => trim($guarantee),
		'installment' => trim($installment),
		'installation' => trim($installation),
	);
}

/**
 * Бейджи над фото на странице товара.
 */
function computex_cond_render_single_product_badges($product, $price_data = null, $has_variations = false)
{
	$html = computex_cond_render_product_card_badges_html($product, $price_data, $has_variations);

	if ($html === '') {
		return;
	}

	echo '<div class="catalog-single__badges" data-single-badges>';
	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '</div>';
}

/**
 * SVG-иконка гарантии (как в catalog-single).
 */
function computex_cond_get_guarantee_svg_icon($clip_id)
{
	return '<svg width="52" height="52" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
		. '<rect width="80" height="80" rx="40" fill="#35495F"></rect>'
		. '<g clip-path="url(#' . esc_attr($clip_id) . ')">'
		. '<path d="M37.945 53.1523C36.1907 54.7735 33.7643 55.1365 31.6122 54.1003C30.8342 53.7256 30.1776 53.2083 29.6636 52.5887L26.7333 59.0701C26.6 59.365 26.7488 59.5872 26.819 59.6691C26.8891 59.7508 27.0861 59.9318 27.3977 59.8451L29.531 59.2513C29.7741 59.1837 30.0199 59.1511 30.2622 59.1511C31.2844 59.1511 32.2466 59.7297 32.7098 60.6885L33.6733 62.6823C33.814 62.9737 34.078 63.0028 34.1878 63.0006C34.2956 62.9992 34.5606 62.9642 34.6939 62.6693L39.355 52.3594C38.8429 52.5068 38.3579 52.7707 37.945 53.1523Z" fill="white"></path>'
		. '<path d="M54.2664 59.0701L51.3361 52.5887C50.8221 53.2084 50.1655 53.7257 49.3875 54.1003C47.2353 55.1365 44.809 54.7735 43.0547 53.1523C42.6418 52.7707 42.1568 52.5068 41.6445 52.3594L46.3056 62.6693C46.439 62.9643 46.704 62.9992 46.8117 63.0006C46.9216 63.0028 47.1855 62.9737 47.3262 62.6823L48.2897 60.6885C48.7529 59.7297 49.7151 59.1511 50.7373 59.1511C50.9797 59.1511 51.2255 59.1837 51.4685 59.2513L53.6018 59.8451C53.9134 59.9319 54.1105 59.7509 54.1805 59.6691C54.2509 59.5871 54.3997 59.3649 54.2664 59.0701Z" fill="white"></path>'
		. '<path d="M56.5683 36.2629C54.1346 34.5965 53.3794 31.2878 54.8491 28.7305C55.7325 27.1932 55.2728 25.6741 54.5479 24.765C53.823 23.8562 52.4442 23.0701 50.749 23.5891C47.9292 24.4528 44.8712 22.9804 43.788 20.2368C43.1369 18.5876 41.6626 18 40.5 18C39.3375 18 37.8631 18.5876 37.212 20.2369C36.1289 22.9806 33.0712 24.4528 30.251 23.5891C28.5557 23.0702 27.1771 23.8562 26.4521 24.7651C25.7273 25.6742 25.2675 27.1931 26.1509 28.7306C27.6206 31.2878 26.8655 34.5966 24.4318 36.263C22.9687 37.2648 22.724 38.8329 22.9825 39.9663C23.2411 41.0998 24.1422 42.4063 25.895 42.6741C28.8107 43.1195 30.9265 45.7727 30.7122 48.7145C30.5832 50.483 31.6566 51.6521 32.704 52.1566C33.7514 52.661 35.3347 52.7714 36.6369 51.5679C37.7199 50.5671 39.1102 50.0665 40.4999 50.0665C41.8902 50.0665 43.2797 50.5668 44.3629 51.5679C45.6653 52.7715 47.2486 52.6611 48.296 52.1566C49.3434 51.6522 50.4167 50.4831 50.2878 48.7146C50.0734 45.7728 52.1893 43.1196 55.105 42.6741C56.8578 42.4063 57.7587 41.0997 58.0174 39.9663C58.2761 38.8327 58.0311 37.2647 56.5683 36.2629ZM40.5 47.5245C34.1214 47.5245 28.932 42.3351 28.932 35.9564C28.932 29.5777 34.1213 24.3882 40.5 24.3882C46.8788 24.3882 52.0681 29.5777 52.0681 35.9563C52.068 42.335 46.8787 47.5245 40.5 47.5245Z" fill="white"></path>'
		. '<path d="M40.4991 26.5469C35.3097 26.5469 31.0879 30.7688 31.0879 35.9581C31.0879 41.1474 35.3096 45.3694 40.4991 45.3694C45.6886 45.3694 49.9104 41.1474 49.9104 35.9581C49.9104 30.7688 45.6885 26.5469 40.4991 26.5469ZM45.3221 35.0456L39.4649 39.3237C39.279 39.4595 39.056 39.5313 38.8289 39.5313C38.7703 39.5313 38.7115 39.5266 38.653 39.5169C38.3674 39.4697 38.1127 39.3096 37.9463 39.0727L36.1942 36.5782C35.8519 36.0907 35.9696 35.418 36.457 35.0757C36.9444 34.7334 37.6169 34.851 37.9594 35.3384L39.08 36.934L44.05 33.3039C44.531 32.9528 45.2058 33.0575 45.557 33.5387C45.9083 34.0196 45.8031 34.6942 45.3221 35.0456Z" fill="white"></path>'
		. '</g><defs><clipPath id="' . esc_attr($clip_id) . '"><rect width="45" height="45" fill="white" transform="translate(18 18)"></rect></clipPath></defs></svg>';
}

/**
 * Блок гарантии, рассрочки и монтажа (яркий стиль как на страницах вода/воздух/тепло).
 */
function computex_cond_render_single_product_services($product_id = 0, $modifier = '')
{
	$texts = computex_cond_get_product_service_texts($product_id);
	$guarantee_text = $texts['guarantee'];
	$installment_text = $texts['installment'];
	$installation_text = $texts['installation'];
	$block_class = 'catalog-single__benefits';

	if ($modifier !== '') {
		$block_class .= ' ' . sanitize_html_class($modifier);
	}

	$clip_guarantee = 'clip-benefit-guarantee-' . absint($product_id);

	echo '<div class="' . esc_attr($block_class) . '">';
	echo '<div class="catalog-single__benefits-grid">';

	echo '<article class="catalog-single__benefit catalog-single__benefit--guarantee">';
	echo '<div class="catalog-single__benefit-tag"><span class="catalog-single__benefit-pulse"></span>Гарантия 5 лет</div>';
	echo '<div class="guarantee__row catalog-single__benefit-row flex">';
	echo '<div class="catalog-single__benefit-icon">' . computex_cond_get_guarantee_svg_icon($clip_guarantee) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '<div class="catalog-single__benefit-body"><h4>Гарантия на оборудование и монтаж</h4><p>' . esc_html($guarantee_text) . '</p></div>';
	echo '</div>';
	echo '<div class="catalog-single__benefit-meta"><span>Оборудование</span><strong>+</strong><span>Монтаж</span></div>';
	echo '</article>';

	echo '<article class="catalog-single__benefit catalog-single__benefit--installment">';
	echo '<div class="catalog-single__benefit-tag"><span class="catalog-single__benefit-pulse"></span>Рассрочка</div>';
	echo '<div class="guarantee__row catalog-single__benefit-row flex">';
	echo '<div class="catalog-single__benefit-icon">';
	echo '<svg width="52" height="52" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="80" height="80" rx="40" fill="#35495F"></rect><path d="M23.625 38.625V47.6254C23.625 49.7256 23.625 50.7752 24.0337 51.5773C24.3932 52.2829 24.9665 52.8572 25.6721 53.2166C26.4735 53.625 27.5231 53.625 29.6192 53.625H51.3808C53.4769 53.625 54.525 53.625 55.3264 53.2166C56.0319 52.8572 56.6072 52.2829 56.9666 51.5773C57.375 50.7759 57.375 49.7278 57.375 47.6318V38.625M23.625 38.625V34.875M23.625 38.625H57.375M57.375 38.625V34.875M23.625 34.875V33.3754C23.625 31.2752 23.625 30.2243 24.0337 29.4221C24.3932 28.7165 24.9665 28.1432 25.6721 27.7837C26.4743 27.375 27.5252 27.375 29.6254 27.375H51.3754C53.4756 27.375 54.5243 27.375 55.3264 27.7837C56.0319 28.1432 56.6072 28.7165 56.9666 29.4221C57.375 30.2235 57.375 31.2731 57.375 33.3692V34.875M23.625 34.875H57.375M31.125 46.125H38.625" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>';
	echo '</div>';
	echo '<div class="catalog-single__benefit-body"><h4>Рассрочка на оборудование и монтаж</h4><p>' . esc_html($installment_text) . '</p></div>';
	echo '</div>';
	echo '<div class="catalog-single__benefit-chips"><span>Оборудование</span><span>Монтаж</span></div>';
	echo '</article>';

	echo '<article class="catalog-single__benefit catalog-single__benefit--installation">';
	echo '<div class="catalog-single__benefit-tag catalog-single__benefit-tag--dark"><span class="catalog-single__benefit-pulse"></span>Монтаж</div>';
	echo '<div class="guarantee__row catalog-single__benefit-row flex">';
	echo '<div class="catalog-single__benefit-icon catalog-single__benefit-icon--light">';
	echo '<svg width="52" height="52" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="80" height="80" rx="40" fill="#ffffff"></rect><path d="M48 24L34 38H42L32 56L54 40H45L48 24Z" stroke="#35495F" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
	echo '</div>';
	echo '<div class="catalog-single__benefit-body"><h4>Монтаж под ключ</h4><p>' . esc_html($installation_text) . '</p></div>';
	echo '</div>';
	echo '<div class="catalog-single__benefit-chips catalog-single__benefit-chips--light"><span>Установка</span><span>Проверка</span><span>Настройка</span></div>';
	echo '</article>';

	echo '</div></div>';
}

function computex_cond_variable_product_has_stock($product)
{
	if (!$product->is_type('variable')) {
		return $product->is_in_stock();
	}

	foreach ($product->get_children() as $variation_id) {
		$variation = wc_get_product($variation_id);

		if ($variation && $variation->is_in_stock() && $variation->is_purchasable()) {
			return true;
		}
	}

	return false;
}

function computex_cond_is_product_visible_in_catalog($product)
{
	if (!$product instanceof WC_Product) {
		return false;
	}

	if ($product->get_status() !== 'publish') {
		return false;
	}

	if ($product->is_type('variable')) {
		return computex_cond_variable_product_has_stock($product);
	}

	return $product->is_in_stock();
}

function computex_cond_catalog_only_published_posts($query)
{
	if (is_admin() || !$query->is_main_query()) {
		return;
	}

	if ($query->get('post_type') !== 'catalog') {
		return;
	}

	$query->set('post_status', 'publish');
}

add_action('pre_get_posts', 'computex_cond_catalog_only_published_posts');

function computex_cond_normalize_shop_filter_request()
{
	if (is_admin()) {
		return;
	}

	if (isset($_GET['min_price']) && ('' === $_GET['min_price'] || (float) $_GET['min_price'] <= 0)) {
		unset($_GET['min_price'], $_REQUEST['min_price']);
	}

	if (isset($_GET['max_price']) && ('' === $_GET['max_price'] || (float) $_GET['max_price'] <= 0)) {
		unset($_GET['max_price'], $_REQUEST['max_price']);
	}

	if (isset($_GET['filter_area'])) {
		$areas = array_map('computex_cond_decode_filter_param', (array) wp_unslash($_GET['filter_area']));
		$areas = array_values(array_filter(array_map('trim', $areas)));

		$_GET['filter_area'] = $areas;
		$_REQUEST['filter_area'] = $areas;
	}

	if (isset($_GET['filter_category'])) {
		$categories = array_map('computex_cond_decode_filter_param', (array) wp_unslash($_GET['filter_category']));
		$categories = array_values(array_filter(array_map('trim', $categories)));

		$_GET['filter_category'] = $categories;
		$_REQUEST['filter_category'] = $categories;
	}
}

add_action('init', 'computex_cond_normalize_shop_filter_request', 1);

function computex_cond_decode_filter_param($value)
{
	$decoded = trim((string) wp_unslash($value));
	$previous = null;
	$guard = 0;

	while ($decoded !== $previous && $guard < 5) {
		$previous = $decoded;
		$decoded = rawurldecode($decoded);
		$guard++;
	}

	return trim($decoded);
}

function computex_cond_get_shop_filter_values()
{
	$categories = array();
	$areas = array();

	if (isset($_GET['filter_category'])) {
		$categories = array_map('computex_cond_decode_filter_param', (array) $_GET['filter_category']);
		$categories = array_values(array_filter($categories));

		foreach ($categories as $index => $category_slug) {
			$term = get_term_by('slug', $category_slug, 'product_cat');

			if ($term && !is_wp_error($term)) {
				$categories[$index] = $term->slug;
			}
		}
	}

	if (isset($_GET['filter_area'])) {
		$areas = array_map('computex_cond_decode_filter_param', (array) $_GET['filter_area']);
		$areas = array_values(
			array_filter(
				array_map('computex_cond_normalize_area_slug', $areas)
			)
		);
	}

	$min_price = isset($_GET['min_price']) ? wc_clean(wp_unslash($_GET['min_price'])) : '';
	$max_price = isset($_GET['max_price']) ? wc_clean(wp_unslash($_GET['max_price'])) : '';

	return array(
		'categories' => $categories,
		'min_price' => ($min_price !== '' && (float) $min_price > 0) ? $min_price : '',
		'max_price' => ($max_price !== '' && (float) $max_price > 0) ? $max_price : '',
		'areas' => $areas,
	);
}

function computex_cond_get_area_attribute_taxonomy()
{
	static $taxonomy = null;

	if (null !== $taxonomy) {
		return $taxonomy;
	}

	$taxonomy = '';

	if (function_exists('wc_get_attribute_taxonomies')) {
		foreach (wc_get_attribute_taxonomies() as $attribute) {
			$haystack = $attribute->attribute_name . ' ' . $attribute->attribute_label;

			if (preg_match('/площад|plosh|plosch|ploshhad|ploshad|area|м2|m2/ui', $haystack)) {
				$taxonomy = wc_attribute_taxonomy_name($attribute->attribute_name);
				return $taxonomy;
			}
		}
	}

	$candidates = array('pa_площадь', 'pa_ploshhad', 'pa_ploshhad-obsluzhivaniya', 'pa_ploshchad', 'pa_area', 'pa_ploshad');

	foreach ($candidates as $candidate) {
		if (taxonomy_exists($candidate)) {
			$taxonomy = $candidate;
			return $taxonomy;
		}
	}

	return $taxonomy;
}

function computex_cond_get_area_filter_terms()
{
	$taxonomy = computex_cond_get_area_attribute_taxonomy();

	if (!$taxonomy) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
		)
	);

	return is_wp_error($terms) ? array() : $terms;
}

function computex_cond_resolve_area_term($value, $taxonomy = null)
{
	if ($taxonomy === null) {
		$taxonomy = computex_cond_get_area_attribute_taxonomy();
	}

	if (!$taxonomy) {
		return null;
	}

	$value = computex_cond_decode_filter_param($value);

	if ($value === '') {
		return null;
	}

	$term = get_term_by('slug', $value, $taxonomy);

	if ($term && !is_wp_error($term)) {
		return $term;
	}

	$term = get_term_by('name', $value, $taxonomy);

	if ($term && !is_wp_error($term)) {
		return $term;
	}

	foreach (computex_cond_get_area_filter_terms() as $candidate) {
		if ($candidate->slug === $value || $candidate->name === $value) {
			return $candidate;
		}
	}

	return null;
}

function computex_cond_get_area_term_ids_by_slugs($area_slugs)
{
	$term_ids = array();

	foreach (array_values(array_filter((array) $area_slugs)) as $area_slug) {
		$term = computex_cond_resolve_area_term($area_slug);

		if ($term && !is_wp_error($term)) {
			$term_ids[] = (int) $term->term_id;
		}
	}

	return array_values(array_unique($term_ids));
}

function computex_cond_normalize_area_slug($value)
{
	$term = computex_cond_resolve_area_term($value);

	if ($term && !is_wp_error($term)) {
		return $term->slug;
	}

	$value = computex_cond_decode_filter_param($value);

	return $value === '' ? '' : $value;
}

function computex_cond_attribute_key_is_area($key, $taxonomy, $attribute_name, $meta_key)
{
	$key = computex_cond_decode_filter_param((string) $key);
	$decoded_taxonomy = $taxonomy ? computex_cond_decode_filter_param($taxonomy) : '';
	$decoded_meta_key = $meta_key ? computex_cond_decode_filter_param($meta_key) : '';

	if (
		($meta_key && $key === $meta_key)
		|| ($decoded_meta_key && $key === $decoded_meta_key)
		|| ($taxonomy && $key === $taxonomy)
		|| ($decoded_taxonomy && $key === $decoded_taxonomy)
		|| ($attribute_name && $key === $attribute_name)
		|| ($attribute_name && stripos($key, $attribute_name) !== false)
		|| ($decoded_taxonomy && stripos($key, $decoded_taxonomy) !== false)
	) {
		return true;
	}

	return (bool) preg_match('/area|plosh|plosch|ploshhad|ploshad|площад|м²|m2/ui', $key);
}

function computex_cond_get_variation_area_slug($attributes)
{
	$taxonomy = computex_cond_get_area_attribute_taxonomy();
	$meta_key = $taxonomy ? 'attribute_' . $taxonomy : '';
	$attribute_name = $taxonomy ? preg_replace('/^pa_/', '', $taxonomy) : '';
	$fallback_value = '';

	foreach ($attributes as $key => $value) {
		if ($value === '' || $value === null) {
			continue;
		}

		$value = computex_cond_decode_filter_param((string) $value);

		if (computex_cond_attribute_key_is_area($key, $taxonomy, $attribute_name, $meta_key)) {
			return computex_cond_normalize_area_slug($value);
		}

		if ($fallback_value === '') {
			$fallback_value = $value;
		}
	}

	if ($fallback_value !== '' && count(array_filter($attributes)) === 1) {
		return computex_cond_normalize_area_slug($fallback_value);
	}

	return '';
}

function computex_cond_get_variation_area_slug_from_id($variation_id, $attributes = array())
{
	$variation_id = absint($variation_id);
	$slug = computex_cond_get_variation_area_slug((array) $attributes);

	if ($slug !== '') {
		return $slug;
	}

	if (!$variation_id) {
		return '';
	}

	$taxonomy = computex_cond_get_area_attribute_taxonomy();

	if (!$taxonomy) {
		return '';
	}

	$meta_value = get_post_meta($variation_id, 'attribute_' . $taxonomy, true);

	if ($meta_value !== '') {
		return computex_cond_normalize_area_slug($meta_value);
	}

	$variation = wc_get_product($variation_id);

	if ($variation instanceof WC_Product_Variation) {
		return computex_cond_get_variation_area_slug($variation->get_attributes());
	}

	return '';
}

/**
 * Ссылка на товар с выбранной вариацией (площадью).
 */
function computex_cond_get_product_link_with_variation($permalink, $variation_id = 0, $area_slug = '')
{
	$permalink = (string) $permalink;

	if ($permalink === '') {
		return '';
	}

	$variation_id = absint($variation_id);
	$area_slug = trim((string) $area_slug);

	if ($variation_id > 0) {
		return add_query_arg('variation', $variation_id, $permalink);
	}

	if ($area_slug !== '') {
		return add_query_arg('area', $area_slug, $permalink);
	}

	return $permalink;
}

/**
 * Вариация из query string (?variation= или ?area=).
 */
function computex_cond_get_preselected_variation_option($variation_options)
{
	if (empty($variation_options)) {
		return null;
	}

	$variation_id = isset($_GET['variation']) ? absint(wp_unslash($_GET['variation'])) : 0;
	$area_slug = '';

	if (isset($_GET['area'])) {
		$area_slug = computex_cond_normalize_area_slug(wp_unslash((string) $_GET['area']));
	}

	if ($variation_id > 0) {
		foreach ($variation_options as $option) {
			if (!empty($option['id']) && (int) $option['id'] === $variation_id) {
				return $option;
			}
		}
	}

	if ($area_slug !== '') {
		foreach ($variation_options as $option) {
			if (!empty($option['slug']) && $option['slug'] === $area_slug) {
				return $option;
			}
		}
	}

	return null;
}

function computex_cond_variation_matches_area_filters($variation_id, $attributes, $area_slugs)
{
	$candidates = array();

	$slug = computex_cond_get_variation_area_slug_from_id($variation_id, $attributes);

	if ($slug !== '') {
		$candidates[] = $slug;
	}

	if (!empty($attributes)) {
		foreach ($attributes as $value) {
			if ($value !== '' && $value !== null) {
				$candidates[] = computex_cond_decode_filter_param((string) $value);
			}
		}
	}

	$candidates = array_values(array_unique(array_filter($candidates)));

	foreach ($candidates as $candidate) {
		if (computex_cond_area_slug_matches_filter($candidate, $area_slugs)) {
			return true;
		}
	}

	return false;
}

function computex_cond_get_product_card_variation_options($product, $shop_filters = null)
{
	if (!$product instanceof WC_Product || !$product->is_type('variable')) {
		return array();
	}

	if ($shop_filters === null) {
		$shop_filters = computex_cond_get_shop_filter_values();
	}

	$product_id = $product->get_id();
	$variation_options = array();
	$index = 0;

	foreach ($product->get_children() as $variation_id) {
		$variation_id = absint($variation_id);
		$variation_product = wc_get_product($variation_id);

		if (!$variation_product || !$variation_product->is_in_stock() || !$variation_product->is_purchasable()) {
			continue;
		}

		$attributes = $variation_product->get_attributes();
		$label = computex_cond_get_variation_option_label($attributes, $index);
		$area_slug = computex_cond_get_variation_area_slug_from_id($variation_id, $attributes);
		$variation_price = computex_cond_get_product_price_data($variation_product);
		$variation_image = '';
		$image_id = $variation_product->get_image_id();

		if ($image_id) {
			$variation_image = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
		}

		$option = array(
			'id' => $variation_id,
			'label' => $label,
			'slug' => $area_slug,
			'attributes' => $attributes,
			'sort' => preg_match('/\d+/', $label, $matches) ? (int) $matches[0] : 999999,
			'price' => $variation_price['current'],
			'price_numeric' => $variation_price['current_numeric'],
			'regular' => $variation_price['regular'],
			'on_sale' => $variation_price['on_sale'],
			'discount_percent' => $variation_price['discount_percent'],
			'discount_label' => $variation_price['discount_label'],
			'savings' => $variation_price['savings'],
			'image' => $variation_image,
			'area' => $label,
			'characteristics' => computex_cond_get_card_display_properties($product_id, $variation_id, $label),
		);

		if (!computex_cond_variation_option_matches_shop_filters($option, $shop_filters)) {
			continue;
		}

		$variation_options[] = $option;
		$index++;
	}

	usort(
		$variation_options,
		function ($first, $second) {
			return $first['sort'] <=> $second['sort'];
		}
	);

	return $variation_options;
}

function computex_cond_area_slug_matches_filter($raw_value, $area_slugs)
{
	$area_slugs = array_values(array_filter((array) $area_slugs));

	if ($raw_value === '' || empty($area_slugs)) {
		return false;
	}

	$filter_term_ids = computex_cond_get_area_term_ids_by_slugs($area_slugs);

	if (empty($filter_term_ids)) {
		return false;
	}

	$variation_term = computex_cond_resolve_area_term($raw_value);

	if ($variation_term && !is_wp_error($variation_term)) {
		return in_array((int) $variation_term->term_id, $filter_term_ids, true);
	}

	$normalized_value = computex_cond_normalize_area_slug($raw_value);

	foreach ($area_slugs as $area_slug) {
		if ($normalized_value === computex_cond_normalize_area_slug($area_slug)) {
			return true;
		}
	}

	return false;
}

function computex_cond_get_parent_ids_by_area_slugs($area_slugs)
{
	global $wpdb;

	$area_slugs = array_values(
		array_filter(
			array_map('computex_cond_normalize_area_slug', (array) $area_slugs)
		)
	);

	if (empty($area_slugs)) {
		return array();
	}

	$taxonomy = computex_cond_get_area_attribute_taxonomy();

	if (!$taxonomy) {
		return array();
	}

	$meta_key = 'attribute_' . $taxonomy;
	$parent_ids = array();

	$variation_ids = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT p.ID
			FROM {$wpdb->posts} p
			INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
			WHERE p.post_type = 'product_variation'
			AND p.post_status = 'publish'
			AND pm.meta_key = %s",
			$meta_key
		)
	);

	foreach ($variation_ids as $variation_id) {
		$variation = wc_get_product((int) $variation_id);

		if (!$variation || !$variation->is_in_stock()) {
			continue;
		}

		$raw_value = get_post_meta((int) $variation_id, $meta_key, true);

		if (!computex_cond_area_slug_matches_filter($raw_value, $area_slugs)) {
			$attributes = $variation->get_attributes();
			$slug = computex_cond_get_variation_area_slug($attributes);

			if (!$slug || !computex_cond_area_slug_matches_filter($slug, $area_slugs)) {
				continue;
			}
		}

		$parent_id = $variation->get_parent_id();

		if ($parent_id) {
			$parent_ids[] = $parent_id;
		}
	}

	$parent_ids = array_values(array_unique(array_filter($parent_ids)));

	if (!empty($parent_ids)) {
		return $parent_ids;
	}

	$term_ids = computex_cond_get_area_term_ids_by_slugs($area_slugs);

	if (empty($term_ids)) {
		return array();
	}

	$products = wc_get_products(
		array(
			'status' => 'publish',
			'limit' => -1,
			'return' => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms' => $term_ids,
					'operator' => 'IN',
				),
			),
		)
	);

	return array_map('intval', $products);
}

function computex_cond_get_catalog_filters_page_url()
{
	if (is_product_taxonomy()) {
		$term = get_queried_object();

		if ($term instanceof WP_Term) {
			$term_link = get_term_link($term);

			if (!is_wp_error($term_link)) {
				return $term_link;
			}
		}
	}

	if (function_exists('wc_get_page_permalink')) {
		return wc_get_page_permalink('shop');
	}

	return home_url('/shop/');
}

function computex_cond_get_active_category_filter_slugs()
{
	$filters = computex_cond_get_shop_filter_values();
	$categories = $filters['categories'];

	if (empty($categories) && is_product_category()) {
		$term = get_queried_object();

		if ($term instanceof WP_Term && $term->taxonomy === 'product_cat') {
			$categories = array($term->slug);
		}
	}

	return $categories;
}

function computex_cond_has_active_shop_filters()
{
	$filters = computex_cond_get_shop_filter_values();

	return !empty($filters['categories'])
		|| !empty($filters['areas'])
		|| $filters['min_price'] !== ''
		|| $filters['max_price'] !== '';
}

function computex_cond_is_catalog_products_main_query($query)
{
	if (is_admin() || !($query instanceof WP_Query)) {
		return false;
	}

	if ('product_query' === $query->get('wc_query')) {
		return true;
	}

	if (!$query->is_main_query() || 'product' !== $query->get('post_type')) {
		return false;
	}

	return $query->is_post_type_archive('product') || $query->is_tax(get_object_taxonomies('product', 'names'));
}

function computex_cond_get_category_term_ids_by_slugs($category_slugs)
{
	$term_ids = array();

	foreach (array_values(array_filter((array) $category_slugs)) as $category_slug) {
		$term = get_term_by('slug', $category_slug, 'product_cat');

		if ($term && !is_wp_error($term)) {
			$term_ids[] = (int) $term->term_id;
		}
	}

	return array_values(array_unique($term_ids));
}

function computex_cond_get_product_ids_by_category_slugs($category_slugs)
{
	$term_ids = computex_cond_get_category_term_ids_by_slugs($category_slugs);

	if (empty($term_ids)) {
		return array();
	}

	$query = new WP_Query(
		array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'no_found_rows' => true,
			'ignore_sticky_posts' => true,
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'term_id',
					'terms' => $term_ids,
					'operator' => 'IN',
					'include_children' => true,
				),
			),
		)
	);

	return array_values(array_unique(array_map('intval', (array) $query->posts)));
}

function computex_cond_filter_product_query_tax_query($tax_query, $wc_query)
{
	if (is_admin() || !computex_cond_has_active_shop_filters()) {
		return $tax_query;
	}

	$filters = computex_cond_get_shop_filter_values();

	if (!empty($filters['areas']) || empty($filters['categories'])) {
		return $tax_query;
	}

	if (!is_array($tax_query)) {
		$tax_query = array();
	}

	$term_ids = computex_cond_get_category_term_ids_by_slugs($filters['categories']);

	if (empty($term_ids)) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => array(0),
			'operator' => 'IN',
		);

		return $tax_query;
	}

	$tax_query[] = array(
		'taxonomy' => 'product_cat',
		'field' => 'term_id',
		'terms' => $term_ids,
		'operator' => 'IN',
		'include_children' => true,
	);

	return $tax_query;
}

add_filter('woocommerce_product_query_tax_query', 'computex_cond_filter_product_query_tax_query', 10, 2);

function computex_cond_merge_product_id_filters($current_ids, $new_ids)
{
	$new_ids = array_values(array_unique(array_map('intval', (array) $new_ids)));

	if ($current_ids === null) {
		return $new_ids;
	}

	return array_values(array_intersect($current_ids, $new_ids));
}

function computex_cond_apply_shop_filters_to_main_query($query)
{
	static $processed = array();

	if (!computex_cond_is_catalog_products_main_query($query)) {
		return;
	}

	$filters = computex_cond_get_shop_filter_values();

	if (empty($filters['categories']) && empty($filters['areas'])) {
		return;
	}

	$query_hash = spl_object_hash($query);

	if (isset($processed[$query_hash])) {
		return;
	}

	$processed[$query_hash] = true;

	$product_ids = null;

	if (!empty($filters['categories'])) {
		$product_ids = computex_cond_merge_product_id_filters(
			$product_ids,
			computex_cond_get_product_ids_by_category_slugs($filters['categories'])
		);
	}

	if (!empty($filters['areas'])) {
		$product_ids = computex_cond_merge_product_id_filters(
			$product_ids,
			computex_cond_get_parent_ids_by_area_slugs($filters['areas'])
		);
	}

	$query->set('post__in', !empty($product_ids) ? $product_ids : array(0));
}

add_action('woocommerce_product_query', 'computex_cond_apply_shop_filters_to_main_query', 99);
add_action('pre_get_posts', 'computex_cond_apply_shop_filters_to_main_query', 99);

function computex_cond_get_shop_pagination_add_args()
{
	$filters = computex_cond_get_shop_filter_values();
	$query_args = array();

	foreach ($filters['categories'] as $category_slug) {
		$query_args['filter_category'][] = $category_slug;
	}

	foreach ($filters['areas'] as $area_slug) {
		$query_args['filter_area'][] = $area_slug;
	}

	if ($filters['min_price'] !== '') {
		$query_args['min_price'] = $filters['min_price'];
	}

	if ($filters['max_price'] !== '') {
		$query_args['max_price'] = $filters['max_price'];
	}

	return $query_args;
}

function computex_cond_render_catalog_pagination($query = null)
{
	if ($query === null) {
		global $wp_query;
		$query = $wp_query;
	}

	$total_pages = (int) $query->max_num_pages;

	if ($total_pages < 2) {
		return;
	}

	$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

	echo paginate_links(
		array(
			'base' => esc_url_raw(str_replace(999999999, '%#%', get_pagenum_link(999999999))),
			'format' => '',
			'current' => $paged,
			'total' => $total_pages,
			'prev_text' => '<span class="custom-arrow custom-arrow--prev">←</span>',
			'next_text' => '<span class="custom-arrow custom-arrow--next">→</span>',
			'add_args' => computex_cond_get_shop_pagination_add_args(),
		)
	);
}

function computex_cond_get_shop_pagination_args($args)
{
	$query_args = isset($args['add_args']) && is_array($args['add_args']) ? $args['add_args'] : array();
	$args['add_args'] = array_merge($query_args, computex_cond_get_shop_pagination_add_args());

	return $args;
}

add_filter('woocommerce_pagination_args', 'computex_cond_get_shop_pagination_args');

function computex_cond_variation_option_matches_shop_filters($option, $filters)
{
	if (!empty($filters['areas'])) {
		$variation_id = !empty($option['id']) ? (int) $option['id'] : 0;
		$attributes = !empty($option['attributes']) ? (array) $option['attributes'] : array();

		if (!computex_cond_variation_matches_area_filters($variation_id, $attributes, $filters['areas'])) {
			if (!empty($option['slug']) && computex_cond_area_slug_matches_filter($option['slug'], $filters['areas'])) {
				// Matched by slug stored on option.
			} elseif (!empty($option['label']) && computex_cond_area_slug_matches_filter($option['label'], $filters['areas'])) {
				// Matched by visible label / term name.
			} else {
				return false;
			}
		}
	}

	$price = isset($option['price_numeric']) ? (float) $option['price_numeric'] : 0;

	if ($price <= 0 && !empty($option['id'])) {
		$variation = wc_get_product((int) $option['id']);

		if ($variation instanceof WC_Product) {
			$price = (float) computex_cond_get_product_price_data($variation)['current_numeric'];
		}
	}

	if ($filters['min_price'] !== '' && $price < (float) $filters['min_price']) {
		return false;
	}

	if ($filters['max_price'] !== '' && $price > (float) $filters['max_price']) {
		return false;
	}

	return true;
}

function computex_cond_has_variation_level_shop_filters($filters = null)
{
	if ($filters === null) {
		$filters = computex_cond_get_shop_filter_values();
	}

	return !empty($filters['areas'])
		|| $filters['min_price'] !== ''
		|| $filters['max_price'] !== '';
}

function computex_cond_filter_variation_options_by_shop_filters($variation_options, $filters = null)
{
	if (empty($variation_options)) {
		return $variation_options;
	}

	if ($filters === null) {
		$filters = computex_cond_get_shop_filter_values();
	}

	if (!computex_cond_has_variation_level_shop_filters($filters)) {
		return $variation_options;
	}

	$filtered = array();

	foreach ($variation_options as $option) {
		if (computex_cond_variation_option_matches_shop_filters($option, $filters)) {
			$filtered[] = $option;
		}
	}

	return $filtered;
}

function computex_cond_filter_variation_options_by_area($variation_options, $area_slugs = null)
{
	$filters = computex_cond_get_shop_filter_values();

	if ($area_slugs !== null) {
		$filters['areas'] = $area_slugs;
	}

	return computex_cond_filter_variation_options_by_shop_filters($variation_options, $filters);
}

function computex_cond_get_variation_characteristic_fields()
{
	return array(
		'cooling_power' => 'Мощность охлаждения, кВт',
		'heating_power' => 'Мощность обогрева, кВт',
		'cooling_consumption' => 'Потребляемая мощность при охлаждении, кВт',
		'heating_consumption' => 'Потребляемая мощность при обогреве, кВт',
		'indoor_dimensions' => 'Габариты внутреннего блока',
		'outdoor_dimensions' => 'Габариты наружного блока',
		'indoor_weight' => 'Вес внутреннего блока, кг',
		'outdoor_weight' => 'Вес наружного блока, кг',
	);
}

function computex_cond_get_variation_characteristics($variation_id)
{
	$characteristics = array();

	foreach (computex_cond_get_variation_characteristic_fields() as $key => $label) {
		$value = get_post_meta($variation_id, '_' . $key, true);

		if ($value !== '') {
			$characteristics[] = array(
				'label' => $label,
				'value' => $value,
			);
		}
	}

	return $characteristics;
}

// Добавляем кастомные поля характеристик в каждую вариацию WooCommerce
add_action('woocommerce_product_after_variable_attributes', 'custom_variation_fields', 10, 3);

function custom_variation_fields($loop, $variation_data, $variation)
{
	$fields = computex_cond_get_variation_characteristic_fields();

	echo '<div class="form-row form-row-full">';
	echo '<h4 style="margin: 12px 0;">Характеристики вариации</h4>';
	echo '</div>';

	foreach ($fields as $key => $label) {
		woocommerce_wp_text_input(array(
			'id' => $key . '_' . $loop,
			'name' => $key . '[' . $loop . ']',
			'label' => $label,
			'value' => get_post_meta($variation->ID, '_' . $key, true),
			'wrapper_class' => 'form-row form-row-full',
		));
	}
}

// Сохраняем значения кастомных полей вариаций WooCommerce
add_action('woocommerce_save_product_variation', 'save_custom_variation_fields', 10, 2);

function save_custom_variation_fields($variation_id, $i)
{
	$fields = array_keys(computex_cond_get_variation_characteristic_fields());

	foreach ($fields as $field) {
		if (isset($_POST[$field][$i])) {
			update_post_meta(
				$variation_id,
				'_' . $field,
				sanitize_text_field(wp_unslash($_POST[$field][$i]))
			);
		}
	}
}

/**
 * Атрибуты вариации для формы (meta + объект вариации).
 */
function computex_cond_get_variation_attributes_for_form($variation_id, $variation_product = null)
{
	if (!$variation_product instanceof WC_Product_Variation) {
		$variation_product = wc_get_product($variation_id);
	}

	if (!$variation_product instanceof WC_Product_Variation) {
		return array();
	}

	$attributes = array_filter((array) $variation_product->get_attributes());

	if (!empty($attributes)) {
		return $attributes;
	}

	$meta_attributes = array();
	$meta_data = get_post_meta($variation_id);

	foreach ($meta_data as $meta_key => $meta_values) {
		if (strpos($meta_key, 'attribute_') !== 0) {
			continue;
		}

		$value = isset($meta_values[0]) ? (string) $meta_values[0] : '';

		if ($value === '') {
			continue;
		}

		$taxonomy = substr($meta_key, strlen('attribute_'));
		$meta_attributes[$taxonomy] = $value;
	}

	return $meta_attributes;
}

/**
 * Полное название вариации для страницы товара (с моделью / SKU).
 */
function computex_cond_get_variation_display_name($parent_product, $variation_product, $area_label = '')
{
	if (!$parent_product instanceof WC_Product || !$variation_product instanceof WC_Product_Variation) {
		return '';
	}

	$parent_name = trim($parent_product->get_name());
	$variation_name = trim($variation_product->get_name());
	$area_label = trim((string) $area_label);

	if ($variation_name !== '' && $variation_name !== $parent_name) {
		return $variation_name;
	}

	$sku = trim($variation_product->get_sku());
	$description = trim(wp_strip_all_tags($variation_product->get_description()));
	$parts = array($parent_name);

	if ($sku !== '') {
		$parts[] = $sku;
	} elseif ($description !== '') {
		$parts[] = $description;
	}

	if ($area_label !== '') {
		$parts[] = $area_label;
	}

	$parts = array_values(array_unique(array_filter($parts)));

	return implode(' · ', $parts);
}

/**
 * Вариации для страницы товара — все опубликованные, без фильтра каталога.
 */
function computex_cond_get_single_product_variation_options($product)
{
	if (!$product instanceof WC_Product || !$product->is_type('variable')) {
		return array();
	}

	$product_id = $product->get_id();
	$variation_options = array();
	$index = 0;

	foreach ($product->get_children(false) as $variation_id) {
		$variation_id = absint($variation_id);
		$variation_product = wc_get_product($variation_id);

		if (!$variation_product instanceof WC_Product_Variation) {
			continue;
		}

		if (!in_array($variation_product->get_status(), array('publish', 'private'), true)) {
			continue;
		}

		$attributes = computex_cond_get_variation_attributes_for_form($variation_id, $variation_product);
		$label = computex_cond_get_variation_option_label($attributes, $index);
		$area_slug = computex_cond_get_variation_area_slug_from_id($variation_id, $attributes);
		$variation_price = computex_cond_get_product_price_data($variation_product);
		$variation_image = '';
		$image_id = $variation_product->get_image_id();

		if ($image_id) {
			$variation_image = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
		}

		$variation_options[] = array(
			'id' => $variation_id,
			'label' => $label,
			'display_name' => computex_cond_get_variation_display_name($product, $variation_product, $label),
			'slug' => $area_slug,
			'attributes' => $attributes,
			'sort' => preg_match('/\d+/u', $label, $matches) ? (int) $matches[0] : 999999,
			'price' => $variation_price['current'],
			'price_numeric' => $variation_price['current_numeric'],
			'regular' => $variation_price['regular'],
			'on_sale' => $variation_price['on_sale'],
			'discount_percent' => $variation_price['discount_percent'],
			'discount_label' => $variation_price['discount_label'],
			'savings' => $variation_price['savings'],
			'image' => $variation_image,
			'area' => $label,
			'in_stock' => $variation_product->is_in_stock() && $variation_product->is_purchasable(),
			'characteristics' => computex_cond_get_card_display_properties($product_id, $variation_id, $label),
		);

		$index++;
	}

	if (empty($variation_options)) {
		$available_variations = $product->get_available_variations();

		if (is_array($available_variations)) {
			foreach ($available_variations as $variation_index => $variation_data) {
				$variation_id = !empty($variation_data['variation_id']) ? absint($variation_data['variation_id']) : 0;

				if (!$variation_id) {
					continue;
				}

				$variation_product = wc_get_product($variation_id);

				if (!$variation_product instanceof WC_Product_Variation) {
					continue;
				}

				$attributes = array();

				if (!empty($variation_data['attributes']) && is_array($variation_data['attributes'])) {
					foreach ($variation_data['attributes'] as $attr_key => $attr_value) {
						$taxonomy = str_replace('attribute_', '', $attr_key);
						$attributes[$taxonomy] = $attr_value;
					}
				}

				if (empty($attributes)) {
					$attributes = computex_cond_get_variation_attributes_for_form($variation_id, $variation_product);
				}

				$label = computex_cond_get_variation_option_label($attributes, $variation_index);
				$variation_price = computex_cond_get_product_price_data($variation_product);

				$variation_options[] = array(
					'id' => $variation_id,
					'label' => $label,
					'display_name' => computex_cond_get_variation_display_name($product, $variation_product, $label),
					'slug' => computex_cond_get_variation_area_slug_from_id($variation_id, $attributes),
					'attributes' => $attributes,
					'sort' => preg_match('/\d+/u', $label, $matches) ? (int) $matches[0] : 999999,
					'price' => $variation_price['current'],
					'price_numeric' => $variation_price['current_numeric'],
					'regular' => $variation_price['regular'],
					'on_sale' => $variation_price['on_sale'],
					'discount_percent' => $variation_price['discount_percent'],
					'discount_label' => $variation_price['discount_label'],
					'savings' => $variation_price['savings'],
					'image' => !empty($variation_data['image']['url']) ? $variation_data['image']['url'] : '',
					'area' => $label,
					'in_stock' => !empty($variation_data['is_in_stock']),
					'characteristics' => computex_cond_get_card_display_properties($product_id, $variation_id, $label),
				);
			}
		}
	}

	usort(
		$variation_options,
		function ($first, $second) {
			return $first['sort'] <=> $second['sort'];
		}
	);

	return $variation_options;
}

/**
 * Кнопки вариаций (как в карточке каталога / слайдере).
 */
function computex_cond_render_single_product_variation_buttons($variation_options, $active_variation_id = 0)
{
	if (empty($variation_options)) {
		return;
	}

	$active_variation_id = absint($active_variation_id);
	$has_active = false;

	foreach ($variation_options as $option) {
		if ($active_variation_id > 0 && !empty($option['id']) && (int) $option['id'] === $active_variation_id) {
			$has_active = true;
			break;
		}
	}

	echo '<div class="flex product-card__variants catalog-single__variants" role="listbox" aria-label="' . esc_attr__('Варианты товара', 'computex-cond') . '">';

	foreach ($variation_options as $index => $option) {
		$form_attributes = computex_cond_get_variation_form_attribute_map($option['attributes']);
		$is_active = $has_active
			? ($active_variation_id > 0 && !empty($option['id']) && (int) $option['id'] === $active_variation_id)
			: ($index === 0);
		$is_disabled = empty($option['in_stock']);

		printf(
			'<button type="button" class="button-gray catalog-single__variant product-card__variant%s%s" role="option" aria-selected="%s"%s data-variation-id="%s" data-area-slug="%s" data-display-name="%s" data-form-attributes="%s" data-characteristics="%s" data-image="%s" data-price="%s" data-regular="%s" data-on-sale="%s" data-discount-label="%s" data-savings="%s" data-in-stock="%s">%s</button>',
			$is_active ? ' is-active' : '',
			$is_disabled ? ' is-disabled' : '',
			$is_active ? 'true' : 'false',
			$is_disabled ? ' disabled' : '',
			esc_attr($option['id']),
			esc_attr(!empty($option['slug']) ? $option['slug'] : ''),
			esc_attr(!empty($option['display_name']) ? $option['display_name'] : $option['label']),
			esc_attr(wp_json_encode($form_attributes, JSON_UNESCAPED_UNICODE)),
			esc_attr(wp_json_encode($option['characteristics'], JSON_UNESCAPED_UNICODE)),
			esc_url(!empty($option['image']) ? $option['image'] : ''),
			esc_attr($option['price']),
			esc_attr($option['regular']),
			!empty($option['on_sale']) ? '1' : '0',
			esc_attr($option['discount_label']),
			esc_attr($option['savings']),
			!empty($option['in_stock']) ? '1' : '0',
			esc_html($option['label'])
		);
	}

	echo '</div>';
}

/**
 * Атрибуты вариации в формате имён полей формы WooCommerce.
 */
function computex_cond_get_variation_form_attribute_map($attributes)
{
	$map = array();

	foreach ((array) $attributes as $taxonomy => $slug) {
		if ($slug === '' || $slug === null) {
			continue;
		}

		$map['attribute_' . sanitize_title((string) $taxonomy)] = (string) $slug;
	}

	return $map;
}

/**
 * Основные и дополнительные строки таблицы характеристик.
 */
function computex_cond_split_characteristics_for_table($properties, $max_primary = 6)
{
	$properties = array_values((array) $properties);
	$primary = computex_cond_filter_preview_characteristics($properties, $max_primary);
	$primary_keys = array();

	foreach ($primary as $property) {
		$primary_keys[computex_cond_property_label_key($property['label'])] = true;
	}

	$extra = array();

	foreach ($properties as $property) {
		if (empty($property['label'])) {
			continue;
		}

		$key = computex_cond_property_label_key($property['label']);

		if (!isset($primary_keys[$key])) {
			$extra[] = $property;
		}
	}

	return array(
		'primary' => $primary,
		'extra' => $extra,
		'total' => count($properties),
	);
}

/**
 * Строки таблицы характеристик.
 */
function computex_cond_render_characteristics_table_rows($properties)
{
	foreach ((array) $properties as $property) {
		if (empty($property['label'])) {
			continue;
		}

		echo '<tr>';
		echo '<td>' . esc_html($property['label']) . ': </td>';
		echo '<td>' . esc_html(isset($property['value']) ? $property['value'] : '') . '</td>';
		echo '</tr>';
	}
}

/**
 * Таблица характеристик для single product.
 */
function computex_cond_render_product_characteristics_table($properties)
{
	if (empty($properties)) {
		echo '<p class="catalog-single__empty-specs">Характеристики не указаны.</p>';
		return;
	}

	echo '<table><tbody>';
	computex_cond_render_characteristics_table_rows($properties);
	echo '</tbody></table>';
}

/**
 * Список характеристик в карточке каталога / shop (только 6 полей).
 */
function computex_cond_render_product_card_specs_list($properties)
{
	$properties = computex_cond_filter_product_card_characteristics($properties);

	echo '<div class="product-card__specs-wrap" data-card-specs-wrap>';
	echo '<ul data-card-specs>';

	foreach ($properties as $property) {
		if (empty($property['label'])) {
			continue;
		}

		echo '<li class="flex"';
		echo computex_cond_is_area_property_label($property['label']) ? ' data-area-spec' : '';
		echo '><p>' . esc_html($property['label']) . ': </p>';
		echo '<p>' . esc_html(isset($property['value']) ? $property['value'] : '') . '</p></li>';
	}

	echo '</ul></div>';
}

/**
 * Список брендов (категории WooCommerce + ACF).
 *
 * @return array<string, string>
 */
function computex_cond_get_brand_option_map()
{
	return array(
		'LG' => 'lg_opisanie',
		'AlpicAir' => 'alpicair_opisanie',
		'Gree' => 'gree_opisanie',
		'Ultima' => 'ultima_opisanie',
		'General' => 'general_opisanie',
		'TLC' => 'tlc_opisanie',
	);
}

/**
 * Категория-бренд товара (product_cat).
 */
function computex_cond_get_product_brand_term($product)
{
	if (!$product instanceof WC_Product) {
		return null;
	}

	$terms = wp_get_post_terms(
		$product->get_id(),
		'product_cat',
		array(
			'orderby' => 'term_id',
		)
	);

	if (is_wp_error($terms) || empty($terms)) {
		return null;
	}

	$brand_names = array_keys(computex_cond_get_brand_option_map());

	foreach ($terms as $term) {
		if (!$term instanceof WP_Term) {
			continue;
		}

		if (in_array(trim($term->name), $brand_names, true)) {
			return $term;
		}
	}

	return null;
}

/**
 * URL каталога бренда: архив категории или магазин с фильтром.
 */
function computex_cond_get_brand_category_url($brand_term)
{
	if (!$brand_term instanceof WP_Term) {
		return '';
	}

	$term_link = get_term_link($brand_term);

	if (!is_wp_error($term_link)) {
		return $term_link;
	}

	if (function_exists('wc_get_page_permalink')) {
		return add_query_arg(
			array(
				'filter_category' => array($brand_term->slug),
			),
			wc_get_page_permalink('shop')
		);
	}

	return '';
}

/**
 * Логотип бренда: ACF «logo_brenda» или миниатюра категории.
 *
 * @return array{url: string, alt: string}|null
 */
function computex_cond_get_brand_logo_image($brand_name, $brand_term = null)
{
	$brand_name = trim((string) $brand_name);

	if ($brand_name === '') {
		return null;
	}

	if (function_exists('have_rows') && have_rows('logo_brenda', 'option')) {
		$match_fields = array('nazvanie', 'brend', 'brand', 'name', 'zagolovok');

		while (have_rows('logo_brenda', 'option')) {
			the_row();
			$logo = get_sub_field('foto');

			if (empty($logo['url'])) {
				continue;
			}

			foreach ($match_fields as $field_name) {
				$field_value = trim((string) get_sub_field($field_name));

				if ($field_value !== '' && strcasecmp($field_value, $brand_name) === 0) {
					return array(
						'url' => $logo['url'],
						'alt' => !empty($logo['alt']) ? $logo['alt'] : $brand_name,
					);
				}
			}

			if (!empty($logo['alt']) && stripos($logo['alt'], $brand_name) !== false) {
				return array(
					'url' => $logo['url'],
					'alt' => $logo['alt'],
				);
			}
		}
	}

	if ($brand_term instanceof WP_Term) {
		$thumbnail_id = (int) get_term_meta($brand_term->term_id, 'thumbnail_id', true);

		if ($thumbnail_id) {
			$image_url = wp_get_attachment_image_url($thumbnail_id, 'medium');

			if ($image_url) {
				return array(
					'url' => $image_url,
					'alt' => $brand_name,
				);
			}
		}
	}

	return null;
}

/**
 * Данные ссылки на категорию бренда для карточки товара.
 *
 * @return array{name: string, url: string, logo: array{url: string, alt: string}}|null
 */
function computex_cond_get_product_brand_link_data($product)
{
	$brand_term = computex_cond_get_product_brand_term($product);

	if (!$brand_term instanceof WP_Term) {
		return null;
	}

	$url = computex_cond_get_brand_category_url($brand_term);

	if ($url === '') {
		return null;
	}

	$logo = computex_cond_get_brand_logo_image($brand_term->name, $brand_term);

	return array(
		'name' => $brand_term->name,
		'url' => $url,
		'logo' => $logo,
	);
}

/**
 * Компактная ссылка на категорию бренда (лого + название).
 */
function computex_cond_render_single_product_brand_link($product)
{
	$brand = computex_cond_get_product_brand_link_data($product);

	if (empty($brand)) {
		return;
	}

	echo '<a class="catalog-single__brand-link" href="' . esc_url($brand['url']) . '">';

	if (!empty($brand['logo']['url'])) {
		echo '<img class="catalog-single__brand-logo" src="' . esc_url($brand['logo']['url']) . '" alt="' . esc_attr($brand['logo']['alt']) . '" width="72" height="28" loading="lazy" decoding="async">';
	}

	echo '<span class="catalog-single__brand-name">' . esc_html($brand['name']) . '</span>';
	echo '</a>';
}

/**
 * Описание бренда по категории товара WooCommerce.
 */
function computex_cond_get_product_brand_description($product)
{
	if (!$product instanceof WC_Product) {
		return '';
	}

	$brand_map = computex_cond_get_brand_option_map();
	$brand_term = computex_cond_get_product_brand_term($product);

	if (!$brand_term instanceof WP_Term || !isset($brand_map[$brand_term->name]) || !function_exists('get_field')) {
		return '';
	}

	$description = get_field($brand_map[$brand_term->name], 'option');

	return $description ? $description : '';
}

/**
 * ACF-характеристики родительского товара (как в catalog CPT).
 */
function computex_cond_get_product_acf_characteristics($product_id)
{
	$rows = array();

	if (!function_exists('have_rows') || !have_rows('harakteristiki', $product_id)) {
		return $rows;
	}

	while (have_rows('harakteristiki', $product_id)) {
		the_row();
		$name = get_sub_field('nazvanie');
		$value = get_sub_field('svojstvo');

		if ($name !== '' && $value !== '') {
			$rows[] = array(
				'label' => $name,
				'value' => $value,
			);
		}
	}

	return $rows;
}

/**
 * Характеристики для вкладки: repeater ACF + textarea + вариация.
 */
function computex_cond_get_single_product_characteristics($product_id, $variation_id = 0, $area_label = '')
{
	$properties = computex_cond_get_card_display_properties($product_id, $variation_id, $area_label);
	$acf_rows = computex_cond_get_product_acf_characteristics($product_id);

	if (empty($acf_rows)) {
		return $properties;
	}

	$merged = array();
	$labels_seen = array();

	computex_cond_append_characteristic_rows($merged, $labels_seen, $acf_rows, false);
	computex_cond_append_characteristic_rows($merged, $labels_seen, $properties, false);

	return computex_cond_move_area_property_first($merged);
}

/**
 * Подключать скрипт карточек товара (магазин, слайдеры, главная).
 */
function computex_cond_should_enqueue_shop_cards_script()
{
	if (!function_exists('WC')) {
		return false;
	}

	if (is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag()) {
		return true;
	}

	if (function_exists('is_product') && is_product()) {
		return true;
	}

	if (is_front_page() || is_home()) {
		return true;
	}

	if (is_page() || is_singular('post')) {
		return true;
	}

	return false;
}

/**
 * Элементы слайдера «Хиты продаж» из ACF (WooCommerce + catalog CPT).
 *
 * @return array<int, array{id: int, type: string}>
 */
function computex_cond_get_hits_slider_items_from_acf()
{
	if (!function_exists('get_field')) {
		return array();
	}

	$products = get_field('tovary', 'option');

	if (empty($products) || !is_array($products)) {
		return array();
	}

	$items = array();
	$seen = array();

	foreach ($products as $item) {
		$id = is_object($item) ? (int) $item->ID : absint($item);

		if (!$id || get_post_status($id) !== 'publish') {
			continue;
		}

		$post_type = get_post_type($id);

		if (!in_array($post_type, array('product', 'catalog'), true)) {
			continue;
		}

		if (isset($seen[$id])) {
			continue;
		}

		$seen[$id] = true;
		$items[] = array(
			'id' => $id,
			'type' => $post_type,
		);
	}

	return $items;
}

/**
 * ID товаров WooCommerce для слайдера (только product из ACF).
 */
function computex_cond_get_hits_product_ids()
{
	$ids = array();

	foreach (computex_cond_get_hits_slider_items_from_acf() as $item) {
		if ($item['type'] === 'product') {
			$ids[] = $item['id'];
		}
	}

	return $ids;
}

/**
 * Карточка catalog CPT в слайдере (как на главной раньше).
 */
function computex_cond_render_hits_catalog_slide($post_id)
{
	$post_id = absint($post_id);

	if (!$post_id) {
		return;
	}

	$name = get_the_title($post_id);
	$price = function_exists('get_field') ? get_field('czena', $post_id) : get_post_meta($post_id, 'czena', true);
	$image_id = get_post_thumbnail_id($post_id);
	$image_src = $image_id ? wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail') : '';
	$image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : $name;
	$permalink = get_permalink($post_id);
	$properties = array();

	if (function_exists('have_rows') && have_rows('svojstva', $post_id)) {
		while (have_rows('svojstva', $post_id)) {
			the_row();
			$properties[] = array(
				'label' => (string) get_sub_field('zagolovok'),
				'value' => (string) get_sub_field('znachenie'),
			);
		}
	}
	?>
	<article class="product-card">
		<div class="product-card__row">
			<div class="product-card__img">
				<?php if ($image_src) : ?>
					<img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy" />
				<?php endif; ?>
			</div>
			<a class="title" href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($name); ?></a>
			<hr>
			<ul data-card-specs>
				<?php foreach ($properties as $property) : ?>
					<li class="flex">
						<p><?php echo esc_html($property['label']); ?>: </p>
						<p><?php echo esc_html($property['value']); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="product-card__info flex">
			<?php if ($price !== '' && $price !== null) : ?>
				<span class="price"><?php echo esc_html($price); ?> BYN</span>
			<?php endif; ?>
			<a class="button-gray" href="<?php echo esc_url($permalink); ?>"><?php esc_html_e('Подробнее', 'computex-cond'); ?></a>
		</div>
	</article>
	<?php
}

/**
 * Слайдер «Хиты продаж» / похожие товары.
 *
 * @param int[]|null $product_ids Список ID WooCommerce. null — из настроек ACF (product + catalog).
 * @param array      $args        title, link, slides_class.
 */
function computex_cond_render_hits_slider($product_ids = null, $args = array())
{
	$items = array();

	if ($product_ids === null) {
		$items = computex_cond_get_hits_slider_items_from_acf();
	} else {
		foreach (array_values(array_filter(array_map('absint', (array) $product_ids))) as $id) {
			$items[] = array(
				'id' => $id,
				'type' => 'product',
			);
		}
	}

	if (empty($items)) {
		return;
	}

	$defaults = array(
		'title' => function_exists('get_field') ? (string) get_field('zagolovok_hity_prodazh', 'option') : '',
		'link' => function_exists('get_field') ? get_field('ssylka_hity_prodazh', 'option') : null,
		'slides_class' => 'swiper-product__wrapp',
	);

	$args = wp_parse_args($args, $defaults);

	$slider_title = !empty($args['title']) ? $args['title'] : __('Хиты продаж', 'computex-cond');
	$slider_link = $args['link'];
	$slides_wrapper_class = $args['slides_class'];

	if (strpos($slides_wrapper_class, 'products') === false && array_filter(
		$items,
		function ($item) {
			return $item['type'] === 'product';
		}
	)) {
		$slides_wrapper_class .= ' products';
	}

	get_template_part(
		'template-parts/hits-product',
		'slider',
		array(
			'items' => $items,
			'slider_title' => $slider_title,
			'slider_link' => $slider_link,
			'slides_wrapper_class' => $slides_wrapper_class,
		)
	);
}

/**
 * Ссылки на соцсети из настроек темы (как на странице контактов).
 *
 * @return array<int, array{key: string, url: string, label: string}>
 */
function computex_cond_get_social_links_from_options()
{
	if (!function_exists('get_field')) {
		return array();
	}

	$links = array(
		array(
			'key' => 'instagram',
			'url' => (string) get_field('instagram', 'option'),
			'label' => 'Instagram',
		),
		array(
			'key' => 'telegram',
			'url' => (string) get_field('telegram', 'option'),
			'label' => 'Telegram',
		),
		array(
			'key' => 'viber',
			'url' => (string) get_field('viber', 'option'),
			'label' => 'Viber',
		),
	);

	$result = array();

	foreach ($links as $link) {
		$url = trim($link['url']);

		if ($url === '') {
			continue;
		}

		$result[] = array(
			'key' => $link['key'],
			'url' => $url,
			'label' => $link['label'],
		);
	}

	return $result;
}

/**
 * SVG-иконки соцсетей для карточки товара (как в контактном блоке, 24px).
 */
function computex_cond_get_product_social_icon_svg($key)
{
	switch ($key) {
		case 'instagram':
			return '<svg width="24" height="24" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20 0.226562C14.5725 0.226562 13.89 0.251563 11.7575 0.346563C9.625 0.446562 8.1725 0.781562 6.9 1.27656C5.56461 1.77738 4.35535 2.56506 3.3575 3.58406C2.3385 4.58192 1.55081 5.79117 1.05 7.12656C0.555 8.39656 0.2175 9.85156 0.12 11.9766C0.025 14.1141 0 14.7941 0 20.2291C0 25.6591 0.025 26.3391 0.12 28.4716C0.22 30.6016 0.555 32.0541 1.05 33.3266C1.5625 34.6416 2.245 35.7566 3.3575 36.8691C4.4675 37.9816 5.5825 38.6666 6.8975 39.1766C8.1725 39.6716 9.6225 40.0091 11.7525 40.1066C13.8875 40.2016 14.5675 40.2266 20 40.2266C25.4325 40.2266 26.11 40.2016 28.245 40.1066C30.3725 40.0066 31.83 39.6716 33.1025 39.1766C34.437 38.6754 35.6454 37.8878 36.6425 36.8691C37.755 35.7566 38.4375 34.6416 38.95 33.3266C39.4425 32.0541 39.78 30.6016 39.88 28.4716C39.975 26.3391 40 25.6591 40 20.2266C40 14.7941 39.975 14.1141 39.88 11.9791C39.78 9.85156 39.4425 8.39656 38.95 7.12656C38.4492 5.79117 37.6615 4.58192 36.6425 3.58406C35.6446 2.56506 34.4354 1.77738 33.1 1.27656C31.825 0.781562 30.37 0.444063 28.2425 0.346563C26.1075 0.251563 25.43 0.226562 19.995 0.226562H20ZM18.2075 3.83156H20.0025C25.3425 3.83156 25.975 3.84906 28.0825 3.94656C30.0325 4.03406 31.0925 4.36156 31.7975 4.63406C32.73 4.99656 33.3975 5.43156 34.0975 6.13156C34.7975 6.83156 35.23 7.49656 35.5925 8.43156C35.8675 9.13406 36.1925 10.1941 36.28 12.1441C36.3775 14.2516 36.3975 14.8841 36.3975 20.2216C36.3975 25.5591 36.3775 26.1941 36.28 28.3016C36.1925 30.2516 35.865 31.3091 35.5925 32.0141C35.2696 32.8813 34.7581 33.666 34.095 34.3116C33.395 35.0116 32.73 35.4441 31.795 35.8066C31.095 36.0816 30.035 36.4066 28.0825 36.4966C25.975 36.5916 25.3425 36.6141 20.0025 36.6141C14.6625 36.6141 14.0275 36.5916 11.92 36.4966C9.97 36.4066 8.9125 36.0816 8.2075 35.8066C7.33958 35.4847 6.554 34.9741 5.9075 34.3116C5.24318 33.6656 4.73082 32.8799 4.4075 32.0116C4.135 31.3091 3.8075 30.2491 3.72 28.2991C3.625 26.1916 3.605 25.5591 3.605 20.2166C3.605 14.8741 3.625 14.2466 3.72 12.1391C3.81 10.1891 4.135 9.12906 4.41 8.42406C4.7725 7.49156 5.2075 6.82406 5.9075 6.12406C6.6075 5.42406 7.2725 4.99156 8.2075 4.62906C8.9125 4.35406 9.97 4.02906 11.92 3.93906C13.765 3.85406 14.48 3.82906 18.2075 3.82656V3.83156ZM30.6775 7.15156C30.3623 7.15156 30.0502 7.21364 29.7591 7.33425C29.4679 7.45486 29.2033 7.63165 28.9804 7.85451C28.7576 8.07737 28.5808 8.34194 28.4602 8.63312C28.3396 8.9243 28.2775 9.23639 28.2775 9.55156C28.2775 9.86674 28.3396 10.1788 28.4602 10.47C28.5808 10.7612 28.7576 11.0258 28.9804 11.2486C29.2033 11.4715 29.4679 11.6483 29.7591 11.7689C30.0502 11.8895 30.3623 11.9516 30.6775 11.9516C31.314 11.9516 31.9245 11.6987 32.3746 11.2486C32.8246 10.7985 33.0775 10.1881 33.0775 9.55156C33.0775 8.91504 32.8246 8.30459 32.3746 7.85451C31.9245 7.40442 31.314 7.15156 30.6775 7.15156ZM20.0025 9.95656C18.6402 9.93531 17.2872 10.1853 16.0224 10.6919C14.7577 11.1986 13.6063 11.9517 12.6354 12.9076C11.6645 13.8635 10.8934 15.003 10.3671 16.2597C9.8408 17.5164 9.56975 18.8653 9.56975 20.2278C9.56975 21.5903 9.8408 22.9392 10.3671 24.1959C10.8934 25.4526 11.6645 26.5921 12.6354 27.548C13.6063 28.5039 14.7577 29.2571 16.0224 29.7637C17.2872 30.2703 18.6402 30.5203 20.0025 30.4991C22.6989 30.457 25.2705 29.3563 27.1624 27.4347C29.0544 25.513 30.1148 22.9245 30.1147 20.2278C30.1148 17.5311 29.0544 14.9426 27.1624 13.0209C25.2705 11.0993 22.6989 9.99863 20.0025 9.95656ZM20.0025 13.5591C20.8781 13.5591 21.7451 13.7315 22.554 14.0666C23.363 14.4017 24.098 14.8928 24.7171 15.5119C25.3363 16.1311 25.8274 16.8661 26.1625 17.675C26.4975 18.484 26.67 19.351 26.67 20.2266C26.67 21.1022 26.4975 21.9692 26.1625 22.7781C25.8274 23.587 25.3363 24.3221 24.7171 24.9412C24.098 25.5603 23.363 26.0515 22.554 26.3865C21.7451 26.7216 20.8781 26.8941 20.0025 26.8941C18.2342 26.8941 16.5383 26.1916 15.2879 24.9412C14.0375 23.6908 13.335 21.9949 13.335 20.2266C13.335 18.4582 14.0375 16.7623 15.2879 15.5119C16.5383 14.2615 18.2342 13.5591 20.0025 13.5591Z" fill="currentColor"/></svg>';
		case 'telegram':
			return '<svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M30 15C30 18.9782 28.4196 22.7936 25.6066 25.6066C22.7936 28.4196 18.9782 30 15 30C11.0218 30 7.20644 28.4196 4.3934 25.6066C1.58035 22.7936 0 18.9782 0 15C0 11.0218 1.58035 7.20644 4.3934 4.3934C7.20644 1.58035 11.0218 0 15 0C18.9782 0 22.7936 1.58035 25.6066 4.3934C28.4196 7.20644 30 11.0218 30 15ZM15.5381 11.0738C14.0781 11.6813 11.1619 12.9375 6.78938 14.8425C6.08063 15.1237 5.70875 15.4 5.67375 15.6712C5.6175 16.1269 6.18938 16.3069 6.9675 16.5525L7.29563 16.6556C8.06063 16.905 9.09187 17.1956 9.62625 17.2069C10.1137 17.2194 10.6562 17.0194 11.2537 16.6069C15.34 13.8494 17.4488 12.4556 17.58 12.4256C17.6738 12.4031 17.805 12.3769 17.8912 12.4556C17.9775 12.5344 17.97 12.6806 17.9606 12.72C17.9044 12.9619 15.66 15.0469 14.4994 16.1269C14.1375 16.4644 13.8806 16.7025 13.8281 16.7569C13.7126 16.8751 13.595 16.9913 13.4756 17.1056C12.7631 17.7919 12.2306 18.3056 13.5038 19.1456C14.1169 19.5506 14.6081 19.8825 15.0975 20.2162C15.63 20.58 16.1625 20.9419 16.8525 21.3956C17.0275 21.5106 17.1963 21.6275 17.3588 21.7462C17.9794 22.1887 18.54 22.5863 19.2281 22.5225C19.6294 22.485 20.0438 22.11 20.2538 20.985C20.7506 18.3281 21.7275 12.5737 21.9525 10.2019C21.9666 10.0047 21.9585 9.80658 21.9281 9.61125C21.9099 9.45377 21.8337 9.3087 21.7144 9.20437C21.5435 9.08707 21.3403 9.0261 21.1331 9.03C20.5706 9.03937 19.7025 9.34125 15.5381 11.0738Z" fill="currentColor"/></svg>';
		case 'viber':
			return '<svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M26.0156 2.92383C25.2715 2.23828 22.2598 0.0527374 15.5449 0.0234405C15.5449 0.0234405 7.6289 -0.451169 3.77344 3.08789C1.6289 5.23242 0.873045 8.37891 0.791014 12.2754C0.708982 16.1719 0.609373 23.4727 7.64648 25.4531H7.65234L7.64648 28.4766C7.64648 28.4766 7.59961 29.7012 8.4082 29.9473C9.38086 30.252 9.95508 29.3203 10.8867 28.3184C11.3965 27.7676 12.0996 26.959 12.6328 26.3438C17.4492 26.748 21.1465 25.8223 21.5684 25.6875C22.541 25.3711 28.043 24.668 28.9336 17.3672C29.8594 9.83203 28.4883 5.07422 26.0156 2.92383ZM26.8301 16.8164C26.0742 22.9102 21.6152 23.2969 20.7949 23.5605C20.4434 23.6719 17.1914 24.4805 13.1074 24.2168C13.1074 24.2168 10.0605 27.8906 9.11133 28.8457C8.80078 29.1563 8.46094 29.127 8.46679 28.5117C8.46679 28.1074 8.49023 23.4902 8.49023 23.4902C8.48437 23.4902 8.48437 23.4902 8.49023 23.4902C2.52539 21.8379 2.87695 15.6211 2.9414 12.3691C3.00586 9.11719 3.62109 6.45117 5.4375 4.65821C8.70117 1.69922 15.4219 2.13867 15.4219 2.13867C21.0996 2.16211 23.8184 3.87305 24.4512 4.44727C26.543 6.24024 27.6094 10.5293 26.8301 16.8164ZM18.6855 12.082C18.709 12.5859 17.9531 12.6211 17.9297 12.1172C17.8652 10.8281 17.2617 10.2012 16.0195 10.1309C15.5156 10.1016 15.5625 9.34571 16.0605 9.375C17.6953 9.46289 18.6035 10.4004 18.6855 12.082ZM19.875 12.7441C19.9336 10.2598 18.3809 8.31446 15.4336 8.09766C14.9355 8.0625 14.9883 7.30664 15.4863 7.3418C18.8848 7.58789 20.6953 9.92578 20.6309 12.7617C20.625 13.2656 19.8633 13.2422 19.875 12.7441ZM22.6289 13.5293C22.6348 14.0332 21.873 14.0391 21.873 13.5352C21.8379 8.75977 18.6562 6.15821 14.7949 6.12891C14.2969 6.12305 14.2969 5.37305 14.7949 5.37305C19.1133 5.40235 22.5879 8.38477 22.6289 13.5293ZM21.9668 19.2773V19.2891C21.334 20.4023 20.1504 21.6328 18.9316 21.2402L18.9199 21.2227C17.6836 20.877 14.7715 19.377 12.9316 17.9121C11.9824 17.1621 11.1152 16.2773 10.4473 15.4277C9.84375 14.6719 9.23437 13.7754 8.64258 12.6973C7.39453 10.4414 7.11914 9.4336 7.11914 9.4336C6.72656 8.21485 7.95117 7.03125 9.07031 6.39844H9.08203C9.62109 6.11719 10.1367 6.21094 10.4824 6.62696C10.4824 6.62696 11.209 7.49414 11.5195 7.92188C11.8125 8.32032 12.2051 8.95899 12.4102 9.31641C12.7676 9.95508 12.5449 10.6055 12.1934 10.875L11.4902 11.4375C11.1328 11.7246 11.1797 12.2578 11.1797 12.2578C11.1797 12.2578 12.2227 16.2012 16.1191 17.1973C16.1191 17.1973 16.6523 17.2441 16.9395 16.8867L17.502 16.1836C17.7715 15.832 18.4219 15.6094 19.0605 15.9668C19.9219 16.4531 21.0176 17.209 21.7441 17.8945C22.1543 18.2285 22.248 18.7383 21.9668 19.2773Z" fill="currentColor"/></svg>';
		default:
			return '';
	}
}

/**
 * Соцсети рядом с товаром (только иконки).
 */
function computex_cond_render_product_panel_socials()
{
	$links = computex_cond_get_social_links_from_options();

	if (empty($links)) {
		return;
	}

	echo '<div class="catalog-single__socials" aria-label="' . esc_attr__('Социальные сети', 'computex-cond') . '">';

	foreach ($links as $link) {
		$icon = computex_cond_get_product_social_icon_svg($link['key']);

		if ($icon === '') {
			continue;
		}

		printf(
			'<a class="catalog-single__social-link" href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s">%s</a>',
			$link['key'] === 'viber' ? esc_attr($link['url']) : esc_url($link['url']),
			esc_attr($link['label']),
			$icon // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}

	echo '</div>';
}

/**
 * Статус наличия для блока цены.
 *
 * @return array{in_stock: bool, text: string, class: string}
 */
function computex_cond_get_product_stock_status($product = null, $in_stock_flag = null)
{
	$in_stock = false;

	if ($in_stock_flag !== null) {
		$in_stock = (bool) $in_stock_flag;
	} elseif ($product instanceof WC_Product) {
		$in_stock = $product->is_in_stock() && $product->is_purchasable();
	}

	return array(
		'in_stock' => $in_stock,
		'text' => $in_stock
			? __('В наличии', 'computex-cond')
			: __('Нет в наличии', 'computex-cond'),
		'class' => $in_stock ? 'is-in-stock' : 'is-out-of-stock',
	);
}

/**
 * Настройка single product WooCommerce.
 */
function computex_cond_setup_woocommerce_single_product()
{
	if (!function_exists('is_product') || !is_product()) {
		return;
	}

	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
}
add_action('wp', 'computex_cond_setup_woocommerce_single_product');