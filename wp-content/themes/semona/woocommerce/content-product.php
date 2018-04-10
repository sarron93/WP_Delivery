<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

$classes[] = 'sm-isotope-item';
$classes[] = 'in-loop';

?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class='product-thumbnail'>
	
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		
		<div class='cart-loading'>
			<i class="icon-spinner-circle fa-spin loading-spinner"></i>
			<i class="icon-check loading-done"></i>
		</div>
		
		<div class='product-hover'>
			<div class='buttons'><?php
				?><a class='button see_details_button' href="<?php the_permalink(); ?>"><?php echo esc_html__( 'See Details', 'semona' ); ?></a><?php
					/**
					 * woocommerce_after_shop_loop_item hook
					 *
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
			?></div>
		</div>

	</div>

	<div class='product-content'>
	
		<?php 
			/**
			 * @hooked woocommerce_template_loop_rating - 5
			 */
			do_action( 'sm_woocommerce_loop_rating' );
		?>
	
		<h5 class='product-title'>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h5>
		
		<div class='product-categories'>
			<?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ' ', '' ) ?>
		</div>
	
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</div>

</div>
