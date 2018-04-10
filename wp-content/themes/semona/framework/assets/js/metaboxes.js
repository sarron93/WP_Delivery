'use strict';

;( function( $ ) {
$(document).ready( function () {
	
	/* Tab UI */
	var minHeight = $('ul.crf_metabox_tabs').height();
	
	function set_tab_height() {
		var height = $('div.crf_metabox').height();
		$('ul.crf_metabox_tabs').height(
			height > minHeight ? ( height + 40 ): minHeight	
		);
	}
	
	$(".crf_metabox_tabs a").on( 'click', function( e ) {
		$( ".crf_metabox_tabs li" ).removeClass( 'active' );
		$(this).closest( 'li' ).addClass( 'active' );

		$( '.crf_metabox_tab' ).removeClass( 'active' ).hide();
		var tabid = $(this).attr( 'href' );
		tabid = tabid.replace( '#', '' );
		$('#crf_tab_' + tabid + '.crf_metabox_tab').addClass( 'active' ).fadeIn( 300,
				function ( ) {
					set_tab_height();
				}
		);
		return false;
	});
	
	$(".crf_metabox_tabs li.active a").trigger('click');

	/* Metabox option type - Upload image */
	$('.crf_metabox input.crf_upload_button').click( function(e) {
		e.preventDefault();
		var self = $(this);

		var file_frame = wp.media.frames.file_frame = wp.media( {
			title: 'Select Image',
			button: {
				text: 'Select Image',
			},
			frame: 'post',
			multiple: false
		} );

		file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();
		$('.media-menu a:contains(Create Gallery)').remove();

		file_frame.on( 'select', function() {
			var selection = file_frame.state().get( 'selection' );
				selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				self.parent().parent().find( '.upload_field' ).val( attachment.url );
			} );

			$('.media-modal-close').trigger( 'click' );
		} );

		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get( 'selection' );
			var size = $( '.attachment-display-settings .size' ).val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				if(!size) {
					attachment.url = attachment.url;
				} else {
					attachment.url = attachment.sizes[size].url;
				}

				self.parent().parent().find( '.upload_field' ).val( attachment.url );
			});

			self.text( 'Remove' ).addClass( 'remove-image' );
			$( '.media-modal-close' ).trigger( 'click' );
		});
	});

	/* Metabox option type - Color */ 
	$('.crf-metabox-color-picker').wpColorPicker();
	
	/* Metabox option group toggle open/close */
	$('.crf-metabox-subsection .subsection-title').on( 'click', function() {
		var $section = $(this).closest( '.crf-metabox-subsection' );
		if( $section.hasClass( 'opened' ) ) {
			$section.removeClass( 'opened' );
			$section.find( '.subsection-content' ).slideUp( 400 );
		} else {
			$section.addClass( 'opened' );
			$section.find( '.subsection-content' ).slideDown( 400 );
		}
	} );
	
	/* Metabox dependency check */
	var option_prefix = 'crf_';
	function metabox_check_dependency() {
		$( '#crf_metabox' ).find( 'div[data-dep-option]' ).each( function() {
			var $this = $(this);
			var dep_option = $this.data( 'dep-option' );
			var dep_value = $this.data( 'dep-value' );
			var dep_default = $this.data( 'dep-default' );
			var dep_value_in = $(this).data( 'dep-value-in' );
			var dep_value_not_in = $(this).data( 'dep-value-not-in' );
			var dep_option_value = $( '#' + option_prefix + dep_option ).val();
			var show = true;
			console.log( dep_value + ' ' + dep_option_value );
			if( dep_option_value == 'default' ) {
				if( dep_value == dep_default ) {
					show = true;
				} else {
					show = false;
				}
			} else if( dep_value ) {
				if( dep_option_value == dep_value ) {
					show = true;
				} else {
					show = false;
				}
			} else if( dep_value_in ) {
				var values = dep_value_in.split( ',' );
				var value_is_in = false;
				for( var i = 0; i < values.length; i++ ) {
					if( values[i] == dep_option_value ) {
						value_is_in = true;
						break;
					}
				}
				if( !value_is_in ) {
					show = false;
				}
			} else if( dep_value_not_in ) {
				var values = dep_value_not_in.split( ',' );
				for( var i = 0; i < values.length; i++ ) {
					if( values[i] == dep_option_value ) {
						show = false;
						break;
					}
				}
			}
			if( show ) {
				$this.css( 'display', 'block' );
			} else { 
				$this.css( 'display', 'none' );
			}
		} );
	}
	metabox_check_dependency();
	$( '.crf-meta-value' ).on( 'change', function() {
		metabox_check_dependency();
	} );
} );
})( jQuery );