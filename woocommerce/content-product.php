<?php

/**

 * Product card for WooCommerce archives.

 *

 * @package computex-cond

 */



defined('ABSPATH') || exit;



global $product;



if (empty($product) || !computex_cond_is_product_visible_in_catalog($product)) {

	return;

}



$product_id = $product->get_id();

$permalink = get_permalink($product_id);

$image_id = $product->get_image_id();

$image_src = $image_id ? wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail') : wc_placeholder_img_src('woocommerce_thumbnail');

$image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : $product->get_name();

$properties = computex_cond_get_card_display_properties($product_id);

$variation_options = array();

$default_option = null;

$price_product = $product;

$shop_filters = computex_cond_get_shop_filter_values();

if ($product->is_type('variable')) {

	$variation_options = computex_cond_get_product_card_variation_options($product, $shop_filters);

	if (empty($variation_options)) {

		return;

	}



	$default_option = $variation_options[0];

	$price_product = wc_get_product($default_option['id']);

	$properties = !empty($default_option['characteristics'])
		? $default_option['characteristics']
		: computex_cond_get_card_display_properties($product_id, $default_option['id'], $default_option['label']);

} elseif (!empty($shop_filters['areas']) && !$product->is_type('variable')) {

	$taxonomy = computex_cond_get_area_attribute_taxonomy();

	if ($taxonomy) {
		$product_terms = wp_get_post_terms($product_id, $taxonomy, array('fields' => 'ids'));
		$filter_term_ids = computex_cond_get_area_term_ids_by_slugs($shop_filters['areas']);
		$matches = !empty($filter_term_ids) && !empty(array_intersect($product_terms, $filter_term_ids));

		if (!$matches) {
			return;
		}
	}

}



$default_price_data = computex_cond_get_product_price_data($price_product ?: $product);

$default_image = $default_option && !empty($default_option['image']) ? $default_option['image'] : $image_src;
$detail_url = $permalink;

if ($default_option) {
	$detail_url = computex_cond_get_product_link_with_variation(
		$permalink,
		$default_option['id'],
		!empty($default_option['slug']) ? $default_option['slug'] : ''
	);
}

?>



<article

	class="product-card"

	data-permalink="<?php echo esc_url($permalink); ?>"

	data-properties="<?php echo esc_attr(wp_json_encode($properties, JSON_UNESCAPED_UNICODE)); ?>"

	<?php if (!empty($variation_options)) : ?>

		data-variations="<?php echo esc_attr(wp_json_encode($variation_options, JSON_UNESCAPED_UNICODE)); ?>"

	<?php endif; ?>

>

	<div class="product-card__row">

		<div class="product-card__img">

			<?php echo computex_cond_render_product_card_badges_html($product, $default_price_data, !empty($variation_options)); ?>

			<img

				src="<?php echo esc_url($default_image); ?>"

				alt="<?php echo esc_attr($image_alt); ?>"

				loading="lazy"

				data-card-image

			>

		</div>



		<a class="title" href="<?php echo esc_url($detail_url); ?>" data-card-link><?php echo esc_html($product->get_name()); ?></a>



		<?php if (!empty($variation_options)) : ?>

			<div class="flex product-card__variants">

				<?php foreach ($variation_options as $index => $option) : ?>

					<button

						class="button-gray product-card__variant<?php echo $index === 0 ? ' is-active' : ''; ?>"

						type="button"

						data-variation-id="<?php echo esc_attr($option['id']); ?>"

						data-area-slug="<?php echo esc_attr(!empty($option['slug']) ? $option['slug'] : ''); ?>"

					>

						<?php echo esc_html($option['label']); ?>

					</button>

				<?php endforeach; ?>

			</div>

		<?php endif; ?>



		<hr>



		<?php computex_cond_render_product_card_specs_list($properties); ?>

	</div>



	<div class="product-card__info flex">

		<?php echo computex_cond_render_product_card_price_html($default_price_data); ?>

		<a class="button-gray" href="<?php echo esc_url($detail_url); ?>" data-card-link>Подробнее </a>

	</div>

</article>

