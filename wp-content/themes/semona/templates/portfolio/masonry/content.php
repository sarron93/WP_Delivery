<?php
$masonry_size = get_post_meta( get_the_ID(), 'crf_featured_image_masonry_size', true );
$portfolio_image = wp_get_attachment_url( get_post_thumbnail_id() );
?>
<article id='post-<?php the_ID(); ?>' <?php echo post_class( 'sm-portfolio v1 sm-isotope-item ' . $masonry_size ) ?>>
	<h6 class='title hidden'><?php echo esc_html( get_the_title() ) ?></h6>
	<div class='featured-media' style="background-image: url('<?php echo esc_url( $portfolio_image ) ?>')">
		<?php
		if( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'hidden' ) );
		}
		?>
		<div class='hover-overlay'>
			<a class='portfolio-link' href='<?php echo esc_url( $portfolio_image ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[portfolio]'>
				<span class='hrz'></span>
				<span class='vrt'></span>
			</a>
		</div>
	</div>
</article>