(function($) {
$(function() {

	// Lightbox
	$("a.zoom").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});
	
	$("a[data-rel^='prettyPhotoModern']").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false,
		iframe_markup: '<div class="sm-temp-wrapper">{content}</div>',
		inline_markup: '<div class="sm-temp-wrapper">{content}</div>',
		changepicturecallback: function() {
			if ( typeof $.fn.mediaelementplayer !== 'undefined' ) {
				$(".sm-temp-wrapper video").mediaelementplayer();
				$(".sm-temp-wrapper audio").mediaelementplayer();
			}
		}
	});

});
})(jQuery);
/*
(function($) {
$(function() {

	// Lightbox
	$("a.zoom").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false,
		iframe_markup: '<div class="sm-temp-wrapper">{content}</div>',
		inline_markup: '<div class="sm-temp-wrapper">{content}</div>',
		changepicturecallback: function() {
			if ( typeof $.fn.mediaelementplayer !== 'undefined' ) {
				$(".sm-temp-wrapper video").mediaelementplayer();
				$(".sm-temp-wrapper audio").mediaelementplayer();
			}
		}
	});

});
})(jQuery);
*/