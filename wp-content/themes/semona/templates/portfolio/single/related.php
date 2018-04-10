<?php 
$id = get_the_ID();

$categories = array();
$tags = array();
$tmp = wp_get_post_terms( $id, 'portfolio_category', array( "fields" => "ids" ) );
if( $tmp ) {
	$categories = array_merge( $categories, $tmp );
}
$tmp = wp_get_post_terms( $id, 'portfolio_tags', array( "fields" => "ids" ) );
if( $tmp ) {
	$tags = array_merge( $tags, $tmp );
}
$args = array(
	'post_type' => 'crf_portfolio',
	'has_password' => false,
	'post__not_in' => array( $id ),
	//'posts_per_page' => 4,
);
$args['tax_query'] = array();
$args['tax_query']['relation'] = 'OR';
$args['tax_query'][] = array(
		'taxonomy'	 => 'portfolio_category',
		'field'	 => 'term_id',
		'terms'	 => $categories,
		'operator'	 => 'IN',
);
$args['tax_query'][] = array(
		'taxonomy'	 => 'portfolio_tags',
		'field'	 => 'term_id',
		'terms'	 => $tags,
		'operator'	 => 'IN'
);
$related_style = crf_get_option_value( 'portfolio-related-style', 'portfolio_related_style' );

$related_posts = new WP_Query( $args );

if( $related_posts->have_posts() ) :
?>
<div class='sm-related-portfolio'>
	<div class='title-area clearfix'>
		<h2 class='related-title'><?php echo esc_html__( 'Related Portfolio', 'semona' ) ?></h2>
		<div class='carousel-controls'><?php
			?><a href='#' class='control prev'><i class='fa fa-angle-left'></i></a><?php
			?><a href='#' class='control next'><i class='fa fa-angle-right'></i></a><?php
		?></div>
	</div>
	<div class='sm-carousel-wrapper'>
		<div class='sm-carousel invisible' data-item-width='300' data-prev='.sm-related-portfolio .control.prev' data-next='.sm-related-portfolio .control.next'>
			<?php
			while( $related_posts->have_posts() ): $related_posts->the_post();
				echo '<div class="carousel-item">';
				get_template_part( "templates/portfolio/{$related_style}/content" );
				echo '</div>';
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
<?php
endif;