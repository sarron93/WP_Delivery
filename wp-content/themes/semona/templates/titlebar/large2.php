<?php
$titlebar_bg_image = sm_get_titlebar_bg_image();
$titlebar_subtitle = sm_get_titlebar_subtitle();
$titlebar_breadcrumbs = sm_get_titlebar_breadcrumbs();
?>
<div class='sm-titlebar large2' style='background-image: url("<?php echo esc_url( $titlebar_bg_image ) ?>")'>
	<div class='container'>
		<div class='title-wrapper'>
			<h1 class='page-title'><?php echo crf_page_title() ?></h1>
			<?php if( $titlebar_subtitle ): ?>
				<h2 class='page-subtitle'><?php echo ( $titlebar_subtitle ) ?></h2>
			<?php endif; ?>
		</div>
		<?php if ( 'yes' == $titlebar_breadcrumbs ) : ?>
		<div class="breadcrumbs-wrap">
			<a class='home-link' href='<?php echo esc_url( home_url() ) ?>' title='<?php echo esc_html__( 'Back Home', 'semona' ) ?>'><i class='fa fa-angle-double-left'></i><?php echo esc_html__( 'Back Home', 'semona' ) ?></a>
			<div class='breadcrumbs'>
				<?php crf_breadcrumb() ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>