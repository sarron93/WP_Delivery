<?php
$fm_wrapper_begin = '<div class="featured-media media-fullwidth">';
$fm_wrapper_end = '</div>';
?>
<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post sm-isotope-item' ) ?>>
	<?php
	$fmtype = get_post_meta( get_the_ID(), 'crf_featured_media_type', true );
	if( $fmtype == 'embed' ) {
		$embed_iframe = get_post_meta( get_the_ID(), 'crf_featured_media_embed', true );
		if( !empty( $embed_iframe ) ) {
			echo ( $fm_wrapper_begin );
			echo ( $embed_iframe );
			echo ( $fm_wrapper_end );
		}
	} else if( $fmtype == 'url' ) {
		$audio_url = esc_url( get_post_meta( get_the_ID(), 'crf_featured_media_url', true ) );
		if( !empty( $audio_url ) ) {
			echo ( $fm_wrapper_begin );
			echo do_shortcode( "[audio src={$audio_url}]" );
			echo ( $fm_wrapper_end );
		}
	}
	?>
	<?php get_template_part( 'templates/blog/classic/content', 'body' ) ?>
</article>