	<div class='post-excerpt clearfix h3'>
		<?php the_excerpt() ?>
	</div>
	<h3 class='title'><?php crf_do_kses( the_title() ) ?></h3>
	<ul class='post-meta'><?php
		?><li><?php sm_the_time() ?></li><?php
		?><li><?php echo get_the_author() ?></li><?php
		?><li><?php
		if( !post_password_required() ) { 
			comments_popup_link( esc_html__( '0 Comments', 'semona' ), esc_html__( '1 Comments', 'semona' ), esc_html__( '% Comments', 'semona' ), 'sm-comments-link' );
		}
		?></li><?php
		?><li><?php echo sm_lp_get_post_likes( get_the_ID() ) ?> <?php echo esc_html__( 'Likes', 'semona' ) ?></li><?php
		?><li><?php the_category( ', ' ) ?></li><?php
	?></ul>
	<div class='readmore-wrapper clearfix'>
		<a class='post-link' href='<?php echo esc_url( get_permalink() ) ?>'><?php esc_html_e( 'Keep Reading', 'semona' ) ?></a>
	</div>