<?php
if ( has_post_thumbnail() ) {
	$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
	$post_img_url = wp_get_attachment_image_src( $post_thumbnail_id, "full" );
	$post_img_url = $post_img_url[0];
}
else {
	$post_img_url = "";
}
?>
<article id="post-<?php the_ID(); ?>" <?php echo post_class( array('sm-post-slide') ) ?>>
	<div class="slider-image-wrapper" <?php if ( !empty($post_img_url) ) { ?>style="background-image: url( '<?php echo esc_url( $post_img_url ); ?>' ); "<?php } ?>>
		<div class="hover-overlay">
			<div class="hover-overlay-wrapper">
				<?php get_template_part( 'templates/blog/blog-slider/content', 'body' ) ?>
			</div>
		</div>
	</div>
</article>