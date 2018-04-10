<article id="post-<?php the_ID(); ?>" <?php post_class( 'sm-post sm-post-single' ) ?>>
	<div class="featured-media">
		<?php
		$fmtype = get_post_meta( get_the_ID(), 'crf_featured_media_type', true );
		if( $fmtype == 'embed' ) {
			echo get_post_meta( get_the_ID(), 'crf_featured_media_embed', true );
		} else if( $fmtype == 'url' ) {
			$audio_url = esc_url( get_post_meta( get_the_ID(), 'crf_featured_media_url', true ) );
			echo do_shortcode( "[audio src={$audio_url}]" );
		}
		?>
	</div>
	<?php get_template_part( 'templates/blog/single/content', 'body' ) ?>
</article>