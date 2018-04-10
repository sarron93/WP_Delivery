<?php
$titlebar_bg_type = sm_get_titlebar_bg_type();
$titlebar_bg_class = '';
$bg_style = '';
if( $titlebar_bg_type == 'gradient1' || $titlebar_bg_type == 'gradient2' ) {
	$titlebar_bg_class = 'with-bg bg-' . $titlebar_bg_type;
} else if( $titlebar_bg_type == 'image' ) {
	$titlebar_bg_class = 'with-bg';
	$titlebar_bg_image = sm_get_titlebar_bg_image();
	if( $titlebar_bg_image ) {
		$bg_style = "style='background-image: url(\"" . esc_url( $titlebar_bg_image ) . "\")'";
	}
}
?>
<div class='sm-titlebar small small2 <?php echo esc_attr( $titlebar_bg_class ); ?>' <?php echo ( $bg_style ) ?>>
	<div class='container full-height'>
		<div class='left titlebar-part full-height'>
			<div class='page-title'><?php echo crf_page_title() ?></div>
		</div>
		<div class='right titlebar-part full-height'>
			<div class='breadcrumbs'>
				<?php crf_breadcrumb() ?>
			</div>
		</div>
	</div>
</div>