<?php
$related_post_count = 4; 
?>
<div class='sm-related-posts'>
	<h2 class='title-related-posts'><?php echo esc_html__( 'Related Posts', 'semona' ) ?></h2>
	<div class='row'>
		<?php
		$query_vars = array(
			'showposts' => $related_post_count, 
			'ignore_sticky_posts' => 1,
			'orderby' => 'rand',
			'post__not_in' => array( get_the_ID() ),
			'category__in' => wp_get_post_categories(),
		);
		$related_posts = new WP_Query( $query_vars );
		while( $related_posts->have_posts() ):
			$related_posts->the_post();
			if( has_post_thumbnail() ) {
				get_template_part( 'templates/blog/related/content' );
			} else {
				get_template_part( 'templates/blog/related/content', 'no-image' );
			}
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</div>