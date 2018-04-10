<?php 
$columns = crf_get_theme_mod_value( 'blog-columns' );
?>
<div class="sm-posts sm-posts-masonry clearfix sm-isotope-container" data-selector=".sm-post" data-columns="<?php echo esc_attr( $columns ) ?>" data-gutter="30" data-layout="masonry">
	<?php
	while( have_posts() ): the_post();
		get_template_part( 'templates/blog/grid/content', get_post_format() );
	endwhile; 
	?>
</div>