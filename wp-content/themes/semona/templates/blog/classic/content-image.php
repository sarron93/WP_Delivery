<article id="post-<?php the_ID(); ?>" <?php echo post_class( 'sm-post sm-isotope-item' ) ?>>
	<?php
	if( has_post_thumbnail() ): ?>
	<div class="featured-media">
		<div class="post-date">
			<div class="date"><?php the_time( 'd' )?></div>
			<div class="month"><?php the_time( 'M' )?></div>
		</div>
		<div class="post-format">
			<i class="fa fa-image"></i>
		</div>
		<div class="hover-overlay">
			<div class="hover-overlay-buttons"><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[blog]'><i class='fa fa-search sm-icon-sonar-animation'></i></a><?php
				?><a class='sm-button-icon' href='<?php echo esc_url( get_permalink() ) ?>'><i class='sm-button-icon fa fa-chain sm-icon-sonar-animation'></i></a><?php
			?></div>
		</div>
		<?php the_post_thumbnail( 'full', array( 'class' => 'fullwidth' ) ); ?>
	</div>
	<?php 
	endif; ?>
	<?php get_template_part( 'templates/blog/classic/content', 'body' ) ?>
</article>