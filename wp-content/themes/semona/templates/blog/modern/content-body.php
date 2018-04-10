	<?php the_category(); ?>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	
	<ul class='post-meta'><?php
		?><li><?php sm_the_time() ?></li><?php
		?><li><?php echo get_the_author() ?></li><?php
		?><li><?php if( !post_password_required() ) { 
			comments_popup_link( esc_html__( '0 Comments', 'semona' ), esc_html__( '1 Comment', 'semona' ), esc_html__( '% Comments', 'semona' ), 'sm-comments-link' );
		} ?></li>
	</ul>