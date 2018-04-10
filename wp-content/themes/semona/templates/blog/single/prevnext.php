<?php
ob_start();
previous_post_link( '%link', esc_html__( 'Previous Post', 'semona' ) );
next_post_link( '%link', esc_html__( 'Next Post', 'semona' ) );
$link = ob_get_clean();
if( $link ) :
?> 
<div class='sm-post-prevnext-link clearfix'>
	<?php echo ( $link ) ?>
</div>
<?php
endif;