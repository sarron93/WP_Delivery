<article id="post-<?php the_ID(); ?>" <?php post_class( 'sm-post sm-post-single' ) ?>>
	<div class="featured-media">
		<div class="video-wrapper">
			<?php
			$fmtype = get_post_meta( get_the_ID(), 'crf_featured_media_type', true );
			if( $fmtype == 'embed' ) {
				echo get_post_meta( get_the_ID(), 'crf_featured_media_embed', true );
			} else if( $fmtype == 'url' ) {
				$video_url = esc_url( get_post_meta( get_the_ID(), 'crf_featured_media_url', true ) );
				echo do_shortcode( "[video src={$video_url}]" );
			}
			?>
		</div>
	</div>
	<?php get_template_part( 'templates/blog/single/content', 'body' ) ?>
</article>