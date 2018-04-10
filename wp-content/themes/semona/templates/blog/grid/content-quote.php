<?php
$post_image_url = wp_get_attachment_url( get_post_thumbnail_id() ); 
?>
<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post sm-post-quote smaller sm-isotope-item' ) ?>>
	<div class="quote-bg-image" style="background-image: url('<?php echo esc_url( $post_image_url ) ?>')"></div>
	<i class="quote-icon icon-quote-right"></i>
	<?php get_template_part( 'templates/blog/grid/content', 'body-quote' ) ?>
</article>