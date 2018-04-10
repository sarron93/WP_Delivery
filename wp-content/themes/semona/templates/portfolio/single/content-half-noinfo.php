<article id="post-<?php echo get_the_ID() ?>" <?php post_class( 'sm-portfolio layout2' ) ?>>
	<div class="row row-content">
		<div class="col-desc">
			<?php
			get_template_part( 'templates/portfolio/single/featured-media', get_post_format() );
			?>
		</div>
		<div class="col-info">
			<h3 class='title'><?php the_title() ?></h3>
			<ul class='post-meta clearfix'><?php
				?><li><?php sm_the_time() ?></li><?php
				?><li><?php echo esc_html( get_the_author() ) ?></li><?php
			?></ul>
			<div class='portfolio-content clearfix'>
			<?php
			the_content();
			?>
			</div>
		</div>
	</div>
</article>