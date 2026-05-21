<?php
/**
 * Скрытая форма вариаций (без количества и «В корзину») — только для JS.
 *
 * @package computex-cond
 * @version 9.6.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);
$variation_options = computex_cond_get_single_product_variation_options($product);
$has_custom_variations = !empty($variation_options);
$wc_variations_unavailable = empty($available_variations) && false !== $available_variations;
?>

<form
	class="variations_form cart"
	action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
	method="post"
	enctype="multipart/form-data"
	data-product_id="<?php echo absint($product->get_id()); ?>"
	data-product_variations="<?php echo $variations_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"
>
	<?php if (!$has_custom_variations && $wc_variations_unavailable) : ?>
		<p class="stock out-of-stock screen-reader-text">
			<?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?>
		</p>
	<?php elseif (!empty($attributes)) : ?>
		<table class="variations" cellspacing="0" role="presentation">
			<tbody>
				<?php foreach ($attributes as $attribute_name => $options) : ?>
					<tr>
						<th class="label">
							<label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
								<?php echo wc_attribute_label($attribute_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</label>
						</th>
						<td class="value">
							<?php
							wc_dropdown_variation_attribute_options(
								array(
									'options' => $options,
									'attribute' => $attribute_name,
									'product' => $product,
								)
							);
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</form>
