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
$product_categories = computex_cond_get_shop_main_category_filter_terms();

$area_terms = function_exists('computex_cond_get_sorted_area_filter_terms')
	? computex_cond_get_sorted_area_filter_terms()
	: computex_cond_get_area_filter_terms();
$brand_terms = function_exists('computex_cond_get_shop_brand_filter_terms')
	? computex_cond_get_shop_brand_filter_terms()
	: array();
$hits_filter_options = array(
	'acf' => array(
		'label' => 'Избранное',
		'count' => count(computex_cond_get_hits_tovary_product_ids()),
	),
	'featured' => array(
		'label' => 'Советуем',
		'count' => count(computex_cond_get_featured_product_ids()),
	),
);
$has_hits_filters = array_filter(
	$hits_filter_options,
	function ($option) {
		return $option['count'] > 0;
	}
);

$has_active_filters = !empty($filters['categories'])
	|| !empty($filters['hits'])
	|| !empty($filters['areas'])
	|| !empty($filters['brands'])
	|| $filters['search'] !== ''
	|| $filters['min_price'] !== ''
	|| $filters['max_price'] !== '';

$active_filter_count = count($filters['categories']) + count($filters['hits']) + count($filters['areas']) + count($filters['brands']);
if ($filters['search'] !== '') {
	$active_filter_count++;
}
if ($filters['min_price'] !== '') {
	$active_filter_count++;
}
if ($filters['max_price'] !== '') {
	$active_filter_count++;
}
?>

<?php
$shop_filters_panel_open = $active_filter_count > 0;
$shop_filters_categories_open = !empty($active_category_slugs) || !empty($filters['areas']);
$shop_filters_brands_open = !empty($filters['brands']);
$shop_filters_hits_open = !empty($filters['hits']);
$shop_filters_price_open = $filters['min_price'] !== '' || $filters['max_price'] !== '';
?>

<div class="sidebar__wrapp sidebar__wrapp--filters shop-filters-panel<?php echo $shop_filters_panel_open ? ' is-filters-open' : ''; ?>">
	<form class="shop-filters" method="get" action="<?php echo esc_url($form_action); ?>">
		<button
			type="button"
			class="shop-filters__header"
			id="shop-filters-header-toggle"
			aria-expanded="<?php echo $shop_filters_panel_open ? 'true' : 'false'; ?>"
			aria-controls="shop-filters-collapsible"
		>
			<span class="shop-filters__header-main">
				<span class="shop-filters__title">Фильтры</span>
				<?php if ($active_filter_count > 0) : ?>
					<span class="shop-filters__badge"><?php echo esc_html((string) $active_filter_count); ?></span>
				<?php endif; ?>
			</span>
			<span class="shop-filters__header-chevron" aria-hidden="true"></span>
		</button>

		<div class="shop-filters__collapsible" id="shop-filters-collapsible">
		<div class="shop-filters__body">
			<section class="shop-filters__section shop-filters__section--search is-open">
				<button
					type="button"
					class="shop-filters__section-title"
					aria-expanded="true"
				>
					<span class="shop-filters__section-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="8" cy="8" r="4.75" stroke="currentColor" stroke-width="1.5"/>
							<path d="M11.5 11.5L15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
					</span>
					<span class="shop-filters__section-label">Поиск</span>
					<span class="shop-filters__section-chevron" aria-hidden="true"></span>
				</button>
				<div class="shop-filters__section-content">
					<label class="shop-filters__search-field">
						<span class="screen-reader-text">Поиск по названию</span>
						<input
							type="search"
							class="shop-filters__search-input"
							name="filter_search"
							value="<?php echo esc_attr($filters['search']); ?>"
							placeholder="Название, модель, артикул"
							autocomplete="off"
							maxlength="120"
						>
					</label>
				</div>
			</section>

			<section class="shop-filters__section<?php echo $shop_filters_categories_open ? ' is-open' : ''; ?>">
				<button
					type="button"
					class="shop-filters__section-title"
					aria-expanded="<?php echo $shop_filters_categories_open ? 'true' : 'false'; ?>"
				>
					<span class="shop-filters__section-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3 4.5h12M3 9h8M3 13.5h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
					</span>
					<span class="shop-filters__section-label">Категории</span>
					<span class="shop-filters__section-chevron" aria-hidden="true"></span>
				</button>
				<div class="shop-filters__section-content">
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
								<?php
								if (
									!empty($area_terms)
									&& function_exists('computex_cond_is_conditioner_main_product_cat_term')
									&& computex_cond_is_conditioner_main_product_cat_term($category)
								) :
									?>
									<ul class="shop-filters__sublist shop-filters__sublist--areas">
										<?php foreach ($area_terms as $area_term) : ?>
											<?php $is_area_checked = in_array($area_term->slug, $filters['areas'], true); ?>
											<li class="shop-filters__item shop-filters__item--child">
												<label class="shop-filters__check shop-filters__check--child<?php echo $is_area_checked ? ' is-active' : ''; ?>">
													<input
														type="checkbox"
														class="shop-filters__input"
														name="filter_area[]"
														value="<?php echo esc_attr($area_term->slug); ?>"
														<?php checked($is_area_checked); ?>
													>
													<span class="shop-filters__box" aria-hidden="true"></span>
													<span class="shop-filters__label"><?php echo esc_html($area_term->name); ?></span>
												</label>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p class="shop-filters__empty">Нет категорий</p>
				<?php endif; ?>
				</div>
			</section>

			<?php if (!empty($brand_terms)) : ?>
				<section class="shop-filters__section<?php echo $shop_filters_brands_open ? ' is-open' : ''; ?>">
					<button
						type="button"
						class="shop-filters__section-title"
						aria-expanded="<?php echo $shop_filters_brands_open ? 'true' : 'false'; ?>"
					>
						<span class="shop-filters__section-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3 5.5h12M3 9h12M3 12.5h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
							</svg>
						</span>
						<span class="shop-filters__section-label">Бренды</span>
						<span class="shop-filters__section-chevron" aria-hidden="true"></span>
					</button>
					<div class="shop-filters__section-content">
						<ul class="shop-filters__list">
							<?php foreach ($brand_terms as $brand_term) : ?>
								<?php $is_brand_checked = in_array($brand_term->slug, $filters['brands'], true); ?>
								<li class="shop-filters__item">
									<label class="shop-filters__check<?php echo $is_brand_checked ? ' is-active' : ''; ?>">
										<input
											type="checkbox"
											class="shop-filters__input"
											name="filter_brand[]"
											value="<?php echo esc_attr($brand_term->slug); ?>"
											<?php checked($is_brand_checked); ?>
										>
										<span class="shop-filters__box" aria-hidden="true"></span>
										<span class="shop-filters__label"><?php echo esc_html($brand_term->name); ?></span>
										<span class="shop-filters__count"><?php echo esc_html((string) $brand_term->count); ?></span>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</section>
			<?php endif; ?>

			<?php if (!empty($has_hits_filters)) : ?>
				<section class="shop-filters__section<?php echo $shop_filters_hits_open ? ' is-open' : ''; ?>">
					<button
						type="button"
						class="shop-filters__section-title"
						aria-expanded="<?php echo $shop_filters_hits_open ? 'true' : 'false'; ?>"
					>
						<span class="shop-filters__section-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9 2.5l1.8 3.6 4 .6-2.9 2.8.7 4-3.6-1.9-3.6 1.9.7-4L3.2 6.7l4-.6L9 2.5z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
							</svg>
						</span>
						<span class="shop-filters__section-label">Хиты продаж</span>
						<span class="shop-filters__section-chevron" aria-hidden="true"></span>
					</button>
					<div class="shop-filters__section-content">
					<ul class="shop-filters__list">
						<?php foreach ($has_hits_filters as $hit_key => $hit_option) : ?>
							<?php $is_checked = in_array($hit_key, $filters['hits'], true); ?>
							<li class="shop-filters__item">
								<label class="shop-filters__check<?php echo $is_checked ? ' is-active' : ''; ?>">
									<input
										type="checkbox"
										class="shop-filters__input"
										name="filter_hits[]"
										value="<?php echo esc_attr($hit_key); ?>"
										<?php checked($is_checked); ?>
									>
									<span class="shop-filters__box" aria-hidden="true"></span>
									<span class="shop-filters__label"><?php echo esc_html($hit_option['label']); ?></span>
									<span class="shop-filters__count"><?php echo esc_html((string) $hit_option['count']); ?></span>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
					</div>
				</section>
			<?php endif; ?>

			<section class="shop-filters__section<?php echo $shop_filters_price_open ? ' is-open' : ''; ?>">
				<button
					type="button"
					class="shop-filters__section-title"
					aria-expanded="<?php echo $shop_filters_price_open ? 'true' : 'false'; ?>"
				>
					<span class="shop-filters__section-icon" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 4.5V3.5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1M4 6h10l-1.2 8.4a1 1 0 0 1-1 .6H6.2a1 1 0 0 1-1-.6L4 6z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
						</svg>
					</span>
					<span class="shop-filters__section-label">Цена, BYN</span>
					<span class="shop-filters__section-chevron" aria-hidden="true"></span>
				</button>
				<div class="shop-filters__section-content">
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
				</div>
			</section>

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
		</div>
	</form>
</div>
