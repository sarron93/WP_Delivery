<?php
$masonry_size = get_post_meta( get_the_ID(), 'crf_featured_image_masonry_size', true );
$portfolio_image = wp_get_attachment_url( get_post_thumbnail_id() );
?>
<article id='post-<?php the_ID(); ?>' <?php echo post_class( 'sm-portfolio v5 sm-isotope-item ' . $masonry_size ) ?>>
	<h6 class='title hidden'><?php echo esc_html( get_the_title() ) ?></h6>
	<div class='featured-media' style="background-image: url('<?php echo esc_url( $portfolio_image ) ?>')">
		<?php
		if( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'hidden' ) );
		}
		?>
		<div class="hover-overlay">
			<div class="hover-overlay-inner"><?php
				?><div class="clearfix"><a class='sm-button-icon' href='<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[portfolio]'><i class='fa fa-search sm-icon-sonar-animation'></i></a><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( get_permalink() ) ?>'><i class='sm-button-icon fa fa-chain sm-icon-sonar-animation'></i></a></div><?php
				?><h6 class='title'><a href='<?php echo esc_url( get_permalink() ) ?>'><?php echo esc_html( get_the_title() ) ?></a></h6>
				<div class='portfolio-categories'>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ) ?>
				</div>
			</div>
		</div>
	</div>
</article>