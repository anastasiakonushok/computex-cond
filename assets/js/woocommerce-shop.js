(function () {
	function escapeHtml(value) {
		return String(value)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
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

	function propertyMatchesKeys(label, wantedKeys) {
		var key = normalizeLabelKey(label);
		var keyCompact = compactLabelKey(label);

		for (var i = 0; i < wantedKeys.length; i++) {
			var wanted = wantedKeys[i];
			var wantedCompact = compactLabelKey(wanted);

			if (key === wanted || keyCompact === wantedCompact) {
				return true;
			}
		}

		return false;
	}

	var cardSpecKeyGroups = [
		['area'],
		['инвертор'],
		['производитель'],
		['wi - fi', 'wi-fi', 'wifi'],
		['страна производства'],
		['класс энергоэффективности'],
	];

	function filterProductCardCharacteristics(specs) {
		if (!specs || !specs.length) {
			return [];
		}

		var filtered = [];
		var seen = {};
		var groupIndex;
		var specIndex;

		for (groupIndex = 0; groupIndex < cardSpecKeyGroups.length; groupIndex++) {
			var group = cardSpecKeyGroups[groupIndex];

			if (group[0] === 'area') {
				for (specIndex = 0; specIndex < specs.length; specIndex++) {
					if (!isAreaLabel(specs[specIndex].label)) {
						continue;
					}

					var areaKey = normalizeLabelKey(specs[specIndex].label);

					if (seen[areaKey]) {
						continue;
					}

					seen[areaKey] = true;
					filtered.push({
						label: 'Обслуживаемая площадь, м²',
						value: specs[specIndex].value || '',
					});
					break;
				}

				continue;
			}

			for (specIndex = 0; specIndex < specs.length; specIndex++) {
				var item = specs[specIndex];
				var key = normalizeLabelKey(item.label);

				if (!item.label || seen[key] || isAreaLabel(item.label)) {
					continue;
				}

				if (!propertyMatchesKeys(item.label, group)) {
					continue;
				}

				seen[key] = true;
				filtered.push({
					label: item.label,
					value: item.value || '',
				});
				break;
			}
		}

		return filtered;
	}

	function buildProductUrl(baseUrl, selected) {
		if (!baseUrl || !selected) {
			return baseUrl || '';
		}

		try {
			var url = new URL(baseUrl, window.location.origin);

			url.searchParams.delete('variation');
			url.searchParams.delete('area');

			if (selected.id) {
				url.searchParams.set('variation', String(selected.id));
			} else if (selected.slug) {
				url.searchParams.set('area', String(selected.slug));
			}

			return url.pathname + url.search + url.hash;
		} catch (error) {
			return baseUrl;
		}
	}

	function updateCardLinks(card, selected) {
		var baseUrl = card.getAttribute('data-permalink') || '';
		var links = card.querySelectorAll('[data-card-link]');

		if (!baseUrl || !links.length) {
			return;
		}

		var nextUrl = buildProductUrl(baseUrl, selected);

		links.forEach(function (link) {
			link.setAttribute('href', nextUrl);
		});
	}

	function renderCharacteristics(specs) {
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

	function renderCardSpecs(specs) {
		return '<ul data-card-specs>' + renderCharacteristics(filterProductCardCharacteristics(specs)) + '</ul>';
	}

	function getDiscountLabel(data) {
		if (data.discount_label) {
			return data.discount_label;
		}

		if (data.discount_percent) {
			return '-' + data.discount_percent + '%';
		}

		return '';
	}

	function renderPrice(priceEl, data) {
		if (!priceEl || !data || !data.price) {
			return;
		}

		if (data.on_sale && data.regular) {
			var discountLabel = getDiscountLabel(data);
			var savings = data.savings || '';

			priceEl.className = 'product-card__price product-card__price--sale';
			priceEl.innerHTML =
				'<div class="product-card__price-row">' +
				'<span class="product-card__price-current">' +
				escapeHtml(data.price) +
				'</span><span class="product-card__price-old">' +
				escapeHtml(data.regular) +
				'</span></div>' +
				'<div class="product-card__economy" data-card-economy>' +
				'<span class="product-card__economy-percent" data-card-discount-percent">' +
				escapeHtml(discountLabel) +
				'</span><span class="product-card__economy-value" data-card-savings">' +
				escapeHtml(savings) +
				'</span></div>';
			return;
		}

		priceEl.className = 'product-card__price';
		priceEl.innerHTML =
			'<span class="product-card__price-current">' + escapeHtml(data.price) + '</span>';
	}

	function updateSaleBadge(card, data) {
		var badge = card.querySelector('[data-card-sale-badge]');

		if (!badge) {
			return;
		}

		if (data.on_sale) {
			badge.textContent = getDiscountLabel(data) || 'акция';
			badge.removeAttribute('hidden');
			badge.style.display = '';
			return;
		}

		badge.setAttribute('hidden', 'hidden');
		badge.style.display = 'none';
	}

	function updateSpecs(card, specsWrap, data) {
		if (!specsWrap) {
			return;
		}

		var items = [];

		if (data && data.characteristics && data.characteristics.length) {
			items = data.characteristics;
		} else {
			try {
				items = JSON.parse(card.getAttribute('data-properties') || '[]');
			} catch (error) {
				items = [];
			}
		}

		specsWrap.innerHTML = renderCardSpecs(items);
	}

	function applySelection(card, button, variations, price, specsWrap, image) {
		var variationId = Number(button.getAttribute('data-variation-id'));
		var selected = variations.find(function (variation) {
			return Number(variation.id) === variationId;
		});

		if (!selected) {
			return;
		}

		card.querySelectorAll('.product-card__variant').forEach(function (item) {
			item.classList.remove('is-active');
		});
		button.classList.add('is-active');

		renderPrice(price, selected);
		updateSaleBadge(card, selected);
		updateSpecs(card, specsWrap, selected);
		updateCardLinks(card, selected);

		if (image && selected.image) {
			image.src = selected.image;
		}
	}

	function initCard(card) {
		var variations = [];
		var properties = [];

		try {
			variations = JSON.parse(card.getAttribute('data-variations') || '[]');
			properties = JSON.parse(card.getAttribute('data-properties') || '[]');
		} catch (error) {
			variations = [];
			properties = [];
		}

		var price = card.querySelector('[data-card-price]');
		var specsWrap = card.querySelector('[data-card-specs-wrap]');
		var image = card.querySelector('[data-card-image]');
		var buttons = card.querySelectorAll('.product-card__variant');

		if (specsWrap && properties.length) {
			specsWrap.innerHTML = renderCardSpecs(properties);
		}

		if (!variations.length) {
			return;
		}

		var activeButton = card.querySelector('.product-card__variant.is-active') || buttons[0];

		if (activeButton) {
			applySelection(card, activeButton, variations, price, specsWrap, image);
		}

		buttons.forEach(function (button) {
			button.addEventListener('click', function (event) {
				event.stopPropagation();
				applySelection(card, button, variations, price, specsWrap, image);
			});
		});
	}

	function initShopFiltersMobile() {
		var panel = document.querySelector('.shop-filters-panel');
		if (!panel) {
			return;
		}

		var mobileQuery = window.matchMedia('(max-width: 1023px)');
		var headerToggle = panel.querySelector('.shop-filters__header');
		var sections = panel.querySelectorAll('.shop-filters__section');

		function syncSectionState(section, isOpen) {
			var title = section.querySelector('.shop-filters__section-title');
			section.classList.toggle('is-open', isOpen);

			if (title) {
				title.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
			}
		}

		function bindSectionToggles() {
			sections.forEach(function (section) {
				var title = section.querySelector('.shop-filters__section-title');
				if (!title || title.dataset.bound === '1') {
					return;
				}

				title.dataset.bound = '1';
				title.addEventListener('click', function () {
					if (!mobileQuery.matches) {
						return;
					}

					syncSectionState(section, !section.classList.contains('is-open'));
				});
			});
		}

		function syncPanelState(isOpen) {
			panel.classList.toggle('is-filters-open', isOpen);

			if (headerToggle) {
				headerToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
			}
		}

		if (headerToggle && headerToggle.dataset.bound !== '1') {
			headerToggle.dataset.bound = '1';
			headerToggle.addEventListener('click', function () {
				if (!mobileQuery.matches) {
					return;
				}

				syncPanelState(!panel.classList.contains('is-filters-open'));
			});
		}

		function applyMode() {
			if (!mobileQuery.matches) {
				syncPanelState(true);
				sections.forEach(function (section) {
					syncSectionState(section, true);
				});
				return;
			}

			if (!panel.classList.contains('is-filters-open')) {
				syncPanelState(false);
			}
		}

		bindSectionToggles();
		applyMode();

		if (typeof mobileQuery.addEventListener === 'function') {
			mobileQuery.addEventListener('change', applyMode);
		} else if (typeof mobileQuery.addListener === 'function') {
			mobileQuery.addListener(applyMode);
		}
	}

	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.product-card[data-variations], .product-card[data-properties]').forEach(initCard);
		initShopFiltersMobile();
	});
})();
