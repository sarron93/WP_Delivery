'use strict';

;( function( $ ) {
	/* Sortable container */
	$(document).ready( function() {
		rebind_sortables( $( '.crf-sortable' ) );
	} );
	
	/* Reinit on widget add, update */
	$(document).on( 'widget-updated', function( e, widget ) {
		rebind_sortables( widget.find( '.crf-sortable' ) );
	} );
	$(document).on( 'widget-added', function( e, widget ) {
		rebind_sortables( widget.find( '.crf-sortable' ) );
	} );

	function rebind_sortables( $container ) {
		$( '.crf-btn-add-accordion-tab' ).off( 'click' );
		$( '.crf-btn-add-accordion-tab' ).on( 'click', function() {
			var $container = $(this).parent().siblings( '.crf-sortable' );
			var $newtab = $(this).parent().siblings( '.crf-new-handle' );
			var newtab_html = $newtab.html();
			newtab_html = newtab_html.replace( /data-name/gi, "name" );
			newtab_html = newtab_html.replace( /data-index/gi, $container.find( '.crf-sortable-handle' ).length );
			$container.append( newtab_html );
			rebind_sortables( $container, true );
			return false;
		} );
		$( '.crf-sortable-handle-title .open' ).off( 'click' );
		$( '.crf-sortable-handle-title .open' ).on( 'click', function() {
			var $content = $(this).closest( '.crf-sortable-handle' ).find( '.crf-sortable-content-wrapper' );
			if( $content.css( 'display' ) == 'block' ) {
				$content.slideUp( 300 );
			} else {
				$content.slideDown( 300 );
				$(this).closest( '.crf-sortable-handle' ).siblings().find( '.crf-sortable-content-wrapper' ).slideUp( 300 );
			}
			return false;
		} );
		$( '.crf-sortable-handle-title .delete' ).off( 'click' );
		$( '.crf-sortable-handle-title .delete' ).on( 'click', function() {
			$(this).closest( '.crf-sortable-handle' ).fadeOut( 200, function() {
				$(this).remove();
			} );
			return false;
		} );
		$( '.crf-sortable-title' ).off( 'change' );
		$( '.crf-sortable-title' ).on( 'change', function() {
			var $this = $(this);
			$this.closest( '.crf-sortable-content-wrapper' ).siblings( '.crf-sortable-handle-title' ).find( 'span' ).html( $this.val() );
		} );

		$container.sortable( {
			cursor: "move"
		} );
	}
} )( jQuery );