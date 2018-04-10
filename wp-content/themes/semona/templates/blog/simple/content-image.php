<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
	<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
	<?php the_category(); ?>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	<div class="sm-post-date"><?php _e( "Published on ", "semona" ); sm_the_time(); ?></div>
	<?php } ?>

	<div class="featured-media media-fullwidth">
		<div class="hover-overlay">
			<div class="hover-overlay-buttons"><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[blog]'><i class='fa fa-search sm-icon-sonar-animation'></i></a><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( get_permalink() ) ?>'><i class='sm-button-icon fa fa-chain sm-icon-sonar-animation'></i></a><?php
			?></div>
		</div>
		<?php
		if( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'fullwidth' ) );
		}
		?>
	</div>

	<?php if ( ! is_sticky() || ! is_home() || is_paged() ) { ?>
	<?php the_category(); ?>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	<?php } ?>

	<div class='post-excerpt'>
		<?php
		if ( ! is_sticky() || ! is_home() || is_paged() ) {
			the_excerpt();
		}
		else {
			add_filter('excerpt_more', 'sticky_new_excerpt_more');
			the_excerpt();
			remove_filter('excerpt_more', 'sticky_new_excerpt_more');
		}
		?>
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