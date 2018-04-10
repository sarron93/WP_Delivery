<?php
ob_start();
previous_post_link( '%link', '<i class="fa fa-long-arrow-left"></i>' . esc_html__( 'Previous', 'semona' ) );
next_post_link( '%link', esc_html__( 'Next', 'semona' ) . '<i class="fa fa-long-arrow-right"></i>' );
$links = ob_get_clean();
if( $links ) :
?> 
<div class='sm-portfolio-prevnext-link clearfix'>
	<?php echo ( $links ) ?>
</div>
<?php
endif;