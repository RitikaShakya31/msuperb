$(".home-index-slider").slick({
	dots: !1,
	fade: !0,
	infinite: !0,
	autoplay: !0,
	arrows: !0,
	speed: 600,
	prevArrow: '<i class="icofont-arrow-right dandik"></i>',
	nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
	slidesToShow: 1,
	slidesToScroll: 1,
	responsive: [
		{ breakpoint: 1200, settings: { slidesToShow: 1, slidesToScroll: 1 } },
		{ breakpoint: 992, settings: { slidesToShow: 1, slidesToScroll: 1 } },
		{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } },
		{
			breakpoint: 576,
			settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 },
		},
	],
}),
	$(".home-grid-slider").slick({
		dots: !0,
		fade: !1,
		infinite: !0,
		autoplay: !0,
		arrows: !0,
		speed: 600,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 992, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 },
			},
		],
	}),
	$(".home-category-slider").slick({
		dots: !0,
		fade: !0,
		infinite: !0,
		autoplay: !0,
		arrows: !0,
		speed: 500,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 992, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 },
			},
		],
	}),
	$(".home-classic-slider").slick({
		dots: !1,
		fade: !1,
		infinite: !0,
		autoplay: !0,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 992, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 },
			},
		],
	}),
	$(".suggest-slider").slick({
		dots: false,
		infinite: true,
		autoplay: false,
		arrows: true,
		speed: 1000,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 3, // Show 3 cards by default
		slidesToScroll: 3, // Scroll 3 items at once
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 3, slidesToScroll: 3 } }, // 3 cards on large screens
			{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } }, // 3 cards on medium screens
			{ breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 3 } }, // 3 cards on smaller screens
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: false }, // 1 card on very small screens, no arrows
			},
		],
	});

$(".lab-slider").slick({
	dots: false,
	infinite: true,
	autoplay: false,
	arrows: true,
	speed: 1000,
	prevArrow: '<i class="icofont-arrow-right dandik"></i>',
	nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
	slidesToShow: 5, // Default cards to show
	slidesToScroll: 5, // Default cards to scroll
	responsive: [
		{ breakpoint: 1200, settings: { slidesToShow: 5, slidesToScroll: 5 } }, // Adjust for medium screens
		{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } }, // Adjust for smaller screens
		{ breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 3 } }, // Adjust for even smaller screens
		{
			breakpoint: 576,
			settings: {
				slidesToShow: 2, // Show 2 cards in mobile view
				slidesToScroll: 2, // Scroll 2 cards in mobile view
				arrows: false, // Disable arrows for mobile view
			},
		},
	],
});

$(".new-slider").slick({
	dots: !1,
	infinite: !0,
	autoplay: !0,
	arrows: !0,
	speed: 800,
	prevArrow: '<i class="icofont-arrow-right dandik"></i>',
	nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
	slidesToShow: 5,
	slidesToScroll: 1,
	responsive: [
		{ breakpoint: 1200, settings: { slidesToShow: 4, slidesToScroll: 2 } },
		{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } },
		{ breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 2 } },
		{
			breakpoint: 576,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				variableWidth: !0,
				arrows: !1,
			},
		},
	],
}),
	$(".category-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: !0,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 5,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 5, slidesToScroll: 5 } },
			{ breakpoint: 992, settings: { slidesToShow: 4, slidesToScroll: 4 } },
			{ breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 3 } },
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					variableWidth: !0,
					arrows: !1,
				},
			},
		],
	}),
	$(".brand-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: !1,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 5,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 4, slidesToScroll: 4 } },
			{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } },
			{ breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 2 } },
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					variableWidth: !0,
					arrows: !1,
				},
			},
		],
	}),
	$(".blog-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: !1,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 3, slidesToScroll: 3 } },
			{ breakpoint: 992, settings: { slidesToShow: 2, slidesToScroll: 2 } },
			{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 },
			},
		],
	}),
	$(".testimonial-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: 1,
		autoplaySpeed: 1500, // Set the autoplay duration in milliseconds (e.g., 5000ms = 5 seconds)
		arrows: !0,
		fade: !1,
		speed: 1e3,
		centerMode: !0,
		centerPadding: "250px",
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: "250px",
				},
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: "130px",
				},
			},
			{
				breakpoint: 768,
				settings: { slidesToShow: 1, slidesToScroll: 1, centerPadding: "40px" },
			},
			{
				breakpoint: 576,
				settings: {
					arrows: !1,
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: "10px",
				},
			},
		],
	}),
	$(".testi-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: !1,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 992, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } },
			{ breakpoint: 576, settings: { slidesToShow: 1, slidesToScroll: 1 } },
		],
	}),
	$(".team-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: !1,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 3, slidesToScroll: 3 } },
			{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } },
			{ breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 2 } },
			{ breakpoint: 576, settings: { slidesToShow: 1, slidesToScroll: 1 } },
		],
	}),
	$(".isotope-slider").slick({
		dots: !1,
		infinite: !0,
		autoplay: !1,
		arrows: !0,
		speed: 800,
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		slidesToShow: 5,
		slidesToScroll: 2,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 5, slidesToScroll: 2 } },
			{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } },
			{ breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 2 } },
			{ breakpoint: 576, settings: { slidesToShow: 2, slidesToScroll: 2 } },
		],
	}),
	$(".preview-slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: !0,
		fade: !0,
		asNavFor: ".thumb-slider",
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		responsive: [
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !0 },
			},
		],
	}),
	$(".thumb-slider").slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: ".preview-slider",
		dots: !1,
		arrows: !1,
		centerMode: !0,
		focusOnSelect: !0,
		responsive: [
			{ breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 1 } },
			{ breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 1 } },
			{ breakpoint: 576, settings: { slidesToShow: 3, slidesToScroll: 1 } },
			{ breakpoint: 400, settings: { slidesToShow: 2, slidesToScroll: 1 } },
		],
	}),
	$(".details-preview").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: !1,
		fade: !0,
		asNavFor: ".details-thumb",
		prevArrow: '<i class="icofont-arrow-right dandik"></i>',
		nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
		responsive: [
			{
				breakpoint: 576,
				settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !0 },
			},
		],
	}),
	$(".details-thumb").slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: ".details-preview",
		dots: !1,
		arrows: !1,
		focusOnSelect: !0,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 3, slidesToScroll: 1 } },
			{ breakpoint: 992, settings: { slidesToShow: 5, slidesToScroll: 1 } },
			{ breakpoint: 768, settings: { slidesToShow: 4, slidesToScroll: 1 } },
			{
				breakpoint: 576,
				settings: { slidesToShow: 4, slidesToScroll: 1, vertical: !1 },
			},
			{
				breakpoint: 400,
				settings: { slidesToShow: 3, slidesToScroll: 1, vertical: !1 },
			},
		],
	});
