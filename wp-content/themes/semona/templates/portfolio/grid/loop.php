<?php
$columns = crf_get_theme_mod_value( 'portfolio-grid-columns' ); 
?>
<div class="sm-portfolio-grid clearfix sm-isotope-container" data-selector=".sm-portfolio" data-columns="<?php echo esc_attr( $columns ) ?>" data-gutter="0" data-layout="masonry2" data-appear-animation="true">
	<?php
	while( have_posts() ): the_post();
		get_template_part( 'templates/portfolio/grid/content' );
	endwhile; 
	?>
</div>