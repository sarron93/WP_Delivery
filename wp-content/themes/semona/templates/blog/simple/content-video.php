<?php
$fm_wrapper_begin = '<div class="featured-media media-fullwidth"><div class="video-wrapper">';
$fm_wrapper_end = '</div></div>';
?>
<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
	<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
	<?php the_category(); ?>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	<div class="sm-post-date"><?php _e( "Published on ", "semona" ); sm_the_time(); ?></div>
	<?php } ?>
	
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
	
	<?php if ( ! is_sticky() || ! is_home() || is_paged() ) { ?>
	<?php the_category(); ?>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	<?php } ?>

	<div class='post-excerpt'>
		<?php the_excerpt() ?>
	</div>

	<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
		<div class="sm-sticky-meta-wrapper">
			<div class="sm-sticky-meta-comments">
				<?php
				if( !post_password_required() ) { 
					comments_popup_link( esc_html__( '0 Comments', 'semona' ), esc_html__( '1 Comments', 'semona' ), esc_html__( '% Comments', 'semona' ), 'sm-comments-link' );
				}
				?>
			</div>
			<div class="sm-sticky-meta-social">
				<ul class="sm-sticky-social">
					<li><a href="#" class=""><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class=""><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class=""><i class="fa fa-pinterest"></i></a></li>
					<li><a href="#" class=""><i class="fa fa-google-plus"></i></a></li>
				</ul>
			</div>
			<div class="sm-sticky-meta-author">
				By <?php the_author_posts_link(); ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="sm-post-date"><?php sm_the_time(); ?></div>
	<?php } ?>
</article>