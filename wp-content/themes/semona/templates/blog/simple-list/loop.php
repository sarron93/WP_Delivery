<div class="sm-posts sm-posts-simple-list-style clearfix sm-isotope-container" data-selector=".sm-post" data-columns="1" data-gutter="0" data-layout="fitRows">
	<?php
	while( have_posts() ): the_post();
		get_template_part( 'templates/blog/simple-list/content', get_post_format() );
	endwhile; 
	?>
</div>