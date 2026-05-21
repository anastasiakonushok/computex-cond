<?php
/**
 * Слайдер «Хиты продаж» (WooCommerce + catalog).
 *
 * @package computex-cond
 *
 * @var array  $items
 * @var string $slider_title
 * @var array|null $slider_link
 * @var string $slides_wrapper_class
 */

defined('ABSPATH') || exit;

$items = !empty($items) ? array_values((array) $items) : array();

if (empty($items)) {
	return;
}

$slider_title = !empty($slider_title) ? $slider_title : __('Хиты продаж', 'computex-cond');
$slides_wrapper_class = !empty($slides_wrapper_class) ? $slides_wrapper_class : 'swiper-product__wrapp';
?>
<section class="section-product">
	<div class="container">
		<div class="section-product__info flex">
			<div class="section-product__title">
				<h2><?php echo esc_html($slider_title); ?></h2>
				<?php if (!empty($slider_link['url'])) : ?>
					<a href="<?php echo esc_url($slider_link['url']); ?>" target="<?php echo esc_attr(!empty($slider_link['target']) ? $slider_link['target'] : '_self'); ?>">
						<?php echo esc_html(!empty($slider_link['title']) ? $slider_link['title'] : ''); ?>
					</a>
				<?php endif; ?>
			</div>
			<div class="section-product__nav flex">
				<div class="swiper-product-prev swiper-nav-hover" aria-hidden="true">
					<svg width="55" height="55" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="65" height="65" rx="8" fill="currentColor"></rect><path d="M36.5816 41.5816C36.0744 42.0888 35.2808 42.1349 34.7215 41.7199L34.5613 41.5816L25.9898 33.0102C25.4827 32.503 25.4366 31.7093 25.8515 31.1501L25.9899 30.9898L34.5613 22.4184C35.1192 21.8605 36.0237 21.8605 36.5816 22.4184C37.0888 22.9256 37.1349 23.7192 36.7199 24.2785L36.5816 24.4387L29.0203 32L36.5816 39.5613C37.1395 40.1192 37.1395 41.0237 36.5816 41.5816Z" fill="white"></path></svg>
				</div>
				<div class="swiper-product-next swiper-nav-hover" aria-hidden="true">
					<svg width="55" height="55" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="65" height="65" rx="8" fill="currentColor"></rect><path d="M28.4184 23.4184C28.9256 22.9112 29.7192 22.8651 30.2785 23.2801L30.4387 23.4184L39.0102 31.9898C39.5173 32.497 39.5634 33.2907 39.1485 33.8499L39.0102 34.0102L30.4387 42.5816C29.8808 43.1395 28.9763 43.1395 28.4184 42.5816C27.9112 42.0744 27.8651 41.2808 28.2801 40.7215L28.4184 40.5613L35.9797 33L28.4184 25.4387C27.8605 24.8808 27.8605 23.9763 28.4184 23.4184Z" fill="white"></path></svg>
				</div>
			</div>
		</div>
		<div class="swiper swiper-product">
			<div class="swiper-scrollbar swiper-product-scrollbar swiper-scrollbar-horizontal"></div>
			<div class="swiper-wrapper <?php echo esc_attr($slides_wrapper_class); ?>">
				<?php
				foreach ($items as $item) {
					$post_id = !empty($item['id']) ? absint($item['id']) : 0;
					$post_type = !empty($item['type']) ? (string) $item['type'] : '';

					if (!$post_id) {
						continue;
					}

					echo '<div class="swiper-slide swiper-product__slide">';

					if ($post_type === 'product' && function_exists('wc_get_product')) {
						$product = wc_get_product($post_id);

						if ($product && 'publish' === $product->get_status() && computex_cond_is_product_visible_in_catalog($product)) {
							$GLOBALS['product'] = $product; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
							wc_get_template_part('content', 'product');
							unset($GLOBALS['product']);
						}
					} elseif ($post_type === 'catalog') {
						computex_cond_render_hits_catalog_slide($post_id);
					}

					echo '</div>';
				}
				?>
			</div>
		</div>
	</div>
</section>
