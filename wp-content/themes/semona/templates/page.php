<?php
$enable_page_comments = ( crf_get_option_value( 'page-comments-enable', 'page_enable_comment' ) != 'no' ); 
$content_area_classes = array();
$content_area_classes[] = 'content-area';
$content_area_classes[] = 'content-page';
if( crf_get_option_value( '', 'page_use_onepage_menu' ) == 'yes' ) {
	$content_area_classes[] = 'content-onepage';
}
?>
<div class='<?php echo esc_attr( implode( ' ', $content_area_classes ) ); ?>'>
	<div class='container'>
	<?php
		while( have_posts() ): the_post();
		
			get_template_part( 'templates/row', 'start' );
		
			the_content();
			
			if( $enable_page_comments && comments_open() ) {
				comments_template();
			}
			
			get_template_part( 'templates/row', 'end' );
			
		endwhile;
	?>
	</div>
</div>