<?php

define( 'SM_AJAX_PAGINATION_NONCE', 'f6a85930f60bc286da57' );
define( 'SM_LIKE_POST_NONCE', 'e986a206c9469e36ab56' );

require_once get_template_directory() . '/framework/index.php';
require_once get_template_directory() . '/widgets/widgets.php';

require_once get_template_directory() . '/inc/ajax.php';
require_once get_template_directory() . '/inc/option-params.php';
if( class_exists( 'WC_API' ) ) {
	require_once get_template_directory() . '/inc/woocommerce.php';
}

global $sm_theme_uri;
$sm_theme_uri = esc_url( get_template_directory_uri() );

add_action( 'wp_head', 'sm_support_ie_lower' );
function sm_support_ie_lower() {
	global $sm_theme_uri; ?>
	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo esc_url( $sm_theme_uri ); ?>/js/html5shiv.js"></script>
	<script src="<?php echo esc_url( $sm_theme_uri ); ?>/js/excanvas.js"></script>
	<![endif]-->
	<?php
}

add_action ( 'after_setup_theme', 'sm_add_theme_supports' );
function sm_add_theme_supports() {
	/* HTML5 Support */
	add_theme_support ( 'html5', array (
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'widgets'
	) );
	
	/* Post thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Post Formats Support */
	add_theme_support ( 'post-formats', array (
		'image',
		'audio',
		'video',
		'gallery',
		'quote',
	) );

	/* Navigation Menu Support */
	add_theme_support( 'nav_menus' );

	/* Default RSS feed links */
	add_theme_support( 'automatic-feed-links' );

	/* Woocommerce Support */
	add_theme_support( 'woocommerce' );

	/* Widget Customizer */
	add_theme_support( 'widget-customizer' );
	
	/* Title tag */
	add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'sm_load_textdomain' );
function sm_load_textdomain(){
	load_theme_textdomain( 'semona', get_template_directory() . '/languages' );
}

function sm_enqueue_google_font_url() {
	$header_style = crf_get_theme_mod_value( 'header-style' );
	$google_fonts = array();
	$google_fonts[] = crf_get_theme_mod_value( 'heading-font' );
	$google_fonts[] = crf_get_theme_mod_value( 'text-font' );
	$google_fonts[] = crf_get_theme_mod_value( 'text-font2' );
	if( $header_style == 'v1' ) {
		$google_fonts[] = crf_get_theme_mod_value( 'topbar-font' );
	}
	$google_fonts[] = crf_get_theme_mod_value( 'nav-font' );
	$google_fonts[] = crf_get_theme_mod_value( 'footer-heading-font' );
	$google_fonts[] = crf_get_theme_mod_value( 'footer-text-font' );
	$google_fonts[] = crf_get_theme_mod_value( 'footer-copyright-font' );
	
	// Elements Fonts
	$google_fonts[] = crf_get_theme_mod_value( 'featurebox-title-font-family' );
	$google_fonts[] = crf_get_theme_mod_value( 'quotes-content-font-family' );
	
	$google_fonts = array_unique( $google_fonts );
	$i = 0;
	$params = '';
	foreach( $google_fonts as $google_font ) {
		$on_or_off = _x( 'on', $google_font . ' font: on or off', 'semona' );
		if( 'off' !== $on_or_off ) {
			if( $i > 0 ) {
				$params .= '|';
			}
			$params .= $google_font . ':300,300italic,400,400italic,500,600,700,700italic,900';
			$i++;
		}
	}

	$crete_round_on_or_off = _x( 'on', 'Crete Round font: on or off', 'semona' );
	if( 'off' !== $crete_round_on_or_off ) {
		if( $i > 0 ) {
			$params .= '|';
		}
		$params .= 'Crete Round:400,400italic';
	}

	$gfurl = add_query_arg( 'family', urlencode( $params ), "//fonts.googleapis.com/css" );
	return $gfurl;
}

add_action( 'wp_enqueue_scripts', 'sm_theme_enqueue_css_js', 11 );
function sm_theme_enqueue_css_js() {
	global $sm_theme_uri;
	
	wp_enqueue_style( 'google-fonts', sm_enqueue_google_font_url(), array(), '1.0.0' );
	
	wp_deregister_style( 'font-awesome' );
	wp_enqueue_style( 'font-awesome', $sm_theme_uri . '/vendor/font-awesome-4.4.0/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'icomoon', $sm_theme_uri . '/vendor/icomoon/style.css' );
	wp_enqueue_style( 'prettyphoto', $sm_theme_uri . '/vendor/prettyphoto/css/prettyPhoto.css' );
	wp_deregister_style( 'flexslider' );
	wp_enqueue_style( 'flexslider', $sm_theme_uri . '/vendor/flexslider-2.5.0/flexslider.css' );
	if( !wp_style_is( 'sm_pe_icon_7_stroke' ) ) {
		wp_enqueue_style( 'sm_pe_icon_7_stroke', $sm_theme_uri . '/vendor/pe-icon-7-stroke/css/pe-icon-7-stroke.css' );
	}

	wp_enqueue_style( 'animate', $sm_theme_uri . '/css/animate.min.css' );
	
	wp_enqueue_style( 'theme', $sm_theme_uri . '/css/style.css' );
	wp_enqueue_style( 'theme-responsive', $sm_theme_uri . '/css/media.css' );

	// prettyPhoto
	wp_enqueue_script( 'prettyphoto', $sm_theme_uri . '/vendor/prettyphoto/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.6', true );
	wp_enqueue_script( 'prettyPhoto-init', $sm_theme_uri . '/vendor/prettyphoto/js/jquery.prettyPhoto.init.js', array( 'jquery', 'prettyphoto' ), '1.0', true );
	// Dequeue waypoint 2 of visual composer, and use our waypoint 3. VC elements will be initialized with waypoint 3 in our theme.js
	wp_deregister_script( 'waypoints' );		
	wp_enqueue_script( 'waypoints', $sm_theme_uri . '/vendor/waypoints/waypoints.js', array(), '3.1.1', true );
	wp_deregister_script( 'flexslider' );
	wp_enqueue_script( 'flexslider', $sm_theme_uri . '/vendor/flexslider-2.5.0/jquery.flexslider-min.js', array( 'jquery' ), '2.5.0', true );

	// To use imagesLoaded in plugins.js of the theme
	wp_dequeue_script( 'imagesLoaded' );
	// To use caroufredsel in plugins.js of the theme
	wp_dequeue_script( 'caroufredsel' );
	wp_deregister_script( 'caroufredsel' );
	if( crf_get_theme_mod_value( 'preloader-enable' ) == 'show' ) {
		wp_enqueue_script( 'queryloader2', $sm_theme_uri . '/js/queryloader2.min.js', array(), false, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'semona-theme-plugins', $sm_theme_uri . '/js/plugins.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'semona-theme', $sm_theme_uri . '/js/theme.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'semona-theme', 'ajax_obj',
    	array(
    	   'ajaxurl' => admin_url( 'admin-ajax.php' ),
    	   'use_css3_animations_on_mobile' => crf_get_theme_mod_value( 'css3-animation-on-mobile' ),
    	)
	);
	
	if ( is_archive() ) {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );
	}
}

/* Bundled plugins set as theme */
add_action( 'init', 'sm_init' );
function sm_init() {
	if( function_exists( 'set_revslider_as_theme' ) ) {
		set_revslider_as_theme();
	}
	if( function_exists( 'vc_set_as_theme' ) ) {
		vc_set_as_theme( true );
	}
}
add_action( 'layerslider_ready', 'sm_layerslider_overrides' );
function sm_layerslider_overrides() {
	$GLOBALS['lsAutoUpdateBox'] = false;
}

/* Dynamic CSS */
function sm_theme_dynamic_css() {
	?>
	<style id="dynamic_css" type="text/css">
	<?php
	require_once get_template_directory() . '/inc/dynamic_css.php';
	
	/* Custom CSS code */
	$custom_css = crf_get_theme_mod_value( 'custom-css' );
	if( $custom_css ) {
		echo ( $custom_css );
	}
	?>
	</style>
	<?php
}
if( !is_admin() ) {
	add_action( 'wp_head', 'sm_theme_dynamic_css' );
}

/* Custom JS */
add_action( "wp_footer", "sm_custom_js", 9999, 0 );
function sm_custom_js() {
	$custom_js = crf_get_theme_mod_value( 'custom-js' );
	if( $custom_js ) { ?>
	<script type="text/javascript">
		<?php echo ( $custom_js ); ?>
	</script>
<?php }
}

/* Body class */
add_filter( 'body_class', 'sm_body_class' );
function sm_body_class( $classes ) {
	$site_layout = crf_get_theme_mod_value( 'site-layout' );
	if( sm_is_blank_page() ) {
		$site_layout = 'wide';
		$classes[] = 'sm-blank-page';
	}
	$classes[] = 'sm-site-layout-' . $site_layout;
	
	$color_scheme = crf_get_theme_mod_value( 'color-scheme' );
	$classes[] = 'sm-scheme-' . $color_scheme;
	return $classes;
}

/* Menu icons */
function sm_add_icon_to_main_nav_menu( $items, $args ) {
	if( class_exists( 'Woocommerce' ) && crf_get_theme_mod_value( 'header-show-shop-icon' ) != 'hide' ) {
		global $woocommerce;
		$cart_url = $woocommerce->cart->get_cart_url();
		$items .= '<li class="menu-item menu-icon menu-cart woocommerce"><a href="' . $cart_url . '">';
		$items .= '<span class="cart-size-wrapper">';
		$items .= '<span id="cart-size">' . intval( $woocommerce->cart->cart_contents_count ) . '</span>';
		$items .= '<i class="fa fa-shopping-cart"></i>';
		$items .= '</span>';
		$items .= '</a>';
		ob_start();
		get_template_part( 'templates/header/cart' );
		$items .= ob_get_clean();
		$items .= '</li>';
	}
	if( crf_get_theme_mod_value( 'header-show-search-icon' ) != 'hide' ) {
		$items .= '<li class="menu-item menu-icon menu-search"><a class="search-icon" href="#"><i class="fa fa-search"></i></a></li>';
	}
	$items = apply_filters( 'sm_main_nav_icons', $items, $args );
	return $items;
}

function sm_add_icon_to_main_nav_menu_v3( $items, $args ) {
	if( class_exists( 'Woocommerce' ) && crf_get_theme_mod_value( 'header-show-shop-icon' ) != 'hide' ) {
		global $woocommerce;
		$cart_url = $woocommerce->cart->get_cart_url();
		$items .= '<li class="menu-item menu-icon menu-cart woocommerce"><a href="' . $cart_url . '">';
		$items .= '<span class="cart-size-wrapper">';
		$items .= '<span id="cart-size">' . intval( $woocommerce->cart->cart_contents_count ) . '</span>';
		$items .= '<i class="fa fa-shopping-cart"></i>';
		$items .= '</span>';
		$items .= '</a>';
		ob_start();
		get_template_part( 'templates/header/cart' );
		$items .= ob_get_clean();
		$items .= '</li>';
	}
	$items = apply_filters( 'sm_main_nav_icons', $items, $args );
	return $items;
}
/* moved to header.php
if ( crf_get_option_value( 'header-style', 'header_style' ) == "v3") {
	add_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu_v3', 10, 2 );
}
else {
	add_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu', 10, 2 );
} */

/* Logo output for header v1 */
function sm_output_logo( $skin = 'light', $css_class = '' ) {
	$logo = "logo-{$skin}";
	$logo_retina = "logo-{$skin}-retina";
	$logo_image = crf_get_theme_mod_value( $logo );
	$logo_retina_image = esc_url( crf_get_theme_mod_value( $logo_retina ) ); 
	if( $logo_image != '' ) {
		if( $logo_retina_image != '' ) {
			$retina_attr = "data-at2x='{$logo_retina_image}'";
		} else {
			$retina_attr = "data-no-retina";
		}
	}
	ob_start(); 
	?><div class='logo-wrapper<?php echo ( $css_class ) ? ( ' ' . esc_attr( $css_class ) ) : ''; ?>'><?php
		?><a href='<?php echo esc_url( home_url() )?>'><img src='<?php echo esc_url( $logo_image ) ?>' <?php echo ( $retina_attr ) ?> alt='<?php echo esc_html__( 'Logo', 'semona' ) ?>' title='<?php echo esc_html__( 'Logo', 'semona' ) ?>'></a><?php
	?></div><?php
	$logo_content = ob_get_contents();
	ob_get_clean();
	
	echo apply_filters( 'sm_logo', $logo_content, $skin, $css_class );
}

/* Logo output for footer */
function sm_output_footer_logo() {
	$logo_image = esc_url( crf_get_theme_mod_value( 'style1-copyright-logo' ) );
	$logo_retina_image = esc_url( crf_get_theme_mod_value( 'style1-copyright-logo-retina' ) );
	$retina_attr = '';
	if( $logo_image != '' ) {
		if( $logo_retina_image != '' ) {
			$retina_attr = "data-at2x='{$logo_retina_image}'";
		} else {
			$retina_attr = "data-no-retina";
		}
	}
	if( $logo_image ) {
		ob_start();
		?>
		<div class='logo-wrapper'><?php
			?><a href='<?php echo esc_url( home_url() )?>'><img src='<?php echo esc_url( $logo_image ) ?>' <?php echo ( $retina_attr ) ?> alt='<?php echo esc_html__( 'Logo', 'semona' ) ?>' title='<?php echo esc_html__( 'Logo', 'semona' ) ?>'></a><?php
		?></div>
	<?php
		$logo_content = ob_get_contents();
		ob_get_clean();
	} else {
		$logo_content = '';
	}
	
	echo apply_filters( 'sm_footer_logo', $logo_content );
}

/* Get footer column class */
function sm_get_column_class( $columns ) {
	$col_class = '';
	switch( $columns ) {
		case 1:
			$col_class = 'col-xs-12 margin-bottom-30-sm';
			break;
		case 2:
			$col_class = 'col-sm-6 margin-bottom-30-sm';
			break;
		case 3:
			$col_class = 'col-sm-4 margin-bottom-30-sm';
			break;
		case 4:
		default:
			$col_class = 'col-sm-6 col-md-3 margin-bottom-30-md';
			break;
	}
	return $col_class;
}

/* Output current time in format set in theme options */
function sm_the_time() {
	the_time( crf_get_theme_mod_value( 'blog-dateformat' ) );
}

/* Title tag */
add_filter( 'wp_title', 'sm_wp_title', 10, 2 );
function sm_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	$title = crf_page_title() . ' - ' . get_bloginfo( 'name', 'display' );
	return $title;
}

/* Search post type */
add_filter( 'pre_get_posts', 'sm_search_filter' );
function sm_search_filter( $query ) {
	if ( is_search() && $query->is_search && !is_admin() && isset( $_GET['s'] ) ) {
		$query->set( 'post_type', array( 'post' ) );
	}
	return $query;
}

/* Portfolios per page */
add_filter( 'pre_get_posts', 'sm_portfolio_items_per_page' );
function sm_portfolio_items_per_page( $query ) {
	$items = crf_get_theme_mod_value( 'portfolio-items-per-page' );
	if( ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_skills' ) || is_tax( 'portfolio_tags' ) ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', $items );
	}
	return $query;
}

/* Post excerpt length */
add_filter( 'excerpt_length', 'sm_post_excerpt_length' );
function sm_post_excerpt_length( $excerpt_length ) {
	$new_excerpt_length = intval( crf_get_theme_mod_value( 'blog-excerpt-length' ) );
	if( $new_excerpt_length > 0 ) {
		return $new_excerpt_length;
	}
	return $excerpt_length;
}

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
	return '...';
}

function sticky_new_excerpt_more( $more ) {
	return '<a href="' . get_the_permalink() . '" class="sm-simple-more">Continue Reading</a>';
}


/* set excerpt length 20 on modern blog style */
function sm_modern_post_excerpt_length () {
	return 20;
}

/* Social sharer urls */
function sm_social_sharer_urls() {
	return array(
			'facebook' => 'http://www.facebook.com/sharer.php?u=%1$s&t=%2$s',
			'twitter' => 'https://twitter.com/share?text=%2$s&url=%1$s',
			'linkedin' => 'http://linkedin.com/shareArticle?mini=true&amp;url=%1$s&amp;title=%2$s',
			'reddit' => 'http://reddit.com/submit?url=%1$s&amp;title=%2$s',
			'tumblr' => 'http://www.tumblr.com/share/link?url=%1$s&amp;name=%2$s&amp;description=%3$s',
			'google-plus' => 'https://plus.google.com/share?url=%1$s',
			'pinterest' => 'http://pinterest.com/pin/create/button/?url=%1$s&amp;description=%3$s',
	);
}

/* Sidebar functions */
function sm_get_sidebar_from_option( $sidebar_option, $sidebar_pos_option ) {
	$sidebar = crf_get_theme_mod_value( $sidebar_option );
	$sidebar_pos = crf_get_option_value( $sidebar_pos_option, 'sidebar_position' );
	if( is_page() ) {
		$meta_raw = get_post_meta( get_the_ID(), 'sbg_selected_sidebar_replacement' );
		if( is_array( $meta_raw ) && count( $meta_raw ) > 0 ) {
			$meta = $meta_raw[0];
			if( is_array( $meta ) ) {
				$pg_sidebar = $meta[0];
				if( $pg_sidebar != '0' ) {
					$sidebar = $pg_sidebar;
				}
			}
		}
	}
	return array(
		'sidebar' => $sidebar, 
		'sidebar-pos' => $sidebar_pos
	); 
}
function sm_get_sidebar() {
	if( is_search() ) {
		return sm_get_sidebar_from_option( 'sidebar-search', 'sidebar-search-pos' );
	}
	if( get_post_type() == 'post' ) {
		return sm_get_sidebar_from_option( 'sidebar-blog', 'sidebar-blog-pos' );
	}
	if( get_post_type() == 'crf_portfolio' ) {
		return sm_get_sidebar_from_option( 'sidebar-portfolio', 'sidebar-portfolio-pos' );
	}
	if( is_page() ) {
		return sm_get_sidebar_from_option( 'sidebar-page', 'sidebar-page-pos' );
	}
	if( get_post_type() == 'product' ) {
		return sm_get_sidebar_from_option( 'sidebar-woocommerce', 'sidebar-woocommerce-pos' );
	}
	if( function_exists( 'is_bbpress') && is_bbpress() ) {
		return sm_get_sidebar_from_option( 'sidebar-bbpress', 'sidebar-bbpress-pos' );
	}
	return false;
}

/* Ajax pagination */
function sm_ajax_pagination( $query, $template, $post_format = false, $infinitescroll = false ) {
	$params = serialize( $query->query_vars );
	$post_count = esc_attr( $query->post_count );
	$more_css_class = '';
	if( $infinitescroll ) {
		$more_css_class = ' sm-infinite-scroll';
	}
	?>
	<div class='sm-pagination-ajax-area<?php echo esc_attr( $more_css_class )?>'>
		<a class='sm-loadmore' href='#' 
				title="<?php echo esc_attr__( 'Load More', 'semona' ); ?>"
				data-query_vars='<?php echo esc_attr( $params ) ?>' 
				data-offset='<?php echo esc_attr( $post_count ) ?>' 
				data-template='<?php echo esc_attr( $template ) ?>'
				data-useformat='<?php echo esc_attr( $post_format ) ?>'
				data-nonce='<?php echo wp_create_nonce( SM_AJAX_PAGINATION_NONCE ) ?>'
			>
			<i class='fa fa-refresh'></i>
		</a>
	</div>
	<?php
}

/* Get titlebar style from theme options based on current page type */
function sm_get_titlebar_style() {
	$titlebar_style_option = 'titlebar-blog-style';
	if( is_search() ) {
		$titlebar_style_option = 'titlebar-search-style';
	} elseif( is_404() ) {
		$titlebar_style_option = 'titlebar-404-style';
	} elseif( is_page() ) {
		$titlebar_style_option = 'titlebar-page-style';
	} elseif( get_post_type() == 'crf_portfolio' ) {
		$titlebar_style_option = 'titlebar-portfolio-style';
	} elseif( get_post_type() == 'product' ) {
		$titlebar_style_option = 'titlebar-woocommerce-style';
	}
	if( is_singular() ) {
		return crf_get_option_value( $titlebar_style_option, 'titlebar_style' );
	} else {
		return crf_get_theme_mod_value( $titlebar_style_option );
	}
}
function sm_get_titlebar_bg_image() {
	$titlebar_bg_option = 'titlebar-blog-bg';
	if( is_search() ) {
		$titlebar_bg_option = 'titlebar-search-bg';
	} elseif( is_404() ) {
		$titlebar_bg_option = 'titlebar-404-bg';
	} elseif( is_page() ) {
		$titlebar_bg_option = 'titlebar-page-bg';
	} elseif( get_post_type() == 'crf_portfolio' ) {
		$titlebar_bg_option = 'titlebar-portfolio-bg';
	} elseif( get_post_type() == 'product' ) {
		$titlebar_bg_option = 'titlebar-woocommerce-bg';
	}
	if( is_singular() ) {
		$pg_opt_bg = crf_get_option_value( '', 'titlebar_bg' );
		if( $pg_opt_bg ) {
			return $pg_opt_bg;
		}
	}
	return crf_get_theme_mod_value( $titlebar_bg_option );
}
function sm_get_titlebar_bg_type() {
	$titlebar_bg_type_option = 'titlebar-blog-bg-type';
	if( is_search() ) {
		$titlebar_bg_type_option = 'titlebar-search-bg-type';
	} elseif( is_404() ) {
		$titlebar_bg_type_option = 'titlebar-404-bg-type';
	} elseif( is_page() ) {
		$titlebar_bg_type_option = 'titlebar-page-bg-type';
	} elseif( get_post_type() == 'crf_portfolio' ) {
		$titlebar_bg_type_option = 'titlebar-portfolio-bg-type';
	} elseif( get_post_type() == 'product' ) {
		$titlebar_bg_type_option = 'titlebar-woocommerce-bg-type';
	}
	return crf_get_option_value( $titlebar_bg_type_option, 'titlebar_bg_type' );
}
function sm_get_titlebar_subtitle() {
	return crf_get_option_value( '', 'titlebar_subtitle' );
}
function sm_get_titlebar_breadcrumbs() {
	return crf_get_option_value( '', 'titlebar_breadcrumbs' );
}
/* Decide to increase or decrease color changes based on color scheme */
global $sm_color_scheme;
$sm_color_scheme = crf_get_theme_mod_value( 'color-scheme' );
function sm_change_hsl( $hex, $h, $s, $l ) {
	global $sm_color_scheme;
	if( $sm_color_scheme == 'dark' ) {
		$l = $l * -1;
	}
	return crf_change_hsl( $hex, $h, $s, $l );
}

/* Check if page template is blank */
function sm_is_blank_page() {
	return is_page_template( 'blank.php' );
}

/* Titlebar Small v3 - hide title optionally */
add_action( 'sm_breadcrumb_single_title', 'sm_breadcrumb_single_title' );
function sm_breadcrumb_single_title( $li_title ) {
	if( sm_get_titlebar_style() == 'small3' && crf_get_theme_mod_value( 'titlebar-small3-hide-single-title' ) == 'yes' ) {
		return '';
	}
	return $li_title;
}
