<div class='content-area content-portfolio'>
	<div class='container'>
	<?php

	while( have_posts() ): the_post();
	
		get_template_part( 'templates/row', 'start' );
	
		get_template_part( 'templates/portfolio/single/prevnext' );

		$layout = crf_get_option_value( '', 'portfolio_layout' );
		get_template_part( 'templates/portfolio/single/content', $layout );
		
		$show_related = crf_get_option_value( 'portfolio-show-related', 'portfolio_show_related' );
		if( $show_related != 'no' ) {
			get_template_part( 'templates/portfolio/single/related' );
		}
		
		$show_comments = crf_get_option_value( 'portfolio-show-comments', 'portfolio_show_comments' );
		if( $show_comments == 'yes' ) {
			comments_template();
		}
		
		get_template_part( 'templates/blog/single/prevnext' );
		
		get_template_part( 'templates/row', 'end' );
		
	endwhile;

	?>
	</div>
</div>