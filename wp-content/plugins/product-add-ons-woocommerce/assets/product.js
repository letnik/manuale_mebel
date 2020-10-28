/* global jQuery */

jQuery(function($) {
	const {
		numberOfDecimals,
		adminAjax,
	} = ZAddons;
	let $inputs = null;
	const isVariations = $(".variations").length > 0;
	const $cart = $(".variations_form.cart");
	let variation = null;
	const quantityInput = $("div.quantity input.qty");
	initHandlers();
	$cart.on("found_variation", function(event, v) {
		variation = v;
		window.setTimeout(function() {
			if (variation && variation.variation_id) {
				removeVariationSection();
				const $addons = $('.zaddon-type-container');
				const ids = $.map($addons, function (element) {
					return $(element).data('id');
				});
				const data = {
					'action': 'get_variation_section',
					'applied_ids': ids,
					'variation_id': variation && variation.variation_id,
				};
				$.get(adminAjax, data, function (response) {
					response = JSON.parse(response);
					const element = $('<div class="za-variation-section">').append(response.section).append('</div>');
					$(element).insertBefore('.zaddon_data');
					update_info();
					initHandlers('.za-variation-section');
				})
					.fail(function (error) {
						console.log(error);
					});
			}
			update_info();
		}, 40);
	});
	$cart.on("hide_variation", function(event) {
		variation = null;
		removeVariationSection();
		window.setTimeout(function() {
			update_info();
		}, 40);
	});

	function update_info() {
		let additional = 0;
		$(".zaddon_data").hide();
		if (isVariations && variation === null) {
			return;
		}

		$inputs.each(function() {
			let addonAdditional = 0;
			switch ($(this).data("type")) {
				case "select":
					addonAdditional += $(this).find("option:selected").data("price") ? $(this).find("option:selected").data("price") : 0;
					break;
				case "radio":
				case "checkbox":
					if ($(this).is(":checked")) addonAdditional += $(this).data("price");
					break;
				case "text":
				default:
					if ($(this).val().length > 0) addonAdditional += $(this).data("price");
			}
			let value = 0;
			switch ($(this).data("value-type")) {
				case 'custom':
					addonAdditional += Number($(this).val());
					break;
				case 'custom_percent':
					value = getPrice() * Number($(this).val()) / 100;
					addonAdditional += round(value);
					break;
				case 'subtotal_percent':
					value = getPrice() * addonAdditional / 100;
					addonAdditional = round(value);
			}

			const quantity = $(this).closest('.zaddon_option').find('.zaddon_quantity_input').val();
			additional += quantity ? quantity * addonAdditional : addonAdditional;
		});

		const $additional = $(".zaddon_additional span");

		$additional.html(formatPrice(additional));

		const $total = $(".zaddon_total span");

		let price = getPrice();

		const $subtotal = $(".zaddon_subtotal span");
		$subtotal.html(formatPrice(price));

		price += additional;
		$total.html(formatPrice(price));
		if ($('.zaddon-type-container ').length) {
			$(".zaddon_data").show();
		}
	}

	quantityInput.on("change", update_info);

	$(".zaddon-type-container select").on('change', activateQuantityHandlers);

	function getPrice() {
		return isVariations ? variation.display_price : +$("#zaddon_base_price").val();
	}

	function round(num) {
		return Math.round(num * Math.pow(10, numberOfDecimals)) / Math.pow(10, numberOfDecimals);
	}

	function activateQuantityHandlers() {
			const quantityInput = $('.zaddon_quantity_input');
			const quantityButton = $('.zaddon_quantity button');

			quantityInput.off("change", update_info);
			quantityButton.off("click", update_info);
			quantityInput.on("change", update_info);
			quantityButton.on("click", update_info);
		}

	$(".variations select").on("change", function() {
		window.setTimeout(function() {
			update_info();
		}, 40);
	});
	activateQuantityHandlers();
	update_info();

	function formatPrice(price) {
			price *= quantityInput.val();
		if(!Intl || !$('#zaddon_locale').val()) return price.toFixed(2);
		const  formatter = new Intl.NumberFormat($('#zaddon_locale').val().replace('_', '-'), {
			style: 'currency',
			currency: $('#zaddon_currency').val(),
			minimumFractionDigits: numberOfDecimals,
		});
		return formatter.format(price);
	}

	function initHandlers(selector = '.zaddon-type-container') {
		$inputs = $(".zaddon-type-container input:not([type=hidden]):not(.zaddon-additional), .zaddon-type-container select");
		$inputs.on("change", update_info);

		$(selector).on("click", ".zaddon-open", function(e) {
			e.preventDefault();
			const $parent = $(this).parents(".zaddon-type-container");
			$parent.toggleClass("zaddon_closed");
			const $description = $parent.find(".zaddon_hide_on_toggle");
			$description.toggleClass("zaddon_hide");

			const hidden = $parent.hasClass("zaddon_closed");

			const text = hidden ? $(this).data("open") : $(this).data("close");
			$(this).html(text);
		});
	}

	function removeVariationSection() {
		$('.za-variation-section').remove();
	}
	window.formatPrice = formatPrice;
});
