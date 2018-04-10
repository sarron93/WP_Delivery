<?php
global $crf_current_sidebar;	// This variable will be also used in row-end.php
$crf_current_sidebar = false;
$sidebar_pos = '';
$sidebar_option = sm_get_sidebar();
if( is_array( $sidebar_option ) ) {
	$crf_current_sidebar = $sidebar_option['sidebar'];
	if( $crf_current_sidebar == '-1' ) {
		$crf_current_sidebar = false;
	} else {
		$sidebar_pos = $sidebar_option['sidebar-pos'];
		if( $sidebar_pos == 'left' ) {
			$sidebar_pos = 'sidebar-left';
		} else {
			$sidebar_pos = 'sidebar-right';
		}
	}
}
?>
<?php if( $crf_current_sidebar ): ?>
		<div class='row with-sidebar <?php echo esc_attr( $sidebar_pos ) ?>'>
			<div class='col-content col-sm-9'>
<?php endif; ?>