<article id="post-<?php the_ID(); ?>" <?php post_class( 'sm-post sm-post-single' ) ?>>
	<?php
	if( has_post_thumbnail() ): ?>
	<div class="featured-media">
		<div class="post-date">
			<div class="date"><?php the_time( 'd' )?></div>
			<div class="month"><?php the_time( 'M' )?></div>
		</div>
		<div class="post-format">
			<i class="fa fa-image"></i>
		</div>
		<?php
		if( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'fullwidth' ) );
		} 
		?>
	</div>
	<div class="author-info clearfix">
		<div class="author-avatar-wrapper">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 108, '', esc_html__( 'Author Avatar', 'semona' ), array( 'class' => 'author-avatar-top' ) ) ?>
		</div>
		<ul class='social-links clearfix'>
		<?php
			global $sm_author_social_link_icons;
			if( !empty( $sm_author_social_link_icons ) && is_array( $sm_author_social_link_icons ) ) {
				foreach( $sm_author_social_link_icons as $id => $name ) {
					$link = get_the_author_meta( $id, get_the_author_meta( 'ID' ) );
					if( $link ) { ?>
						<li class='<?php echo esc_attr( $id ) ?>'><a href='<?php echo esc_url( $link ) ?>'><i class='fa fa-<?php echo esc_attr( $id ) ?>'></i></a></li>
						<?php
					}
				}
			}
			?>
		</ul>
	</div>
	<?php 
	endif; ?>
	<?php get_template_part( 'templates/blog/single/content', 'body' ) ?>
</article>