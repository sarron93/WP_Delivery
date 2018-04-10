<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
	<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
	<?php the_category(); ?>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	<div class="sm-post-date"><?php _e( "Published on ", "semona" ); sm_the_time(); ?></div>
	<?php } ?>

	<div class="featured-media media-fullwidth">
		<?php
		$image_ids = crf_get_post_gallery_ids( get_the_ID() );
		$gallery_images = array();
		foreach( $image_ids as $imgid ) {
			$imgurl = wp_get_attachment_image_src( $imgid, 'full' );
			if( !empty( $imgurl[0] ) ) {
				$gallery_images[] = $imgurl[0];
			}
		} 
		if( count( $gallery_images ) > 0 ) { ?>
		<div class="sm-flexslider flexslider">
			<ul class="slides">
			<?php
			foreach( $gallery_images as $image ) {
				echo "<li><img src='" . esc_url( $image ) . "' alt='" . get_the_title() . " " . esc_html__( 'Image', 'semona' ) . "'></li>";
			}
			?>
			</ul>
		</div>
		<?php
		}
		?>
	</div>

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