<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post smaller sm-isotope-item' ) ?>>
	<div class="featured-media media-fullwidth">
		<div class="post-date outlined">
			<div class="date"><?php the_time( 'd' )?></div>
			<div class="month"><?php the_time( 'M' )?></div>
		</div>
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
	<?php get_template_part( 'templates/blog/grid/content', 'body' ) ?>
</article>