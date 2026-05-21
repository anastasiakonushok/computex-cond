(function ($) {
	'use strict';

	function escapeHtml(value) {
		return String(value)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
	}

	function renderPriceHtml(data) {
		if (!data || !data.price) {
			return '';
		}

		if (data.on_sale && data.regular) {
			var discountLabel = data.discount_label || '';
			var savings = data.savings || '';

			return (
				'<div class="product-card__price product-card__price--sale">' +
				'<div class="product-card__price-row">' +
				'<span class="product-card__price-current">' +
				escapeHtml(data.price) +
				'</span><span class="product-card__price-old">' +
				escapeHtml(data.regular) +
				'</span></div>' +
				'<div class="product-card__economy">' +
				'<span class="product-card__economy-percent">' +
				escapeHtml(discountLabel) +
				'</span><span class="product-card__economy-value">' +
				escapeHtml(savings) +
				'</span></div></div>'
			);
		}

		return (
			'<div class="product-card__price">' +
			'<span class="product-card__price-current">' +
			escapeHtml(data.price) +
			'</span></div>'
		);
	}

	function isAreaLabel(label) {
		return /обслуживаем.*площад|площад.*помещ|площад|plosh|area/i.test(label || '');
	}

	function normalizeLabelKey(label) {
		return String(label || '')
			.toLowerCase()
			.trim();
	}

	function compactLabelKey(label) {
		return normalizeLabelKey(label).replace(/[\s\-–—]+/g, '');
	}

	function filterPreviewCharacteristics(specs, maxItems) {
		maxItems = maxItems || 6;

		if (!specs || !specs.length) {
			return [];
		}

		var previewKeys = [
			'производитель',
			'класс энергоэффективности',
			'инвертор',
			'wi - fi',
			'wi-fi',
			'wifi',
			'хладагент (фреон)',
			'страна производства',
		];
		var preview = [];
		var seen = {};
		var index;

		for (index = 0; index < specs.length; index++) {
			if (!isAreaLabel(specs[index].label)) {
				continue;
			}

			var areaKey = normalizeLabelKey(specs[index].label);

			if (seen[areaKey]) {
				continue;
			}

			seen[areaKey] = true;
			preview.push(specs[index]);
		}

		for (index = 0; index < specs.length; index++) {
			if (preview.length >= maxItems) {
				break;
			}

			var item = specs[index];
			var key = normalizeLabelKey(item.label);
			var keyCompact = compactLabelKey(item.label);

			if (seen[key] || isAreaLabel(item.label)) {
				continue;
			}

			for (var i = 0; i < previewKeys.length; i++) {
				var wanted = previewKeys[i];
				var wantedCompact = compactLabelKey(wanted);

				if (key === wanted || keyCompact === wantedCompact) {
					seen[key] = true;
					preview.push(item);
					break;
				}
			}
		}

		if (preview.length >= 3) {
			return preview;
		}

		for (index = 0; index < specs.length; index++) {
			if (preview.length >= maxItems) {
				break;
			}

			var fallbackItem = specs[index];
			var fallbackKey = normalizeLabelKey(fallbackItem.label);

			if (seen[fallbackKey] || isAreaLabel(fallbackItem.label)) {
				continue;
			}

			seen[fallbackKey] = true;
			preview.push(fallbackItem);
		}

		return preview;
	}

	function renderSpecsPreviewList(specs) {
		if (!specs || !specs.length) {
			return '';
		}

		return specs
			.map(function (item) {
				var areaAttr = isAreaLabel(item.label) ? ' data-area-spec' : '';

				return (
					'<li class="flex"' +
					areaAttr +
					'><p>' +
					escapeHtml(item.label) +
					': </p><p>' +
					escapeHtml(item.value) +
					'</p></li>'
				);
			})
			.join('');
	}

	function renderSpecsTable(specs) {
		if (!specs || !specs.length) {
			return '<p class="catalog-single__empty-specs">Характеристики не указаны.</p>';
		}

		var rows = specs
			.map(function (item) {
				return (
					'<tr><td>' +
					escapeHtml(item.label) +
					': </td><td>' +
					escapeHtml(item.value) +
					'</td></tr>'
				);
			})
			.join('');

		return '<table><tbody>' + rows + '</tbody></table>';
	}

	function getCardData($card) {
		var characteristics = [];

		try {
			characteristics = JSON.parse($card.attr('data-characteristics') || '[]');
		} catch (error) {
			characteristics = [];
		}

		return {
			price: $card.attr('data-price') || '',
			regular: $card.attr('data-regular') || '',
			on_sale: $card.attr('data-on-sale') === '1',
			discount_label: $card.attr('data-discount-label') || '',
			savings: $card.attr('data-savings') || '',
			image: $card.attr('data-image') || '',
			display_name: $card.attr('data-display-name') || '',
			in_stock: $card.attr('data-in-stock') !== '0',
			characteristics: characteristics,
		};
	}

	function updateStock($main, data) {
		var $stock = $main.find('[data-single-stock]');

		if (!$stock.length) {
			return;
		}

		var inStock = data.in_stock !== false && data.in_stock !== 0;

		$stock
			.text(inStock ? 'В наличии' : 'Нет в наличии')
			.toggleClass('is-in-stock', inStock)
			.toggleClass('is-out-of-stock', !inStock)
			.attr('data-in-stock', inStock ? '1' : '0');
	}

	function updateSaleBadge($main, data) {
		var $badge = $main.find('.catalog-single__media [data-card-sale-badge]');

		if (!$badge.length) {
			return;
		}

		if (data.on_sale) {
			$badge.text(data.discount_label || 'акция').removeAttr('hidden');
			return;
		}

		$badge.attr('hidden', 'hidden');
	}

	function updateVariationName($main, data) {
		var $variationName = $main.find('[data-single-variation-name]');

		if (!$variationName.length) {
			return;
		}

		if (data.display_name) {
			$variationName.text(data.display_name).removeAttr('hidden');
			return;
		}

		$variationName.attr('hidden', 'hidden');
	}

	function updateUi($main, data) {
		var $priceWrap = $main.find('[data-single-price-wrap]');
		var $specsTable = $main.closest('.catalog-single').find('[data-single-specs-table]');
		var $imageLink = $main.find('[data-single-image]');
		var priceHtml = renderPriceHtml(data);

		updateVariationName($main, data);

		if ($priceWrap.length) {
			$priceWrap.find('.product-card__price, .product-card__price--sale').remove();

			if (priceHtml) {
				$priceWrap.find('.catalog-single__price').prepend(priceHtml);
			}
		}

		updateSaleBadge($main, data);
		updateStock($main, data);

		if ($specsTable.length) {
			$specsTable.html(renderSpecsTable(data.characteristics));
		}

		var $specsPreview = $main.find('[data-single-specs-preview]');

		if ($specsPreview.length && data.characteristics && data.characteristics.length) {
			$specsPreview.html(renderSpecsPreviewList(filterPreviewCharacteristics(data.characteristics)));
		}

		if (data.image && $imageLink.length) {
			$imageLink.attr('href', data.image);
			$imageLink.find('img').attr('src', data.image);
		}
	}

	function setActiveCard($cards, $active) {
		$cards.removeClass('is-active').attr('aria-selected', 'false');
		$active.addClass('is-active').attr('aria-selected', 'true');
	}

	function getPreselectedCard($cards) {
		var params = new URLSearchParams(window.location.search);
		var variationId = params.get('variation');
		var areaSlug = params.get('area');
		var $matched = $();

		if (variationId) {
			$matched = $cards.filter('[data-variation-id="' + variationId + '"]');
		}

		if (!$matched.length && areaSlug) {
			$matched = $cards.filter('[data-area-slug="' + areaSlug + '"]');
		}

		if (!$matched.length) {
			return null;
		}

		return $matched.not(':disabled').not('.is-disabled').first().length
			? $matched.not(':disabled').not('.is-disabled').first()
			: $matched.first();
	}

	function applyCardToForm($form, $card) {
		var attributes = {};

		try {
			attributes = JSON.parse($card.attr('data-form-attributes') || '{}');
		} catch (error) {
			attributes = {};
		}

		Object.keys(attributes).forEach(function (name) {
			var $select = $form.find('select[name="' + name + '"]');

			if ($select.length) {
				$select.val(attributes[name]).trigger('change');
			}
		});
	}

	function initSingleProduct($main) {
		var $form = $main.find('form.variations_form');

		if (!$form.length) {
			return;
		}

		var $cards = $main.find('.catalog-single__variant[data-variation-id]');
		var $preselectedCard = getPreselectedCard($cards);
		var $firstCard = $preselectedCard && $preselectedCard.length ? $preselectedCard : $cards.first();

		if ($firstCard.length) {
			setActiveCard($cards, $firstCard);
			updateUi($main, getCardData($firstCard));
		}

		$cards.on('click', function (event) {
			event.stopPropagation();

			var $card = $(this);

			if ($card.is(':disabled') || $card.hasClass('is-disabled')) {
				return;
			}

			setActiveCard($cards, $card);
			updateUi($main, getCardData($card));
			applyCardToForm($form, $card);
		});

		$form.on('found_variation', function (event, variation) {
			if (!variation || !variation.variation_id) {
				return;
			}

			var $matched = $cards.filter('[data-variation-id="' + variation.variation_id + '"]');

			if ($matched.length) {
				setActiveCard($cards, $matched);
				updateUi($main, getCardData($matched));
			}
		});

		$form.on('reset_data', function () {
			if ($preselectedCard && $preselectedCard.length) {
				setActiveCard($cards, $preselectedCard);
				updateUi($main, getCardData($preselectedCard));
				applyCardToForm($form, $preselectedCard);
				return;
			}

			if ($firstCard.length) {
				setActiveCard($cards, $firstCard);
				updateUi($main, getCardData($firstCard));
			}
		});

		function initFirstVariation() {
			if (!$firstCard.length || $form.data('computex-initialized')) {
				return;
			}

			$form.data('computex-initialized', true);
			setActiveCard($cards, $firstCard);
			updateUi($main, getCardData($firstCard));
			applyCardToForm($form, $firstCard);
		}

		$form.on('wc_variation_form', initFirstVariation);
		setTimeout(initFirstVariation, 350);
	}

	$(function () {
		$('[data-product-single]').each(function () {
			initSingleProduct($(this));
		});
	});
})(jQuery);
