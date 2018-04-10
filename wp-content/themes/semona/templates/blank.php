<div class='content-area content-blank'>
	<div class='container'>
	<?php
		while( have_posts() ): the_post();
		
			get_template_part( 'templates/row', 'start' );
		
			the_content();
			
			get_template_part( 'templates/row', 'end' );
			
		endwhile;
	?>
	</div>
</div>