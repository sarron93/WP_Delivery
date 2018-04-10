<?php 
$image_ids = crf_get_post_gallery_ids( get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post sm-isotope-item' ) ?>>
	<?php
	if( is_array( $image_ids ) && count( $image_ids ) > 0 ): ?>
	<div class="featured-media">
		<div class="post-date">
			<div class="date"><?php the_time( 'd' )?></div>
			<div class="month"><?php the_time( 'M' )?></div>
		</div>
		<div class="post-format">
			<i class="fa fa-image"></i>
		</div>
		<?php
		$gallery_images = array();
		foreach( $image_ids as $imgid ) {
			$imgurl = wp_get_attachment_image_src( $imgid, 'full' );
			if( !empty( $imgurl[0] ) ) {
				$gallery_images[] = $imgurl[0];
			}
		} 
		if( count( $gallery_images ) > 0 ) { ?>
		<div class="sm-flexslider flexslider" data-smooth-height="true">
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
	<?php 
	endif; ?>
	<?php get_template_part( 'templates/blog/classic/content', 'body' ) ?>
</article>