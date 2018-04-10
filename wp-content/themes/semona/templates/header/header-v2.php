<?php

$display_header = crf_get_option_value( '', 'display_header' );

$header_classes = array();
$header_classes[] = 'header-v2';
$header_classes[] = 'transparent';
$header_classes[] = crf_get_option_value( 'header-v2-skin', 'header_v2_skin' ) . '-skin';
if( crf_get_option_value( '', 'header_v2_stretch' ) == 'yes' ) {
	$header_classes[] = 'stretched';
}

$color_scheme = crf_get_theme_mod_value( 'color-scheme' );

$header_v2_bg = '';
$header_v2_bg_image = crf_get_option_value( 'header-v2-bg-image', 'titlebar_bg' );
if( $header_v2_bg_image ) {
	$header_v2_bg = " style='background-image: url(\"" . esc_url( $header_v2_bg_image ) . "\")'";
}

if( $display_header != 'hide' ) :
	ob_start();
	$slider_exists = crf_insert_slider();
	$slider_content = ob_get_clean();
?>
<header class='<?php echo esc_attr( implode( ' ', $header_classes ) ) ?>'>
	
	<div class='header-v2-content'>
		<?php if( !$slider_exists ) : ?>
			<div class='header-v2-titlebar'<?php echo ( $header_v2_bg ) ?>>
				<div class='page-info container'>
					<h1 class='page-title'><?php echo crf_page_title() ?><span class='primary-color'>.</span></h1>
					<div class='breadcrumbs'>
						<?php crf_breadcrumb() ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	
	<?php
	$main_nav_classes = array();
	$main_nav_classes[] = 'sm-header-nav-area';
	if( crf_get_theme_mod_value( 'header-enable-sticky' ) != 'no' ) {
		$main_nav_classes[] = 'sticky-nav';
	} 
	?>
	<div class='<?php echo implode( ' ', $main_nav_classes )?>'>
		<div class='container'>
			<div class='left-side'>
				<?php if( crf_get_option_value( '', 'header_v2_hide_logo' ) != 'yes' ): ?>
					<?php sm_output_logo( 'dark', 'logo-dark' ); ?>
					<?php sm_output_logo( 'light', 'logo-light' ); ?>
				<?php endif; ?>
				<?php sm_output_logo( $color_scheme, 'logo-sticky' )?>
			</div>
			<div class='right-side'>
				<a class='menu-toggle' href='#'>
					<span class='bar bar1'></span>
					<span class='bar bar2'></span>
					<span class='bar bar3'></span>
				</a>
			</div>
		</div>
	</div>
	
	<div class='sm-full-screen-nav'>
		<nav>
			<h2 class='hidden'><?php _e( 'Main Navigation Menu', 'semona' ) ?></h2>
			<?php
			if( has_nav_menu( 'main-menu' ) ) {
				remove_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu' );
				wp_nav_menu( 
					array( 
						'theme_location' => 'main-menu',
						'container_id'	=>	'main-menu-wrapper',
						'container_class' => 'main-menu clearfix', 
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'walker' => new Crystal_Footer_Nav_Walker()
					)
				);
			}
			?>
		</nav>
	</div>
	
</header>
<?php
if( $slider_exists ) {
	echo "<div class='sm-slider-area'>\n";
	echo ( $slider_content );
	echo "</div>\n";
} 
endif;
?>