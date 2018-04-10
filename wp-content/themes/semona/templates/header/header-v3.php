<?php
/* remove default search icon */
// remove_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu', 10, 2 );

$display_header = crf_get_option_value( '', 'display_header' );

$header_classes = array();
$header_classes[] = 'header-v3';

$transparent_header = false;
if( crf_get_option_value( '', 'transparent_header' ) == 'yes' ) {
	if( crf_get_option_value( '', 'slider_position' ) != 'above' ) {
		$header_classes[] = 'transparent';
		$transparent_header = true;
	}
}

$transparent_header_skin = '';
if( $transparent_header ) {
	$transparent_header_skin = crf_get_option_value( '', 'transparent_header_skin' );
	$header_classes[] = $transparent_header_skin . '-mainnav';
}
$header_classes[] = crf_get_option_value( 'main-nav-hover-style', 'main_nav_hover_style' );

$color_scheme = crf_get_theme_mod_value( 'color-scheme' );

$slider_position = crf_get_option_value( '', 'slider_position' );

$hide_logo_area = crf_get_option_value( '', 'header_v3_hide_logo_area' );

/* Slider above header */
if( $slider_position == 'above' ) {
	echo "<div class='sm-slider-area'>\n";
	crf_insert_slider();
	echo "</div>\n";
}
if( $display_header != 'hide' ) :
?>
<header id='sm-header' class='<?php echo esc_attr( implode( ' ', $header_classes ) ) ?>'>
	<?php
	$main_nav_classes = array();
	$main_nav_classes[] = 'main-nav';
	if( crf_get_theme_mod_value( 'header-enable-sticky' ) != 'no' ) {
		$main_nav_classes[] = 'sticky-nav';
	} 
	?>
	<div class='<?php echo implode( ' ', $main_nav_classes )?>'>
		<div class='container'>
			<nav class="sm-h3-menu-left">
				<h2 class='hidden'><?php _e( 'Main Navigation Menu', 'semona' ) ?></h2>
				<?php
				if( has_nav_menu( 'main-menu' ) ) {
					wp_nav_menu( 
						array( 
							'theme_location' => 'main-menu',
							'container_id'	=>	'main-menu-wrapper',
							'container_class' => 'main-menu clearfix', 
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker' => new Crystal_Nav_Walker()
						)
					);
				}
				?>
			</nav>
			<div class='sm-h3-social-right'>
				<?php
				$theme_options = array( 'social-facebook', 'social-twitter', 'social-googleplus', 'social-instagram', 'social-pinterest', 'social-dribbble', 'social-skype', 'social-youtube', 'social-rss', 'social-tumblr', 'social-behance', 'social-vimeo', 'social-github', 'social-linkedin' );
				$icons = array( 'fa-facebook', 'fa-twitter', 'fa-google-plus', 'fa-instagram', 'fa-pinterest-p', 'fa-dribbble', 'fa-skype', 'fa-youtube-play', 'fa-rss', 'fa-tumblr', 'fa-behance', 'fa-vimeo-square', 'fa-github-alt', 'fa-linkedin' );
				$i = 0;
				foreach( $theme_options as $theme_option ) {
					$link = esc_url( crf_get_theme_mod_value( $theme_option ) );
					if( $link != '' ) {
						echo "<a href='{$link}'><i class='fa fa-fw {$icons[$i]}'></i></a>";
					}
					$i++;
				}
				?>
				<?php if( crf_get_theme_mod_value( 'header-show-search-icon' ) != 'hide' ) { ?>
				<div class="inline-block main-menu">
					<ul class="menu">
						<li class="menu-item menu-icon menu-search"><a class="search-icon" href="#"><i class="fa fa-search"></i></a></li>
					</ul>
				</div>
				<?php } ?>
			</div>
			<?php if( crf_get_theme_mod_value( 'header-show-search-icon' ) != 'hide' ) { ?>
			<div class="main-search-form">
				<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<div class="search-input-wrapper">
						<input type="text" class="search-field" name="s" placeholder="<?php _e( 'Search...', 'semona' ) ?>">
					</div>
				</form>
				<a class="search-button" href='#'><i class="fa fa-search"></i></a>
			</div>
			<?php } ?>
		</div>
		<div class="v3-logo-wrapper align-center">
			<div class="inline-block">
			<?php
				sm_output_logo( $color_scheme );
				if( $transparent_header_skin ) {
					sm_output_logo( ( $transparent_header_skin == 'light' ) ? 'light' : 'dark', 'transparent-header-logo' );
				}
			?>
			</div>
		</div>
	</div>
	<?php
	get_template_part( 'templates/header/mobile-header' );
	?>
</header>
<?php
endif;

/* Slider below header (default) */
if( $slider_position != 'above' ) {
	echo "<div class='sm-slider-area'>\n";
	crf_insert_slider();
	echo "</div>\n";
} 

get_template_part( 'templates/titlebar' );