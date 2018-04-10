<div class="sm-author-box clearfix">
	<div class="author-avatar-wrapper">
		<div class='author-avatar-border'>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 168, '', esc_html__( 'Author Avatar', 'semona' ), array( 'class' => 'author-avatar' ) ) ?>
		</div>
	</div>
	<div class="author-info">
		<h4 class='name'><?php echo get_the_author();//the_author_posts_link(); ?><span class='author-label'><?php echo esc_html__( 'Author', 'semona' ) ?></span></h4>
		<div class='desc'>
			<?php echo the_author_meta( 'description' ) ?>
		</div>
		<?php if( defined( 'SM_AUTHOR_SOCIAL_LINK_OPTIONS_ADDED' ) ): ?>
		<div class='social-links'>
			<?php
			global $sm_author_social_link_icons;
			if( !empty( $sm_author_social_link_icons ) && is_array( $sm_author_social_link_icons ) ) { 
				foreach( $sm_author_social_link_icons as $id => $name ) {
					$link = get_the_author_meta( $id, get_the_author_meta( 'ID' ) );
					if( $link ) { ?>
						<a class='<?php echo esc_attr( $id ) ?>' href='<?php echo esc_url( $link ) ?>'><i class='fa fa-<?php echo esc_attr( $id ) ?>'></i></a>
						<?php
					}
				}
			}
			?>
		</div>
		<?php endif;?>
	</div>
</div>