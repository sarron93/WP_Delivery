<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
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

	<div class="featured-media media-fullwidth">
		<div class="sm-flexslider flexslider">
			<ul class="slides">
			<?php
			foreach( $gallery_images as $image ) {
				echo "<li><img src='" . esc_url( $image ) . "' alt='" . get_the_title() . " " . esc_html__( 'Image', 'semona' ) . "'></li>";
			}
			?>
			</ul>
		</div>
	</div>
	<?php } ?>

	<div class="sm-post-simple-list-content">
		<?php the_category(); ?>
		<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
		<div class='post-excerpt'>
			<?php the_excerpt() ?>
		</div>
		<div class="sm-post-date"><?php sm_the_time(); ?></div>
	</div>
</article>