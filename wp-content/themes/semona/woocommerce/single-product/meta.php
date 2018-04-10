<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$cats = $product->get_categories( ', ' );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
$tags = $product->get_tags( ', ' );
$shipping_class = get_the_terms( $product->id, 'product_shipping_class' );
if ( $shipping_class && ! is_wp_error( $shipping_class ) ) {
	$shipping_class = current( $shipping_class )->name;
}
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<table class="product-meta-table">
	
		<?php if( $cats ): ?>
		<tr>
			<td class='label'><?php echo _n( 'Category:', 'Categories:', $cat_count, 'semona' ) ?></td>
			<td class='value'><?php echo ( $cats ); ?></td>
		</tr>
		<?php endif; ?>

		<?php if( $tags ): ?>
		<tr>
			<td class='label'><?php echo _n( 'Tag:', 'Tags:', $tag_count, 'semona' ) ?></td>
			<td class='value'><?php echo ( $tags ); ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if( $shipping_class ): ?>
		<tr>
			<td class='label'><?php echo esc_html__( 'Shipping:', 'semona' ) ?></td>
			<td class='value'><?php echo esc_html( $shipping_class ) ?></td>
		</tr>
		<?php endif ?>

	</table>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>