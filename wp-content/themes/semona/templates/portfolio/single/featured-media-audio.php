<div class='sm-portfolio-featured-media'>
	<?php
	$fmtype = crf_get_option_value( '', 'crf_featured_media_type' );
	if( $fmtype == 'embed' ) {
		echo crf_get_option_value( '', 'featured_media_embed' );
	} else if( $fmtype == 'url' ) {
		$audio_url = esc_url( crf_get_option_value( '', 'crf_featured_media_url' ) );
		echo do_shortcode( "[audio src={$audio_url}]" );
	}
	?>
</div>