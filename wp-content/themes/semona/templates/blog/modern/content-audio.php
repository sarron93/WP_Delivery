<article id="post-<?php the_ID(); ?>" <?php echo post_class( array('sm-post') ) ?>>
	<div class="featured-media media-fullwidth">
		<div class="hover-overlay">
			<div class="hover-overlay-wrapper">
				<?php get_template_part( 'templates/blog/modern/content', 'body' ) ?>
			</div>
		</div>
	</div>

	<a class='sm-blog-audio-placeholder sm-blog-icon-placeholder' href='#sm-blog-audio-wrapper-<?php echo get_the_ID(); ?>' data-rel="prettyPhotoModern[<?php echo get_the_ID(); ?>]">
		<span class="pe-7s-volume"></span>
	</a>

	<div id="sm-blog-audio-wrapper-<?php echo get_the_ID(); ?>" class="hidden">
		<?php
		$fmtype = get_post_meta( get_the_ID(), 'crf_featured_media_type', true );
		if( $fmtype == 'embed' ) {
			echo '<div class="audio-wrapper">';
			$embed_iframe = get_post_meta( get_the_ID(), 'crf_featured_media_embed', true );
			if( !empty( $embed_iframe ) ) {
				echo ( $embed_iframe );
			}
			echo '</div>';
		} else if( $fmtype == 'url' ) {
			$audio_url = esc_url( get_post_meta( get_the_ID(), 'crf_featured_media_url', true ) );
			if( !empty( $audio_url ) ) {
				// echo do_shortcode( "[audio src={$audio_url}]" );
				echo "<audio controls><source src=\"{$audio_url}\" type=\"audio/mpeg\"></video>";
			}
		}
		?>
	</div>
</article>