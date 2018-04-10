"use strict";

( function( $, window, undefined ) {
	
	$.fn.initPrettyPhoto = function() {
		$(this).prettyPhoto( {
			hook: 'data-rel',
			social_tools: false,
			theme: 'pp_woocommerce',
			horizontal_padding: 20,
			opacity: 0.8,
			default_width: 1024,
			default_height: 768,
			deeplinking: false
		} );
	}
	$.fn.initPrettyPhotoForAjax = function() {
		$(this).prettyPhoto({
			hook: 'data-rel',
			social_tools: false,
			theme: 'pp_woocommerce',
			horizontal_padding: 20,
			opacity: 0.8,
			default_width: 1024,
			default_height: 768,
			deeplinking: false,
			iframe_markup: '<div class="sm-temp-wrapper">{content}</div>',
			inline_markup: '<div class="sm-temp-wrapper">{content}</div>',
			changepicturecallback: function() {
				if ( typeof $.fn.mediaelementplayer !== 'undefined' ) {
					$(".sm-temp-wrapper video").mediaelementplayer({
							defaultVideoWidth: 1024,
						    defaultVideoHeight: 768,
						    videoWidth: 1024,
						    videoHeight: 768,
					});
					$(".sm-temp-wrapper audio").mediaelementplayer( {
							defaultVideoWidth: 1024,
							audioWidth: 1024
					});
					
					$(window).trigger('resize');
				}
			}
		});
	}
	
	function ThrottledScroll( handler, timeout ) {
		this.timeout = timeout || 10;
		this.handler = handler;
		this.scrolled = true;
		this.interval = '';
		var _this = this;
		function init() {
			$(window).on( 'scroll', function() {
				_this.scrolled = true;
			} );
			_this.interval = setInterval( function() {
				if (_this.scrolled) {
					try {
						handler();
					} catch( err ) {
						console.log( err );
					}
					_this.scrolled = false;
				}
			}, _this.timeout );
		}
		init();
	}

	var $body = $('body');
	var sticky_pos = 0;
	var $sticky_nav = $('.sticky-nav:visible');
	if( $('header').length > 0 && $sticky_nav.length > 0 ) {
		sticky_pos = $('header').offset().top + $sticky_nav.height();
	}

	/* Mobile browser detection */
	var isMobile = false;
	if( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
	    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)) ) {
	    isMobile = true;
	}

	/* Animate.css animation */
	if( !isMobile || ajax_obj.use_css3_animations_on_mobile == 'yes' ) {
		$( document ).ready( function() {
			new WOW( { offset: 100 } ).init();
		} );
	}

	/* Preloader if enabled */
	if( $('.sm-preloader').length > 0 ) {
		window.addEventListener( 'DOMContentLoaded', function() {
	        new QueryLoader2( document.querySelector( "body" ), {
	            barColor: "#efefef",
	            backgroundColor: "#111",
	            percentage: true,
	            barHeight: 3,
	            minimumTime: 200,
	            fadeOutTime: 200,
	            onComplete: function() {
	            	$('.sm-preloader').fadeOut( 1200, function() {
	        			$('.sm-preloader').hide();
	        		} );
	            }
	        } );
	    } );
	}

	/* Visual Composer waypoint 3 override */
	setTimeout( function () {
		if ( typeof $.fn.waypoint !== 'undefined' ) {
			$( '.wpb_animate_when_almost_visible:not(.wpb_start_animation)' ).waypoint( function () {
				$( this.element ).addClass( 'wpb_start_animation' );
			}, { offset: '85%' } );
		}
	}, 1600 );
	setTimeout( function () {
		if ( typeof $.fn.waypoint !== 'undefined' ) {
			$( '.vc_progress_bar' ).waypoint( function () {
				$( this.element ).find( '.vc_single_bar' ).each( function ( index ) {
					var $this = $( this ),
						bar = $this.find( '.vc_bar' ),
						val = bar.data( 'percentage-value' );

					setTimeout( function () {
						bar.css( { "width": val + '%' } );
					}, index * 200 );
				} );
			}, { offset: '85%' } );
		}
	}, 100 );

	/* Menu item smooth scroll */
	var scroll_offset = 0;
	if( $('#wpadminbar').length > 0 ) {
		scroll_offset += $('#wpadminbar').height();
	}
	if( $('header').length > 0 ) {
		scroll_offset += $('header').height();
	}
	/* Menu item smooth scroll */
	$('li.menu-item a').smoothScroll( {
		offset: -scroll_offset,
		speed: 800
	} );
	/* Menu item to top smooth scroll */
	$('li.menu-item a[href="#top"]').on( 'click', function() {
		$.smoothScroll( {
			scrollElement: 0
		} );
	} );
	/* Hash links smooth scroll */
	$('a[href*="#"]:not(.ui-tabs-anchor)').smoothScroll();

	/* Slider - Triangle Down - Mouse - Event Handler */
	$('.sm-vstd-wrap .slide-link').on('click', function() {
		var $slider_area = $('.sm-slider-area')
		var slider_offset = $slider_area.offset().top + $slider_area.height();
		$.smoothScroll({offset: slider_offset});
	});
	
	/* Header v1 - preventing dropdown overflowing container */
	// - Top level dropdown
	var $dropdowns = $( '.menu > .menu-item:not(.menu-icon) > .sub-menu' );
	if( $dropdowns.length > 0 ) {
		var $container = $($dropdowns[0]).closest( '.container' );
		if( $container.length > 0 ) {
			var container_right_max = $container.offset().left + $container.width();
			$dropdowns.each( function() {
				var $dropdown = $(this);
				if( $dropdown.offset().left + $dropdown.width() > container_right_max - 15 ) {
					$dropdown.css( 'left', 'auto' );
					$dropdown.css( 'right', '0' );
				}
			} );
		}
	}
	// - Sub level dropdown
	var $sub_dropdowns = $( '.menu .sub-menu > .menu-item > .sub-menu' );
	if( $sub_dropdowns.length > 0 ) {
		var $container = $($dropdowns[0]).closest( '.container' );
		if( $container.length > 0 ) {
			var container_right_max = $container.offset().left + $container.width();
			$sub_dropdowns.each( function() {
				var $sub_dropdown = $(this);
				if( $sub_dropdown.offset().left + $sub_dropdown.width() > container_right_max - 15 ) {
					$sub_dropdown.css( 'left', 'auto' );
					$sub_dropdown.css( 'right', '100%' );
				}
			} );
		}
	}
	
	/* Header v1 - Main nav search box */
	var search_form_opened = false;
	$('.menu-search .search-icon').on( 'click', function() {
		var $searchbox = $('.main-search-form');
		search_form_opened = true;
		$searchbox.fadeIn( 200 );
		return false;
	} );
	$('.main-search-form .search-button').on( 'click', function() {
		$('.main-search-form .search-form').submit();
		return false;
	} );
	$('.main-search-form').on( 'click', function() {
		return false;
	} );
	$('html, body').on( 'click', function( event) {
		if( search_form_opened && !$( event.target ).closest( 'header a' ).length ) {
			search_form_opened = false;
			$('.main-search-form').fadeOut( 200 );
			return false;
		}
	} );
	
	/* Header v1 - Mobile header */
	function close_mobile_menu() {
		$('.sm-mobile-header .menu-toggle').removeClass( 'close' );
		$('.mobile-menu .sub-menu' ).slideUp( 400 );
		$('.mobile-menu').slideUp( 400 );
		$('.mobile-menu li').removeClass( 'opened' );
	}
	$('.sm-mobile-header .menu-toggle').on( 'click', function() {
		var $this = $(this);
		if( $this.hasClass( 'close' ) ) {
			close_mobile_menu();
		} else {
			$this.addClass( 'close' );
			$('.mobile-menu').slideDown( 400 );
		}
		return false;
	} );
	$('.sm-mobile-header .chevron').on( 'click', function() {
		var $this = $(this);
		var menuitem = $this.closest( 'li' );
		var submenu = menuitem.children( '.sub-menu' );
		if( submenu.length > 0 ) {
			if( menuitem.hasClass( 'opened' ) ) {
				menuitem.removeClass( 'opened' );
				menuitem.find( 'li' ).removeClass( 'opened' );
				menuitem.find( '.sub-menu' ).slideUp( 300 );
			} else {
				menuitem.addClass( 'opened' );
				submenu.slideDown( 300 );
			}
			return false;
		}
	} );
	$('.sm-mobile-header .search-icon').on( 'click', function() {
		$('.sm-mobile-header .search-form').submit();
	} );

	/* Header v2 - menu toggle */
	$('.header-v2 .menu-toggle').on( 'click', function() {
		var $header = $(this).closest( '.header-v2' );
		if( $header.hasClass( 'opened' ) ) {
			$header.removeClass( 'opened' );
			$body.removeClass( 'sm-stop-scrolling' );
		} else {
			$header.addClass( 'opened' );
			$body.addClass( 'sm-stop-scrolling' );
		}
		return false;
	} );

	/* Onepage menu navigation */
	function home_menu_item_active() {
		$( 'ul.menu > li:not(.menu-icon)' ).removeClass( 'current-onepage-menu-item' );
		$( 'ul.menu > li:not(.menu-icon) > a[href="#"]' ).parent().addClass( 'current-onepage-menu-item' );
	}
	if( $('.content-page.content-onepage').length > 0 ) {
		$(document).ready( function() {
			if( $('.sm-multi-scroll').length > 0 ) {	// Multi-scroll onepage navigation
				if( typeof $.fn.multiscroll !== 'undefined' ) {
					$( 'ul.menu > li:not(.menu-icon) > a' ).on( 'click', function() {
						var menu_item_index = $(this).parent().index();
						if( menu_item_index >= 0 ) {
							$.fn.multiscroll.moveTo( menu_item_index + 1 );
						}
					} );
				}
			} else {		// Normal onepage navigation
				var toppos_offset = 0;
				if( $sticky_nav.length > 0 ) {
					toppos_offset = $sticky_nav.height();
				}
				home_menu_item_active();
				$( '.content-page > .container > .vc_row' ).each( function() {
					var $this = $(this);
					$this.waypoint( {
						handler: function() {
							var row_id = $this.attr( 'id' );
							if( row_id ) {
								var $current_menu_item = $( 'ul.menu > li:not(.menu-icon) > a[href="#' + row_id + '"]' );
								if( $current_menu_item.length > 0 ) {
									$( 'ul.menu > li:not(.menu-icon)' ).removeClass( 'current-onepage-menu-item' );
									$current_menu_item.parent().addClass( 'current-onepage-menu-item' );
								}
							}
						},
						offset: toppos_offset
					} );
				} );
				$( 'header' ).waypoint( {
					handler: function() {
						home_menu_item_active();
					}
				} )
			}

			$( '.header-v2 ul.menu a' ).on( 'click', function() {
				$('.header-v2 .menu-toggle').trigger( 'click' );
			})
		} );
	}
	
	/* Totop */
	$('.totop-handle').on( 'click', function() {
		$.smoothScroll( {
			scrollElement: 0,
			speed: 1000
		} );
	} );
	
	/* Sharer links */
	$('.sm-sharer-link').on( 'click', function() {
		var url = $(this).attr( 'href' );
		window.open( url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600' );
		return false;
	} );
	
	/* Woocommerce add to cart button */
	$body.on( 'click', '.product .add_to_cart_button', function() {
		var $product = $(this).closest( '.product' );
		var $spinner = $product.find( '.cart-loading' );
		$spinner.find( '.loading-spinner').show();
		$spinner.find( '.loading-done').hide();
		$spinner.addClass( 'spinner-adding-to-cart' );
	} );
	$body.bind( 'added_to_cart', function() {
		var $spinner = $( '.spinner-adding-to-cart' );
		$spinner.find( '.loading-spinner').fadeOut( 300 );
		$spinner.find( '.loading-done' ).fadeIn( 300 );
		setTimeout( function() {
			$spinner.removeClass( 'spinner-adding-to-cart' );
		}, 2000 );
	} );

	/* Post Like click */
	$('.sm-like-post').on( 'click', function() {
		var $this = $(this);
		$.ajax( {
			url: ajax_obj.ajaxurl,
			type: 'post',
			data: {
				action: 'sm_request_like_post',
				postid: $this.data( 'postid' ),
				nonce: $this.data( 'nonce' )
			},
			success: function( val ) {
				if( val > 0 ) {
					$this.find( 'span' ).html( val );
					$this.find( 'i' ).removeClass( 'fa-heart-o').addClass( 'fa-heart' );
					$this.replaceWith( $( '<span>' + $this.html() + '</span>' ) );
				}
			},
			error: function( val ) {
				console.log( 'Unexpected error: ajax call failed.' );
			}
		} );
		return false;
	} );

	/* Flexslider */
	function sm_init_flexslider( $slider_element ) {
		$slider_element.flexslider( {
			animation: 'slide',
			animationSpeed: 400,
			directionNav: $slider_element.data( 'directionnav' ),
			controlNav: $slider_element.data( 'controlnav' ),
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
			smoothHeight: $slider_element.data( 'smooth-height' )
		} );
	}
	$('.sm-flexslider').each( function() {
		var $this = $(this);
		if( $this.closest( '.sm-isotope-container' ).length <= 0 ) {
			sm_init_flexslider( $this );
		}
	} );
	
	/* Carousels */
	$('.sm-carousel').each( function() {
		var $carousel = $(this);
		var items = $carousel.data( 'items' );
		items = ( items ) ? items : 4;
		var item_width = $carousel.data( 'item-width' );
		$carousel.find( '.carousel-item' ).css( 'width', item_width + 'px' );
		$carousel.find( '.carousel-item' ).css( 'max-width', item_width + 'px' );
		$carousel.carouFredSel( {
			circular: true,
			responsive: true,
			prev: $carousel.data( 'prev' ),
			next: $carousel.data( 'next' ),
			items: {
				width: item_width,
				visible: {
					min: 1,
					max: items
				}
			},
			auto: false,
			mousewheel: false,
			scroll: {
				items: 1,
				duration: 400,
				pauseOnHover: false
			},
			swipe: {
				onMouse: true,
				onTouch: true
			}
		}, {
			onWindowResize: 'debounce'
		} );
		$carousel.removeClass( 'invisible' );
	} );
	
	/* Category widget (including woocommerce product category widget) */
	$('.widget_categories a, .widget_product_categories a').on( 'click', function( e ) {
		e.stopPropagation();
	} );
	$('.widget_categories li, .widget_product_categories li').on( 'click', function( e ) {
		e.stopPropagation();
		var $this = $(this);
		var $submenu = $this.children( '.children' );
		if( $submenu.length > 0 ) {
			if( $this.hasClass( 'opened' ) ) {
				$this.removeClass( 'opened' );
				$submenu.slideUp( 300 );
			} else {
				$this.addClass( 'opened' );
				$submenu.slideDown( 300 );
			}
		}
	} );
	
	/* Shop quantity input */
	$('.sm-quantity-input .quantity-dec').on( 'click', function() {
		var $qty_input = $(this).siblings( 'input.qty' );
		
		var qty = $qty_input.val();
		qty = parseInt( ( qty )? qty : 0 );
		
		var step = $qty_input.data( 'step' );
		if( step ) {
			qty -= parseInt( step );
		} else {
			qty -= 1;
		}
		
		var min = $qty_input.attr( 'min' );
		if( min ) {
			min = parseInt( min );
			qty = ( qty >= min )? qty : min;
		}
		
		$qty_input.val( qty );
		return false;
		
	} );
	$('.sm-quantity-input .quantity-inc').on( 'click', function() {
		var $qty_input = $(this).siblings( 'input.qty' );
		
		var qty = $qty_input.val();
		qty = parseInt( ( qty )? qty : 0 );
		
		var step = $qty_input.data( 'step' );
		if( step ) {
			qty += parseInt( step );
		} else {
			qty += 1;
		}
		
		var max = $qty_input.attr( 'max' );
		if( max ) {
			max = parseInt( max );
			qty = ( qty <= max )? qty : max;
		}
		
		$qty_input.val( qty );
		return false;
	} );
	
	/* Large titlebar parallax */
	if( $( '.sm-titlebar.large' ).length > 0 ) {
		$(document).ready( function() {
			var $titlebar = $( '.sm-titlebar.large' );
			var titlebar_height = $titlebar.outerHeight();
			function create_titlebar_parallax() {
				var scrolltop = $(window).scrollTop();
				if( scrolltop < titlebar_height ) {
					var percentage = ( scrolltop / titlebar_height ).toFixed( 3 );
					$titlebar.find( '.title-wrapper' ).css( 'opacity', 1 - percentage * 1.6 );
					/*$titlebar.css( 'background-position', 'center ' + ( scrolltop / 1.75 ) + 'px' );*/
				}
			}
			$(window).on( 'scroll', function() {
				window.requestAnimationFrame( create_titlebar_parallax );
			} );
			create_titlebar_parallax();
		} );
	}

	/* Isotope Initialization */
	var $isotope_containers = $('.sm-isotope-container');
	function isotope_columns( wrapper ) {
		var columns = wrapper.data( 'columns' );
		var margin = wrapper.data( 'margin' );
		var layout = wrapper.data( 'layout' );
		if( !margin ) {
			margin = 0;
		}
		if( window.innerWidth <= 500 ) {
			columns = 1;
		} else if( window.innerWidth <= 768 ) {
			if( columns > 2 ) {
				columns = 2;
			}
		}
		if( columns > 2 ) {
			var column_width = Math.floor( ( wrapper[0].getBoundingClientRect().width + margin ) / columns - margin );
			if( column_width < 240 ) {
				if( layout == 'masonry2' ) {
					if( columns == 6 ) {
						columns = 4;
					}
				} else {
					columns = Math.floor( ( wrapper[0].getBoundingClientRect().width + margin ) / ( 300 + margin ) );
				}
			}
		}
		return columns;
	}
	function isotope_appear_items( $items, $animated ) {
		if( $animated == true ) {
			$items.each( function( i ) {
				var $selector = $(this);
				setTimeout( function() {
					if( !$selector.hasClass( 'animation-done' ) ) {
						$selector.addClass( 'animating' );
						setTimeout( function() {
							$selector.addClass( 'animation-done' ).removeClass( 'animating' );
						}, 500 );
					}
				}, i * 200 );
			} );
		} else {
			$items.addClass( 'animation-done' );
		}
	}
	function isotope_set_items_width( $container ) {
		var gutter = $container.data( 'gutter' );		// Masonry 2 layout ignores gutter parameter
		var selector = $container.data( 'selector' );
		var layout = $container.data( 'layout' );
		var cols = isotope_columns( $container );
		
		if( layout == 'masonry2' ) {
			var item_width = Math.floor( Math.floor( $container[0].getBoundingClientRect().width ) / cols );
			if( cols >= 2 ) {
				$container.find( selector + '.x_x' ).width( item_width );
				$container.find( selector + '.x_x' ).height( item_width );
				$container.find( selector + '.x_dx' ).width( item_width );
				$container.find( selector + '.x_dx' ).height( item_width * 2);
				if( cols > 2 ) {
					$container.find( selector + '.dx_x' ).width( item_width * 2 );
					$container.find( selector + '.dx_x' ).height( item_width );
					$container.find( selector + '.dx_dx' ).width( item_width * 2 );
					$container.find( selector + '.dx_dx' ).height( item_width * 2 );
				} else {
					$container.find( selector + '.dx_x' ).width( item_width );
					$container.find( selector + '.dx_x' ).height( item_width / 2 );
					$container.find( selector + '.dx_dx' ).width( item_width );
					$container.find( selector + '.dx_dx' ).height( item_width );
				}
			} else {
				$container.find( selector ).width( item_width );
				$container.find( selector + '.x_x' ).height( item_width );
				$container.find( selector + '.x_dx' ).height( item_width * 2);
				$container.find( selector + '.dx_x' ).height( item_width / 2 );
				$container.find( selector + '.dx_dx' ).height( item_width );
			}
			return item_width;
		} else {
			var item_width = Math.floor( ( $container[0].getBoundingClientRect().width + gutter ) / cols ) - gutter;
			$container.find( selector ).css( 'width', item_width );
			return item_width;
		}
	}
	function isotope_do_layout() {
		$isotope_containers.each( function() {
			var $this = $(this);
			var gutter = $this.data( 'gutter' );		// Masonry 2 layout ignores gutter parameter
			var selector = $this.data( 'selector' );
			var layout = $this.data( 'layout' );
			var cols = isotope_columns( $this );

			var column_width = isotope_set_items_width( $this );
			
			if( layout == 'fitRows' ) {
				$this.isotope( {
					layoutMode: 'fitRows',
					selector: selector,
					fitRows: {
						gutter: gutter,
					},
					transitionDuration: '0s',
					hiddenStyle: {
						opacity: 0,
						transform: 'translateY(100px)'
					},
					visibleStyle: {
						opacity: 1,
						transform: 'translateY(0)'
					}
				} );
			} else if( layout == 'masonry' || layout == 'masonry2' ) {
				$this.isotope( {
					layoutMode: 'masonry',
					selector: selector,
					masonry: {
						columnWidth: column_width,
						gutter: gutter
					},
					transitionDuration: '0s',
					hiddenStyle: {
						opacity: 0,
						transform: 'translateY(100px)'
					},
					visibleStyle: {
						opacity: 1,
						transform: 'translateY(0)'
					}
				} );
			}
			
			// Initialize flexslider 
			sm_init_flexslider( $this.find( '.sm-flexslider' ) );

			// Show isotope container on waypoint
			$this.waypoint( {
				handler: function() {
					var waypoint = this;
					waypoint.disable();
					$this.css( 'visibility', 'visible' );
					isotope_appear_items( $this.find( selector ), $this.data( 'appear-animation' ) );
				},
				offset: '99%'
			} );

			/* Category filter */
			var $filters = $this.prev();
			if( $filters.length == 0 ) {
				$filters = $this.parent().prev();
			}
			$filters.find( '.filter' ).on( 'click', function() {
				var filter = $(this).data( 'filter' );
				$this.find( selector ).addClass( 'animation-done' ).removeClass( 'animating' );
				$this.isotope( 'option', {
					transitionDuration: '0.5s'
				} );
				$this.isotope( { filter: filter } );
				$this.isotope( 'option', {
					transitionDuration: '0s'
				} );
				return false;
			} );
		} );
	}
	function isotope_append_items( $container, $posts_to_append_html, $loadmore_link ) {
		var $new_posts = $('<div/>');
		var selector = $container.data( 'selector' );
		
		$new_posts.html( $posts_to_append_html );
		$new_posts = $new_posts.find( selector );
		$new_posts.css( 'opacity', 0 );
		$container.append( $new_posts );
		
		imagesLoaded( $new_posts, function() {
			isotope_set_items_width( $container );
			
			$container.find("a[data-rel^='prettyPhoto']").initPrettyPhoto();
			$container.find("a[data-rel^='prettyPhotoModern']").initPrettyPhotoForAjax();
			
			if ( $container.hasClass( "sm-isotope-container") ) {
				$container.isotope( 'appended', $new_posts );
				isotope_appear_items( $new_posts, true );
			}
			else {
				$new_posts.animate({ 'opacity': 1 }, 400);
			}
		} );
		var offset = $loadmore_link.data( 'offset' ) + $new_posts.length;
		$loadmore_link.data( 'offset', offset );

		// Initialize mediaelement
		if ( $container.hasClass( "sm-isotope-container") ) {
		if ( typeof $.fn.mediaelementplayer !== 'undefined' ) {
			$new_posts.find( "video" ).mediaelementplayer();
			$new_posts.find( "audio" ).mediaelementplayer();
		}
		}
	}
	function pagination_ajax_loadmore_finished( $loadmore_link ) {
		$loadmore_link.removeClass( 'loading' );
	}
	function pagination_ajax_is_load_finished( $ifs_anchor, waypoint ) {
		$ifs_anchor.removeClass( 'loading' );
		if( typeof waypoint != 'undefined' ) {
			setTimeout( function() {
				Waypoint.refreshAll();
				waypoint.enable();
			}, 500 );
		}
	}
	imagesLoaded( $isotope_containers, function() {
		/* Init isotope, also init category filter. Category filter container must be prev sibling of isotope container or its parent. */
		isotope_do_layout();
		
		/* Pagination - load more */
		$('.sm-loadmore').on( 'click', function() {
			var $loadmore_link = $(this);
			if( ! $loadmore_link.hasClass( 'infinite-scroll' ) ) {
				var params_data = $loadmore_link.data();
				$loadmore_link.addClass( 'loading' );
				if( $loadmore_link.length > 0 ) {
					$.ajax( {
						url: ajax_obj.ajaxurl,
						type: 'post',
						data: {
							action: 'sm_loadmore_posts',
							params: params_data,
							nonce: $loadmore_link.data( 'nonce' )
						},
						success: function( html ) {
							if( html == 'allloaded' ) {
								pagination_ajax_loadmore_finished( $loadmore_link );
								$loadmore_link.fadeOut( 500 );
							} else {
								var $container = $loadmore_link.parent().siblings( '.sm-isotope-container' );
								
								if ( $container.length == 0 ) { // if blog modern style
									$container = $loadmore_link.parent().siblings(".sm-posts-modern-style");
								}

								isotope_append_items( $container, html, $loadmore_link );
								pagination_ajax_loadmore_finished( $loadmore_link );
							}
						},
						error: function( val ) {
							pagination_ajax_loadmore_finished( $loadmore_link );
						}
					} );
				}
			}
			return false;
		} );
		
		/* Pagination - infinite scroll */
		setTimeout( function() {
			$('.sm-infinite-scroll').each( function() {
				var $this = $(this);
				var $loadmore_link = $this.find( '.sm-loadmore' );
				$this.waypoint( {
					handler: function() {
						var waypoint = this;
						waypoint.disable();
						var params_data = $loadmore_link.data();
						$this.addClass( 'loading' );
						$.ajax( {
							url: ajax_obj.ajaxurl,
							type: 'post',
							data: {
								action: 'sm_loadmore_posts',
								params: params_data,
								nonce: $loadmore_link.data( 'nonce' )
							},
							success: function( html ) {
								if( html == 'allloaded' ) {
									pagination_ajax_is_load_finished( $this );
								} else {
									var $container = $loadmore_link.parent().siblings( '.sm-isotope-container' );
									
									if ( $container.length == 0 ) { // if blog modern style
										$container = $loadmore_link.parent().siblings(".sm-posts-modern-style");
									}
									
									isotope_append_items( $container, html, $loadmore_link );
									pagination_ajax_is_load_finished( $this, waypoint );
								}
							},
							error: function( val ) {
								pagination_ajax_is_load_finished( $this, waypoint );
							}
						} );
					},
					offset: '99%'
				} );
			} );
		}, 600 );

		$(window).on( "throttledresize", function() {
			isotope_do_layout();
			Waypoint.refreshAll();
		} );
	} );

	/* Initializations after all images loaded */
	imagesLoaded( $('body'), function() {
	
		/* Hack to prevent strange parallax behavior of Visual Composer */
		var resize_event = document.createEvent( 'UIEvents' );
		resize_event.initUIEvent( 'resize', true, false, window, 0 );
		window.dispatchEvent( resize_event );

		/* Loader finish */
		$('body').removeClass( 'loading' );
		$('#preloader').hide();
		$('#preloader-wrapper').css( 'opacity', '0' );
		setTimeout( function() {
			$('#preloader-wrapper').hide();
		}, 1200 );

		/*/// Add code with image loaded here */

	} ); // imagesLoaded scope end

	/********* Window resize event *********/
	$(window).on( "resize", function() {
		
		Waypoint.refreshAll();

	} );

	/********* Resize event at reduced rate *********/
	$(window).on( "throttledresize", function() {
		
		$sticky_nav = $('.sticky-nav:visible');

	} );
	
	/********* Scroll event at reduced rate *********/
	new ThrottledScroll( function() {
		
		/* Sticky menu */
		if( $(window).scrollTop() > sticky_pos + 150 ) {
			if( !$sticky_nav.hasClass( 'sticky' ) ) {
				if( ! $('header').hasClass( 'transparent' ) ) {
					var margin_top = $sticky_nav.height();
					$('.sm-wrapper').css( 'padding-top', margin_top );
				}
				$sticky_nav.addClass( 'sticky animated short slideInDown' );
			}
		} else {
			$('.sm-wrapper').css( 'padding-top', 0 );
			$('.sticky-nav').removeClass( 'sticky animated short slideInDown' );
		}
		
	} );
	
} )( jQuery, window );
