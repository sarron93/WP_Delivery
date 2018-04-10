<?php
$post_columns = crf_get_theme_mod_value( 'blog-columns' );
?>
<div class="sm-posts sm-posts-modern-style clearfix" data-selector=".sm-post" data-columns="<?php echo esc_attr( $post_columns ) ?>">
	<?php
	while( have_posts() ): the_post();
		get_template_part( 'templates/blog/modern/content', get_post_format() );
	endwhile; 
	?>
</div>