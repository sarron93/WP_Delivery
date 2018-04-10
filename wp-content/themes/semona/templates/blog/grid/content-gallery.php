<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
	<div class="featured-media media-fullwidth">
		<div class="post-date outlined">
			<div class="date"><?php the_time( 'd' )?></div>
			<div class="month"><?php the_time( 'M' )?></div>
		</div>
		<?php
		$image_ids = crf_get_post_gallery_ids( get_the_ID() );
		$gallery_images = array();
		foreach( $image_ids as $imgid ) {
			$imgurl = wp_get_attachment_image_src( $imgid, 'full' );
			if( !empty( $imgurl[0] ) ) {
				$gallery_images[] = $imgurl[0];
			}
		} 
		if( count( $gallery_images ) > 0 ) { ?>
		<div class="sm-flexslider flexslider">
			<ul class="slides">
			<?php
			foreach( $gallery_images as $image ) {
				echo "<li><img src='" . esc_url( $image ) . "' alt='" . get_the_title() . " " . esc_html__( 'Image', 'semona' ) . "'></li>";
			}
			?>
			</ul>
		</div>
		<?php
		}
		?>
	</div>
	<?php get_template_part( 'templates/blog/grid/content', 'body' ) ?>
</article>