<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $woocommerce_loop;

$shop_columns = 3;
$cols = crf_get_theme_mod_value( 'woocommerce-product-columns' );
if( $cols > 0 ) {
	$shop_columns = $cols;
}
if( empty( $woocommerce_loop['columns'] ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		$woocommerce_loop['columns'] = $shop_columns;
} else if( is_page() ) {
	$shop_columns = $woocommerce_loop['columns'];
	
}
?>
<div class="clearfix"></div>
<div class="products sm-isotope-container" data-selector=".sm-isotope-item" data-columns="<?php echo esc_attr( $shop_columns ) ?>" data-gutter="30" data-layout="fitRows" data-appear-animation="true">