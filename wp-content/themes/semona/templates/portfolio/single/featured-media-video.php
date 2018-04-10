<div class='sm-portfolio-featured-media'>
	<div class='video-wrapper'>
		<?php
		$fmtype = crf_get_option_value( '', 'featured_media_type' );
		if( $fmtype == 'embed' ) {
			echo crf_get_option_value( '', 'featured_media_embed' );
		} else if( $fmtype == 'url' ) {
			$video_url = esc_url( crf_get_option_value( '', 'featured_media_url' ) );
			echo do_shortcode( "[video src={$video_url}]" );
		}
		?>
	</div>
</div>