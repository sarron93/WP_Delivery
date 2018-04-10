	<div class="post-meta2-wrapper clearfix">
		<ul class='post-meta2 clearfix'><?php
			?><li><?php
				if( sm_lp_did_I_liked_post( get_the_ID() ) || !is_user_logged_in() ) {
					echo sm_lp_get_post_likes( get_the_ID() ) . "<i class='fa fa-heart'></i>";
				} else { ?>
					<a class='sm-like-post' href='#' data-postid='<?php echo get_the_ID() ?>' data-nonce='<?php echo wp_create_nonce( SM_LIKE_POST_NONCE ); ?>'><span><?php echo sm_lp_get_post_likes( get_the_ID() ) ?></span><i class='fa fa-heart-o'></i></a>
				<?php
				}
			?></li><?php
			?><li><?php echo esc_html( get_comments_number() ) ?><i class='fa fa-comment'></i></li><?php
		?></ul>
	</div>
	<h3 class='title'><?php crf_do_kses( the_title() ) ?></h3>
	<ul class='post-meta'><?php
		?><li><?php sm_the_time() ?></li><?php
		?><li><?php  echo get_the_author();//the_author_posts_link(); ?></li><?php
		ob_start();
		the_category( ', ' );
		$cats = ob_get_clean();
		if( $cats ) {
			echo '<li>' . $cats . '</li>';
		}
	?></ul>
	<div class='post-content clearfix'>
		<?php the_content() ?>
		<?php 
		wp_link_pages( array(
			'before'           => '<div class="sm-post-pagination">' . esc_html__( 'Pages: ', 'semona' ),
			'after'            => '</div>',
			'next_or_number'   => 'number',
			'separator'        => '',
			'nextpagelink'     => '<i class="fa fa-angle-left"></i>',
			'previouspagelink' => '<i class="fa fa-angle-right"></i>',
			'pagelink'         => '<span>%</span>',
			'echo'             => 1
		) );
		?>
	</div>

	<?php the_tags( "<div class='post-tags'><span class='label'>" . esc_html__( 'Tags:', 'semona' ) . "</span>", "", "</div>" ) ?>