<?php
/**
 * Shop sidebar filters.
 *
 * @package computex-cond
 */

defined('ABSPATH') || exit;

$filters = computex_cond_get_shop_filter_values();
$form_action = computex_cond_get_catalog_filters_page_url();
$active_category_slugs = computex_cond_get_active_category_filter_slugs();
$default_cat_id = (int) get_option('default_product_cat', 0);

$product_categories = get_terms(
	array(
		'taxonomy' => 'product_cat',
		'hide_empty' => true,
		'exclude' => $default_cat_id ? array($default_cat_id) : array(),
	)
);

$area_terms = computex_cond_get_area_filter_terms();
$has_active_filters = !empty($filters['categories']) || !empty($filters['areas']) || $filters['min_price'] !== '' || $filters['max_price'] !== '';

$active_filter_count = count($filters['categories']) + count($filters['areas']);
if ($filters['min_price'] !== '') {
	$active_filter_count++;
}
if ($filters['max_price'] !== '') {
	$active_filter_count++;
}
?>

<div class="sidebar__wrapp sidebar__wrapp--filters shop-filters-panel">
	<form class="shop-filters" method="get" action="<?php echo esc_url($form_action); ?>">
		<div class="shop-filters__header">
			<h2 class="shop-filters__title">Фильтры</h2>
			<?php if ($active_filter_count > 0) : ?>
				<span class="shop-filters__badge"><?php echo esc_html((string) $active_filter_count); ?></span>
			<?php endif; ?>
		</div>

		<div class="shop-filters__body">
			<section class="shop-filters__section">
				<h3 class="shop-filters__section-title">
					<span class="shop-filters__section-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3 4.5h12M3 9h8M3 13.5h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
					</span>
					Категории
				</h3>
				<?php if (!is_wp_error($product_categories) && !empty($product_categories)) : ?>
					<ul class="shop-filters__list">
						<?php foreach ($product_categories as $category) : ?>
							<?php if ((int) $category->count < 1) : ?>
								<?php continue; ?>
							<?php endif; ?>
							<?php $is_checked = in_array($category->slug, $active_category_slugs, true); ?>
							<li class="shop-filters__item">
								<label class="shop-filters__check<?php echo $is_checked ? ' is-active' : ''; ?>">
									<input
										type="checkbox"
										class="shop-filters__input"
										name="filter_category[]"
										value="<?php echo esc_attr($category->slug); ?>"
										<?php checked($is_checked); ?>
									>
									<span class="shop-filters__box" aria-hidden="true"></span>
									<span class="shop-filters__label"><?php echo esc_html($category->name); ?></span>
									<span class="shop-filters__count"><?php echo esc_html((string) $category->count); ?></span>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p class="shop-filters__empty">Нет категорий</p>
				<?php endif; ?>
			</section>

			<section class="shop-filters__section">
				<h3 class="shop-filters__section-title">
					<span class="shop-filters__section-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 4.5V3.5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1M4 6h10l-1.2 8.4a1 1 0 0 1-1 .6H6.2a1 1 0 0 1-1-.6L4 6z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
						</svg>
					</span>
					Цена, BYN
				</h3>
				<div class="shop-filters__price">
					<label class="shop-filters__price-field">
						<span class="shop-filters__price-caption">От</span>
						<input
							type="number"
							class="shop-filters__price-input"
							name="min_price"
							min="0"
							step="0.01"
							placeholder="0"
							value="<?php echo $filters['min_price'] !== '' ? esc_attr($filters['min_price']) : ''; ?>"
						>
					</label>
					<span class="shop-filters__price-sep" aria-hidden="true"></span>
					<label class="shop-filters__price-field">
						<span class="shop-filters__price-caption">До</span>
						<input
							type="number"
							class="shop-filters__price-input"
							name="max_price"
							min="0"
							step="0.01"
							placeholder="∞"
							value="<?php echo $filters['max_price'] !== '' ? esc_attr($filters['max_price']) : ''; ?>"
						>
					</label>
				</div>
			</section>

			<?php if (!empty($area_terms)) : ?>
				<section class="shop-filters__section">
					<h3 class="shop-filters__section-title">
						<span class="shop-filters__section-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="3" y="3" width="12" height="12" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
								<path d="M3 9h12M9 3v12" stroke="currentColor" stroke-width="1.4"/>
							</svg>
						</span>
						Обслуживаемая площадь
					</h3>
					<ul class="shop-filters__list shop-filters__list--grid">
						<?php foreach ($area_terms as $area_term) : ?>
							<?php $is_checked = in_array($area_term->slug, $filters['areas'], true); ?>
							<li class="shop-filters__item">
								<label class="shop-filters__check shop-filters__check--chip<?php echo $is_checked ? ' is-active' : ''; ?>">
									<input
										type="checkbox"
										class="shop-filters__input"
										name="filter_area[]"
										value="<?php echo esc_attr($area_term->slug); ?>"
										<?php checked($is_checked); ?>
									>
									<span class="shop-filters__box" aria-hidden="true"></span>
									<span class="shop-filters__label"><?php echo esc_html($area_term->name); ?></span>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endif; ?>
		</div>

		<div class="shop-filters__footer">
			<button type="submit" class="shop-filters__submit">Применить</button>
			<?php if ($has_active_filters) : ?>
				<a class="shop-filters__reset" href="<?php echo esc_url($form_action); ?>">
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
						<path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
					</svg>
					Сбросить
				</a>
			<?php endif; ?>
		</div>
	</form>
</div>
