	<ul class='post-meta'><?php
		?><li><?php sm_the_time() ?></li><?php
		?><li><?php echo get_the_author() ?></li><?php
	?></ul>
	<a href='<?php echo esc_url( get_permalink() ) ?>'><h3 class='title'><?php crf_do_kses( the_title() ) ?></h3></a>
	<div class='post-excerpt'>
		<?php the_excerpt() ?>
	</div>
	<div class='readmore-wrapper clearfix'>
		<?php
		if( !post_password_required() ) { 
			comments_popup_link( esc_html__( '0 Comments', 'semona' ), esc_html__( '1 Comments', 'semona' ), esc_html__( '% Comments', 'semona' ), 'sm-comments-link' );
		}
		?>
		<a class='post-link' href='<?php echo esc_url( get_permalink() ) ?>'><?php esc_html_e( 'Keep Reading', 'semona' ) ?></a>
	</div>