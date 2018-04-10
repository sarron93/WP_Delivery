<article id="post-<?php the_ID(); ?>" <?php echo post_class( array('sm-post') ) ?>>
	<div class="featured-media media-fullwidth">
		<div class="hover-overlay">
			<div class="hover-overlay-wrapper">
				<?php get_template_part( 'templates/blog/modern/content', 'body' ) ?>
			</div>
		</div>
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
	if( count( $gallery_images ) > 0 ) {
		foreach( $gallery_images as $image ) {
			echo "<a class='sm-hidden-gallery sm-blog-icon-placeholder' href='" . esc_url( $image ) . "' data-rel='prettyPhotoModern[" . get_the_ID() . "]' alt='" . get_the_title() . "' title='" . get_the_title() . "'><span class='pe-7s-albums'></span></a>";
		}
	}
	?>
</article>