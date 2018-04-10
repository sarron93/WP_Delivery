<?php
$titlebar_bg_image = sm_get_titlebar_bg_image();
$titlebar_subtitle = sm_get_titlebar_subtitle(); 
$titlebar_hide_nav = crf_get_option_value( '', 'titlebar_large1_hide_nav' );
?>
<div class='sm-titlebar large' style='background-image: url("<?php echo esc_url( $titlebar_bg_image ) ?>")'>
	<div class='container'>
		<div class='title-wrapper'>
			<h1 class='page-title'><?php echo crf_page_title() ?></h1>
			<?php if( $titlebar_subtitle ): ?>
				<h2 class='page-subtitle'><?php echo ( $titlebar_subtitle ) ?></h2>
			<?php endif; ?>
			<div class='primary-underline'>
				<div class='triangle-down'>
				</div>
			</div>
		</div>
		<?php if( $titlebar_hide_nav != 'yes' ) : ?>
		<a class='home-link' href='<?php echo esc_url( home_url() ) ?>' title='<?php echo esc_html__( 'Back Home', 'semona' ) ?>'><i class='fa fa-angle-double-left'></i><?php echo esc_html__( 'Back Home', 'semona' ) ?></a>
		<div class='breadcrumbs'>
			<?php crf_breadcrumb() ?>
		</div>
		<?php endif; ?>
	</div>
</div>