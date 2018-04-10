<div class='sm-portfolio-featured-media'>
	<?php
	if( has_post_thumbnail() ) {
		the_post_thumbnail( 'full', array( 'class' => 'fullwidth' ) );
	}
	?>
</div>