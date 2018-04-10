<?php
$preloader_logo = crf_get_theme_mod_value( 'preloader-logo' );
$preloader_logo_retina = crf_get_theme_mod_value( 'preloader-logo-retina' );
?>
<div class="sm-preloader">
	<img class="preload-logo" src="<?php echo esc_url( $preloader_logo ) ?>" alt="">
</div>