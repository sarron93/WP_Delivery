<article id="post-<?php the_ID(); ?>" <?php echo post_class( array('sm-post') ) ?>>
	<div class="featured-media media-fullwidth">
		<div class="hover-overlay">
			<div class="hover-overlay-wrapper">
				<?php get_template_part( 'templates/blog/modern/content', 'body' ) ?>
			</div>
		</div>
	</div>

	<a class='sm-blog-video-placeholder sm-blog-icon-placeholder' href='#sm-blog-video-wrapper-<?php echo get_the_ID(); ?>' data-rel="prettyPhotoModern[<?php echo get_the_ID(); ?>]">
		<span class="pe-7s-video"></span>
	</a>

	<div id="sm-blog-video-wrapper-<?php echo get_the_ID(); ?>" class="hidden">
		<?php
		$video_url = "";
		$fmtype = get_post_meta( get_the_ID(), 'crf_featured_media_type', true );
		if( $fmtype == 'embed' ) {
			echo '<div class="video-wrapper">';
			$embed_iframe = get_post_meta( get_the_ID(), 'crf_featured_media_embed', true );
			if( !empty( $embed_iframe ) ) {
				echo ( $embed_iframe );
			}
			echo '</div>';
		} else if( $fmtype == 'url' ) {
			$video_url = esc_url( get_post_meta( get_the_ID(), 'crf_featured_media_url', true ) );
			if( !empty( $video_url ) ) {
				// echo do_shortcode( "[video src={$video_url}]" );
				echo "<video controls><source src=\"{$video_url}\" type=\"video/mp4\"></video>";
			}
		}
		?>
	</div>
</article>
