<article id="post-<?php echo get_the_ID() ?>" <?php post_class( 'sm-portfolio' ) ?>>
	<?php
	get_template_part( 'templates/portfolio/single/featured-media', get_post_format() );
	?>
	<div class="row-content no-aside">
		<h2 class='title'><?php the_title() ?></h2>
		<ul class='post-meta clearfix'><?php
			?><li><?php sm_the_time() ?></li><?php
			?><li><?php echo esc_html( get_the_author() ) ?></li><?php
			?><li><?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ) ?></li><?php
		?></ul>
		<div class='portfolio-content clearfix'>
		<?php
		the_content();
		?>
		</div>
	</div>
</article>