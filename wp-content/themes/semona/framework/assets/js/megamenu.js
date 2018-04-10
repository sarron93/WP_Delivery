'use strict';

;( function( $ ) {
	$(document).ready( function () {
		
		function check_megamenu_options_visibility( $megamenu_checkbox ) {
			var parent = $megamenu_checkbox.closest( 'li.menu-item' );
			if( $megamenu_checkbox.is( ":checked" ) ) {
				if( !parent.hasClass( 'menu-item-depth-0' ) ) {
					return;
				}
				showCustomFields( parent );
			}
			else {
				if ( ! parent.hasClass( 'menu-item-depth-0' ) ) {
					return;
				}
				hideCustomFields( parent );
			}
		} 
		$( 'input[type=checkbox]', 'p.megamenu-item.field-crf_enable_megamenu' ).on( 'click', function(e) {
			check_megamenu_options_visibility( $(this) );
		} );

		function showCustomFields ( obj ) {	// obj should li.menu-item of depth 0
			obj.find( 'p.megamenu-item.level-0:not(.field-crf_enable_megamenu)' ).show();
			while( obj = obj.next() ) {
				if( typeof obj.attr( 'class' ) == 'undefined' ) {
					break;
				}
				if( obj.hasClass( 'menu-item' ) && obj.hasClass( 'menu-item-depth-0' ) ) {
					break;
				}
				if( obj.hasClass( 'menu-item-depth-1' ) ) {
					obj.find( 'p.megamenu-item.level-1' ).show();
				} else if( obj.hasClass( 'menu-item-depth-2' ) ) {
					obj.find( 'p.megamenu-item.level-2' ).show();
				}
			}
		}

		function hideCustomFields ( obj ) {
			obj.find( 'p.megamenu-item:not(.field-crf_enable_megamenu):not(.level-all)' ).hide();
			while( obj = obj.next() ) {
				if( typeof obj.attr( 'class' ) == 'undefined' ) {
					break;
				}
				if( obj.hasClass( 'menu-item' ) && obj.hasClass( 'menu-item-depth-0' ) ) {
					break;
				}
				var $p_megamenu_item = obj.find( 'p.megamenu-item' );
				if( $p_megamenu_item.hasClass( 'level-all' ) ) {
					break;
				}
				obj.find( 'p.megamenu-item' ).hide();
			}
		}
		
		/* Megamenu options show/hide on init */
		var megamenu_checkboxes = $( 'input[type=checkbox]', 'p.megamenu-item.field-crf_enable_megamenu' );
		for( var ci = 0; ci < megamenu_checkboxes.length; ci++ ) {
			check_megamenu_options_visibility( $(megamenu_checkboxes[ci]) );
		}

		/* Megamenu options show/hide on menu item sort/move */
		$( "#menu-to-edit" ).on( "sortstop", function( event, ui ) {
			setTimeout ( function ( ) { 
				var obj = $( ui.item[0] );
				var origin = obj;

				if( obj.hasClass( 'menu-item-depth-0' ) ) {
					check_megamenu_options_visibility( obj.find( 'p.megamenu-item.field-crf_enable_megamenu input[type=checkbox]' ) );
				}
				else if ( obj.hasClass('menu-item-depth-1') || obj.hasClass('menu-item-depth-2') ) {
					while ( ( obj = obj.prev() ) != null && obj.hasClass( 'menu-item' ) && !obj.hasClass( 'menu-item-depth-0' ) ) {}
					check_megamenu_options_visibility( obj.find( 'p.megamenu-item.field-crf_enable_megamenu input[type=checkbox]' ) );
				}
			}, 100 );
		} );
		
		/* Megamenu background select */
		var custom_uploader;
		$( '.crf-select-megamenu-bg' ).on( 'click', function() {
			var $button = $(this);
			if( custom_uploader ) {
		        custom_uploader.open();
		        return;
		    }
			custom_uploader = wp.media.frames.file_frame = wp.media( {
		        title: 'Choose Image',
		        button: {
		            text: 'Choose Image'
		        },
		        multiple: false
		    } );
		    custom_uploader.on( 'select', function() {
		    	var selection = custom_uploader.state().get( 'selection' );
		        selection.map( function( attachment ) {
			        attachment = attachment.toJSON();
			        console.log(attachment.sizes['full'].url);
			        if( attachment.sizes['full'].url ) {
			        	$button.siblings( '.crf-megamenu-bg-image-wrapper' ).find( '.crf-megamenu-bg' ).attr( 'src', attachment.sizes['full'].url ).show();
			        	$button.siblings( 'input' ).val( attachment.id );
			        }
		        } );
		    } );
		    custom_uploader.open();
		    return false;
		} );
		$( '.crf-remove-megamenu-bg' ).on( 'click', function() {
			var $button = $(this);
			$button.siblings( '.crf-megamenu-bg-image-wrapper' ).find( '.crf-megamenu-bg' ).hide().attr( 'src', '' );
			$button.siblings( 'input' ).val( '' );
			return false;
		} );

		// load jquery.select2 
		/*$("select[id^='edit-menu-item-crf_fa_icons']").select2(
		{
			width: "100%",
			templateResult: select2Formatter,
			templateSelection: select2Formatter
		});
		
		function select2Formatter ( icon ) {
				var original = icon.element;
				return $( '<span><i class="fa fa-fw ' + $(original).data('icon') + '"></i> ' + icon.text + '</span>');
		}*/
	} );
} )( jQuery );