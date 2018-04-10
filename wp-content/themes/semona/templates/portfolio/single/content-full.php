<article id="post-<?php echo get_the_ID() ?>" <?php post_class( 'sm-portfolio' ) ?>>
	<?php
	get_template_part( 'templates/portfolio/single/featured-media', get_post_format() );
	?>
	<div class="row row-content">
		<div class="col-desc">
			<h2 class='title'><?php the_title() ?></h2>
			<ul class='post-meta clearfix'><?php
				?><li><?php sm_the_time() ?></li><?php
				?><li><?php echo esc_html( get_the_author() ) ?></li><?php
				?><li><?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ) ?></li><?php
			?></ul>
			<div class='portfolio-content clearfix'>
			<?php
			the_content();
			?>
		</div>
		</div>
		<div class="col-info">
			<h3 class='title info'><?php echo esc_html__( 'Project Details', 'semona' ) ?></h3>
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
			<ul class='info-fields'>
				<?php
				$client = crf_get_option_value( '', 'portfolio_client' );
				if( $client ): ?>
					<li class='field'>
						<div class='label'><i class='fa fa-user'></i><?php echo esc_html__( 'Customer', 'semona' ) ?>:</div>
						<div class='value'><?php echo esc_html( $client ) ?></div>
					</li>
				<?php endif; ?>
				<?php
				$category = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' );
				$category = strip_tags( $category );
				if( $category ): ?>
					<li class='field'>
						<div class='label'><i class='fa fa-gear'></i><?php echo esc_html__( 'Category', 'semona' ) ?>:</div>
						<div class='value'><?php echo ( $category ); ?></div>
					</li>
				<?php endif; ?>
				<?php
				$skills = get_the_term_list( get_the_ID(), 'portfolio_skills', '', ', ', '' );
				$skills = strip_tags( $skills );
				if( $skills ): ?>
					<li class='field'>
						<div class='label'><i class='fa fa-cube'></i><?php echo esc_html__( 'Skills', 'semona' ) ?>:</div>
						<div class='value'><?php echo ( $skills ) ?></div>
					</li>
				<?php endif; ?>
				<?php
				$demourl = crf_get_option_value( '', 'portfolio_demo' );
				if( $demourl ): ?>
					<li class='field'>
						<div class='label'><i class='fa fa-chain'></i><?php echo esc_html__( 'Demo', 'semona' ) ?>:</div>
						<div class='value'><a href='<?php echo esc_url( $demourl ) ?>'><?php echo esc_html__( 'View Website', 'semona' ) ?></a></div>
					</li>
				<?php endif; ?>
				<?php
				ob_start();
				sm_the_time();
				$date = ob_get_contents();
				ob_get_clean();
				if( $date ): ?>
					<li class='field'>
						<div class='label'><i class='fa fa-calendar'></i><?php echo esc_html__( 'Date', 'semona' ) ?>:</div>
						<div class='value'><?php echo esc_html( $date ) ?></div>
					</li>
				<?php endif; ?>
				<?php
				$tags = get_the_term_list( get_the_ID(), 'portfolio_tags', '', ', ', '' );
				$tags = strip_tags( $tags );
				if( $tags ): ?>
					<li class='field'>
						<div class='label'><i class='fa fa-cube'></i><?php echo esc_html__( 'Tags', 'semona' ) ?>:</div>
						<div class='value'><?php echo ( $tags ) ?></div>
					</li>
				<?php endif; ?>
			</ul>
			<?php
			get_template_part( 'templates/portfolio/single/social-sharer' );
			?>
		</div>
	</div>
</article>