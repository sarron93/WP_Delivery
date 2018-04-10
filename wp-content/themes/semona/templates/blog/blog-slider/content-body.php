<div class="categories"><?php the_category( ', ' ) ?></div>

<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>

<div class='clearfix'>
	<a class='sm-button' href='<?php echo esc_url( get_permalink() ) ?>'><?php esc_html_e( 'READ MORE', 'semona' ) ?></a>
</div>