<div class='content-area content-blog'>
	<div class='container'>
	<?php
	
	get_template_part( 'templates/row', 'start' );

	while( have_posts() ): the_post();

		get_template_part( 'templates/blog/single/content', get_post_format() );
		
		get_template_part( 'templates/blog/single/author' );
		
		comments_template();
		
		get_template_part( 'templates/blog/single/prevnext' );
		
	endwhile;
	
	get_template_part( 'templates/row', 'end' );
	
	?>
	</div>
</div>