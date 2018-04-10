<div class='sm-related-post col-xs-6 no-image'>
	<div class='col-related-post'><?php /* Content column */ ?>
		<div class='related-post-content-col-wrapper'>
			<div class='post-content-wrapper'>
				<div class='post-meta'>
					<span><?php sm_the_time() ?></span>
					<span class='sep'>/</span>
					<span><?php echo esc_html__( 'by', 'semona' ) ?>&nbsp;<?php echo esc_html( get_the_author() ) ?></span>
				</div>
				<a href='<?php echo esc_url( get_permalink() ) ?>'><h6 class='title'><?php crf_do_kses( the_title() ) ?></h6></a>
				<?php the_excerpt() ?>
			</div>
			<div class='post-meta2'>
				<span><?php echo sm_lp_get_post_likes( get_the_ID() ) ?><i class='fa fa-heart'></i></span>
				<span><?php echo esc_html( get_comments_number() ) ?><i class='fa fa-comment'></i></span>
			</div>
		</div>
	</div>
</div>