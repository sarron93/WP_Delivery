"use strict";

( function( $, window, undefined ) {
	
	var $body = $('body');
	
	function change_option( id, val ) {
		wp.customize( id, function( obj ) {
			var _trnspt = obj.transport;
			obj.transport = 'postMessage';
			obj.set( val );
			obj.transport = _trnspt;
		} );
	}
	
	function change_option_refresh( id, val ) {
		wp.customize( id, function( obj ) {
			obj.set( val );
		} );
	}
	
	/* Image radio control */
	$body.on( 'click', '.image-radio-options .option-image', function() {
		var $this = $(this);
		$this.addClass( 'selected' );
		$this.siblings().removeClass( 'selected' );
		var $input = $this.closest( '.customize-control' ).find( 'input' );
		var option_id = $input.attr( 'data-customize-setting-link' );
		change_option_refresh( option_id, $this.data( 'value' ) );
		return false;
	} );
	
	/* Color scheme change */
	function force_refresh( id ) {
		wp.customize( id, function( obj ) {
			var val = obj.get();
			var _trnspt = obj.transport;
			obj.transport = 'postMessage';
			obj.set( '' );
			obj.transport = 'refresh';
			obj.set( val );
			obj.transport = _trnspt;
		} );
	}
	wp.customize( 'color-scheme', function( val ) {
		val.bind( function( to ) {
			var postfix = '';
			if( to != crf_customizer_options.default_color_scheme ) {
				postfix = '-' + to;
			}
			for( var i in crf_customizer_options.color_scheme_options ) {
				var option = crf_customizer_options.color_scheme_options[i];
				change_option( option, crf_customizer_options.color_scheme_colors[option + postfix] );
			}
			force_refresh( 'primary-color' );
		} );
	} );

} )( jQuery, window );