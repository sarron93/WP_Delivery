<?php
/* 
 * This template is copied from header-v1.php because header-v4 uses the same layout as header-v1 but with some modifications
 * Modifications for v4 in this template:
 * - Header class
 * - Separate container div for logo wrapper and nav menu
 */

$display_header = crf_get_option_value( '', 'display_header' );

$header_classes = array();
$header_classes[] = 'header-v1';
$header_classes[] = 'header-v4';
$header_classes[] = 'shadow';
$transparent_header = false;
if( crf_get_option_value( '', 'transparent_header' ) == 'yes' ) {
	if( crf_get_option_value( '', 'slider_position' ) != 'above' ) {
		$header_classes[] = 'transparent';
		$transparent_header = true;
	}
}
if( crf_get_option_value( 'header-top-border', 'display_top_border' ) == 'show' ) {
	$header_classes[] = 'topline';
}
$header_classes[] = crf_get_option_value( 'topbar-skin', 'topbar_skin' );
if( crf_get_option_value( 'topbar-bottom-border', 'topbar_bottom_border' ) == 'show' ) {
	$header_classes[] = 'topbar-border-bottom';
}
$transparent_header_skin = '';
if( $transparent_header ) {
	$transparent_header_skin = crf_get_option_value( '', 'transparent_header_skin' );
	$header_classes[] = $transparent_header_skin . '-mainnav';
}
$header_classes[] = crf_get_option_value( 'main-nav-hover-style', 'main_nav_hover_style' );

$display_topbar = crf_get_option_value( 'topbar-show', 'display_topbar' );

$color_scheme = crf_get_theme_mod_value( 'color-scheme' );

$slider_position = crf_get_option_value( '', 'slider_position' );

/* Slider above header */
if( $slider_position == 'above' ) {
	echo "<div class='sm-slider-area'>\n";
	crf_insert_slider();
	echo "</div>\n";
}
if( $display_header != 'hide' ) :
?>
<header id='sm-header' class='<?php echo esc_attr( implode( ' ', $header_classes ) ) ?>'>
	<?php if( $display_topbar != 'hide' ): ?>
	<div class='topbar'>
		<div class='container'>
			<div class='topbar-left'>
				<span class='group'>
					<span><i class='icon-call'></i></span>
					<span id='phone'><?php echo esc_html( crf_get_theme_mod_value( 'topbar-phone' ) ) ?></span>
				</span>
				<span class='group'>
					<span><i class='icon-envelope larger'></i></span>
					<span id='email'><?php echo esc_html( crf_get_theme_mod_value( 'topbar-email' ) ) ?></span>
				</span>
			</div>
			<div class='topbar-right'>
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
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php
	$main_nav_classes = array();
	$main_nav_classes[] = 'main-nav';
	if( crf_get_theme_mod_value( 'header-enable-sticky' ) != 'no' ) {
		$main_nav_classes[] = 'sticky-nav';
	} 
	?>
	<div class='<?php echo implode( ' ', $main_nav_classes )?>'>
		<div class='container'><?php
			sm_output_logo( $color_scheme );
			if( $transparent_header_skin ) {
				sm_output_logo( ( $transparent_header_skin == 'light' ) ? 'light' : 'dark', 'transparent-header-logo' );
			}
		?></div>
		<div class='main-nav-wrapper'>
			<div class='container'><?php
				?><nav>
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
					<div class="main-search-form">
						<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
							<div class="search-input-wrapper">
								<input type="text" class="search-field" name="s" placeholder="<?php _e( 'Search...', 'semona' ) ?>">
							</div>
						</form>
						<a class="search-button" href='#'><i class="fa fa-search"></i></a>
					</div>
				</nav><?php
			?></div>
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