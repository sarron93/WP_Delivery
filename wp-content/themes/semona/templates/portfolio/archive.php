<?php 
$portfolio_layout = crf_get_theme_mod_value( 'portfolio-layout' );
?>
<div class='content-area content-portfolio'>
	<div class='container'>
		<?php
		
		if( have_posts() ) {
		 
			get_template_part( 'templates/row', 'start' );
					
			get_template_part( 'templates/portfolio/filter' );
			
			?>
			<div class='row'>
				<?php
				
				get_template_part( "templates/portfolio/{$portfolio_layout}/loop" );
				
				$pagination_type = crf_get_theme_mod_value( 'portfolio-pagination' );
				global $wp_query;
				if( $pagination_type == 'loadmore' ) {
					sm_ajax_pagination( $wp_query, "templates/portfolio/{$portfolio_layout}/content", false, false );
				} else if( $pagination_type == 'infinitescroll' ) {
					sm_ajax_pagination( $wp_query, "templates/portfolio/{$portfolio_layout}/content", false, true );
				} else {
					crf_pagination_archive();
				}
				
				?>
			</div>
			<?php
			 
			get_template_part( 'templates/row', 'end' );
		
		} else {
			
			get_template_part( 'templates/empty' );
			
		}
		
		?>
	</div>
</div>