<?php

/**
 * Woocommerce init
 */
add_action( 'init', 'sm_woocommerce_init' );
function sm_woocommerce_init() {
	$catalog_size = array(
			'width' 	=> '570',	// px
			'height'	=> '715',	// px
			'crop'		=> 0 		// true
	);

	/*$single_size = array(
	 'width' 	=> '535',	// px
	 'height'	=> '950',	// px
	 'crop'		=> 0 		// true
	);*/

	update_option( 'shop_catalog_image_size', $catalog_size );
	//update_option( 'shop_single_image_size', $single_size );
}

/**
 * Woocommerce container start & end
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'sm_woocommerce_container_start', 10 );
add_action( 'woocommerce_after_main_content', 'sm_woocommerce_container_end', 10 );

/**
 * Sidebar logic is incorporated in container start/end 
 */
remove_action( 'woocommerce_sidebar' , 'woocommerce_get_sidebar', 10 );

function sm_woocommerce_container_start() {
	?>
	<div class='content-area content-woocommerce'><div class='container'>
	<?php
	
	get_template_part( 'templates/row', 'start' );
}

function sm_woocommerce_container_end() {
	get_template_part( 'templates/row', 'end' );
	
	?>
	</div></div>
	<?php
}

/**
 * Remove woocommerce page title
 */
add_filter( 'woocommerce_show_page_title', 'sm_woocommerce_show_page_title' );
function sm_woocommerce_show_page_title() {
	return false;
}

/**
 * Remove default rating from product, and instead link to our hook so we can use it
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'sm_woocommerce_loop_rating', 'woocommerce_template_loop_rating', 5 );

/**
 * Rating template modification
 */
add_action( 'woocommerce_product_get_rating_html', 'sm_rating_html', 10, 2 );
function sm_rating_html( $rating_html, $rating ) {
	$new_rating_html = '';
	$new_rating_html = '<div class="star-rating-container">';
	if( !empty( $rating_html ) ) {
		$new_rating_html .= $rating_html;
		$new_rating_html .= '<div class="line left"></div>';
		$new_rating_html .= '<div class="line right"></div>';
	} else {
		$new_rating_html .= '<div class="star-rating no-ratings" title="' . esc_html__( 'No ratings', 'semona' ) . '"></div>';
	}
	$new_rating_html .= '</div>';

	return $new_rating_html;
}

/**
 * Single product - ratings before title
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
add_action( 'woocommerce_single_product_summary', 'sm_woocommerce_single_categories', 11 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 12 );
add_action( 'woocommerce_single_product_summary', 'sm_woocommerce_sku_info', 15 );
function sm_woocommerce_single_categories() {
	echo "<div class='categories'>";
	echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' );
	echo "</div>";
}
function sm_woocommerce_sku_info() {
	global $post, $product;

	$availability_html = "<span class='stock-stat'>";
	if( $product->is_in_stock() ) {
		$availability_html .= esc_html__( 'In stock', 'semona' );
		$availability_html .= "<i class='fa fa-check-circle-o'></i>";
	} else {
		$availability_html .= esc_html__( 'Out of stock', 'semona' );
		$availability_html .= "<i class='fa fa-times-circle-o'></i>";
	}
	$availability_html .= "</span>";
	if( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<div class='sku-info'>
			<span class="sku_wrapper"><?php _e( 'SKU:', 'semona' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'semona' ); ?></span></span><?php
			echo ( $availability_html ) ?>
		</div><?php
	endif;
}

add_action( 'woocommerce_share', 'sm_woocommerce_share' );
function sm_woocommerce_share() {
	?>
	<div class='sm-woocommerce-social-share'>
		<?php
		$sharer_urls = sm_social_sharer_urls(); 
		foreach( $sharer_urls as $icon => $url ) {
			$link = sprintf( $url, rawurlencode( get_permalink() ), rawurlencode( get_the_title() ), rawurlencode( get_the_excerpt() ) );
			if( $link ) {
				$icon .= '-square';
				?><a class='sm-sharer-link' href='<?php echo esc_url( $link ) ?>'><i class='fa fa-<?php echo esc_attr( $icon ) ?>'></i></a><?php
			}
		}
		?>
	</div>
	<?php
}

/* Mini cart update */
add_filter( 'woocommerce_add_to_cart_fragments', 'sm_add_to_cart_fragment' );
function sm_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<span id="cart-size"><?php echo intval( WC()->cart->cart_contents_count ) ?></span>
	<?php
	$fragments['span#cart-size'] = ob_get_clean();
	
	ob_start();
	?>
	<div class="sm-mini-cart-container">
		<?php woocommerce_mini_cart() ?>
	</div>
	<?php
	$fragments['.sm-mini-cart-container'] = ob_get_clean();
	
	return $fragments;
}

/* Product grid columns */
// This code won't have effect - see woocommerce/loop/loop-start.php
add_filter( 'loop_shop_columns', 'sm_loop_columns' );
if ( !function_exists( 'sm_loop_columns' ) ) {
	function sm_loop_columns() {
		$cols = crf_get_theme_mod_value( 'woocommerce-product-columns' );
		return ( $cols > 1 ) ? $cols : 3;
	}
}

/* Products per page */
add_filter( 'loop_shop_per_page', 'sm_products_per_page', 20 );
function sm_products_per_page( $cols ) {
	$products_per_page = crf_get_theme_mod_value( 'woocommerce-products-per-page' );
	return ( $products_per_page ) ? $products_per_page : 10;
}