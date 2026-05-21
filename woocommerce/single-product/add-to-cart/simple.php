<?php
/**
 * Simple product add to cart.
 *
 * @package computex-cond
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
	return;
}

echo wc_get_stock_html($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

if ($product->is_in_stock()) :
	do_action('woocommerce_before_add_to_cart_form');
	?>
	<form
		class="cart catalog-single__cart"
		action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
		method="post"
		enctype="multipart/form-data"
	>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php
		do_action('woocommerce_before_add_to_cart_quantity');
		woocommerce_quantity_input(
			array(
				'min_value' => $product->get_min_purchase_quantity(),
				'max_value' => $product->get_max_purchase_quantity(),
				'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			)
		);
		do_action('woocommerce_after_add_to_cart_quantity');
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button-primary alt">
			<?php echo esc_html($product->single_add_to_cart_text()); ?>
		</button>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>
	<?php
	do_action('woocommerce_after_add_to_cart_form');
endif;
