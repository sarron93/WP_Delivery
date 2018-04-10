	<a href='<?php echo esc_url( get_permalink() ) ?>'>
		<div class='post-excerpt h5'>
			<?php the_excerpt() ?>
		</div>
		<h3 class='title'><?php crf_do_kses( the_title() ) ?></h3>
	</a>
	<ul class='post-meta'><?php
		?><li><?php sm_the_time() ?></li><?php
	?></ul>
	<div class='readmore-wrapper clearfix'>
		<a class='post-link' href='<?php echo esc_url( get_permalink() ) ?>'><?php esc_html_e( 'Keep Reading', 'semona' ) ?></a>
	</div>