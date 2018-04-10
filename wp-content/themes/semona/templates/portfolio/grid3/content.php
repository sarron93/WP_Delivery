<?php
$portfolio_image = wp_get_attachment_url( get_post_thumbnail_id() );
?>
<article id='post-<?php the_ID(); ?>' <?php echo post_class( 'sm-portfolio v3 sm-isotope-item' ) ?>>
	<div class='featured-media fullwidth' style="background-image: url('<?php echo esc_url( $portfolio_image ) ?>')">
		<?php
		if( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'hidden' ) );
		}
		?>
		<div class='hover-area'>
			<div class='info'>
				<a href='<?php echo esc_url( get_permalink() ) ?>'><h6 class='title'><?php echo esc_html( get_the_title() ) ?></h6></a>
				<div class='categories'>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ) ?>
				</div>
			</div>
			<div class='links'><?php
				?><a class='link' href='<?php echo esc_url( get_permalink() ) ?>'>
					<?php echo esc_html__( 'View', 'semona' ) ?>
				</a><?php
				?><a class='link' href='<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[portfolio]'>
					<?php echo esc_html__( 'Zoom', 'semona' ) ?>
				</a><?php
			?></div>
		</div>
	</div>
</article>