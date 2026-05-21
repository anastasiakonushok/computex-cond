<?php
/**
 * Single product content (catalog-single layout).
 *
 * @package computex-cond
 */

defined('ABSPATH') || exit;

global $product;

if (!$product instanceof WC_Product) {
	return;
}

do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form();
	return;
}

$product_id = $product->get_id();
$variation_options = array();
$default_option = null;
$price_product = $product;
$display_properties = computex_cond_get_single_product_characteristics($product_id);
$image_id = $product->get_image_id();
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : wc_placeholder_img_src('woocommerce_single');
$image_html = $image_id ? wp_get_attachment_image($image_id, 'full') : '<img src="' . esc_url($image_url) . '" alt="">';

if ($product->is_type('variable')) {
	$variation_options = computex_cond_get_single_product_variation_options($product);

	if (!empty($variation_options)) {
		$preselected_option = computex_cond_get_preselected_variation_option($variation_options);
		$default_option = $preselected_option ? $preselected_option : $variation_options[0];
		$price_product = wc_get_product($default_option['id']);

		if (!empty($default_option['image'])) {
			$image_url = $default_option['image'];
			$image_html = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '">';
		}

		$display_properties = !empty($default_option['characteristics'])
			? $default_option['characteristics']
			: computex_cond_get_single_product_characteristics($product_id, $default_option['id'], $default_option['label']);
	}
}

$preview_properties = computex_cond_filter_preview_characteristics($display_properties);

$price_data = computex_cond_get_product_price_data($price_product ?: $product);
$stock_status = computex_cond_get_product_stock_status(
	$price_product ?: $product,
	!empty($default_option) && array_key_exists('in_stock', $default_option)
		? !empty($default_option['in_stock'])
		: null
);
$brand_description = computex_cond_get_product_brand_description($product);
$description = $product->get_description();
$contact_link = function_exists('get_field') ? get_field('ssylka_na_straniczu_kontaktov', 'option') : null;
$has_variations = !empty($variation_options);
$variations_json = !empty($variation_options)
	? wp_json_encode($variation_options, JSON_UNESCAPED_UNICODE)
	: '[]';
?>

<div
	id="product-<?php the_ID(); ?>"
	<?php wc_product_class('catalog-single catalog-single--wc', $product); ?>
	data-variations="<?php echo esc_attr($variations_json); ?>"
>
	<section class="section-breadcrumb-black">
		<div class="container">
			<?php
			if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			}
			?>
		</div>
	</section>

	<section class="catalog-single">
		<div class="container catalog-single__container">
			<?php woocommerce_output_all_notices(); ?>

			<div class="catalog-single__body flex" data-product-single>
				<div class="catalog-single__media">
					<?php computex_cond_render_single_product_badges($product, $price_data, $has_variations); ?>
					<a
						class="catalog-single__img"
						href="<?php echo esc_url($image_url); ?>"
						data-fancybox
						data-single-image
					>
						<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</div>

				<div class="catalog-single__content catalog-single__panel">
					<?php computex_cond_render_single_product_brand_link($product); ?>
					<h1 class="catalog-single__title"><?php the_title(); ?></h1>
					<?php if (!empty($default_option['display_name'])) : ?>
						<p class="catalog-single__variation-name" data-single-variation-name>
							<?php echo esc_html($default_option['display_name']); ?>
						</p>
					<?php elseif (!empty($variation_options)) : ?>
						<p class="catalog-single__variation-name" data-single-variation-name hidden></p>
					<?php endif; ?>

					<div class="catalog-single__price-box" data-single-price-wrap>
						<div class="catalog-single__price-col">
							<div class="catalog-single__price flex">
								<?php echo computex_cond_render_product_card_price_html($price_data); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p
								class="catalog-single__stock <?php echo esc_attr($stock_status['class']); ?>"
								data-single-stock
								data-in-stock="<?php echo !empty($stock_status['in_stock']) ? '1' : '0'; ?>"
							>
								<?php echo esc_html($stock_status['text']); ?>
							</p>
						</div>
						<?php if ($contact_link) : ?>
							<a
								class="button-primary catalog-single__buy-btn"
								href="<?php echo esc_url($contact_link['url']); ?>"
								target="<?php echo esc_attr(!empty($contact_link['target']) ? $contact_link['target'] : '_self'); ?>"
							>
								<?php echo esc_html($contact_link['title']); ?>
							</a>
						<?php endif; ?>
					</div>

					<?php computex_cond_render_product_panel_socials(); ?>

					<?php if (!empty($variation_options)) : ?>
						<div class="catalog-single__variations-block">
							<p class="catalog-single__variations-label">Обслуживаемая площадь, м²</p>
							<?php computex_cond_render_single_product_variation_buttons($variation_options, !empty($default_option['id']) ? (int) $default_option['id'] : 0); ?>
						</div>
						<div class="catalog-single__specs-box">
							<p class="catalog-single__specs-title">Основные характеристики</p>
							<ul class="catalog-single__specs-preview" data-single-specs-preview>
								<?php foreach ($preview_properties as $property) : ?>
									<li class="flex"<?php echo computex_cond_is_area_property_label($property['label']) ? ' data-area-spec' : ''; ?>>
										<p><?php echo esc_html($property['label']); ?></p>
										<p><?php echo esc_html($property['value']); ?></p>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ($product->is_type('variable')) : ?>
						<div class="catalog-single__variations-form-hidden" hidden aria-hidden="true">
							<?php
							wc_get_template(
								'single-product/add-to-cart/variable.php',
								array(
									'attributes' => $product->get_variation_attributes(),
									'available_variations' => $product->get_available_variations(),
								)
							);
							?>
						</div>
					<?php endif; ?>

					<a class="all-desc catalog-single__specs-link" href="#info">Все характеристики</a>
				</div>
			</div>

			<div class="catalog-single__block flex" id="info">
				<div class="catalog-single__description">
					<ul class="tab-links flex">
						<li class="active"><a href="#tab1">Характеристики</a></li>
						<?php if ($description) : ?>
							<li><a href="#tab2">Описание</a></li>
						<?php endif; ?>
						<?php if ($brand_description) : ?>
							<li><a href="#tab<?php echo $description ? '3' : '2'; ?>">О производителе</a></li>
						<?php endif; ?>
					</ul>

					<div class="tab-content">
						<div class="tab active" id="tab1">
							<h3>Характеристики</h3>
							<div class="catalog-single__table" data-single-specs-table>
								<?php computex_cond_render_product_characteristics_table($display_properties); ?>
							</div>
						</div>

						<?php if ($description) : ?>
							<div class="tab" id="tab2">
								<h3>Описание</h3>
								<div class="inner-content">
									<?php echo wp_kses_post(wpautop($description)); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ($brand_description) : ?>
							<div class="tab" id="tab<?php echo $description ? '3' : '2'; ?>">
								<h3>О производителе</h3>
								<div class="inner-content">
									<?php echo wp_kses_post($brand_description); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="catalog-single__info guarantee">
					<?php computex_cond_render_single_product_services($product_id, 'catalog-single__benefits--sidebar'); ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	$services_bg = function_exists('get_field') ? get_field('fon_dlya_uslug', 'option') : '';
	if ($services_bg && function_exists('have_rows') && have_rows('uslugi_blok', 'option')) :
		?>
		<section
			style="background-image: linear-gradient(rgba(43, 60, 77, 0.89), rgba(43, 60, 77, 0.89)), url('<?php echo esc_url($services_bg); ?>');"
			class="services-section"
		>
			<div class="container services-section__container flex">
				<?php
				while (have_rows('uslugi_blok', 'option')) :
					the_row();
					$ssylka = get_sub_field('ssylka');
					?>
					<div class="services-section__card">
						<span><?php the_sub_field('nomer'); ?></span>
						<h2><?php the_sub_field('zagolovok'); ?></h2>
						<p><?php the_sub_field('tekst'); ?></p>
						<?php if (!empty($ssylka['url'])) : ?>
							<a
								class="button-primary"
								href="<?php echo esc_url($ssylka['url']); ?>"
								target="<?php echo esc_attr(!empty($ssylka['target']) ? $ssylka['target'] : '_self'); ?>"
							>
								<?php echo esc_html($ssylka['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$related = wc_get_related_products($product_id, 12);

	if (empty($related)) {
		$fallback_products = wc_get_products(
			array(
				'status' => 'publish',
				'limit' => 12,
				'exclude' => array($product_id),
				'orderby' => 'rand',
			)
		);

		foreach ($fallback_products as $fallback_product) {
			if ($fallback_product instanceof WC_Product) {
				$related[] = $fallback_product->get_id();
			}
		}
	}

	if (!empty($related)) {
		computex_cond_render_hits_slider(
			$related,
			array(
				'title' => function_exists('get_field') ? (string) get_field('zagolovok_hity_prodazh', 'option') : __('Похожие товары', 'computex-cond'),
				'link' => function_exists('get_field') ? get_field('ssylka_hity_prodazh', 'option') : null,
			)
		);
	}
	?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>
