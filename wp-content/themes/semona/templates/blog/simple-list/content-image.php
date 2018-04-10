<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
	<?php if( has_post_thumbnail() ) { ?>
	<div class="featured-media">
		<div class="hover-overlay">
			<div class="hover-overlay-buttons"><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[blog]'><i class='fa fa-search sm-icon-sonar-animation'></i></a><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( get_permalink() ) ?>'><i class='sm-button-icon fa fa-chain sm-icon-sonar-animation'></i></a><?php
			?></div>
		</div>
		<?php the_post_thumbnail( 'full', array( 'class' => 'fullwidth' ) ); ?>
	</div>
	<?php } ?>
	
	<div class="sm-post-simple-list-content">
		<?php the_category(); ?>
		<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
		<div class='post-excerpt'>
			<?php
			if ( ! is_sticky() || is_paged() ) {
				the_excerpt();
			}
			else {
				add_filter('excerpt_more', 'sticky_new_excerpt_more');
				the_excerpt();
				remove_filter('excerpt_more', 'sticky_new_excerpt_more');
			}
			?>
		</div>
		<div class="sm-post-date"><?php sm_the_time(); ?></div>
	</div>
</article>