<?php
$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
?>
<div class='sm-related-post col-xs-6'>
	<div class='row row-related-post'>
		<div class='col-md-6 col-related-post'><?php /* Featured image column */ ?>
			<div class='featured-image-wrapper'>
				<div class='featured-image' style='background-image: url("<?php echo esc_url( $featured_image_url ) ?>")'>
					<img class='hidden' src='<?php echo esc_url( $featured_image_url ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' alt='<?php echo esc_attr( get_the_title() ) ?>'>
				</div>
				<div class="hover-overlay">
					<div class="hover-overlay-buttons"><?php
						if( $featured_image_url ):
							?><a class='sm-button-icon' href='<?php echo esc_url( $featured_image_url ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[relatedposts]'><i class='fa fa-search sm-icon-sonar-animation'></i></a><?php
						endif;
						?><a class='sm-button-icon' href='<?php echo esc_url( get_permalink() ) ?>'><i class='fa fa-chain sm-icon-sonar-animation'></i></a><?php
					?></div>
				</div>
			</div>
		</div>
		<div class='col-md-6 col-related-post'><?php /* Content column */ ?>
			<div class='related-post-content-col-wrapper'>
				<div class='triangle-mark'></div>
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
</div>