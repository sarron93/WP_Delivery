<?php
$layout = crf_get_theme_mod_value( 'blog-layout' );
$post_layout = $layout;
if( $post_layout == 'masonry' ) {
	$post_layout = 'grid';
}
?>
<div class='content-area content-blog'>
	<div class='container'>
		<?php
		
		if( have_posts() ) {
			
			get_template_part( 'templates/row', 'start' );
			
			get_template_part( "templates/blog/{$layout}/loop" );
			
			$pagination_type = crf_get_theme_mod_value( 'blog-pagination' );
			global $wp_query;
			if( $pagination_type == 'loadmore' ) {
				sm_ajax_pagination( $wp_query, "templates/blog/{$post_layout}/content", true, false );
			} else if( $pagination_type == 'infinitescroll' ) {
				sm_ajax_pagination( $wp_query, "templates/blog/{$post_layout}/content", true, true );
			} else {
				crf_pagination_archive();
			}
	
			get_template_part( 'templates/row', 'end' );
			
		} else {
			
			get_template_part( 'templates/empty' );
			
		}
		?>
	</div>
</div>