<?php
$fm_wrapper_begin = '<div class="featured-media media-fullwidth"><div class="video-wrapper">';
$fm_wrapper_end = '</div></div>';
?>
<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
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
		$video_url = esc_url( get_post_meta( get_the_ID(), 'crf_featured_media_url', true ) );
		if( !empty( $video_url ) ) {
			echo ( $fm_wrapper_begin );
			echo do_shortcode( "[video src={$video_url}]" );
			echo ( $fm_wrapper_end );
		}
	}
	?>

	<div class="sm-post-simple-list-content">
		<?php the_category(); ?>
		<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
		<div class='post-excerpt'>
			<?php the_excerpt() ?>
		</div>
		<div class="sm-post-date"><?php sm_the_time(); ?></div>
	</div>
</article>