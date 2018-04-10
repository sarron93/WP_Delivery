/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
'use strict';

( function( $ ) {

	function customize( val, innerfunction ) {
		if ( innerfunction == undefined ) return ;
		if ( ! $.isFunction( innerfunction ) ) return;

		wp.customize( val, function( value ) {
			value.bind( function( to ) {
				innerfunction( to );
			} );
		} );
	}

	/* Header - topbar */
	customize( "topbar-phone", function( content ) {
		$( 'header #phone').html( content );
	} );
	customize( "topbar-email", function( content ) {
		$( 'header #email').html( content );
	} );
	
	/* Footer - copyright bar */
	customize( "footer-copyright-text", function( content ) {
		$( 'footer .copyright-text').html( content );
	} );

} )( jQuery );
