<?php

/* Site and sidebar width */
$content_width = floatval( crf_get_theme_mod_value( 'main-width' ) );
$sidebar_width = intval( crf_get_theme_mod_value( 'sidebar-width' ) );
$sidebar_width = ( $sidebar_width < 10 )? 10 : $sidebar_width;
$sidebar_width = ( $sidebar_width > 50 )? 50 : $sidebar_width;

/* General */
$color_scheme = crf_get_theme_mod_value( 'color-scheme' );

$primary_color = crf_get_theme_mod_value( 'primary-color' );
$secondary_color = crf_get_theme_mod_value( 'secondary-color' );
$gradient1_start_color = crf_get_theme_mod_value( 'gradient1-start-color' );
$gradient1_end_color = crf_get_theme_mod_value( 'gradient1-end-color' );
$gradient2_start_color = crf_get_theme_mod_value( 'gradient2-start-color' );
$gradient2_end_color = crf_get_theme_mod_value( 'gradient2-end-color' );
$text_color = crf_get_theme_mod_value( 'text-color' );
$heading_color = crf_get_theme_mod_value( 'heading-color' );
$heading_light_color = crf_get_theme_mod_value( 'heading-light-color' );
$border_color = crf_get_theme_mod_value( 'border-color' );
$heading_underline_color = crf_get_theme_mod_value( 'heading-underline-color' );
$bg_color = crf_get_theme_mod_value( 'bg-color' );
$bg_color2 = crf_get_theme_mod_value( 'bg-color2' );

$text_color_lightened = crf_change_hsl( $text_color, 0, 0, 10 );
$grey_color = crf_change_hsl( $primary_color, 3, -62, -23 );

$primary_hover_color = crf_change_hsl( $primary_color, 0, 0, 10 );
$secondary_hover_color = crf_change_hsl( $secondary_color, 0, 0, 10 );

/* Background */
$content_bg_image = crf_get_option_value( 'content-bg-image', 'content_bg_image' );
$content_bg_repeat = crf_get_option_value( 'content-bg-repeat', 'content_bg_repeat' );
$content_bg_color = crf_get_option_value( '', 'content_bg_color' );
if( $content_bg_color == '#bg' ) {
	$content_bg_color = $bg_color;
} else if( $content_bg_color == '#bg2' ) {
	$content_bg_color = $bg_color2;
}

$outer_bg_type = crf_get_option_value( 'outer-bg-type', 'outer_bg_type' ); 
$outer_bg_pattern = crf_get_option_value( 'outer-bg-pattern', 'outer_bg_pattern' );
$outer_bg_image = crf_get_option_value( 'outer-bg-image', 'outer_bg_image' );
$outer_bg_repeat = crf_get_option_value( 'outer-bg-repeat', 'outer_bg_repeat' );

/* Header */
$header_bg_color = crf_get_theme_mod_value( 'header-bg-color' );

$topbar_height = crf_get_theme_mod_value( 'topbar-height' );
$topbar_text_color = crf_get_theme_mod_value( 'topbar-text-color' );
$topbar_bg_color = crf_get_theme_mod_value( 'topbar-bg-color' );
$topbar_contact_icon_color = $primary_color;
$topbar_icon_social_color = crf_get_theme_mod_value( 'topbar-icon-social-color' );
$main_nav_height = crf_get_theme_mod_value( 'main-nav-height' );

$header_v4_logoarea_height = crf_get_theme_mod_value( 'header-v4-logoarea-height' );
$header_v4_main_nav_height = crf_get_theme_mod_value( 'header-v4-main-nav-height' );

$main_nav_font_color = crf_get_theme_mod_value( 'main-nav-font-color' );
$main_nav_hover_color = crf_get_theme_mod_value( 'main-nav-hover-color' );
$main_nav_bg_color = crf_get_theme_mod_value( 'main-nav-bg-color' );

$header_v3_logoarea_top_padding = crf_get_theme_mod_value( 'v3-logoarea-top-padding' );
$header_v3_logoarea_bottom_padding = crf_get_theme_mod_value( 'v3-logoarea-bottom-padding' );
$header_V3_logoarea_bg_color = crf_get_option_value( 'v3-logoarea-bg-color', 'v3_logoarea_bg_color' );

$dropdown_item_width = crf_get_theme_mod_value( 'dropdown-item-width' );
$dropdown_item_height = crf_get_theme_mod_value( 'dropdown-item-height' );
$dropdown_item_padding = crf_get_theme_mod_value( 'dropdown-item-padding' );
$dropdown_item_color = crf_get_theme_mod_value( 'dropdown-item-color' );
$dropdown_item_arrow_color = crf_get_theme_mod_value( 'dropdown-item-arrow-color' );
$dropdown_bg_color = crf_get_theme_mod_value( 'dropdown-bg-color' );
$dropdown_bg_color_hover = crf_get_theme_mod_value( 'dropdown-bg-color-hover' );
$dropdown_separator_color = crf_get_theme_mod_value( 'dropdown-separator-color' );
$dropdown_hover_color = crf_get_theme_mod_value( 'dropdown-hover-color' );
$mobile_menu_item_color = $heading_color;
$mobile_menu_subitem_color = sm_change_hsl( $heading_color, -1, 0, 9 );
$mobile_menu_bg_color = $bg_color;
$mobile_menu_bg_sel_color = $bg_color2;
$mobile_menu_separator_color = $bg_color2;

/* Footer */
$footer_text_color = crf_get_theme_mod_value( 'footer-text-color' );
$footer_border_color = crf_get_theme_mod_value( 'footer-border-color' );
$footer_bg_color = crf_get_theme_mod_value( 'footer-bg-color' );
$footer_bg_image_opacity = crf_get_option_value( 'footer-bg-image-opacity', 'footer_bg_image_opacity' );
$widget_area_title_color = crf_get_theme_mod_value( 'widget-area-title-color' );
$footer_copyright_bg_color = crf_get_theme_mod_value( 'footer-copyright-bg-color' );

$widget_area_padding_top = crf_get_theme_mod_value( 'widget-area-padding-top' );
$widget_area_padding_bottom = crf_get_theme_mod_value( 'widget-area-padding-bottom' );

$footer_copyright_bar_padding_top = crf_get_theme_mod_value( 'footer-copyright-bar-padding-top' );
$footer_copyright_bar_padding_bottom = crf_get_theme_mod_value( 'footer-copyright-bar-padding-bottom' );

$footer_bg_color2 = crf_color_minus( $footer_bg_color, "#050605" );
$footer_3d_border_dark = crf_change_hsl( $footer_bg_color, 0, -4, -7 );
$footer_3d_border_light = crf_change_hsl( $footer_bg_color, 2, -2, 6 );
$footer_style3_social_color1 = crf_change_hsl( $footer_bg_color, 11, -5, 35 );
$footer_style3_social_color2 = crf_change_hsl( $footer_bg_color, 11, -1, 18 );
$footer_style3_social_hover_color1 = crf_change_hsl( $footer_bg_color, -3, 45, 65 );
$footer_style3_social_hover_color2 = crf_change_hsl( $footer_bg_color, -2, 43, 36 );
$footer_bg_color3 = crf_change_hsl( $footer_bg_color, -1, -2, 5 );
$footer_text_color_lightened = crf_change_hsl( $footer_text_color, 0, 0, 15 );

/* Preloader */
$preloader_bar_color = crf_get_theme_mod_value( 'preloader-bar-color' );

/* Blog */
$blog_bg_color = crf_get_theme_mod_value( 'blog-bg-color' );
$post_format_box_color = crf_get_theme_mod_value( 'post-format-box-color' );
$post_readmore_link_color = crf_get_theme_mod_value( 'post-readmore-link-color' );
$post_box_shadow_color = crf_get_theme_mod_value( 'post-box-shadow-color' );

$post_bg_color = $bg_color;
$post_media_player_bg_color = crf_change_hsl( $primary_color, 3, -62, -23 );
$quote_post_bg_color = $post_media_player_bg_color;
$post_comment_reply_link_color = crf_change_hsl( $text_color, 0, 0, 3 );
$post_tag_color = crf_change_hsl( $text_color, 1, 8, 13 );

$post_related_hover_text_color = crf_change_hsl( $secondary_color, 0, -27, 26 );
$post_related_hover_meta_color = crf_change_hsl( $secondary_color, -8, -80, 28 );
$post_related_hover_meta_icon_color = crf_change_hsl( $secondary_color, 0, -6, 26 );

/* Portfolio */
$portfolio_grid2_shadow_color = crf_get_theme_mod_value( 'portfolio-grid2-shadow-color' );
$portfolio_v2_border_color = $portfolio_grid2_shadow_color; 
$portfolio_category_filter_color = sm_change_hsl( $text_color, -2, 2, -20 );
$portfolio_grid2_title_color = sm_change_hsl( $text_color, -3, 3, -21 );
$portfolio_grid2_category_color = sm_change_hsl( $text_color, 1, 8, 13 );
$portfolio_grid2_hover_shadow_color = crf_change_hsl( $primary_color, 0, -27, -12 );
$portfolio_prevnext_color = sm_change_hsl( $border_color, 1, -6, -6 );
$portfolio_info_border_color = sm_change_hsl( $border_color, -3, 4, 5 );
$portfolio_info_icon_color = sm_change_hsl( $border_color, 3, -2, 2 );
$portfolio_social_link_color = sm_change_hsl( $border_color, 0, -12, -7 );
$portfolio_featured_image_max_width = crf_get_option_value( '', 'portfolio_featured_image_max_width' );
$portfolio_featured_image_max_height = crf_get_option_value( '', 'portfolio_featured_image_max_height' );

/* Pagination */
$pagination_loadmore_gradient_start_color = $grey_color;
$pagination_loadmore_gradient_end_color = crf_change_hsl( $primary_color, 4, -63, -6 );

/* 404 */
$error_404_search_icon_color = sm_change_hsl( $text_color, 2, 8, 24 );

/* Typography */
$heading_font = crf_get_theme_mod_value( 'heading-font' );
$heading_font_weight = crf_get_theme_mod_value( 'heading-font-weight' );
$post_heading_font_weight = crf_get_theme_mod_value( 'post-heading-font-weight' );
$h1_font_size = intval( crf_get_theme_mod_value( 'h1-font-size' ) );
$h2_font_size = intval( crf_get_theme_mod_value( 'h2-font-size' ) );
$h3_font_size = intval( crf_get_theme_mod_value( 'h3-font-size' ) );
$h4_font_size = intval( crf_get_theme_mod_value( 'h4-font-size' ) );
$h5_font_size = intval( crf_get_theme_mod_value( 'h5-font-size' ) );
$h6_font_size = intval( crf_get_theme_mod_value( 'h6-font-size' ) );

$text_font = crf_get_theme_mod_value( 'text-font' );
$text_font2 = crf_get_theme_mod_value( 'text-font2' );
$text_font_size = intval( crf_get_theme_mod_value( 'text-font-size' ) );
$text_font_weight = crf_get_theme_mod_value( 'text-font-weight' );
$text_line_height = crf_get_theme_mod_value( 'text-line-height' );

$topbar_font = crf_get_theme_mod_value( 'topbar-font' );
$topbar_font_weight = crf_get_theme_mod_value( 'topbar-font-weight' );
$topbar_font_size = intval( crf_get_theme_mod_value( 'topbar-font-size' ) );
$topbar_icon_size = intval( crf_get_theme_mod_value( 'topbar-icon-size' ) );
$nav_font = crf_get_theme_mod_value( 'nav-font' );
$nav_font_size = intval( crf_get_theme_mod_value( 'nav-font-size' ) );
$mobile_menu_font_size = $nav_font_size - 1;
$main_nav_font_weight = crf_get_theme_mod_value( 'main-nav-font-weight' );
$dropdown_item_font_weight = crf_get_theme_mod_value( 'dropdown-item-font-weight' );

$footer_heading_font = crf_get_theme_mod_value( 'footer-heading-font' );
$footer_heading_font_size1 = intval( crf_get_theme_mod_value( 'footer-heading-font-size1' ) );
$footer_heading_font_size2 = intval( crf_get_theme_mod_value( 'footer-heading-font-size2' ) );
$footer_heading_font_weight = crf_get_theme_mod_value( 'footer-heading-font-weight' );
$footer_text_font = crf_get_theme_mod_value( 'footer-text-font' );
$footer_copyright_font = crf_get_theme_mod_value( 'footer-copyright-font' );
$footer_social_icon_size = intval( crf_get_theme_mod_value( 'footer-social-icon-size' ) );
$footer_style3_social_size = 26;

/* Button */
$button_style = crf_get_theme_mod_value( 'button-style' );
$button_shape = crf_get_theme_mod_value( 'button-shape' );
$button_size = crf_get_theme_mod_value( 'button-size' );
$button_size_settings = array(
		'sm-size-xs' => array(
				'font-size' => 9,
				'icon-size' => 10,
				'shadow-3d' => 2,
				'h-padding' => 19,
				'v-padding' => 9,
		),
		'sm-size-sm' => array(
				'font-size' => 10,
				'icon-size' => 11,
				'shadow-3d' => 2,
				'h-padding' => 22,
				'v-padding' => 13,
		),
		'sm-size-md' => array(
				'font-size' => 11,
				'icon-size' => 14,
				'shadow-3d' => 3,
				'h-padding' => 22,
				'v-padding' => 15,
		),
		'sm-size-lg' => array(
				'font-size' => 12,
				'icon-size' => 15,
				'shadow-3d' => 4,
				'h-padding' => 32,
				'v-padding' => 20,
		),
		'sm-size-xl' => array(
				'font-size' => 14,
				'icon-size' => 16,
				'shadow-3d' => 5,
				'h-padding' => 32,
				'v-padding' => 20,
		),
);
$button_current_size = $button_size_settings[$button_size];

$button_letter_spacing = intval( crf_get_theme_mod_value( 'button-letter-spacing' ) );
$button_light_color = crf_get_theme_mod_value( 'button-light-color' );
if ( empty( $button_light_color ) ) {
	$button_light_color = $primary_color;
}
$button_dark_color = crf_get_theme_mod_value( 'button-dark-color' );
if ( empty( $button_dark_color ) ) {
	$button_dark_color = $primary_color;
}
$button_def_color = $button_light_color;
if ( 'dark' == $color_scheme ) {
	$button_def_color = $button_dark_color;
}
$button_min_width = crf_get_theme_mod_value( 'button-min-width' );

/* Callout */
$callout_bg_color = crf_get_theme_mod_value( 'callout-bg-color' );
if ( empty( $callout_bg_color ) ) {
	$callout_bg_color = $primary_color;
}
/* Section Header */

$section_header_title_font_size = crf_get_theme_mod_value( 'section-header-title-font-size' );
$section_header_letter_spacing = crf_get_theme_mod_value( 'section-header-letter-spacing' );
$section_header_underline_color = crf_get_theme_mod_value( 'section-header-underline-thickness' );
$section_header_underline_thickness = crf_get_theme_mod_value( 'section-header-underline-thickness' );
$section_header_underline_shape = crf_get_theme_mod_value( 'section-header-underline-shape' );
$section_header_uppercase = crf_get_theme_mod_value( 'section-header-uppercase' );

/* Accordion */
$accordion_hdr_color = crf_get_theme_mod_value( 'accordion-hdr-color' );

/* Horizontal Tabs */
$tabs_hdr_color1 = crf_get_theme_mod_value( 'tabs-hdr-color1' );
$tabs_hdr_color2 = crf_get_theme_mod_value( 'tabs-hdr-color2' );

/* Vertical Tabs */
$vtabs_default_text_color = $vtabs_light_text_color = crf_get_theme_mod_value( 'vtabs-light-text-color' );
$vtabs_default_active_color = $vtabs_light_active_color = crf_get_theme_mod_value( 'vtabs-light-active-color' );
$vtabs_default_inactive_color = $vtabs_light_inactive_color = crf_get_theme_mod_value( 'vtabs-light-inactive-color' );

$vtabs_dark_text_color = crf_get_theme_mod_value( 'vtabs-dark-text-color' );
$vtabs_dark_active_color = crf_get_theme_mod_value( 'vtabs-dark-active-color' );
$vtabs_dark_inactive_color = crf_get_theme_mod_value( 'vtabs-dark-inactive-color' );

if ( $color_scheme == 'dark' ) {
	$vtabs_default_text_color = $vtabs_dark_text_color;
	$vtabs_default_active_color = $vtabs_dark_active_color;
	$vtabs_default_inactive_color = $vtabs_dark_inactive_color;
}

/* Pricing Table */
$pt_theme_featured_color = crf_get_theme_mod_value( 'pt-featured-color' );

$pt_theme_default_bg1 = $pt_theme_light_bg1 = crf_get_theme_mod_value( 'pt-theme-light-bg1' );
$pt_theme_default_bg2 = $pt_theme_light_bg2 = crf_get_theme_mod_value( 'pt-theme-light-bg2' );
$pt_theme_default_heading_text = $pt_theme_light_heading_text = crf_get_theme_mod_value( 'pt-theme-light-heading-text' );
$pt_theme_default_feature_text = $pt_theme_light_feature_text = crf_get_theme_mod_value( 'pt-theme-light-feature-text' );
$pt_theme_default_border = $pt_theme_light_border = crf_get_theme_mod_value( 'pt-theme-light-border' );

$pt_theme_dark_bg1 = crf_get_theme_mod_value( 'pt-theme-dark-bg1' );
$pt_theme_dark_bg2 = crf_get_theme_mod_value( 'pt-theme-dark-bg2' );
$pt_theme_dark_heading_text = crf_get_theme_mod_value( 'pt-theme-dark-heading-text' );
$pt_theme_dark_feature_text = crf_get_theme_mod_value( 'pt-theme-dark-feature-text' );
$pt_theme_dark_border = crf_get_theme_mod_value( 'pt-theme-dark-border' );

$pt_style3_default_btn_hover = '#ffffff';

if ( $color_scheme == 'dark' ) {
	$pt_theme_default_bg1 = $pt_theme_dark_bg1;
	$pt_theme_default_bg2 = $pt_theme_dark_bg2;
	$pt_theme_default_heading_text = $pt_theme_dark_heading_text;
	$pt_theme_default_feature_text = $pt_theme_dark_feature_text;
	$pt_theme_default_border = $pt_theme_dark_border;
	$pt_style3_default_btn_hover = $bg_color; // consider
}

/* Quotes Slider */
$quotes_content_font_family = crf_get_theme_mod_value( 'quotes-content-font-family' );

/* Feature Box */
$featurebox_title_font_family = crf_get_theme_mod_value( 'featurebox-title-font-family' );
$featurebox_title_font_size = crf_get_theme_mod_value( 'featurebox-title-font-size' );
$featurebox_title_font_weight = crf_get_theme_mod_value( 'featurebox-title-font-weight' );
$featurebox_title_letter_spacing = crf_get_theme_mod_value( 'featurebox-title-letter-spacing' );

/* Team Slider */
$team_slider_nav_color = 'rgba(0, 0, 0, .1)';
$team_link_color = sm_change_hsl($text_color, 0, 9, 28);

if ('dark' == $color_scheme ) {
	$team_slider_nav_color = 'rgba(255, 255, 255, 0.1)';
}

/* Progress Steps */
if ( 'dark' == $color_scheme ) {
	$ps_circle_wrap_color = 'rgba(255, 255, 255, 0.2)';
} else {
	$ps_circle_wrap_color = 'rgba(0, 0, 0, 0.1)';
}

/* Testimonials */
$ts_main_color = $heading_color;

/* Timeline Post */
$timeline_spine_color = crf_get_theme_mod_value( 'timeline-spine-color' );
$timeline_border_color = crf_get_theme_mod_value( 'timeline-border-color' );
$timeline_spine_hover_color = crf_get_theme_mod_value( 'timeline-spine-hover-color' );

/* Content */
$content_padding_top = crf_get_option_value( '', 'content_padding_top' );
$content_padding_bottom = crf_get_option_value( '', 'content_padding_bottom' );

/* Woocommerce */
$woocommerce_catalog_font_size = 13;
$woocommerce_catalog_color = sm_change_hsl( $heading_color , -1, 0, 9 );
$woocommerce_price_before_sale_color = sm_change_hsl( $text_color , -1, 1, 12 );
$woocommerce_product_category_color = sm_change_hsl( $text_color , -1, 3, 13 );
$woocommerce_rating_zero_color = sm_change_hsl( $bg_color2, 0, 0, -10 );
$woocommerce_meta_name_color = sm_change_hsl( $text_color , 0, -2, -4 );
$woocommerce_widget_price_color = sm_change_hsl( $heading_color , 0, -1, 9 );

?>
<?php /*********************** Dynamic CSS begin ******************************/ ?>
<?php

/* Site and sidebar width */

?>
<?php
if ( $content_width > 970 ) : ?>
@media (min-width: 768px) {
	.container {
		width: 750px;
	}
}
@media (min-width: 992px) {
	.container {
		width: 970px;
	}
}
@media (min-width: <?php echo esc_attr( $content_width + 20 ) ?>px) {
	.container {
		width: <?php echo esc_attr( $content_width ) ?>px;
	}
}
<?php elseif ( $content_width > 750 ) : ?>
@media (min-width: 768px) {
	.container {
		width: 750px;
	}
}
@media (min-width: 992px) {
	.container {
		width: <?php echo esc_attr( $content_width ) ?>px;
	}
}
<?php else : ?>
@media (min-width: <?php echo esc_attr( $content_width + 20 ) ?>px) {
	.container {
		width: <?php echo esc_attr( $content_width ) ?>px;
	}
}
<?php endif; ?>
@media (min-width: 768px) {
	.col-content {
		width: <?php echo intval( 100 - $sidebar_width ) ?>%;
	}
	.col-sidebar {
		width: <?php echo intval( $sidebar_width ) ?>%;
	}
}
<?php

/* Outer area width */

$site_boxed_width = intval( $content_width ) + 30;
?>
body.sm-site-layout-boxed .sm-wrapper {
	width: <?php echo intval( $site_boxed_width ) ?>px;
}
@media (max-width: <?php echo intval( $site_boxed_width ) ?>px) {
	body.sm-site-layout-boxed .sm-wrapper {
		margin-top: 0;
		margin-bottom: 0;
	}
}

@media screen and (min-width: <?php echo intval( $site_boxed_width ) ?>px) {
	.sm-site-layout-boxed .vc_row[data-vc-full-width=true],
	.with-sidebar .vc_row[data-vc-full-width=true] {
		width: calc(100% + 60px) !important;
		left: -15px !important;
		right: -15px !important;
		position: relative;
		padding-left: 15px !important;
		padding-right: 15px !important;
	}		
	.sm-site-layout-boxed .vc_row[data-vc-full-width=true][data-vc-stretch-content=true],
	.with-sidebar .vc_row[data-vc-full-width=true][data-vc-stretch-content=true] {
		padding-left: 0 !important;
		padding-right: 0 !important;
	}
}

<?php

/* Outer & content backgrounds */

if( !$content_bg_color ) {
	$content_bg_color = $bg_color;
}
?>
body.sm-site-layout-boxed {
	<?php if( $outer_bg_type == 'pattern' ): ?>
		background-image: url('<?php echo esc_url( get_template_directory_uri() . "/images/patterns/{$outer_bg_pattern}.jpg" ) ?>');
	<?php elseif( $outer_bg_type == 'image' ): ?>
		background-image: url('<?php echo esc_url( $outer_bg_image ) ?>');
		background-repeat: <?php echo esc_attr( $outer_bg_repeat ) ?>;
	<?php endif; ?>
}
.content-area {
	background-color: <?php echo esc_attr( $content_bg_color ) ?>;
	<?php if( $content_bg_image ): ?>
		background-image: url('<?php echo esc_url( $content_bg_image ) ?>');
		background-repeat: <?php echo esc_attr( $content_bg_repeat ) ?>;
	<?php endif; ?>
	<?php if( !empty( $content_padding_top ) || $content_padding_top == '0' ): ?>
		padding-top: <?php echo intval( $content_padding_top ) ?>px !important;
	<?php endif; ?>
	<?php if( !empty( $content_padding_bottom ) || $content_padding_bottom == '0' ): ?>
		padding-bottom: <?php echo intval( $content_padding_bottom ) ?>px !important;
	<?php endif; ?>
}
.content-area.content-blank:after {
	<?php if( $content_bg_image ): ?>
		background-image: url('<?php echo esc_url( $content_bg_image ) ?>');
	<?php endif; ?>
}
<?php

/* General Styling */

?>
body {
	color: <?php echo esc_attr( $text_color ) ?>;
}
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
h1 .light, h2 .light, h3 .light, 
h4 .light, h5 .light, h6 .light, 
.h1 .light, .h2 .light, .h3 .light, 
.h4 .light, .h5 .light, .h6 .light {
	color: <?php echo esc_attr( $heading_light_color ) ?>;
}
a {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
a:hover {
	color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
blockquote {
	border-left-color: <?php echo esc_attr( $primary_color ) ?>;
	font-size: <?php echo intval( $text_font_size ) + 2 ?>px;
}
blockquote.alt {
	color: <?php echo esc_attr( $heading_color ) ?>;
	font-size: <?php echo intval( $h3_font_size ) ?>px;
}
blockquote.alt:before {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
hr {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
pre, code {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
kbd {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
tr {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
input[type=text],
input[type=email],
input[type=number],
input[type=date],
input[type=url],
input[type=password],
input[type=search],
input[type=tel],
textarea {
	color: <?php echo esc_attr( $text_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
	font-size: <?php echo intval( $text_font_size ) ?>px;
}
select {
	color: <?php echo esc_attr( $text_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
	font-size: <?php echo intval( $text_font_size ) ?>px;
}
.content-area:not(.content-blog) input[type=text],
.content-area:not(.content-blog) input[type=email],
.content-area:not(.content-blog) input[type=number],
.content-area:not(.content-blog) input[type=date],
.content-area:not(.content-blog) input[type=url],
.content-area:not(.content-blog) input[type=password],
.content-area:not(.content-blog) input[type=search],
.content-area:not(.content-blog) input[type=tel],
.content-area:not(.content-blog) textarea,
.content-area:not(.content-blog) select {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.primary-color {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.secondary-color {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.gradient1-color {
	color: <?php echo esc_attr( $gradient1_start_color ) ?>;
	background: -webkit-linear-gradient( -45deg, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?> );
	-webkit-text-fill-color: transparent;
	-webkit-background-clip: text;
}
.gradient2-color {
	color: <?php echo esc_attr( $gradient2_start_color ) ?>;
	background: -webkit-linear-gradient( -45deg, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?> );
	-webkit-text-fill-color: transparent;
	-webkit-background-clip: text;
}
.text-font2 {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
<?php 

/* Common elements */

?>
.sm-flexslider {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-flexslider .flex-control-paging li a.flex-active {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-flexslider .flex-direction-nav a:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Preloader */

?>
.sm-preloader {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.queryloader__overlay__bar {
	background-color: <?php echo esc_attr( $preloader_bar_color ) ?> !important;
}
<?php 

/* Header v1 */

?>
<?php
// Topbar
?>
header.header-v1 {
	background-color: <?php echo esc_attr( $header_bg_color ) ?>;
}
header.header-v1 .topbar {
	color: <?php echo esc_attr( $topbar_text_color ) ?>;
}
header.header-v1 .topbar span,
header.header-v1 .topbar a {
	line-height: <?php echo esc_attr( $topbar_height ) ?>px;
}
header.header-v1 .topbar-left i {
	color: <?php echo esc_attr( $topbar_contact_icon_color ) ?>;
}
header.header-v1 .topbar-right a {
	color: <?php echo esc_attr( $topbar_icon_social_color ) ?>;
}
header.header-v1 .topbar-right a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php
// Main nav area
?>
header.header-v1 .main-nav {
	background-color: <?php echo esc_attr( $main_nav_bg_color ) ?>;
}
header.header-v1 .main-nav .logo-wrapper {
	height: <?php echo esc_attr( $main_nav_height ) ?>px;
}
header.header-v1 .main-menu #cart-size {
	background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
header.header-v1 .main-menu .menu-item.current-menu-item.page_item > a,
header.header-v1 .main-menu .menu-item.current-menu-ancestor > a,
header.header-v1 .main-menu .menu-item.current-onepage-menu-item > a,
header.header-v3 .main-menu .menu-item.current-menu-item.page_item > a,
header.header-v3 .main-menu .menu-item.current-menu-ancestor > a,
header.header-v3 .main-menu .menu-item.current-onepage-menu-item > a {
	color: <?php echo esc_attr( $main_nav_hover_color ) ?> !important;
}
header.header-v1 .main-menu .menu > .menu-item > a {
	line-height: <?php echo esc_attr( $main_nav_height ) ?>px;
	color: <?php echo esc_attr( $main_nav_font_color ) ?>;
}
header.header-v1 .main-menu .sub-menu > .menu-item:not(:first-child) > a span {
	border-top-color: <?php echo esc_attr( $dropdown_separator_color ) ?>;
}
header.header-v1 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover > a {
	background-color: <?php echo esc_attr( $dropdown_bg_color_hover ) ?>;
	color: <?php echo esc_attr( $dropdown_hover_color ) ?>;
}
header.header-v1 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover > a span:after {
	color: <?php echo esc_attr( $dropdown_hover_color ) ?>;
}
header.header-v1 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover:not(:first-child) > a {
	border-top-color: <?php echo esc_attr( $dropdown_bg_color_hover ) ?>;
}
header.header-v1 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover + .menu-item {
	border-top-color: <?php echo esc_attr( $dropdown_bg_color_hover ) ?>;
}
header.header-v1 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) .menu-item span:after {
	color: <?php echo esc_attr( $dropdown_item_arrow_color ) ?>;
}
header.header-v1 .main-menu .crf-megamenu-sub-menu > .menu-item:hover > a {
	color: <?php echo esc_attr( $dropdown_hover_color ) ?>;
}
header.header-v1 .main-menu .sub-menu,
header.header-v1 .main-menu .crf-megamenu-wrapper {
	background-color: <?php echo esc_attr( $dropdown_bg_color ) ?>;
}
header.header-v1 .main-menu .sub-menu .menu-item,
header.header-v1 .main-menu .crf-megamenu-wrapper .menu-item {
	width: <?php echo esc_attr( $dropdown_item_width ) ?>px;
}
header.header-v1 .main-menu .sub-menu .menu-item a,
header.header-v1 .main-menu .crf-megamenu-wrapper .menu-item a {
	padding: 0 <?php echo esc_attr( $dropdown_item_padding ) ?>px;
	color: <?php echo esc_attr( $dropdown_item_color ) ?>;
}
header.header-v1 .main-menu .sub-menu .menu-item span,
header.header-v1 .main-menu .crf-megamenu-wrapper .menu-item span {
	line-height: <?php echo esc_attr( $dropdown_item_height ) ?>px;
}
header.header-v1 .main-menu .sub-menu:before,
header.header-v1 .main-menu .crf-megamenu-wrapper:before {
	background-color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
<?php
// Header topline
?>
header.header-v1.topline {
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php
// Topbar styles
?>
header.header-v1.primary-bg .topbar {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
header.header-v1.gradient1-bg .topbar {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -o-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: linear-gradient(to right, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
}
header.header-v1.gradient2-bg .topbar {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
	background-image: -o-linear-gradient(left, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
	background-image: linear-gradient(to right, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
}
header.header-v1.bg2-bg .topbar {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
header.header-v1.default-bg.topbar-border-bottom .topbar,
header.header-v1.bg2-bg.topbar-border-bottom .topbar {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header.header-v1.default-bg .topbar {
	background-color: <?php echo esc_attr( $topbar_bg_color ) ?>;
}
<?php
// Hover styles
?>
header.header-v1 .main-menu .menu > .menu-item:hover > a {
	color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
header.header-v1.hover2 .main-menu .menu > .menu-item:not(.menu-icon) > a span:before {
	background-color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
header.header-v1.hover3 .main-menu .menu > .menu-item:not(.menu-icon) > a span:before {
	background-color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
header.header-v1 .main-menu .menu > .menu-icon:hover > a {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Transparent header */ ?>
header.header-v1.transparent.light-mainnav .main-nav:not(.sticky) .main-menu .menu > .menu-item:not(:hover) > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
<?php /* Sticky header */ ?>
.sticky-nav:not(.sm-mobile-header).sticky .menu > .menu-item > a > span {
	font-size: <?php echo intval( $nav_font_size ) - 1 ?>px !important;
}
<?php
// Main nav search box
?>
header.header-v1 .main-search-form {
	background-color: <?php echo esc_attr( $main_nav_bg_color ) ?>;
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-mobile-header {
	background-color: <?php echo esc_attr( $main_nav_bg_color ) ?>;
}
.sm-mobile-header .mobile-menu {
	background-color: <?php echo esc_attr( $mobile_menu_bg_color ) ?>;
}
.sm-mobile-header .mobile-header .menu-toggle-container .menu-toggle {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-mobile-header .mobile-menu a:hover {
	color: <?php echo esc_attr( $dropdown_hover_color ) ?> !important;
}
.sm-mobile-header .mobile-menu li.opened > a {
	background-color: <?php echo esc_attr( $mobile_menu_bg_sel_color ) ?>;
}
.sm-mobile-header .mobile-menu ul.menu > li > a {
	color: <?php echo esc_attr( $mobile_menu_item_color ) ?>;
	border-top-color: <?php echo esc_attr( $mobile_menu_separator_color ) ?>;
	border-bottom-color: <?php echo esc_attr( $mobile_menu_separator_color ) ?>;
}
.sm-mobile-header .mobile-menu ul.menu > li.opened > a:before {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-mobile-header .mobile-menu .sub-menu a {
	color: <?php echo esc_attr( $mobile_menu_subitem_color ) ?>;
}
.sm-mobile-header .search-field-wrapper {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
<?php 

/* Header v2 */

?>
.header-v2 .header-v2-titlebar .breadcrumbs {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.header-v2 .header-v2-titlebar .breadcrumbs li:not(:last-child):after {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.header-v2 .header-v2-titlebar .breadcrumbs a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.header-v2:not(.opened) .sm-header-nav-area.sticky {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.header-v2:not(.opened) .sm-header-nav-area.sticky .menu-toggle .bar {
	background-color: <?php echo esc_attr( $heading_color ) ?>;
}
.header-v2 .sm-full-screen-nav nav {
	font-family: <?php echo esc_attr( $heading_font ) ?>, sans-serif;
}
.header-v2 .sm-full-screen-nav a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Header v3 */

?>
<?php /* Topbar */ ?>
header.header-v3 {
	background-color: <?php echo esc_attr( $header_bg_color ) ?>;
}
<?php /* Main nav area */ ?>
header.header-v3 .main-nav {
	background-color: <?php echo esc_attr( $main_nav_bg_color ) ?>;
}
<?php /* header.header-v3 .main-nav .logo-wrapper {
	height: <?php echo esc_attr( $main_nav_height ) ?>px;
} */ ?>
header.header-v3 .main-menu .menu > .menu-item > a {
	line-height: <?php echo esc_attr( $main_nav_height ) ?>px;
	color: <?php echo esc_attr( $main_nav_font_color ) ?>;
}
header.header-v3 .main-nav div.sm-h3-social-right a {
	line-height: <?php echo esc_attr( $main_nav_height ) ?>px;
}
header.header-v3 .main-menu .sub-menu > .menu-item:not(:first-child) > a span {
	border-top-color: <?php echo esc_attr( $dropdown_separator_color ) ?>;
}
header.header-v3 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover > a {
	background-color: <?php echo esc_attr( $dropdown_bg_color_hover ) ?>;
	color: <?php echo esc_attr( $dropdown_hover_color ) ?>;
}
header.header-v3 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover > a span:after {
	color: <?php echo esc_attr( $dropdown_hover_color ) ?>;
}
header.header-v3 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover:not(:first-child) > a {
	border-top-color: <?php echo esc_attr( $dropdown_bg_color_hover ) ?>;
}
header.header-v3 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) > .menu-item:hover + .menu-item {
	border-top-color: <?php echo esc_attr( $dropdown_bg_color_hover ) ?>;
}
header.header-v3 .main-menu .sub-menu:not(.crf-megamenu-sub-menu) .menu-item span:after {
	color: <?php echo esc_attr( $dropdown_item_arrow_color ) ?>;
}
header.header-v3 .main-menu .crf-megamenu-sub-menu > .menu-item:hover > a {
	color: <?php echo esc_attr( $dropdown_hover_color ) ?>;
}
header.header-v3 .main-menu .sub-menu,
header.header-v3 .main-menu .crf-megamenu-wrapper {
	background-color: <?php echo esc_attr( $dropdown_bg_color ) ?>;
}
header.header-v3 .main-menu .sub-menu .menu-item,
header.header-v3 .main-menu .crf-megamenu-wrapper .menu-item {
	width: <?php echo esc_attr( $dropdown_item_width ) ?>px;
}
header.header-v3 .main-menu .sub-menu .menu-item a,
header.header-v3 .main-menu .crf-megamenu-wrapper .menu-item a {
	padding: 0 <?php echo esc_attr( $dropdown_item_padding ) ?>px;
	color: <?php echo esc_attr( $dropdown_item_color ) ?>;
}
header.header-v3 .main-menu .sub-menu .menu-item span,
header.header-v3 .main-menu .crf-megamenu-wrapper .menu-item span {
	line-height: <?php echo esc_attr( $dropdown_item_height ) ?>px;
}
header.header-v3 .main-menu .sub-menu:before,
header.header-v3 .main-menu .crf-megamenu-wrapper:before {
	background-color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
<?php /* Hover styles */ ?>
header.header-v3 .main-menu .menu > .menu-item:hover > a {
	color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
header.header-v3.hover2 .main-menu .menu > .menu-item:not(.menu-icon) > a span:before {
	background-color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
header.header-v3.hover3 .main-menu .menu > .menu-item:not(.menu-icon) > a span:before {
	background-color: <?php echo esc_attr( $main_nav_hover_color ) ?>;
}
header.header-v3 .main-menu .menu > .menu-icon:hover > a {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Transparent header */ ?>
header.header-v3.transparent.light-mainnav .main-nav:not(.sticky) .main-menu .menu > .menu-item:not(:hover) > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
<?php /* Main nav search box */ ?>
header.header-v3 .main-search-form {
	background-color: <?php echo esc_attr( $main_nav_bg_color ) ?>;
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Logoarea padding */ ?>
header.header-v3 .main-nav .logo-wrapper {
	padding-top: <?php echo esc_attr( $header_v3_logoarea_top_padding ); ?>px;
	padding-bottom: <?php echo esc_attr( $header_v3_logoarea_bottom_padding ); ?>px;
}
<?php /* Logoarea bg color */ ?>
header.header-v3 .main-nav .v3-logo-wrapper {
	background-color: <?php echo esc_attr( $header_V3_logoarea_bg_color ); ?>;
}
<?php 

/* Header v4 */

?>
header.header-v4 .main-nav > .container,
header.header-v4 .main-nav .logo-wrapper {
	height: <?php echo esc_attr( $header_v4_logoarea_height ) ?>px;
}
header.header-v4 .main-menu .menu > .menu-item > a {
	line-height: <?php echo esc_attr( $header_v4_logoarea_height ) ?>px;
}
header.header-v4 .main-nav .main-nav-wrapper {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
header.header-v4 .main-nav .main-nav-wrapper > .container {
	height: <?php echo esc_attr( $header_v4_main_nav_height ) ?>px;
}
header.header-v4 .main-nav .main-menu .menu > .menu-item > a {
	line-height: <?php echo esc_attr( $header_v4_main_nav_height ) ?>px;
}
<?php 

/* Titlebar */

?>
.sm-titlebar.small {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
.sm-titlebar.small .breadcrumbs a {
	color: <?php echo esc_attr( $text_color ) ?>;
}
.sm-titlebar.small .breadcrumbs a:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-titlebar.small.bg-gradient1 {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -o-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: linear-gradient(to right, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
}
.sm-titlebar.small.bg-gradient2 {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
	background-image: -o-linear-gradient(left, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
	background-image: linear-gradient(to right, <?php echo esc_attr( $gradient2_start_color ) ?>, <?php echo esc_attr( $gradient2_end_color ) ?>);
}
.sm-titlebar.large {
	background-color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-titlebar.large .title-wrapper .primary-underline:before,
.sm-titlebar.large .title-wrapper .primary-underline:after {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-titlebar.large .title-wrapper .primary-underline .triangle-down:before {
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-titlebar.large a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-titlebar.large2 {
	background-color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-titlebar.large2 .title-wrapper:before {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-titlebar.large2 a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php

/* Footer */

$available_social_link_count = 14;
$fs3si_size = $footer_style3_social_size * 1.1;
$fsl_padding = ( $content_width - 30 - $fs3si_size ) / ( $available_social_link_count - 1 ) - $fs3si_size;
$fsl_padding = $fsl_padding / 2;
?>
footer {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
	background-color: <?php echo esc_attr( $footer_bg_color ) ?>;
}
footer .footer-bg {
	opacity: <?php echo esc_attr( $footer_bg_image_opacity ) / 100 ?>;
}
footer .style3-social-links-area i {
	color: <?php echo esc_attr( $footer_style3_social_color1 ) ?>;
	background: -webkit-linear-gradient(<?php echo esc_attr( $footer_style3_social_color1 ) ?>, <?php echo esc_attr( $footer_style3_social_color2 ) ?>);
	-webkit-text-fill-color: transparent;
	-webkit-background-clip: text;
}
footer .style3-social-links-area a:hover i {
	color: <?php echo esc_attr( $footer_style3_social_hover_color1 ) ?>;
	background: -webkit-linear-gradient(<?php echo esc_attr( $footer_style3_social_hover_color1 ) ?>, <?php echo esc_attr( $footer_style3_social_hover_color2 ) ?>);
	-webkit-text-fill-color: transparent;
	-webkit-background-clip: text;
}
footer .widget-area {
	padding: <?php echo esc_attr( $widget_area_padding_top ) ?>px 0 <?php echo esc_attr( $widget_area_padding_bottom ) ?>px;
}
footer .crf-widget > h4:first-child {
	color: <?php echo esc_attr( $widget_area_title_color ) ?>;
}
footer .crf-widget:first-child > h4:first-child:after {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
footer .copyright .container {
	padding-top: <?php echo esc_attr( $footer_copyright_bar_padding_top ) ?>px;
	padding-bottom: <?php echo esc_attr( $footer_copyright_bar_padding_bottom ) ?>px;
}
footer .copyright .totop-handle {
	background-color: <?php echo esc_attr( $footer_copyright_bg_color ) ?>;
}
<?php /* Footer general elements */ ?>
footer a {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
footer a.alt {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
footer input[type=email],
footer input[type=text],
footer input[type=password],
footer input[type=tel],
footer input[type=url],
footer input[type=search],
footer textarea,
footer select {
	background-color: <?php echo esc_attr( $footer_bg_color3 ) ?>;
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer input[type=email]::-webkit-input-placeholder,
footer input[type=text]::-webkit-input-placeholder,
footer input[type=password]::-webkit-input-placeholder,
footer input[type=tel]::-webkit-input-placeholder,
footer input[type=url]::-webkit-input-placeholder,
footer input[type=search]::-webkit-input-placeholder,
footer textarea::-webkit-input-placeholder,
footer select::-webkit-input-placeholder {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer input[type=email]:-moz-placeholder,
footer input[type=text]:-moz-placeholder,
footer input[type=password]:-moz-placeholder,
footer input[type=tel]:-moz-placeholder,
footer input[type=url]:-moz-placeholder,
footer input[type=search]:-moz-placeholder,
footer textarea:-moz-placeholder,
footer select:-moz-placeholder {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer input[type=email]::-moz-placeholder,
footer input[type=text]::-moz-placeholder,
footer input[type=password]::-moz-placeholder,
footer input[type=tel]::-moz-placeholder,
footer input[type=url]::-moz-placeholder,
footer input[type=search]::-moz-placeholder,
footer textarea::-moz-placeholder,
footer select::-moz-placeholder {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer input[type=email]:-ms-input-placeholder,
footer input[type=text]:-ms-input-placeholder,
footer input[type=password]:-ms-input-placeholder,
footer input[type=tel]:-ms-input-placeholder,
footer input[type=url]:-ms-input-placeholder,
footer input[type=search]:-ms-input-placeholder,
footer textarea:-ms-input-placeholder,
footer select:-ms-input-placeholder {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer input[type=submit] {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
footer input[type=submit]:hover {
	background-color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
<?php /* Footer general elements end */ ?>
footer.style1 .copyright {
	background-color: <?php echo esc_attr( $footer_copyright_bg_color ) ?>;
}
footer.style2 .copyright {
	background-color: <?php echo esc_attr( $footer_copyright_bg_color ) ?>;
}
footer.style3 {
	background-color: <?php echo esc_attr( $footer_bg_color2 ) ?>;
}
footer.style3 .style3-social-links-area {
	border-bottom-color: <?php echo esc_attr( $footer_3d_border_dark ) ?>;
}
footer .style3-social-links-container {
	margin-left: -<?php echo esc_attr( $fsl_padding ) + 2 ?>px;
	margin-right: -<?php echo esc_attr( $fsl_padding ) + 2 ?>px;
}
footer .style3-social-links-container .social-link-col {
	padding-left: <?php echo esc_attr( $fsl_padding ) ?>px;
	padding-right: <?php echo esc_attr( $fsl_padding ) ?>px;
}
footer.style3 .widget-area {
	border-bottom-color: <?php echo esc_attr( $footer_3d_border_dark ) ?>;
	border-top-color: <?php echo esc_attr( $footer_3d_border_light ) ?>;
}
footer.style3 .copyright {
	border-top-color: <?php echo esc_attr( $footer_3d_border_light ) ?>;
}
footer.style4 .widget-area {
	border-bottom-color: <?php echo esc_attr( $footer_3d_border_dark ) ?>;
}
footer.style4 .copyright {
	border-top-color: <?php echo esc_attr( $footer_3d_border_light ) ?>;
}
<?php /* Footer style3,4 menu */ ?>
footer.style3 .copyright .footer-menu .menu-item:not(:first-child):before,
footer.style4 .copyright .footer-menu .menu-item:not(:first-child):before {
	background-color: <?php echo esc_attr( $footer_3d_border_dark ) ?>;
}
footer.style3 .copyright .footer-menu .menu-item:not(:last-child):after,
footer.style4 .copyright .footer-menu .menu-item:not(:last-child):after {
	background-color: <?php echo esc_attr( $footer_3d_border_light ) ?>;
}
<?php 

/* Blog */

?>
<?php // Archive ?>
.content-area.content-blog {
	background-color: <?php echo esc_attr( $blog_bg_color ) ?>;
}
<?php // Post ?>
.sm-post {
	background-color: <?php echo esc_attr( $post_bg_color ) ?>;
	border-bottom-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post.sticky {
	border-bottom-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post .featured-media .post-date {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post .featured-media .post-format {
	background-color: <?php echo esc_attr( $post_format_box_color ) ?>;
}
.sm-post .hover-overlay i {
	color: <?php echo esc_attr( $heading_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-post .hover-overlay i:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post .title:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post .post-meta a:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post .post-link {
	color: <?php echo esc_attr( $post_readmore_link_color ) ?>;
}
.sm-post .post-link:before {
	background-color: <?php echo esc_attr( $post_readmore_link_color ) ?>;
}
.sm-post .post-link:after {
	border-color: transparent <?php echo esc_attr( $post_readmore_link_color ) ?>;
}
.sm-post .post-link:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post .post-link:hover:before {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post .post-link:hover:after {
	border-color: transparent <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post .post-excerpt a {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post .post-excerpt a:hover {
	color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-post .mejs-container .mejs-controls {
	background-color: <?php echo crf_fadeout( $post_media_player_bg_color, 5 ) ?>;
}
.sm-post .mejs-container .mejs-controls .mejs-time-rail .mejs-time-current {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post.smaller .readmore-wrapper .sm-comments-link:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
<?php // Quote post ?>
.sm-post-quote {
	background-color: <?php echo esc_attr( $quote_post_bg_color ) ?>;
}
.sm-post-quote .quote-icon {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-post-quote .title {
	color: <?php echo esc_attr( $secondary_color ) ?> !important;
}
<?php // Single post ?>
.sm-post-single .title {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-post-single .title:hover {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-post-single .post-tags .label {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-post-single .post-tags a {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	color: <?php echo esc_attr( $post_tag_color ) ?>;
}
.sm-post-single .post-tags a:hover {
	border-color: <?php echo esc_attr( $primary_color ) ?>;
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php // Author box ?>
.sm-author-box {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	border-bottom-color: <?php echo esc_attr( $post_box_shadow_color ) ?>;
}
.sm-author-box .author-avatar-wrapper .author-avatar-border {
	border-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-author-box .author-info .name a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-author-box .author-info .author-label {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php // Related posts ?>
.sm-related-posts .col-related-post {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-related-posts .sm-related-post:hover .col-related-post,
.sm-related-posts .sm-related-post:hover:not(.no-image) .related-post-content-col-wrapper .triangle-mark:before {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-related-posts .sm-related-post:hover .post-content-wrapper {
	color: <?php echo esc_attr( $post_related_hover_text_color ) ?>;
}
.sm-related-posts .sm-related-post:hover .post-meta,
.sm-related-posts .sm-related-post:hover .post-meta2 {
	color: <?php echo esc_attr( $post_related_hover_meta_color ) ?>;
}
.sm-related-posts .sm-related-post:hover .post-meta2 i {
	color: <?php echo esc_attr( $post_related_hover_meta_icon_color ) ?>;
}
.sm-related-posts .sm-related-post:not(.no-image) .related-post-content-col-wrapper .triangle-mark:before {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-related-posts .featured-image-wrapper .hover-overlay i {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-related-posts .featured-image-wrapper .hover-overlay i:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-related-posts .post-meta,
.sm-related-posts .post-meta2 {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
<?php // Comments ?>
.sm-post-comments .post-comment-protected-message {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-post-comments .comment-list .comment {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	border-bottom-color: <?php echo esc_attr( $post_box_shadow_color ) ?>;
}
.sm-post-comments .comment-list .sm-label-awaiting-moderation {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-comments .comment-list ol.children {
	border-left-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-comments .comment-list ol.children .comment:before {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-comments .comment-list ol.children .comment:after {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-comments .comment-list .comment-box .comment-edit-link,
.sm-post-comments .comment-list .comment-box .comment-reply-link {
	background-color: <?php echo esc_attr( $post_comment_reply_link_color ) ?>;
}
.sm-post-comments .comment-list .comment-box .comment-edit-link:hover,
.sm-post-comments .comment-list .comment-box .comment-reply-link:hover {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.content-page .sm-post-comments .comment-list .comment {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
<?php // Post navigation links ?>
.sm-post-prevnext-link {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-post-prevnext-link a {
	color: <?php echo esc_attr( $heading_light_color ) ?>;
}
.sm-post-prevnext-link a:first-child:before {
	background-color: <?php echo esc_attr( $heading_light_color ) ?>;
}
.sm-post-prevnext-link a:first-child:after {
	border-color: transparent <?php echo esc_attr( $heading_light_color ) ?>;
}
.sm-post-prevnext-link a:first-child:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-prevnext-link a:first-child:hover:before {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-prevnext-link a:first-child:hover:after {
	border-color: transparent <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-prevnext-link a:last-child:before {
	background-color: <?php echo esc_attr( $heading_light_color ) ?>;
}
.sm-post-prevnext-link a:last-child:after {
	border-color: transparent <?php echo esc_attr( $heading_light_color ) ?>;
}
.sm-post-prevnext-link a:last-child:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-prevnext-link a:last-child:hover:before {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-post-prevnext-link a:last-child:hover:after {
	border-color: transparent <?php echo esc_attr( $secondary_color ) ?>;
}
<?php

/* Pagination */

?>
.crf-pagination .pagelink {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.crf-pagination .pagelink.current {
	background-color: <?php echo esc_attr( $heading_color ) ?>;
	color: <?php echo esc_attr( $bg_color ) ?>;
}
.crf-pagination a.pagelink:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-pagination-ajax-area .sm-loadmore {
	background-image: -webkit-linear-gradient(top, <?php echo esc_attr( $pagination_loadmore_gradient_start_color ) ?>, <?php echo esc_attr( $pagination_loadmore_gradient_end_color ) ?>);
	background-image: -moz-linear-gradient(top, <?php echo esc_attr( $pagination_loadmore_gradient_start_color ) ?>, <?php echo esc_attr( $pagination_loadmore_gradient_end_color ) ?>);
	background-image: -o-linear-gradient(top, <?php echo esc_attr( $pagination_loadmore_gradient_start_color ) ?>, <?php echo esc_attr( $pagination_loadmore_gradient_end_color ) ?>);
	background-image: linear-gradient(to bottom, <?php echo esc_attr( $pagination_loadmore_gradient_start_color ) ?>, <?php echo esc_attr( $pagination_loadmore_gradient_end_color ) ?>);
}
<?php 

/* Portfolio */

?>
.sm-isotope-filter .filter {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	color: <?php echo esc_attr( $portfolio_category_filter_color ) ?>;
}
.sm-isotope-filter .filter:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.v1 .featured-media .hover-overlay {
	background-color: <?php echo esc_attr( crf_fadeout( $primary_color, 10 ) ) ?>;
}
.sm-portfolio.v2 .hover-overlay i {
	color: <?php echo esc_attr( $heading_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-portfolio.v2 .hover-overlay i:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.v2 .portfolio-info {
	border-color: <?php echo esc_attr( $portfolio_grid2_shadow_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	-webkit-box-shadow: 0 5px 0 0 <?php echo esc_attr( $portfolio_grid2_shadow_color ) ?>;
	-moz-box-shadow: 0 5px 0 0 <?php echo esc_attr( $portfolio_grid2_shadow_color ) ?>;
	box-shadow: 0 5px 0 0 <?php echo esc_attr( $portfolio_grid2_shadow_color ) ?>;
}
.sm-portfolio.v2 .portfolio-info:before {
	border-color: <?php echo esc_attr( $bg_color ) ?> transparent;
}
.sm-portfolio.v2 .portfolio-info .title {
	color: <?php echo esc_attr( $portfolio_grid2_title_color ) ?>;
}
.sm-portfolio.v2 .portfolio-info .portfolio-categories a {
	color: <?php echo esc_attr( $portfolio_grid2_category_color ) ?>;
}
.sm-portfolio.v2:hover .portfolio-info {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
	border-color: <?php echo esc_attr( $primary_color ) ?>;
	-webkit-box-shadow: 0 5px 0 0 <?php echo esc_attr( $portfolio_grid2_hover_shadow_color ) ?>;
	-moz-box-shadow: 0 5px 0 0 <?php echo esc_attr( $portfolio_grid2_hover_shadow_color ) ?>;
	box-shadow: 0 5px 0 0 <?php echo esc_attr( $portfolio_grid2_hover_shadow_color ) ?>;
}
.sm-portfolio.v2:hover .portfolio-info:before {
	border-color: <?php echo esc_attr( $primary_color ) ?> transparent;
}
.sm-portfolio.v3 .hover-area a {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.sm-portfolio.v3 .hover-area a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.v3 .hover-area .links .link {
	font-family: <?php echo esc_attr( $heading_font ) ?>, sans-serif;
}
.sm-portfolio.v3 .hover-area .links .link:hover {
	border-color: <?php echo esc_attr( $primary_color ) ?>;
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.v4 .hover-area .info .categories a {
	color: <?php echo esc_attr( $primary_color ) ?>;
	font-family: <?php echo esc_attr( $heading_font ) ?>, sans-serif;
}
.sm-portfolio.v4 .hover-area .info .categories a:hover {
	color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-portfolio.v4 .hover-area .links .link:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.v5 .featured-media .hover-overlay i:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.v5 .featured-media .hover-overlay-inner .title a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio-prevnext-link a {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	color: <?php echo esc_attr( $portfolio_prevnext_color ) ?>;
}
.sm-portfolio-prevnext-link a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-related-portfolio .title-area {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-related-portfolio .carousel-controls .control {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	color: <?php echo esc_attr( $portfolio_social_link_color ) ?>;
}
.sm-portfolio .post-meta a:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-portfolio .info-fields .field {
	border-bottom-color: <?php echo esc_attr( $portfolio_info_border_color ) ?>;
}
.sm-portfolio .info-fields .field i {
	color: <?php echo esc_attr( $portfolio_info_icon_color ) ?>;
}
.sm-portfolio .social-links span {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-portfolio .social-links a {
	color: <?php echo esc_attr( $portfolio_social_link_color ) ?>;
}
.sm-portfolio .social-links a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-portfolio.layout2 .social-links {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.content-portfolio .sm-post-comments input[type=text],
.content-portfolio .sm-post-comments input[type=email],
.content-portfolio .sm-post-comments input[type=url],
.content-portfolio .sm-post-comments textarea {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.content-portfolio .sm-post-comments .comment {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
<?php /* Portfolio featured gallery/image max width/height */ ?>
<?php if( $portfolio_featured_image_max_width || $portfolio_featured_image_max_height ): ?>
.sm-portfolio-featured-media > img,
.sm-portfolio-featured-media .sm-flexslider .slides li > img {
	margin: auto;
	<?php
	if( $portfolio_featured_image_max_width ) { 
		echo "max-width: " . intval( $portfolio_featured_image_max_width ) . "px;";
	}
	if( $portfolio_featured_image_max_height ) {
		echo "max-height: " . intval( $portfolio_featured_image_max_height ) . "px;";
		echo "width: auto;";
	}
	?>
}
<?php endif; ?>
<?php 

/* 404 Not Found */

?>
.sm-404-content .home-link:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
	border-bottom-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-404-searchbox {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
.sm-404-searchbox .searchbox-wrapper {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.sm-404-searchbox .search-button {
	color: <?php echo esc_attr( $error_404_search_icon_color ) ?>;
	font-size: <?php echo esc_attr( $text_font_size ) ?>px;
}
<?php

/* Revolution Slider */

?>
.tp-bullets.custom .tp-bullet.selected {
	background-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.primary-line-through {
	position: relative;
}
.primary-line-through:after {
	content: '';
	position: absolute;
	border-top: 4px solid <?php echo esc_attr( $primary_color ); ?>;
	margin-top: -2px;
	width: 100%;
	left: 0;
	top: 50%;
}
.sm-vstd-wrap:before,
.sm-vstd-wrap:after {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-vstd-wrap path {
	fill: <?php echo esc_attr( $bg_color ); ?>;
}
<?php

/* Element - Row */

?>
.primary-bg,
.sm-primary-overlay:before {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.bg-color,
.sm-bg-color-overlay:before {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.bg-color2,
.sm-bg-color2-overlay:before {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}

.vc_row {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	background-position: center;
	background-repeat: no-repeat;
}
<?php

/* Element - Section Header */

?>
.sm-section-header .title {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
	font-size: <?php echo esc_attr( $section_header_title_font_size ); ?>px;
	letter-spacing: <?php echo esc_attr( $section_header_letter_spacing ); ?>px; 
}
.sm-section-header .subtitle {
	letter-spacing: <?php echo esc_attr( $section_header_letter_spacing ); ?>px;
}
.sm-section-header .subtitle.sm-primary {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-section-header .underline:before {
	background-color: <?php echo esc_attr( $heading_underline_color ); ?>;
	height: <?php echo esc_attr( $section_header_underline_thickness ); ?>px;
}
<?php 
// LESS INDEPENDENT BEGINS
if ( 'sm-shape-rounded' == $section_header_underline_shape ) : 
?>
.sm-section-header .underline:before {
	border-radius: 10px;
}
<?php 
endif; 
if ( 'no' == $section_header_uppercase ) :
?>
.sm-section-header .title {
	text-transform: none;
}
<?php
endif;
// LESS INDEPENDENT ENDS
?>
<?php

/* Element - Custom Heading */

?>
.sm-custom-heading .heading:before,
.sm-custom-heading .heading:after {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php

/* Element - Dropcap */

?>
.sm-dropcap {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-dropcap.rect,
.sm-dropcap.round-rect,
.sm-dropcap.circle,
.sm-dropcap.inverted-arch {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php

/* Element - Icon List Item */

?>
.sm-icon-list-item i {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php

/* Element - Highlight Text */

?>
.sm-highlight {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php

/* Element - Button */

?>
.sm-button,
input[type=submit],
button,
.sm-button.sm-style-modern,
input[type=submit].sm-style-modern,
button.sm-style-modern {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
	border-color: <?php echo esc_attr( $button_def_color ); ?>;
	background-color: <?php echo esc_attr( $button_def_color ); ?>;
<?php /* Less Independent - Begin */ ?>
<?php if ( 'sm-shape-square' == $button_shape ) :?>
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
<?php elseif ( 'sm-shape-round' == $button_shape ) :?>
	-moz-border-radius: 4em;
	-webkit-border-radius: 4em;
	border-radius: 4em;
<?php endif; ?>
<?php if ( 'dark' == $color_scheme ) : ?>
	/*color: <?php echo esc_attr( $bg_color ); ?>;*/
<?php endif; ?>	
<?php if ( !empty( $button_min_width ) ) : ?>
	min-width: <?php echo intval( $button_min_width ); ?>px;
<?php endif; ?>
	letter-spacing: <?php echo esc_attr( $button_letter_spacing ); ?>px;
<?php /* Less Independent - End */ ?>
}
.sm-button:hover,
input[type=submit]:hover,
button:hover,
.sm-button.sm-style-modern:hover,
input[type=submit].sm-style-modern:hover,
button.sm-style-modern:hover,
.sm-button:focus,
input[type=submit]:focus,
button:focus,
.sm-button.sm-style-modern:focus,
input[type=submit].sm-style-modern:focus,
button.sm-style-modern:focus {
<?php if ( 'dark' == $color_scheme ) : ?>
	/*color: <?php echo esc_attr( $bg_color ); // Less Independent ?>;*/
<?php endif; ?>	
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, 6 );?>;
	border-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, 6 );?>;
}
.sm-button:active:focus,
input[type=submit]:active:focus,
button:active:focus,
.sm-button.sm-style-modern:active:focus,
input[type=submit].sm-style-modern:active:focus,
button.sm-style-modern:active:focus,
.sm-button.active,
input[type=submit].active,
button.active,
.sm-button.sm-style-modern.active,
input[type=submit].sm-style-modern.active,
button.sm-style-modern.active {
<?php if ( 'dark' == $color_scheme ) : ?>
	/*color: <?php echo esc_attr( $bg_color ); // Less Independent ?>;*/
<?php endif; ?>	
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 );?>;
	border-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 );?>;
}
.sm-button.sm-style-flat,
input[type=submit].sm-style-flat,
button.sm-style-flat {
<?php if ( 'dark' == $color_scheme ) : ?>
	/*color: <?php echo esc_attr( $bg_color ); // Less Independent ?>;*/
<?php endif; ?>	
	background-color: <?php echo esc_attr( $button_def_color ); ?>;
	border-color: <?php echo esc_attr( $button_def_color ); ?>;
}
.sm-button.sm-style-flat:hover,
input[type=submit].sm-style-flat:hover,
button.sm-style-flat:hover,
.sm-button.sm-style-flat:focus,
input[type=submit].sm-style-flat:focus,
button.sm-style-flat:focus {
<?php if ( 'dark' == $color_scheme ) : ?>
	/*color: <?php echo esc_attr( $bg_color ); // Less Independent ?>;*/
<?php endif; ?>	
	border-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, 6 );?>;
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, 6 );?>;
}
.sm-button.sm-style-flat:active:focus,
input[type=submit].sm-style-flat:active:focus,
button.sm-style-flat:active:focus,
.sm-button.sm-style-flat.active,
input[type=submit].sm-style-flat.active,
button.sm-style-flat.active {
<?php if ( 'dark' == $color_scheme ) : ?>
	/*color: <?php echo esc_attr( $bg_color ); // Less Independent ?>;*/
<?php endif; ?>	
	border-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 );?>;
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 );?>;
}
.sm-button.sm-style-3d,
input[type=submit].sm-style-3d,
button.sm-style-3d {
	background-color: <?php echo esc_attr( $button_def_color ); ?>;
	box-shadow: 0 <?php echo esc_attr( $button_current_size['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $button_def_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-style-3d:hover,
input[type=submit].sm-style-3d:hover,
button.sm-style-3d:hover,
.sm-button.sm-style-3d:focus,
input[type=submit].sm-style-3d:focus,
button.sm-style-3d:focus {
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, 3 ); ?>;
}
.sm-button.sm-style-3d:active:focus,
button.sm-style-3d:active:focus,
input[type=submit].sm-style-3d:active:focus {
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 ); ?>;
}
.sm-button.sm-style-3d.sm-size-xs,
input[type=submit].sm-style-3d.sm-size-xs,
button.sm-style-3d.sm-size-xs {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-xs']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $button_def_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-style-3d.sm-size-sm,
input[type=submit].sm-style-3d.sm-size-sm,
button.sm-style-3d.sm-size-sm {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-sm']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $button_def_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-style-3d.sm-size-md,
input[type=submit].sm-style-3d.sm-size-md,
button.sm-style-3d.sm-size-md {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-md']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $button_def_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-style-3d.sm-size-lg,
input[type=submit].sm-style-3d.sm-size-lg,
button.sm-style-3d.sm-size-lg {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-lg']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $button_def_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-style-3d.sm-size-xl,
input[type=submit].sm-style-3d.sm-size-xl,
button.sm-style-3d.sm-size-xl {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-xl']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $button_def_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-style-outline,
input[type=submit].sm-style-outline,
button.sm-style-outline {
	color: <?php echo esc_attr( $button_def_color ); ?>;
	border-color: <?php echo esc_attr( $button_def_color ); ?>;
}
.sm-button.sm-style-outline:hover,
input[type=submit].sm-style-outline:hover,
button.sm-style-outline:hover,
.sm-button.sm-style-outline:focus,
input[type=submit].sm-style-outline:focus,
button.sm-style-outline:focus {
<?php if ( 'dark' == $color_scheme ) : ?>
	color: #111;
<?php endif;?>
	border-color: <?php echo esc_attr( $button_def_color ); ?>;
	background-color: <?php echo esc_attr( $button_def_color ); ?>;
}
.sm-button.sm-style-outline:active:focus,
button.sm-style-outline:active:focus,
.sm-button.sm-style-outline.active,
input[type=submit].sm-style-outline.active,
button.sm-style-outline.active {
<?php if ( 'dark' == $color_scheme ) : ?>
	color: #111;
<?php endif;?>
	border-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 );?>;
	background-color: <?php echo crf_change_hsl( $button_def_color, 0, 0, -8 );?>;
}
.sm-button.sm-style-white,
input[type=submit].sm-style-white,
button.sm-style-white {
	color: <?php echo esc_attr( $button_def_color ); ?>;
<?php
/* Less Independent - Begin */
if ( 'dark' == $color_scheme ) :?>
	background-color: <?php echo esc_attr( $bg_color ); ?>;
	border-color: #fff;
	color: #fff;
<?php 
endif; 
/* Less Independent - End */
?>
}
.sm-button.sm-style-white:hover,
input[type=submit].sm-style-white:hover,
button.sm-style-white:hover,
.sm-button.sm-style-white:focus,
input[type=submit].sm-style-white:focus,
button.sm-style-white:focus {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-button.sm-style-white:active:focus,
input[type=submit].sm-style-white:active:focus,
button.sm-style-white:active:focus,
.sm-button.sm-style-white.active,
input[type=submit].sm-style-white.active,
button.sm-style-white.active {
	border-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
}
.sm-button.sm-primary.sm-style-flat,
input[type=submit].sm-primary.sm-style-flat,
button.sm-primary.sm-style-flat {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-button.sm-primary.sm-style-flat:hover,
input[type=submit].sm-primary.sm-style-flat:hover,
button.sm-primary.sm-style-flat:hover,
.sm-button.sm-primary.sm-style-flat:focus,
input[type=submit].sm-primary.sm-style-flat:focus,
button.sm-primary.sm-style-flat:focus {
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, 6 );?>;
}
.sm-button.sm-primary.sm-style-flat:active:focus,
input[type=submit].sm-primary.sm-style-flat:active:focus,
button.sm-primary.sm-style-flat:active:focus,
.sm-button.sm-primary.sm-style-flat.active,
input[type=submit].sm-primary.sm-style-flat.active,
button.sm-primary.sm-style-flat.active {
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
}
.sm-button.sm-primary.sm-style-3d,
input[type=submit].sm-primary.sm-style-3d,
button.sm-primary.sm-style-3d {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
	box-shadow: 0 <?php echo esc_attr( $button_current_size['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $primary_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-primary.sm-style-3d:hover,
input[type=submit].sm-primary.sm-style-3d:hover,
button.sm-primary.sm-style-3d:hover,
.sm-button.sm-primary.sm-style-3d:focus,
input[type=submit].sm-primary.sm-style-3d:focus,
button.sm-primary.sm-style-3d:focus {
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, 3 ); ?>;
}
.sm-button.sm-primary.sm-style-3d:active:focus,
button.sm-primary.sm-style-3d:active:focus,
input[type=submit].sm-primary.sm-style-3d:active:focus {
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 ); ?>;
}
.sm-button.sm-primary.sm-style-3d.sm-size-xs,
input[type=submit].sm-primary.sm-style-3d.sm-size-xs,
button.sm-primary.sm-style-3d.sm-size-xs {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-xs']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $primary_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-primary.sm-style-3d.sm-size-sm,
input[type=submit].sm-primary.sm-style-3d.sm-size-sm,
button.sm-primary.sm-style-3d.sm-size-sm {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-sm']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $primary_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-primary.sm-style-3d.sm-size-md,
input[type=submit].sm-primary.sm-style-3d.sm-size-md,
button.sm-primary.sm-style-3d.sm-size-md {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-md']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $primary_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-primary.sm-style-3d.sm-size-lg,
input[type=submit].sm-primary.sm-style-3d.sm-size-lg,
button.sm-primary.sm-style-3d.sm-size-lg {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-lg']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $primary_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-primary.sm-style-3d.sm-size-xl,
input[type=submit].sm-primary.sm-style-3d.sm-size-xl,
button.sm-primary.sm-style-3d.sm-size-xl {
	box-shadow: 0 <?php echo esc_attr( $button_size_settings['sm-size-xl']['shadow-3d'] ); ?>px 0 <?php echo crf_change_hsl( $primary_color, 0, 0, -11 ); ?>;
}
.sm-button.sm-primary.sm-style-outline,
input[type=submit].sm-primary.sm-style-outline,
button.sm-primary.sm-style-outline {
	color: <?php echo esc_attr( $primary_color ); ?>;
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-button.sm-primary.sm-style-outline:hover,
input[type=submit].sm-primary.sm-style-outline:hover,
button.sm-primary.sm-style-outline:hover,
.sm-button.sm-primary.sm-style-outline:focus,
input[type=submit].sm-primary.sm-style-outline:focus,
button.sm-primary.sm-style-outline:focus {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-button.sm-primary.sm-style-outline:active:focus,
input[type=submit].sm-primary.sm-style-outline:active:focus,
button.sm-primary.sm-style-outline:active:focus,
.sm-button.sm-primary.sm-style-outline.active,
input[type=submit].sm-primary.sm-style-outline.active,
button.sm-primary.sm-style-outline.active {
	border-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
}
.sm-button.sm-primary.sm-style-white,
input[type=submit].sm-primary.sm-style-white,
button.sm-primary.sm-style-white {
	color: <?php echo esc_attr( $primary_color ); ?>;
<?php
/* Less Independent - Begin */
if ( 'dark' == $color_scheme ) :?>
	background-color: <?php echo esc_attr( $bg_color ); ?>;
	border-color: #fff;
	color: #fff;
<?php 
endif; 
/* Less Independent - End */
?>
}
.sm-button.sm-primary.sm-style-white:hover,
input[type=submit].sm-primary.sm-style-white:hover,
button.sm-primary.sm-style-white:hover,
.sm-button.sm-primary.sm-style-white:focus,
input[type=submit].sm-primary.sm-style-white:focus,
button.sm-primary.sm-style-white:focus {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-button.sm-primary.sm-style-white:active:focus,
input[type=submit].sm-primary.sm-style-white:active:focus,
button.sm-primary.sm-style-white:active:focus,
.sm-button.sm-primary.sm-style-white.active,
input[type=submit].sm-primary.sm-style-white.active,
button.sm-primary.sm-style-white.active {
	border-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
}
.sm-button.sm-primary,
input[type=submit].sm-primary,
button.sm-primary,
.sm-button.sm-primary.sm-style-modern,
input[type=submit].sm-primary.sm-style-modern,
button.sm-primary.sm-style-modern {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-button.sm-primary:hover,
input[type=submit].sm-primary:hover,
button.sm-primary:hover,
.sm-button.sm-primary.sm-style-modern:hover,
input[type=submit].sm-primary.sm-style-modern:hover,
button.sm-primary.sm-style-modern:hover,
.sm-button.sm-primary:focus,
input[type=submit].sm-primary:focus,
button.sm-primary:focus,
.sm-button.sm-primary.sm-style-modern:focus,
input[type=submit].sm-primary.sm-style-modern:focus,
button.sm-primary.sm-style-modern:focus {
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, 6 );?>;
	border-color: <?php echo crf_change_hsl( $primary_color, 0, 0, 6 );?>;
}
.sm-button.sm-primary:active:focus,
input[type=submit].sm-primary:active:focus,
button.sm-primary:active:focus,
.sm-button.sm-primary.sm-style-modern:active:focus,
input[type=submit].sm-primary.sm-style-modern:active:focus,
button.sm-primary.sm-style-modern:active:focus,
.sm-button.sm-primary.active,
input[type=submit].sm-primary.active,
button.sm-primary.active,
.sm-button.sm-primary.sm-style-modern.active,
input[type=submit].sm-primary.sm-style-modern.active,
button.sm-primary.sm-style-modern.active {
	background-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
	border-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -8 );?>;
}
.sm-button.sm-style-def-grad1,
input[type=submit].sm-style-def-grad1,
button.sm-style-def-grad1 {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -o-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: linear-gradient(135deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
}
.sm-button.sm-style-def-grad2,
input[type=submit].sm-style-def-grad2,
button.sm-style-def-grad2 {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -o-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: linear-gradient(135deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
}
.sm-button,
button,
input[type=submit] {
	font-size: <?php echo esc_attr( $button_current_size['font-size'] ); ?>px;
	padding: <?php echo esc_attr( $button_current_size['v-padding']); ?>px <?php echo esc_attr( $button_current_size['h-padding']); ?>px;
}
.sm-button.sm-style-flat,
button.sm-style-flat,
input[type=submit].sm-style-flat,
.sm-button.sm-style-def-grad1,
button.sm-style-def-grad1,
input[type=submit].sm-style-def-grad1,
.sm-button.sm-style-def-grad2,
button.sm-style-def-grad2,
input[type=submit].sm-style-def-grad2,
.sm-button.sm-style-gradient,
button.sm-style-gradient,
input[type=submit].sm-style-gradient {
	padding: <?php echo esc_attr( $button_current_size['v-padding'] + 1 ); ?>px <?php echo esc_attr( $button_current_size['h-padding'] + 1 ); ?>px;
}
.sm-button.sm-style-outline.sm-border-thick,
button.sm-style-outline.sm-border-thick,
input[type=submit].sm-style-outline.sm-border-thick {
	padding: <?php echo esc_attr( $button_current_size['v-padding'] - 1 ); ?>px <?php echo esc_attr( $button_current_size['h-padding'] - 1 ); ?>px;
}
.sm-button .sm-icon,
button .sm-icon,
input[type=submit] .sm-icon {
	font-size: <?php echo esc_attr( $button_current_size['icon-size'] ); ?>px;
}
.sm-button.sm-style-3d:active:focus,
button.sm-style-3d:active:focus,
input[type=submit].sm-style-3d:active:focus {
	top: <?php echo esc_attr( $button_current_size['shadow-3d'] );?>px;
}
<?php

/* Element - Callout */

?>
.sm-callout {
	background-color: <?php echo esc_attr( $callout_bg_color ); ?>;
}
.sm-callout.sm-primary {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-callout.sm-style-def-grad1 {
	background-image: -webkit-linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -o-linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
}
.sm-callout.sm-style-def-grad2 {
	background-image: -webkit-linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -o-linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
}
.sm-callout .heading {
	font-family: <?php echo esc_attr( $heading_font ); ?>;
	font-weight: <?php echo esc_attr( $heading_font_weight ); ?>;
}
<?php

/* Element - Image Carousel */

?>
.sm-image-carousel.sm-primary {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}

.sm-image-carousel.sm-style-def-grad1 {
	background-image: -webkit-linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -o-linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
}
.sm-image-carousel.sm-style-def-grad2 {
	background-image: -webkit-linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -o-linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
}
.sm-image-carousel .bullet-controls a {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php

/* Element - Accordion */

?>
.sm_accordion .sm_accordion_header,
.sm_accordion.sm-bg-color2 .sm_accordion_header {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm_accordion .sm_accordion_header,
.sm_accordion .sm_accordion_header a {
	color: <?php echo esc_attr( $accordion_hdr_color ); ?>;
}
.sm_accordion.sm-bg-color .sm_accordion_header {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_accordion.sm-primary-active .sm_accordion_header.ui-state-active {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_accordion .ui-accordion-header-icon:before,
.sm_accordion .ui-accordion-header-icon:after {
	background-color: <?php echo esc_attr( $accordion_hdr_color ); ?>;
}
.sm_accordion.sm-content-border .sm_accordion_content {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-style-def-grad1 .sm_accordion_header.ui-state-active {
	background-image: -webkit-linear-gradient(0deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(0deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -o-linear-gradient(0deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: linear-gradient(90deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
}
.sm_accordion.sm-style-def-grad2 .sm_accordion_header.ui-state-active {
	background-image: -webkit-linear-gradient(0deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(0deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -o-linear-gradient(0deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: linear-gradient(90deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
}
.sm_accordion.sm-style-outline .sm_accordion_header {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-style-outline:not(.sm-ctrl-fa) .ui-accordion-header-icon:before,
.sm_accordion.sm-style-outline:not(.sm-ctrl-fa) .ui-accordion-header-icon:after {
	background-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-style-underline .sm_accordion_header {
	border-bottom-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-style-underline:not(.sm-ctrl-fa) .ui-accordion-header-icon:before,
.sm_accordion.sm-style-underline:not(.sm-ctrl-fa) .ui-accordion-header-icon:after {
	background-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-style-underline .sm_accordion_section:not(:last-child) .sm_accordion_content {
	border-bottom-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-ctrl-bg .ui-accordion-header-icon {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm_accordion.sm-ctrl-bg .ui-state-active .ui-accordion-header-icon {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_accordion .ui-accordion-header-icon {
	color: <?php echo esc_attr( $text_color ); ?>;
}
.sm_accordion.sm-style-solid.sm-ctrl-bg .ui-accordion-header .ui-accordion-header-icon {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_accordion.sm-style-solid.sm-ctrl-bg.sm-bg-color .ui-accordion-header-icon {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm_accordion.sm-style-solid.sm-ctrl-bg.sm-bg-color2 .ui-accordion-header-icon {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_accordion.sm-header-border .sm_accordion_header {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
<?php

/* Element - Tabs */

?>
.sm_tabs .sm_tabs_nav li {
	border-right-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_tabs .sm_tabs_nav li:not(:last-child) {
	border-right-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_tabs .sm_tabs_nav li a {
	color: <?php echo esc_attr( $tabs_hdr_color2 ); ?>;
}
.sm_tabs .sm_tabs_nav li.ui-state-active {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs .sm-panel-wrap {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_tabs.sm-style-outline .sm_tabs_nav {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_tabs.sm-style-outline .sm_tabs_nav li {
	border-top-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm_tabs.sm-style-outline .sm_tabs_nav li a {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-style-outline .sm_tabs_nav li.ui-state-active a {
	border-top-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs.sm-bg-color .sm_tabs_nav li {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_tabs.sm-bg-color .sm_tabs_nav li a {
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-bg-color2 .sm_tabs_nav li {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm_tabs.sm-bg-color2 .sm_tabs_nav li a {
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-blue-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-orange-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-turquoise-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-purple-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-pink-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-green-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-red-active .sm_tabs_nav li.ui-state-active a,
.sm_tabs.sm-grey-active .sm_tabs_nav li.ui-state-active a {
	color: <?php echo esc_attr( $tabs_hdr_color2 ); ?>;
}
.sm_tabs.sm-primary-active .sm_tabs_nav li.ui-state-active {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs.sm-primary-active .sm_tabs_nav li.ui-state-active a {
	color: <?php echo esc_attr( $tabs_hdr_color2 ); ?>;
}
.sm_tabs.sm-bg-color-active .sm_tabs_nav li.ui-state-active {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_tabs.sm-bg-color-active .sm_tabs_nav li.ui-state-active a {
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-bg-color2-active .sm_tabs_nav li.ui-state-active {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm_tabs.sm-bg-color2-active .sm_tabs_nav li.ui-state-active a {
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-primary-active .sm_tabs_nav li.ui-state-active:before {
	border-top-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs .sm_tabs_nav li.ui-state-active:after {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs.sm-same-bg.sm-bg-color-active {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-same-bg.sm-bg-color2-active {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
	color: <?php echo esc_attr( $tabs_hdr_color1 ); ?>;
}
.sm_tabs.sm-same-bg.sm-primary-active {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs.sm-same-bg.sm-primary-active .sm_tabs_nav li {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_tabs.sm-bg-color-content .sm-panel-wrap {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_tabs.sm-bg-color2-content .sm-panel-wrap {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php

/* Element - Vertical Tabs */
 
?>
.sm_vtabs .sm_tabs_nav li {
	border-color: <?php echo esc_attr( $bg_color ); ?>;
	border-right-color: <?php echo esc_attr( $vtabs_default_active_color ); ?>;
	background-color: <?php echo esc_attr( $vtabs_default_inactive_color ); ?>;
}
.sm_vtabs:not(.sm-style-outline) .sm_tabs_nav li:first-child {
	border-top-color: <?php echo esc_attr( $vtabs_default_inactive_color ); ?>;
}
.sm_vtabs .sm_tabs_nav li.ui-state-active {
	background-color: <?php echo esc_attr( $vtabs_default_active_color ); ?>;
	border-right: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs:not(.sm-style-outline) .sm_tabs_nav li.ui-state-active:first-child {
	border-top-color: <?php echo esc_attr( $vtabs_default_active_color ); ?>;
}
.sm_vtabs .sm_tabs_nav li:not(.ui-state-active) a:hover,
.sm_vtabs.sm-theme-light .sm_tabs_nav li:not(.ui-state-active) a:hover {
	background-color: <?php echo crf_change_hsl( $vtabs_default_active_color, 0, 0, -5 ); ?>;
}
.sm_vtabs .sm_tabs_nav a {
	color: <?php echo esc_attr( $vtabs_default_text_color ); ?>;
}
.sm_vtabs .sm_tabs_nav a:hover {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_vtabs .sm-panel-wrap {
	border-color: <?php echo esc_attr( $vtabs_default_active_color ); ?>;
	background-color: <?php echo esc_attr( $vtabs_default_active_color ); ?>;
	color: <?php echo esc_attr( $vtabs_default_text_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav li {
	border-color: <?php echo esc_attr( $bg_color ); ?>;
	border-right-color: <?php echo esc_attr( $vtabs_light_active_color ); ?>;
	background-color: <?php echo esc_attr( $vtabs_light_inactive_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav li:first-child {
	border-top-color: <?php echo esc_attr( $vtabs_light_inactive_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav li.ui-state-active {
	background-color: <?php echo esc_attr( $vtabs_light_active_color ); ?>;
	border-right: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav li.ui-state-active:first-child {
	border-top-color: <?php echo esc_attr( $vtabs_light_active_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav li:not(.ui-state-active) a:hover {
	background-color: <?php echo crf_change_hsl( $vtabs_light_active_color, 0, 0, -5 ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav a {
	color: <?php echo esc_attr( $vtabs_light_text_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm_tabs_nav a:hover {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_vtabs.sm-theme-light .sm-panel-wrap {
	border-color: <?php echo esc_attr( $vtabs_light_active_color ); ?>;
	background-color: <?php echo esc_attr( $vtabs_light_active_color ); ?>;
	color: <?php echo esc_attr( $vtabs_light_text_color ); ?>;
}

.sm_vtabs.sm-theme-dark .sm_tabs_nav li {
	border-color:<?php echo esc_attr( $vtabs_dark_active_color ); ?>;
	background-color: <?php echo esc_attr( $vtabs_dark_inactive_color ); ?>;
}
.sm_vtabs.sm-theme-dark .sm_tabs_nav li:first-child {
	border-top-color: <?php echo esc_attr( $vtabs_dark_inactive_color ); ?>;
}
.sm_vtabs.sm-theme-dark .sm_tabs_nav li.ui-state-active {
	background-color: <?php echo esc_attr( $vtabs_dark_active_color ); ?>;
	border-right: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs.sm-theme-dark .sm_tabs_nav li.ui-state-active:first-child {
	border-top-color: <?php echo esc_attr( $vtabs_dark_active_color ); ?>;
}
.sm_vtabs.sm-theme-dark .sm_tabs_nav li :not(.ui-state-active) a:hover {
	background-color: <?php echo crf_change_hsl( $vtabs_dark_active_color, 0, 0, 5 ); ?>;
}
.sm_vtabs.sm-theme-dark .sm_tabs_nav a {
	color: <?php echo esc_attr( $vtabs_dark_text_color ); ?>;
}
.sm_vtabs.sm-theme-dark .sm_tabs_nav a:hover {
	color: <?php echo esc_attr( $vtabs_dark_text_color ); ?>;
}
.sm_vtabs.sm-theme-dark .sm-panel-wrap {
	border-color: <?php echo esc_attr( $vtabs_dark_active_color ); ?>;
	background-color: <?php echo esc_attr( $vtabs_dark_active_color ); ?>;
	color: <?php echo crf_change_hsl( $vtabs_dark_text_color, 0, 0, -6.25 ); ?>;
}
.sm_vtabs.sm-style-outline .sm_tabs_nav a {
	color: <?php echo esc_attr( $vtabs_light_text_color ); ?>;
}
.sm_vtabs.sm-style-outline .sm_tabs_nav a:hover {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_vtabs.sm-style-outline .sm_tabs_nav li.ui-state-active {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
	border-right-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs.sm-style-outline .sm_tabs_nav li.ui-state-active a {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_vtabs.sm-style-outline .sm_tabs_nav li:not(.ui-state-active) a:hover {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs.sm-style-outline .sm_tabs_nav li,
.sm_vtabs.sm-style-outline .sm-panel-wrap {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs.sm-bg-color .sm_tabs_wrapper > .sm-panel-wrap {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_vtabs.sm-bg-color2 .sm_tabs_wrapper > .sm-panel-wrap {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php 

/* Element - Message */

?>
.sm_message_box.sm-primary {
	color: <?php echo esc_attr( $primary_color ); ?>;
	border-color: <?php echo esc_attr( $primary_color ); ?>;
	background-color: #cae1f8;
}
.sm_message_box.sm-primary.sm-style-solid {
	color: <?php echo esc_attr( $primary_color ); ?>;
	border-color: <?php echo esc_attr( $primary_color ); ?>;
	background-color: #cae1f8;
}
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-icon,
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-title,
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-content,
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-close {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-close:hover,
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-close:focus {
	color: <?php echo crf_change_hsl( $primary_color, 0, 0, 10 ) ?>;
}
.sm_message_box.sm-primary.sm-style-solid .sm_message_box-close:active:focus {
	color: <?php echo crf_change_hsl( $primary_color, 0, 0, -10 ) ?>;
}
.sm_message_box.sm-primary.sm-style-outline {
	color: <?php echo esc_attr( $primary_color ); ?>;
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-icon,
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-title,
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-content,
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-close {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-close:hover,
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-close:focus {
	color: <?php echo crf_change_hsl( $primary_color, 0, 0, 10 ) ?>;
}
.sm_message_box.sm-primary.sm-style-outline .sm_message_box-close:active:focus {
	color: <?php echo crf_change_hsl( $primary_color, 0, 0, -10 ) ?>;
}
.sm_message_box.sm-primary .sm_message_box-icon,
.sm_message_box.sm-primary .sm_message_box-title,
.sm_message_box.sm-primary .sm_message_box-content,
.sm_message_box.sm-primary .sm_message_box-close {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_message_box.sm-primary .sm_message_box-close:hover,
.sm_message_box.sm-primary .sm_message_box-close:focus {
	color: <?php echo crf_change_hsl( $primary_color, 0, 0, 10 ) ?>;
}
.sm_message_box.sm-primary .sm_message_box-close:active:focus {
	color: <?php echo crf_change_hsl( $primary_color, 0, 0, -10 ) ?>;
}
<?php 

/* Element - Pie chart */

?>
.sm_pie_chart_value {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm_pie_chart.sm-style2 .sm_pie_chart_value,
.sm_pie_chart.sm-style2 .sm_pie_chart_heading {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif;
}
<?php 

/* Element - Progress Bar */

?>
.sm-progressbar .gauge,
.sm-progressbar.sm-primary .gauge {
	background-color: <?php echo esc_attr( $primary_color ); ?>
}
.sm-progressbar .value {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif;
}
.sm-progressbar.sm-shape-square .meter {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
	border-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm-progressbar.sm-shape-square .value {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-progressbar.sm-shape-square .value:before {
	border-top-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php 

/* Element - Pricing Table */

?>
.sm-pricing-column-wrapper.sm-featured .featured-text {
	background-color: <?php echo esc_attr( $pt_theme_featured_color ); ?>;
}
.sm-pricing-table .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	-webkit-box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_default_border ); ?>;
	-moz-box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_default_border ); ?>;
	box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_default_border ); ?>;
}
.sm-pricing-table .sm-pricing-column {
	border-color: <?php echo esc_attr( $pt_theme_default_border ); ?>;
	background-color: <?php echo esc_attr( $pt_theme_default_bg1 ); ?>;
}
.sm-pricing-table .sm-pricing-column .header {
	color: <?php echo esc_attr( $pt_theme_default_heading_text ); ?>;
}
.sm-pricing-table .sm-pricing-column .features {
	border-color: <?php echo esc_attr( $color_scheme == 'dark' ? $pt_theme_default_bg1 : $pt_theme_default_border ); ?>;
	color: <?php echo esc_attr( $pt_theme_default_feature_text ); ?>;
}
.sm-pricing-table .sm-pricing-column .feature {
	border-color: <?php echo esc_attr( $color_scheme == 'dark' ? $pt_theme_default_bg1 : $pt_theme_default_border ); ?>;
}
<?php if ($color_scheme == 'dark' ) : ?>
.sm-pricing-table .sm-pricing-column-wrapper.sm-featured .sm-pricing-column {
	border: none;
}
<?php endif; ?>
.sm-pricing-table .sm-pricing-column .feature:nth-child(odd) {
	background-color: <?php echo esc_attr( $pt_theme_default_bg2 ); ?>;
}
.sm-pricing-table .sm-pricing-column .feature strong {
	border-color: <?php echo esc_attr( $pt_theme_default_heading_text ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	-webkit-box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_light_border ); ?>;
	-moz-box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_light_border ); ?>;
	box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_light_border ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column {
	border-color: <?php echo esc_attr( $pt_theme_light_border ); ?>;
	background-color: <?php echo esc_attr( $pt_theme_light_bg1 ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column .header {
	color: <?php echo esc_attr( $pt_theme_light_heading_text ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column .features {
	border-color: <?php echo esc_attr( $pt_theme_light_border ); ?>;
	color: <?php echo esc_attr( $pt_theme_light_feature_text ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column .feature {
	border-color: <?php echo esc_attr( $pt_theme_light_border ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column .feature:nth-child(odd) {
	background-color: <?php echo esc_attr( $pt_theme_light_bg2 ); ?>;
}
.sm-pricing-table.sm-theme-light .sm-pricing-column .feature strong {
	border-color: <?php echo esc_attr( $pt_theme_light_heading_text ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	background-color: <?php echo esc_attr( crf_change_hsl( $pt_theme_dark_bg1, 0, 0, 2 ) ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column-wrapper.sm-raised .feature:nth-child(odd) {
	background-color: <?php echo esc_attr( crf_change_hsl( $pt_theme_dark_bg2, 0, 0, 2 ) ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column {
	border-color: <?php echo esc_attr( $pt_theme_dark_border ); ?>;
	background-color: <?php echo esc_attr( $pt_theme_dark_bg1 ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column .header {
	color: <?php echo esc_attr( $pt_theme_dark_heading_text ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column .features {
	color: <?php echo esc_attr( $pt_theme_dark_feature_text ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column .feature:nth-child(odd) {
	background-color: <?php echo esc_attr( $pt_theme_dark_bg2 ); ?>;
}
.sm-pricing-table.sm-theme-dark .sm-pricing-column .feature strong {
	border-color: <?php echo esc_attr( $pt_theme_dark_heading_text ); ?>;
}

.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured .featured-text {
	border-color: <?php echo esc_attr( $pt_theme_default_bg1 ); ?>;
}
.sm-pricing-table.sm-style1.sm-theme-light .sm-pricing-column-wrapper.sm-featured .featured-text {
	border-color: <?php echo esc_attr( $pt_theme_light_bg1 ); ?>;
}
.sm-pricing-table.sm-style1.sm-theme-dark .sm-pricing-column-wrapper.sm-featured .featured-text {
	border-color: <?php echo esc_attr( $pt_theme_dark_bg1 ); ?>;
}
.sm-pricing-table.sm-style1.sm-theme-dark .sm-pricing-column-wrapper.sm-raised .featured-text {
	border-color: <?php echo esc_attr( crf_change_hsl( $pt_theme_dark_bg1, 0, 0, 2 ) ); ?>;
}
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper .header .title {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
	-webkit-box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($primary_color, 0, 0, -15 ) ); ?>;
	-moz-box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($primary_color, 0, 0, -15 ) ); ?>;
	box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($primary_color, 0, 0, -15 ) ); ?>;
}
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured .header .title {
	background-color: <?php echo esc_attr( $pt_theme_featured_color ); ?>;
	-webkit-box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($pt_theme_featured_color, 0, 0, -15 ) ); ?>;
	-moz-box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($pt_theme_featured_color, 0, 0, -15 ) ); ?>;
	box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($pt_theme_featured_color, 0, 0, -15 ) ); ?>;
}
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured.sm-primary .header .title {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
	-webkit-box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($primary_color, 0, 0, -15 ) ); ?>;
	-moz-box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($primary_color, 0, 0, -15 ) ); ?>;
	box-shadow: 0px 5px 0px <?php echo esc_attr( crf_change_hsl($primary_color, 0, 0, -15 ) ); ?>;
}
.sm-pricing-table.sm-style2 .sm-pricing-column-wrapper.sm-featured .header .price {
	border-color: <?php echo esc_attr( $pt_theme_featured_color ); ?>;
}
.sm-pricing-table.sm-style2 .sm-pricing-column-wrapper.sm-featured .header .price-inner {
	background-color: <?php echo esc_attr( $pt_theme_featured_color ); ?>;
}
.sm-pricing-table.sm-style2 .sm-pricing-column-wrapper .header .price,
.sm-pricing-table.sm-style2 .sm-pricing-column-wrapper.sm-primary .header .price {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-pricing-table.sm-style2 .sm-pricing-column-wrapper .header .price-inner,
.sm-pricing-table.sm-style2 .sm-pricing-column-wrapper.sm-primary .header .price-inner {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-pricing-table.sm-style2.sm-theme-dark .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	-webkit-box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_dark_border ); ?>;
	-moz-box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_dark_border ); ?>;
	box-shadow: 0 0 10px 2px <?php echo esc_attr( $pt_theme_dark_border ); ?>;
}
.sm-pricing-table.sm-style3 .header .price {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
	font-family: <?php echo esc_attr( $heading_font ); ?>, Arial, Helvetica, sans-serif;
}
.sm-pricing-table.sm-style3 .header .title {
	font-family: <?php echo esc_attr( $heading_font ); ?>, Arial, Helvetica, sans-serif;
	color: <?php echo esc_attr( $pt_theme_default_heading_text ); ?>;
}
.sm-pricing-table.sm-style3 .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	-webkit-box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_default_border); ?>;
	-moz-box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_default_border); ?>;
	box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_default_border); ?>;
}
.sm-pricing-table.sm-style3 .sm-pricing-column-wrapper.sm-primary .header .price {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-pricing-table.sm-style3.sm-theme-light .header .title {
	color: <?php echo esc_attr( $pt_theme_light_heading_text ); ?>;
}
.sm-pricing-table.sm-style3.sm-theme-light .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	-webkit-box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_light_border ); ?>;
	-moz-box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_light_border ); ?>;
	box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_light_border ); ?>;
}
.sm-pricing-table.sm-style3.sm-theme-dark .header .title {
	color: <?php echo esc_attr( $pt_theme_dark_heading_text ); ?>;
}
.sm-pricing-table.sm-style3.sm-theme-dark .sm-pricing-column-wrapper.sm-raised .sm-pricing-column {
	-webkit-box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_dark_border ); ?>;
	-moz-box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_dark_border ); ?>;
	box-shadow: 0 0 20px 2px <?php echo esc_attr( $pt_theme_dark_border ); ?>;
}
<?php // LESS INDEPENDENT BEGIN FOR BUTTON ?>
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured .sm-button {
	color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
}
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured .sm-button:hover,
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured .sm-button:focus {
	background-color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
	color: white !important;
}
.sm-pricing-table.sm-style1 .sm-pricing-column-wrapper.sm-featured .sm-button:active:focus {
	background-color: <?php echo crf_change_hsl( $pt_theme_featured_color, 0, 0, -8 ); ?> !important;
	border-color: <?php echo crf_change_hsl( $pt_theme_featured_color, 0, 0, -8 ); ?> !important;
	color: white !important;
}
.sm-pricing-table.sm-style2 .sm-button {
	color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
}
.sm-pricing-table.sm-style2 .sm-button:hover,
.sm-pricing-table.sm-style2 .sm-button:focus {
	background-color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_featured_color ); ?> !important;
	color: white !important;
}
.sm-pricing-table.sm-style2 .sm-button:active:focus {
	background-color: <?php echo crf_change_hsl( $pt_theme_featured_color, 0, 0, -8 ); ?> !important;
	border-color: <?php echo crf_change_hsl( $pt_theme_featured_color, 0, 0, -8 ); ?> !important;
	color: white !important;
}
.sm-pricing-table.sm-style3 .sm-button {
	color: <?php echo esc_attr( $pt_theme_default_heading_text ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_default_border ); ?> !important;
}
.sm-pricing-table.sm-style3 .sm-button:hover,
.sm-pricing-table.sm-style3 .sm-button:focus {
	background-color: <?php echo esc_attr( $pt_theme_default_heading_text ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_default_heading_text ); ?> !important;
	color: <?php echo esc_attr( $pt_style3_default_btn_hover ); ?> !important;
}
.sm-pricing-table.sm-style3 .sm-button:active:focus {
	background-color: <?php echo crf_change_hsl( $pt_theme_default_heading_text, 0, 0, -8 ); ?> !important;
	border-color: <?php echo crf_change_hsl( $pt_theme_default_heading_text, 0, 0, -8 ); ?> !important;
	color: <?php echo esc_attr( $pt_style3_default_btn_hover ); ?> !important;
}
.sm-pricing-table.sm-style3.sm-theme-light .sm-button {
	color: <?php echo esc_attr( $pt_theme_light_heading_text ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_light_border ); ?> !important;
}
.sm-pricing-table.sm-style3.sm-theme-light .sm-button:hover,
.sm-pricing-table.sm-style3.sm-theme-light .sm-button:focus {
	background-color: <?php echo esc_attr( $pt_theme_light_heading_text ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_light_heading_text ); ?> !important;
	color: white !important;
}
.sm-pricing-table.sm-style3.sm-theme-light .sm-button:active:focus {
	background-color: <?php echo crf_change_hsl( $pt_theme_light_heading_text, 0, 0, -8 ); ?> !important;
	border-color: <?php echo crf_change_hsl( $pt_theme_light_heading_text, 0, 0, -8 ); ?> !important;
	color: white !important;
}
.sm-pricing-table.sm-style3.sm-theme-dark .sm-button {
	color: <?php echo esc_attr( $pt_theme_dark_heading_text ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_dark_border ); ?> !important;
}
.sm-pricing-table.sm-style3.sm-theme-dark .sm-button:hover,
.sm-pricing-table.sm-style3.sm-theme-dark .sm-button:focus {
	background-color: <?php echo esc_attr( $pt_theme_dark_border ); ?> !important;
	border-color: <?php echo esc_attr( $pt_theme_dark_border ); ?> !important;
	color: black !important;
}
.sm-pricing-table.sm-style3.sm-theme-dark .sm-button:active:focus {
	background-color: <?php echo crf_change_hsl( $pt_theme_dark_border, 0, 0, -8 ); ?> !important;
	border-color: <?php echo crf_change_hsl( $pt_theme_dark_border, 0, 0, -8 ); ?> !important;
	color: black !important;
}
<?php // LESS INDEPENDENT END FOR BUTTON ?>
<?php 

/* Element - Seperator */

?>
.sm-separator.sm-heading-underline hr {
	border-top-color: <?php echo esc_attr( $heading_underline_color ); ?>
}
.sm-separator.sm-primary hr {
	border-top-color: <?php echo esc_attr( $primary_color ); ?>
}
.sm-separator.sm-style-diamond .diamond,
.sm-separator.sm-style-diamond .left-line,
.sm-separator.sm-style-diamond .left-line:before,
.sm-separator.sm-style-diamond .right-line,
.sm-separator.sm-style-diamond .right-line:before {
	background-color: <?php echo esc_attr( $border_color ); ?>
}
.sm-separator.sm-style-diamond.sm-heading-underline .diamond,
.sm-separator.sm-style-diamond.sm-heading-underline .left-line,
.sm-separator.sm-style-diamond.sm-heading-underline .left-line:before,
.sm-separator.sm-style-diamond.sm-heading-underline .right-line,
.sm-separator.sm-style-diamond.sm-heading-underline .right-line:before {
	background-color: <?php echo esc_attr( $heading_underline_color ); ?>
}
.sm-separator.sm-style-diamond.sm-primary .diamond,
.sm-separator.sm-style-diamond.sm-primary .left-line,
.sm-separator.sm-style-diamond.sm-primary .left-line:before,
.sm-separator.sm-style-diamond.sm-primary .right-line,
.sm-separator.sm-style-diamond.sm-primary .right-line:before {
	background-color: <?php echo esc_attr( $primary_color ); ?>
}
<?php 

/* Element - Team Member */

?>
.sm-team-member a .member-name:hover {
	color: <?php echo esc_attr( $primary_color ); ?>;	
}
.sm-team-member.sm-style1 .member-bg {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-member.sm-style2 .member-title,
.sm-team-member.sm-style3 .member-title {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.sm-team-member.sm-style2 .member-title {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-member.sm-style4 .image-wrap img {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-team-member.sm-style4 .image-wrap img:hover {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-member.sm-style4 .member-name {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-member.sm-style5 .image-wrap {
	border-bottom-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-member.sm-style6 .member-title:after {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php 

/* Element - Team Slider */

?>
.sm-team-slider .nav-control {
	border-color: <?php echo esc_attr( $team_slider_nav_color ); ?>;
}
.sm-team-slider .nav-control:hover {
	border-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-team-slider .team-slider-pagination a {
	background-color: <?php echo esc_attr( $team_slider_nav_color ); ?>;
}
.sm-team-slider .team-slider-pagination a:hover,
.sm-team-slider .team-slider-pagination a.selected {
	background-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-team-slider a .member-name:hover {
	color: <?php echo esc_attr( $primary_color ); ?>
}
.sm-team-slider.sm-style1 .member-social-link {
	border-color: <?php echo esc_attr( $team_link_color ); ?>;
	color: <?php echo esc_attr( $team_link_color ); ?>;
}
.sm-team-slider.sm-style1 .member-title {
	color: <?php echo esc_attr( $text_color_lightened ); ?>;
}
.sm-team-slider.sm-style1 .member-title:after {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-slider.sm-style1 .member-social-link:hover,
.sm-team-slider.sm-style1 .member-social-link:focus,
.sm-team-slider.sm-style3 .member-social-link:hover,
.sm-team-slider.sm-style3 .member-social-link:focus {
	background-color: <?php echo esc_attr( $primary_color ); ?> !important;
	border-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-team-slider.sm-style2 .member-title {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-team-slider.sm-style2 .member-social-link:hover,
.sm-team-slider.sm-style2 .member-social-link:focus {
	color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-team-slider.sm-style3 .member-name,
.sm-team-slider.sm-style3 .member-title {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.sm-team-slider.sm-style3 .member-title {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-team-slider-item .member-name {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
<?php 

/* Element - Counter Box */

?>
.sm-counterbox.sm-style-round .counterbox-container:hover .icon-wrap {
	border-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.sm-counterbox.sm-style-round .counterbox-container:hover .icon-wrap-inner {
	background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.sm-counterbox.sm-style-round .icon-wrap-inner:before {
	background-color: <?php echo esc_attr( $secondary_color ); ?>;
}
.sm-counterbox.sm-style-round .counter-value {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-counterbox.sm-style-split .cb-text,
.sm-counterbox.sm-style-split .counter-value {
	color: <?php echo esc_attr( $heading_color ); ?>;
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.sm-counterbox.sm-style-split .info-wrap {
	color: <?php echo esc_attr( $heading_color ); ?>;
	border-left-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-counterbox.sm-style-flip .cb-text {
	font-family: <?php echo esc_attr( $heading_font ); ?>;
}
.sm-counterbox.sm-style-flip .flip:nth-last-child(3n+4):after {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
<?php 

/* Element - Section Icon */

?>
.sm_section_icon.sm-style-def-grad1 .vline-circle {
	background-color: <?php echo esc_attr( $gradient1_end_color ); ?>;
}
.sm_section_icon.sm-style-def-grad2 .vline-circle {
	background-color: <?php echo esc_attr( $gradient2_end_color ); ?>;
}
.sm_section_icon.sm-primary .vline-circle {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_section_icon .vline-circle:before {
	background-color: <?php echo esc_attr( $heading_underline_color ); ?>;
}
.sm_section_icon.sm-wrap-circle.sm-primary .section_icon_inner {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_section_icon.sm-wrap-circle.sm-style-def-grad1 .section_icon_inner {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: -o-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
	background-image: linear-gradient(135deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 90%);
}
.sm_section_icon.sm-wrap-circle.sm-style-def-grad2 .section_icon_inner {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -o-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: linear-gradient(135deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
}
.sm_section_icon.sm-wrap-circle .section_icon_inner,
.sm_section_icon.sm-wrap-circle .section_icon_inner.sm-bg-color {
	border-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm_section_icon.sm-wrap-circle .section_icon_inner.sm-bg-color2 {
	border-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm_section_icon.sm-wrap-polygon.sm-primary polygon {
	fill: <?php echo esc_attr( $primary_color ); ?>;
}
.sm_section_icon.sm-wrap-polygon.sm-style-def-grad1 .stop_off0 {
	stop-color: <?php echo esc_attr( $gradient1_start_color ); ?>
}
.sm_section_icon.sm-wrap-polygon.sm-style-def-grad1 .stop_off100 {
	stop-color: <?php echo esc_attr( $gradient1_end_color ); ?>;
}
.sm_section_icon.sm-wrap-polygon.sm-style-def-grad2 .stop_off0 {
	stop-color: ?php echo esc_attr( $gradient2_start_color ); ?>;
}
.sm_section_icon.sm-wrap-polygon.sm-style-def-grad2 .stop_off100 {
	stop-color: <?php echo esc_attr( $gradient2_end_color ); ?>;
}
.sm_section_icon.sm-wrap-polygon svg, 
.sm_section_icon.sm-wrap-polygon svg.sm-bg-color {
	stroke: <?php echo esc_attr( $bg_color ); ?>;;
}
.sm_section_icon.sm-wrap-polygon svg.sm-bg-color2 {
	stroke: <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php 

/* Element - Testimonial Slider */

?>
.sm-testimonials.sm-style3 .ts-wrap {
	border-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials .ts-nav a {
	border-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials .ts-nav a.selected,
.sm-testimonials .ts-nav a:hover {
	background-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-testimonials .ts-name,
.sm-testimonials .ts-company,
.sm-testimonials .ts-content,
.sm-testimonials .ts-info {
	color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style1 .avatar-wrap:before,
.sm-testimonials.sm-style2 .avatar-wrap:before,
.sm-testimonials.sm-style4 .avatar-wrap:before {
	background-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style1 .content-wrap,
.sm-testimonials.sm-style2 .content-wrap {
	border-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style1 .content-wrap:before,
.sm-testimonials.sm-style1 .content-wrap:after,
.sm-testimonials.sm-style1 .content-wrap .ts-angle:after,
.sm-testimonials.sm-style1 .content-wrap .ts-angle:before,
.sm-testimonials.sm-style2 .content-wrap:before,
.sm-testimonials.sm-style2 .content-wrap:after,
.sm-testimonials.sm-style2 .content-wrap .ts-angle:before,
.sm-testimonials.sm-style2 .content-wrap .ts-angle:after {
	background-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style1 .ts-nav a.selected,
.sm-testimonials.sm-style1 .ts-nav a:hover {
	background-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style3 .avatar-wrap:before,
.sm-testimonials.sm-style3 .avatar-wrap:after {
	border-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style3 .avatar-inner {
	border-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style4 .ts-company,
.sm-testimonials.sm-style4 .ts-name {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.sm-testimonials.sm-style4 .ts-company {
	color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-testimonials.sm-style4 .ts-nav a {
	background-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonials.sm-style5 .ts-item-wrap a {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php 

/* Element - Numbered Thumbnail */

?>
.sm-numbered-thumbnail .nt-number {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif;
	background-color: <?php echo esc_attr( $primary_color ); ?>;
	border-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-numbered-thumbnail.sm-primary .nt-number {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-numbered-thumbnail.sm-bg-color-border .nt-number {
	border-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-numbered-thumbnail.sm-bg-color2-border .nt-number {
	border-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php 

/* Element - Quotes Slider */

?>
.sm-quotes-slider {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.quotes-nav a {
	background-color: <?php echo esc_attr( $heading_color ); ?>;
}
.quotes-nav a:hover,
.quotes-nav a.selected {
	background-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-style1 .sm-quote {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-style1 .sm-quote:before,
.sm-style1 .sm-quote .quote-name:before,
.sm-style1 .sm-quote:after,
.sm-style1 .sm-quote .quote-name:after {
	border-color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-style1 .sm-quote .quote-content {
	font-family: '<?php echo esc_attr( $quotes_content_font_family ); ?>', Arial, Helvetica, sans-serif;
	border-color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-style2 .quote-symbol:before,
.sm-style2 .quote-symbol:after {
	border-left-color: <?php echo esc_attr( $primary_color ); ?>;
	border-top-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-style2 .quote-name {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-style2.sm-theme-light .quote-content {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-style3 .quote-inner-wrap {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	color: <?php echo esc_attr( $heading_color ); ?>;
}
<?php 

/* Element - Feature Box */

?>
.sm-featurebox .featurebox-title {
	font-family: '<?php echo esc_attr( $featurebox_title_font_family ); ?>', Arial, Helvetica, sans-serif;
}
.sm-featurebox .featurebox-title.default {
	font-size: <?php echo esc_attr( $featurebox_title_font_size ); ?>px;
	font-weight: <?php echo esc_attr( $featurebox_title_font_weight ); ?>;
	letter-spacing: <?php echo esc_attr( $featurebox_title_letter_spacing ); ?>px;
}
.sm-featurebox .featurebox-icon {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-featurebox .featurebox-icon i.sm-primary {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-featurebox .featurebox-icon i.sm-style-def-grad1:before {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient1_start_color ); ?> 10%, <?php echo esc_attr( $gradient1_end_color ); ?> 70%);
	color: <?php echo esc_attr( $gradient1_end_color ); ?>;
}
.sm-featurebox .featurebox-icon i.sm-style-def-grad2:before {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 70%);
	color: <?php echo esc_attr( $gradient2_end_color ); ?>;
}
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon,
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon.sm-primary	{
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon.sm-bg-color	{
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon.sm-bg-color2	{
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon.sm-primary	{
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon.sm-bg-color	{
	border-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon.sm-bg-color2	{
	border-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon i:after {
	-webkit-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $border_color ); ?>;
	-moz-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $border_color ); ?>;
	box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $border_color ); ?>;
}
.sm-featurebox.sm-wrap-double-circle .featurebox-icon,
.sm-featurebox.sm-wrap-double-circle .featurebox-icon.sm-primary {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-featurebox.sm-wrap-double-circle .featurebox-icon.sm-bg-color {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-featurebox.sm-wrap-double-circle .featurebox-icon.sm-bg-color2 {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm-featurebox.sm-wrap-double-circle .border-overlay,
.sm-featurebox.sm-wrap-double-circle .border-overlay.sm-bg-color {
	border-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-featurebox.sm-wrap-double-circle .border-overlay.sm-primary-color {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-featurebox.sm-wrap-double-circle .border-overlay.sm-bg-color2 {
	border-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon.sm-primary i:after,
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon.sm-primary i:after,
.sm-featurebox.sm-wrap-double-circle .featurebox-icon.sm-primary i:after {
	-webkit-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $primary_color ); ?>;
	-moz-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $primary_color ); ?>;
	box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $primary_color ); ?>;
}
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon.sm-bg-color i:after,
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon.sm-bg-color i:after,
.sm-featurebox.sm-wrap-double-circle .featurebox-icon.sm-bg-color i:after {
	-webkit-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $bg_color ); ?>;
	-moz-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $bg_color ); ?>;
	box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $bg_color ); ?>;
}
.sm-featurebox.sm-wrap-solid-circle .featurebox-icon.sm-bg-color2 i:after,
.sm-featurebox.sm-wrap-outlined-circle .featurebox-icon.sm-bg-color2 i:after,
.sm-featurebox.sm-wrap-double-circle .featurebox-icon.sm-bg-color2 i:after {
	-webkit-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $bg_color2 ); ?>;
	-moz-box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $bg_color2 ); ?>;
	box-shadow: 0 0 0 2px rgba(255, 255, 255, 0), 0 0 0 4px <?php echo esc_attr( $bg_color2 ); ?>;
}
<?php 

/* Element - Contact Form 7 */

?>
.sm-contact-form .wpcf7 input[type=text],
.sm-contact-form .wpcf7 input[type=email],
.sm-contact-form .wpcf7 input[type=URL],
.sm-contact-form .wpcf7 input[type=tel],
.sm-contact-form .wpcf7 input[type=number],
.sm-contact-form .wpcf7 input[type=date],
.sm-contact-form .wpcf7 textarea,
.sm-contact-form .wpcf7 select {
	font-size: <?php echo esc_attr( $text_font_size ); ?>px;
	color: <?php echo esc_attr( $text_color ); ?>;
}
.sm-contact-form .wpcf7 input[type=text].sm-style-outline,
.sm-contact-form .wpcf7 input[type=email].sm-style-outline,
.sm-contact-form .wpcf7 input[type=URL].sm-style-outline,
.sm-contact-form .wpcf7 input[type=tel].sm-style-outline,
.sm-contact-form .wpcf7 input[type=number].sm-style-outline,
.sm-contact-form .wpcf7 input[type=date].sm-style-outline,
.sm-contact-form .wpcf7 textarea.sm-style-outline,
.sm-contact-form .wpcf7 select.sm-style-outline {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-contact-form .wpcf7 input[type=text].sm-style-solid,
.sm-contact-form .wpcf7 input[type=email].sm-style-solid,
.sm-contact-form .wpcf7 input[type=URL].sm-style-solid,
.sm-contact-form .wpcf7 input[type=tel].sm-style-solid,
.sm-contact-form .wpcf7 input[type=number].sm-style-solid,
.sm-contact-form .wpcf7 input[type=date].sm-style-solid,
.sm-contact-form .wpcf7 textarea.sm-style-solid,
.sm-contact-form .wpcf7 select.sm-style-solid {
	background-color: <?php echo esc_attr( $bg_color2 ); ?>;
	border-color: <?php echo esc_attr( $bg_color2 ); ?>;
}
.sm-contact-form .wpcf7 input[type=text].sm-style-solid:focus,
.sm-contact-form .wpcf7 input[type=email].sm-style-solid:focus,
.sm-contact-form .wpcf7 input[type=URL].sm-style-solid:focus,
.sm-contact-form .wpcf7 input[type=tel].sm-style-solid:focus,
.sm-contact-form .wpcf7 input[type=number].sm-style-solid:focus,
.sm-contact-form .wpcf7 input[type=date].sm-style-solid:focus,
.sm-contact-form .wpcf7 textarea.sm-style-solid:focus,
.sm-contact-form .wpcf7 select.sm-style-solid:focus {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-contact-form .wpcf7 input[type=text].sm-style-underline,
.sm-contact-form .wpcf7 input[type=email].sm-style-underline,
.sm-contact-form .wpcf7 input[type=URL].sm-style-underline,
.sm-contact-form .wpcf7 input[type=tel].sm-style-underline,
.sm-contact-form .wpcf7 input[type=number].sm-style-underline,
.sm-contact-form .wpcf7 input[type=date].sm-style-underline,
.sm-contact-form .wpcf7 textarea.sm-style-underline,
.sm-contact-form .wpcf7 select.sm-style-underline {
	border-bottom-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-contact-form .wpcf7 input[type=text].sm-style-underline:focus,
.sm-contact-form .wpcf7 input[type=email].sm-style-underline:focus,
.sm-contact-form .wpcf7 input[type=URL].sm-style-underline:focus,
.sm-contact-form .wpcf7 input[type=tel].sm-style-underline:focus,
.sm-contact-form .wpcf7 input[type=number].sm-style-underline:focus,
.sm-contact-form .wpcf7 input[type=date].sm-style-underline:focus,
.sm-contact-form .wpcf7 textarea.sm-style-underline:focus,
.sm-contact-form .wpcf7 select.sm-style-underline:focus {
	border-bottom-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-contact-form .wpcf7 .wpcf7-form-control-wrap:after {
	color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-subscribe-form .button-wrap input {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif;
}
.sm-contact-form .wpcf7 button.sm-style-underline {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-contact-form .wpcf7 button.sm-style-underline,
.sm-contact-form .wpcf7 button.sm-style-underline:before {
	border-bottom-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php 

/* Element - Social Links */

?>
.sm-social-links .social-link {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-social-links .social-link:after {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-social-links.sm-style-outline .social-link {
	color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-social-links.sm-style-outline .social-link:before {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
<?php 

/* Element - Image Slider */

?>
.sm-image-slider {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-image-slider .sm-preview-slider {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-image-slider .sm-thumbs-carousel .slides li {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-image-slider .sm-thumbs-carousel .slides li.flex-active-slide {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-image-slider .flex-control-paging li a:hover,
.sm-image-slider .flex-control-paging li a.flex-active {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-image-slider.sm-bullet-shape-square .flex-direction-nav a:hover {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php 

/* Element - Countdown */

?>
.sm-countdown.sm-style1 element,
.sm-countdown.sm-style1 .unit {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif !important;
}
.sm-countdown.sm-style2 .element,
.sm-countdown.sm-style2 .unit {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif !important;
}
.sm-countdown.sm-style2 .unit {
	color: <?php echo esc_attr( $primary_color ); ?> !important;
}
.sm-countdown.sm-style3 .element {
	border-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
<?php 

/* Element - Progress Steps */

?>
.sm-progress-steps .step .ps-circle-wrap {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif;
}
.sm-progress-steps .step .ps-circle-wrap span {
	background-color: <?php echo esc_attr( $ps_circle_wrap_color ); ?>;
}
.sm-progress-steps .step .ps-circle-wrap,
.sm-progress-steps .step:before,
.sm-progress-steps .step:after {
	border-color: <?php echo esc_attr( $ps_circle_wrap_color ); ?>;
}
.sm-progress-steps .step .ps-title:after {
	border-top-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step.left .flowline {
	border-left-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step.right .flowline {
	border-right-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step.first .step-icon,
.sm-progress-steps2 .workflow-step.last .step-icon {
	border-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step .title {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step .flowline {
	border-top-color: <?php echo esc_attr( $primary_color ); ?>;
	border-bottom-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step .step-icon i {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps2 .workflow-step.style-gray .title {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
.sm-progress-steps2 .workflow-step.style-gray .flowline {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
.sm-progress-steps2 .workflow-step.style-gray .step-icon i {
	border-color: <?php echo esc_attr( $border_color ); ?>;
	color: <?php echo esc_attr( $heading_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-progress-steps3 .step:before,
.sm-progress-steps3 .step:after {
	border-color: <?php echo esc_attr( $text_color ); ?>;
}
.sm-progress-steps3 .step .ps-rect-wrap {
	color: <?php echo esc_attr( $text_color ); ?>;
}
.sm-progress-steps3 .step .ps-rect-wrap .step-number {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-progress-steps3 .step .ps-arrow-icon {
	background-color: <?php echo esc_attr( $text_color ); ?>;
}
<?php 

/* Element - Latest Tweet */

?>
.sm-latest-tweet.sm-type1 .tweet-name,
.sm-latest-tweet.sm-type1 .tweet-time {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.sm-latest-tweet.sm-type1.sm-wrap-solid-circle .tweet-icon {
	border-color: <?php echo crf_change_hsl( $primary_color, 0, 0, -10 ); ?>;
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-latest-tweet .tweet-pagination a.selected,
.sm-latest-tweet .tweet-pagination a:hover {
	background-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
<?php

/* Element - Timeline */

?>
.sm-timeline .date-wrap,
.sm-timeline .te-date {
	font-family: '<?php echo esc_attr( $text_font2 ); ?>', Arial, Helvetica, sans-serif;
}
.sm-timeline .date-wrap {
	border-color: <?php echo esc_attr( $timeline_spine_color ); ?>;
}
.sm-timeline .timeline-spine {
	background-color: <?php echo esc_attr( $timeline_spine_color ); ?>;
}
.sm-timeline .te-content-wrap {
	border-color: <?php echo esc_attr( $timeline_border_color ); ?>;
}
.sm-timeline .border-part-top {
	border-top-color: <?php echo esc_attr( $timeline_border_color ); ?>;
}
.sm-timeline .border-part-bottom {
	border-bottom-color: <?php echo esc_attr( $timeline_border_color ); ?>;
}
.sm-timeline .angle-part:before {
	border-bottom-color: <?php echo esc_attr( $timeline_border_color ); ?>;
}
.sm-timeline .grid-item-wrap {
	border-color: <?php echo esc_attr( $timeline_border_color ); ?>;
	background-color: <?php echo esc_attr( $bg_color ); ?>;
}
.sm-timeline .anchor-point {
	border-color: <?php echo esc_attr( $timeline_spine_color ); ?>;
}
.sm-timeline .timeline-element-inner:hover .anchor-point {
	border-color: <?php echo esc_attr( $timeline_spine_hover_color ); ?>;
}
.sm-timeline .timeline-element-inner:hover .te-content-wrap,
.sm-timeline .timeline-element-inner:hover .border-part-top,
.sm-timeline .timeline-element-inner:hover .border-part-bottom,
.sm-timeline .timeline-element-inner:hover .angle-part {
	background-color: rgba(0, 0, 0, 0.025);
}
.sm-timeline .timeline-element-inner:hover .angle-part:after {
	border-left-color: rgba(0, 0, 0, 0.025) !important;
	border-right-color: rgba(0, 0, 0, 0.025) !important;
}
.sm-timeline .te-title {
	color: <?php echo esc_attr( $heading_color ); ?>;
}
@media (min-width: 768px) {
	.sm-timeline .left-side .border-part-top,
	.sm-timeline .left-side .angle-part:before,
	.sm-timeline .left-side .border-part-bottom {
		border-right-color: <?php echo esc_attr( $timeline_border_color ); ?>;
	}
	.sm-timeline .left-side .grid-item-wrap:before {
		border-left-color: <?php echo esc_attr( $timeline_border_color ); ?>;
	}
	.sm-timeline .left-side .grid-item-wrap:after {
		border-left-color: <?php echo esc_attr( $bg_color ); ?>;
	}
	.sm-timeline .right-side .border-part-top,
	.sm-timeline .right-side .angle-part:before,
	.sm-timeline .right-side .border-part-bottom {
		border-left-color: <?php echo esc_attr( $timeline_border_color ); ?>;
	}
	.sm-timeline .right-side .grid-item-wrap:before {
		border-right-color: <?php echo esc_attr( $timeline_border_color ); ?>;
	}
	.sm-timeline .right-side .grid-item-wrap:after {
		border-right-color: <?php echo esc_attr( $bg_color ); ?>;
	}
}
<?php 

/* Element - Image */

?>
.sm-image .pp-image-hover i {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
.sm-image .sm-action-text:before {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php 

/* Element - Testimonial */

?>
.sm-testimonial .ts-name {
	color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonial .avatar-wrap:before {
	background-color: <?php echo esc_attr( $ts_main_color ); ?>;
}
.sm-testimonial .ts-name,
.sm-testimonial .ts-company {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
<?php 

/* Element - Readmore link */

?>
.sm-readmore a {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-readmore a:hover {
	color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-readmore.sm-style1 a:before {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-readmore.sm-style1 a:after {
	border-color: transparent <?php echo esc_attr( $primary_color ) ?>;
}
.sm-readmore.sm-style1 a:hover:before {
	background-color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-readmore.sm-style1 a:hover:after {
	border-color: transparent <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-readmore.sm-style2 a {
	font-family: '<?php echo esc_attr( $heading_font ); ?>', Arial, Helvetica, sans-serif;
}
.sm-readmore.sm-style2 a:before {
	background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
	background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
	background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
	background-image: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
}
.sm-readmore.sm-style2 a:after {
	background-image: -webkit-linear-gradient(right, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
	background-image: -moz-linear-gradient(right, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
	background-image: -o-linear-gradient(right, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
	background-image: linear-gradient(to left, rgba(0, 0, 0, 0) 0%, <?php echo esc_attr( $border_color ); ?>);
}
<?php 

/* Element - Contact Info */

?>
footer .sm-contact-info:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .sm-contact-info .field {
	color: <?php echo crf_change_hsl($footer_text_color, 0, -1, -10 ); ?>;
}
header .sm-contact-info:not(:last-child),
.content-area .sm-contact-info:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header .sm-contact-info .field,
.content-area .sm-contact-info .field {
	color: <?php echo crf_change_hsl($text_color, 0, -1, -10 ); ?>;
}
<?php 

/* Element - Multi Scroll */

?>
#multiscroll-nav li a span {
	background-color: <?php echo esc_attr( $border_color ); ?>;
}
#multiscroll-nav li a.active span {
	background-color: <?php echo esc_attr( $primary_color ); ?>;
}
<?php 

/* Google Map */

?>
.sm-google-map .sm-infobox {
	background-color: <?php echo esc_attr( $bg_color ); ?>;
	border-color: <?php echo esc_attr( $bg_color ); ?>;
}
<?php 

/* Pageable Container */

?>
.sm-pageable-container .carousel-control:hover {
	border-color: <?php echo esc_attr( $primary_color ); ?> !important;
}
<?php 

/* Widgets */

?>
.content-area .crf-widget > h4:first-child:after,
header .crf-widget > h4:first-child:after {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Widget - Calendar */

?>
header .widget_calendar #today,
.content-area .widget_calendar #today {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Widget - Link Widgets */

?>
footer .widget_archive li:not(:last-child),
footer .widget_pages li:not(:last-child),
footer .widget_rss li:not(:last-child),
footer .widget_meta li:not(:last-child),
footer .widget_recent_entries li:not(:last-child),
footer .widget_recent_comments li:not(:last-child),
footer .sm-widget-useful-links li:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .widget_archive li:before,
footer .widget_pages li:before,
footer .widget_rss li:before,
footer .widget_meta li:before,
footer .widget_recent_entries li:before,
footer .widget_recent_comments li:before,
footer .sm-widget-useful-links li:before {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
footer .widget_archive li a,
footer .widget_pages li a,
footer .widget_rss li a,
footer .widget_meta li a,
footer .widget_recent_entries li a,
footer .widget_recent_comments li a,
footer .sm-widget-useful-links li a {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer .widget_archive li a:hover,
footer .widget_pages li a:hover,
footer .widget_rss li a:hover,
footer .widget_meta li a:hover,
footer .widget_recent_entries li a:hover,
footer .widget_recent_comments li a:hover,
footer .sm-widget-useful-links li a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
header .widget_archive li:not(:last-child),
.content-area .widget_archive li:not(:last-child),
header .widget_pages li:not(:last-child),
.content-area .widget_pages li:not(:last-child),
header .widget_rss li:not(:last-child),
.content-area .widget_rss li:not(:last-child),
header .widget_meta li:not(:last-child),
.content-area .widget_meta li:not(:last-child),
header .widget_recent_entries li:not(:last-child),
.content-area .widget_recent_entries li:not(:last-child),
header .widget_recent_comments li:not(:last-child),
.content-area .widget_recent_comments li:not(:last-child),
header .sm-widget-useful-links li:not(:last-child),
.content-area .sm-widget-useful-links li:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header .widget_archive li a,
.content-area .widget_archive li a,
header .widget_pages li a,
.content-area .widget_pages li a,
header .widget_rss li a,
.content-area .widget_rss li a,
header .widget_meta li a,
.content-area .widget_meta li a,
header .widget_recent_entries li a,
.content-area .widget_recent_entries li a,
header .widget_recent_comments li a,
.content-area .widget_recent_comments li a,
header .sm-widget-useful-links li a,
.content-area .sm-widget-useful-links li a {
	color: <?php echo esc_attr( $text_color ) ?>;
}
header .widget_archive li a:hover,
.content-area .widget_archive li a:hover,
header .widget_pages li a:hover,
.content-area .widget_pages li a:hover,
header .widget_rss li a:hover,
.content-area .widget_rss li a:hover,
header .widget_meta li a:hover,
.content-area .widget_meta li a:hover,
header .widget_recent_entries li a:hover,
.content-area .widget_recent_entries li a:hover,
header .widget_recent_comments li a:hover,
.content-area .widget_recent_comments li a:hover,
header .sm-widget-useful-links li a:hover,
.content-area .sm-widget-useful-links li a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
header .widget_recent_entries .post-date,
.content-area .widget_recent_entries .post-date {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
header .widget_recent_comments .comment-author-link,
.content-area .widget_recent_comments .comment-author-link {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Widget - Categories (including Woocommerce product categories) */

?>
header .widget_categories > ul > li,
.content-area .widget_categories > ul > li {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header .widget_categories > ul > li > a,
.content-area .widget_categories > ul > li > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
header .widget_categories > ul > li > ul.children,
.content-area .widget_categories > ul > li > ul.children {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
header .widget_categories > ul > li > ul.children > li > a,
.content-area .widget_categories > ul > li > ul.children > li > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
header .widget_categories ul.children li a,
.content-area .widget_categories ul.children li a {
	color: <?php echo esc_attr( $text_color ) ?>;
}
header .widget_categories a:hover,
.content-area .widget_categories a:hover {
	color: <?php echo esc_attr( $primary_color ) ?> !important;
}
footer .widget_categories > ul > li {
	border-bottom-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .widget_categories > ul > li > a {
	color: <?php echo esc_attr( $footer_text_color_lightened ) ?>;
}
footer .widget_categories > ul > li > ul.children {
	border-top-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .widget_categories > ul > li > ul.children > li > a {
	color: <?php echo esc_attr( $footer_text_color_lightened ) ?>;
}
footer .widget_categories ul.children li a {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer .widget_categories a:hover {
	color: <?php echo esc_attr( $primary_color ) ?> !important ;
}
header .widget_product_categories > ul > li,
.content-area .widget_product_categories > ul > li {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header .widget_product_categories > ul > li > a,
.content-area .widget_product_categories > ul > li > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
header .widget_product_categories > ul > li > ul.children,
.content-area .widget_product_categories > ul > li > ul.children {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
header .widget_product_categories > ul > li > ul.children > li > a,
.content-area .widget_product_categories > ul > li > ul.children > li > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
header .widget_product_categories ul.children li a,
.content-area .widget_product_categories ul.children li a {
	color: <?php echo esc_attr( $text_color ) ?>;
}
header .widget_product_categories a:hover,
.content-area .widget_product_categories a:hover {
	color: <?php echo esc_attr( $primary_color ) ?> !important;
}
footer .widget_product_categories > ul > li {
	border-bottom-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .widget_product_categories > ul > li > a {
	color: <?php echo esc_attr( $footer_text_color_lightened ) ?>;
}
footer .widget_product_categories > ul > li > ul.children {
	border-top-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .widget_product_categories > ul > li > ul.children > li > a {
	color: <?php echo esc_attr( $footer_text_color_lightened ) ?>;
}
footer .widget_product_categories ul.children li a {
	color: <?php echo esc_attr( $footer_text_color ) ?>;
}
footer .widget_product_categories a:hover {
	color: <?php echo esc_attr( $primary_color ) ?> !important ;
}
<?php 

/* Widget - Tags */

?>
footer .tagcloud a {
	border-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer.style1 .tagcloud a:hover,
footer.style3 .tagcloud a:hover,
footer.style4 .tagcloud a:hover {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -o-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: linear-gradient(to right, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
}
footer.style2 .tagcloud a {
	background-color: <?php echo esc_attr( $footer_bg_color3 ) ?>;
}
footer.style2 .tagcloud a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
header .tagcloud a,
.content-area .tagcloud a {
	background-color: <?php echo esc_attr( $grey_color ) ?>;
}
header .tagcloud a:hover,
.content-area .tagcloud a:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Widget - Search */

?>
footer .widget_search {
	background-color: <?php echo esc_attr( $footer_bg_color3 ) ?>;
}
header .widget_search,
.content-area .widget_search {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
header .widget_search input.search-submit,
.content-area .widget_search input.search-submit {
	color: <?php echo esc_attr( $text_color ) ?>;
}
header .widget_search button.search-submit,
.content-area .widget_search button.search-submit {
	color: <?php echo esc_attr( $text_color ) ?>;
}
.content-area.content-blog .widget_search {
	border-color: <?php echo esc_attr( $bg_color ) ?>;
}
<?php 

/* Widget - Recent Tweets */
 
?>
footer .sm-widget-tweets a:not(:hover) {
	color: <?php echo esc_attr( crf_change_hsl( $footer_text_color, 0, 0, 15 ) ) ?>;
}
footer .sm-widget-tweets .sm-tweet-container:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .sm-widget-tweets .twitter-icon {
	background-color: <?php echo esc_attr( $footer_bg_color3 ) ?>;
	color: <?php echo esc_attr( $footer_bg_color ) ?>;
}
header .sm-widget-tweets a:not(:hover),
.content-area .sm-widget-tweets a:not(:hover) {
	color: <?php echo esc_attr( $text_color_lightened ) ?>;
}
header .sm-widget-tweets .sm-tweet-container:not(:last-child),
.content-area .sm-widget-tweets .sm-tweet-container:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header .sm-widget-tweets .twitter-icon,
.content-area .sm-widget-tweets .twitter-icon {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php 

/* Widget - Accordion */

?>
.crf-widget .sm_accordion .sm_accordion_header:not(.ui-state-active):hover a {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
footer .crf-widget .sm_accordion .sm_accordion_section:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $footer_border_color ) ?>;
}
footer .crf-widget .sm_accordion .sm_accordion_content {
	color: <?php echo esc_attr( $footer_text_color_lightened ) ?>;
}
header .crf-widget .sm_accordion .sm_accordion_section:not(:last-child),
.content-area .crf-widget .sm_accordion .sm_accordion_section:not(:last-child) {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
header .crf-widget .sm_accordion .sm_accordion_content,
.content-area .crf-widget .sm_accordion .sm_accordion_content {
	color: <?php echo esc_attr( $text_color_lightened ) ?>;
}
<?php 

/* Widget - Contact Form 7 */

?>
footer .crf-widget .wpcf7 input[type=text],
footer .crf-widget .wpcf7 input[type=email],
footer .crf-widget .wpcf7 input[type=URL],
footer .crf-widget .wpcf7 input[type=tel],
footer .crf-widget .wpcf7 input[type=number],
footer .crf-widget .wpcf7 input[type=date],
footer .crf-widget .wpcf7 textarea,
footer .crf-widget .wpcf7 select {
	border-color: <?php echo esc_attr( $footer_bg_color3 ) ?>;
}
footer .crf-widget .wpcf7 input[type=text]:focus,
footer .crf-widget .wpcf7 input[type=email]:focus,
footer .crf-widget .wpcf7 input[type=URL]:focus,
footer .crf-widget .wpcf7 input[type=tel]:focus,
footer .crf-widget .wpcf7 input[type=number]:focus,
footer .crf-widget .wpcf7 input[type=date]:focus,
footer .crf-widget .wpcf7 textarea:focus,
footer .crf-widget .wpcf7 select:focus,
footer .crf-widget .wpcf7 input[type=text]:active,
footer .crf-widget .wpcf7 input[type=email]:active,
footer .crf-widget .wpcf7 input[type=URL]:active,
footer .crf-widget .wpcf7 input[type=tel]:active,
footer .crf-widget .wpcf7 input[type=number]:active,
footer .crf-widget .wpcf7 input[type=date]:active,
footer .crf-widget .wpcf7 textarea:active,
footer .crf-widget .wpcf7 select:active {
	border-color: <?php echo esc_attr( $secondary_color ) ?>;
}
footer .crf-widget .wpcf7 input[type=submit],
footer .crf-widget .wpcf7 button {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
footer .crf-widget .wpcf7 input[type=submit]:hover,
footer .crf-widget .wpcf7 button:hover {
	background-color: <?php echo esc_attr( $secondary_hover_color ) ?>;
}
header .wpcf7 input[type=text],
.content-area .wpcf7 input[type=text],
header .wpcf7 input[type=email],
.content-area .wpcf7 input[type=email],
header .wpcf7 input[type=URL],
.content-area .wpcf7 input[type=URL],
header .wpcf7 input[type=tel],
.content-area .wpcf7 input[type=tel],
header .wpcf7 input[type=number],
.content-area .wpcf7 input[type=number],
header .wpcf7 input[type=date],
.content-area .wpcf7 input[type=date],
header .wpcf7 textarea,
.content-area .wpcf7 textarea,
header .wpcf7 select,
.content-area .wpcf7 select {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
header .wpcf7 input[type=text]:focus,
.content-area .wpcf7 input[type=text]:focus,
header .wpcf7 input[type=email]:focus,
.content-area .wpcf7 input[type=email]:focus,
header .wpcf7 input[type=URL]:focus,
.content-area .wpcf7 input[type=URL]:focus,
header .wpcf7 input[type=tel]:focus,
.content-area .wpcf7 input[type=tel]:focus,
header .wpcf7 input[type=number]:focus,
.content-area .wpcf7 input[type=number]:focus,
header .wpcf7 input[type=date]:focus,
.content-area .wpcf7 input[type=date]:focus,
header .wpcf7 textarea:focus,
.content-area .wpcf7 textarea:focus,
header .wpcf7 select:focus,
.content-area .wpcf7 select:focus,
header .wpcf7 input[type=text]:active,
.content-area .wpcf7 input[type=text]:active,
header .wpcf7 input[type=email]:active,
.content-area .wpcf7 input[type=email]:active,
header .wpcf7 input[type=URL]:active,
.content-area .wpcf7 input[type=URL]:active,
header .wpcf7 input[type=tel]:active,
.content-area .wpcf7 input[type=tel]:active,
header .wpcf7 input[type=number]:active,
.content-area .wpcf7 input[type=number]:active,
header .wpcf7 input[type=date]:active,
.content-area .wpcf7 input[type=date]:active,
header .wpcf7 textarea:active,
.content-area .wpcf7 textarea:active,
header .wpcf7 select:active,
.content-area .wpcf7 select:active {
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
.crf-widget .wpcf7 input[type=submit],
.crf-widget .wpcf7 button {
	background-color: <?php echo esc_attr( $grey_color ) ?>;
}
.crf-widget .wpcf7 input[type=submit]:hover,
.crf-widget .wpcf7 button:hover {
	background-color: <?php echo esc_attr( crf_change_hsl( $grey_color, 0, 0, 10 ) ) ?>;
}
.content-area.content-blog .wpcf7 input[type=text],
.content-area.content-blog .wpcf7 input[type=email],
.content-area.content-blog .wpcf7 input[type=URL],
.content-area.content-blog .wpcf7 input[type=tel],
.content-area.content-blog .wpcf7 input[type=number],
.content-area.content-blog .wpcf7 input[type=date],
.content-area.content-blog .wpcf7 textarea,
.content-area.content-blog .wpcf7 select {
	border-color: <?php echo esc_attr( $bg_color ) ?>;
}

<?php 

/* Widget - Instagram */

?>
.sm-widget-instagram .sm-instagram-pics > li .hover-link {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-widget-instagram .sm-instagram-pics > li .hover-link:after {
	background-color: <?php echo esc_attr( $footer_bg_color3 ) ?>;
}
<?php 

/* Typography */

?>
<?php /* Headings */ ?>
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
	font-family: '<?php echo esc_attr( $heading_font ) ?>', sans-serif;
	font-weight: <?php echo esc_attr( $heading_font_weight ) ?>;
}
h1, .h1 {
	font-size: <?php echo esc_attr( $h1_font_size ) ?>px;
}
h2, .h2 {
	font-size: <?php echo esc_attr( $h2_font_size ) ?>px;
}
h3, .h3 {
	font-size: <?php echo esc_attr( $h3_font_size ) ?>px;
}
h4, .h4 {
	font-size: <?php echo esc_attr( $h4_font_size ) ?>px;
}
h5, .h5 {
	font-size: <?php echo esc_attr( $h5_font_size ) ?>px;
}
h6, .h6 {
	font-size: <?php echo esc_attr( $h6_font_size ) ?>px;
}
<?php /* Blog and portfolio headings */ ?>
.sm-post-comments .comment-list .comment-box .author,
.sm-post-comments .leave-comment,
.sm-post-comments .comments-label,
.sm-post .title,
.sm-post .post-link,
.sm-post-prevnext-link a,
.sm-related-posts .title-related-posts,
.sm-related-posts .title,
.sm-related-portfolio .related-title,
.sm-portfolio .title,
.sm-portfolio .social-links,
.sm-portfolio .social-links span,
.woocommerce .product-category .category-title {
	font-weight: <?php echo esc_attr( $post_heading_font_weight ) ?>;
}
<?php /* Text */ ?>
body {
	font-family: '<?php echo esc_attr( $text_font ) ?>', sans-serif;
	font-size: <?php echo esc_attr( $text_font_size ) ?>px;
	font-weight: <?php echo esc_attr( $text_font_weight ) ?>;
	line-height: <?php echo esc_attr( $text_line_height ) ?>;
}
<?php /* Header */ ?>
header.header-v1 .topbar {
	font-family: '<?php echo esc_attr( $topbar_font ) ?>', sans-serif;
	font-size: <?php echo esc_attr( $topbar_font_size ) ?>px;
	font-weight: <?php echo esc_attr( $topbar_font_weight ) ?>;
}
header.header-v1 .topbar i {
	font-size: <?php echo esc_attr( $topbar_icon_size ) ?>px;
}
header.header-v1 .main-menu {
	font-family: '<?php echo esc_attr( $nav_font ) ?>', sans-serif;
}
header.header-v1 .main-menu .menu-item a,
header.header-v1 .main-menu .menu-item span {
	font-size: <?php echo esc_attr( $nav_font_size ) ?>px;
}
header.header-v1 .main-menu .menu > .menu-item > a {
	font-weight: <?php echo esc_attr( $main_nav_font_weight ) ?>;
}
header.header-v1 .main-menu .sub-menu .menu-item a,
header.header-v1 .main-menu .crf-megamenu-wrapper .menu-item a {
	font-weight: <?php echo esc_attr( $dropdown_item_font_weight ) ?>;
}
header.header-v1 .main-menu .crf-megamenu-wrapper .crf-megamenu-column > a > span {
	font-size: <?php echo esc_attr( $nav_font_size ) + 4 ?>px;
}
header.header-v1 .main-menu .crf-megamenu-wrapper .crf-megamenu-column > a {
	font-weight: <?php echo esc_attr( $heading_font_weight ) ?>;
}
header.header-v1 .main-menu .menu-icon a {
	font-size: <?php echo esc_attr( $nav_font_size ) + 1 ?>px;
}
header.header-v1 .main-menu #cart-size {
	font-family: '<?php echo esc_attr( $topbar_font ) ?>', sans-serif;
}
<?php /* Sticky header */ ?>
.sticky-nav:not(.sm-mobile-header).sticky .menu > .menu-item > a > span {
	font-size: <?php echo esc_attr( $nav_font_size ) - 1 ?>px !important;
}
<?php /* Search Box */ ?>
header.header-v1 .main-search-form .search-button {
	font-size: <?php echo esc_attr( $nav_font_size ) ?>px;
}
.sm-mobile-header {
	font-family: '<?php echo esc_attr( $nav_font ) ?>', sans-serif;
}
.sm-mobile-header .mobile-menu a {
	font-size: <?php echo esc_attr( $mobile_menu_font_size ) ?>px;
}
.sm-mobile-header .mobile-menu ul.menu > li > a {
	font-weight: <?php echo esc_attr( $main_nav_font_weight ) ?>;
}
.sm-mobile-header .mobile-menu ul.menu > li > a .chevron {
	font-size: <?php echo esc_attr( $mobile_menu_font_size ) - 1 ?>px;
}
<?php /* Titlebar */ ?>
.sm-titlebar.small,
.sm-titlebar.large,
.sm-titlebar.large2 {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-titlebar.small.small3 .page-title {
	font-family: '<?php echo esc_attr( $text_font ) ?>', sans-serif;
}
<?php /* Footer */ ?>
footer {
	font-family: '<?php echo esc_attr( $footer_text_font ) ?>', sans-serif;
}
footer .style3-social-links-area i {
	font-size: <?php echo esc_attr( $footer_style3_social_size ) ?>px;
}
footer .crf-widget > h4:first-child {
	font-family: '<?php echo esc_attr( $footer_heading_font ) ?>', sans-serif;
	font-size: <?php echo esc_attr( $footer_heading_font_size1 ) ?>px;
	font-weight: <?php echo esc_attr( $footer_heading_font_weight ) ?>;
}
footer .copyright {
	font-family: '<?php echo esc_attr( $footer_copyright_font ) ?>', sans-serif;
}
footer .copyright .social-links a {
	font-size: <?php echo esc_attr( $footer_social_icon_size ) ?>px;
}
footer .copyright .copyright-text a {
	color: <?php echo esc_attr( $primary_color ); ?>;
}
footer .copyright .copyright-text a:hover {
	color: <?php echo esc_attr( $primary_hover_color ); ?>;
}
footer .copyright .copyright-text,
footer .copyright .social-links a,
footer .copyright .footer-menu .menu-item {
	<?php $footer_copyright_max_font_size = ( $footer_social_icon_size > $text_font_size )? $footer_social_icon_size : $text_font_size; ?>
	line-height: <?php echo intval( $footer_copyright_max_font_size * $text_line_height ) ?>px;
}
footer input[type=email],
footer input[type=text],
footer input[type=password],
footer input[type=tel],
footer input[type=url],
footer input[type=search],
footer textarea,
footer select {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
footer input[type=submit],
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
footer.style2 .crf-widget > h4:first-child {
	font-size: <?php echo esc_attr( $footer_heading_font_size2 ) ?>px;
	font-weight: <?php echo esc_attr( $footer_heading_font_weight ) ?>;
}
footer.style3 .crf-widget > h4:first-child {
	font-size: <?php echo esc_attr( $footer_heading_font_size2 ) ?>px;
	font-weight: <?php echo esc_attr( $footer_heading_font_weight ) ?>;
}
footer.style4 .crf-widget > h4:first-child {
	font-size: <?php echo esc_attr( $footer_heading_font_size2 ) ?>px;
	font-weight: <?php echo esc_attr( $footer_heading_font_weight ) ?>;
}
footer.style3 .copyright .footer-menu .menu-item,
footer.style4 .copyright .footer-menu .menu-item {
	font-size: <?php echo esc_attr( $text_font_size ) - 2 ?>px;
}
<?php /* Blog */ ?>
.sm-post .featured-media .post-date .date {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post .post-meta {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post .mejs-container .mejs-controls .mejs-time .mejs-currenttime,
.sm-post .mejs-container .mejs-controls .mejs-time .mejs-duration {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', Helvetica, sans-serif;
}
.sm-post.smaller .readmore-wrapper .sm-comments-link {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post-quote .title {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post-quote.smaller .post-meta {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post-single .post-meta2-wrapper {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post-single .post-tags a {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-author-box .author-info .author-label {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-post-comments .comment-list .comment-box .date {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
	font-size: <?php echo intval( $text_font_size - 1 ) ?>px;
}
.sm-post-comments .comment-list .comment-box .comment-edit-link,
.sm-post-comments .comment-list .comment-box .comment-reply-link {
	font-size: <?php echo intval( $text_font_size - 2 ) ?>px;
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.crf-pagination .pagelink {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
<?php /* Portfolio */ ?>
.sm-portfolio .post-meta {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
.sm-portfolio .post-meta2 {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
}
<?php /* Widgets */ ?>
.widget_categories > ul > li:not(:first-child):after {
	top: <?php echo esc_attr( $text_font_size / 2 + 5 ) ?>px;
}
.widget_categories > ul > li > ul.children > li:after {
	top: <?php echo esc_attr( $text_font_size / 2 + 5 ) ?>px;
}
.tagcloud a {
	font-family: '<?php echo esc_attr( $text_font2 ) ?>', sans-serif;
	font-size: <?php echo esc_attr( $text_font_size ) ?>px !important;
}
<?php 

/* Animations */

?>
@-webkit-keyframes sonarEffect {
	0% {
		opacity: 0.3;
	}
	40% {
		opacity: 0.5;
		box-shadow: 0 0 0 2px rgba(255,255,255,0), 0 0 0 4px <?php echo esc_attr( $primary_color ) ?>;
	}
	100% {
		box-shadow: 0 0 0 2px rgba(255,255,255,0), 0 0 0 4px <?php echo esc_attr( $primary_color ) ?>;
		-webkit-transform: scale(1.3);
		opacity: 0;
	}
}
@-moz-keyframes sonarEffect {
	0% {
		opacity: 0.3;
	}
	40% {
		opacity: 0.5;
		box-shadow: 0 0 0 2px rgba(255,255,255,0), 0 0 0 4px <?php echo esc_attr( $primary_color ) ?>;
	}
	100% {
		box-shadow: 0 0 0 2px rgba(255,255,255,0), 0 0 0 4px <?php echo esc_attr( $primary_color ) ?>;
		-moz-transform: scale(1.3);
		opacity: 0;
	}
}
@keyframes sonarEffect {
	0% {
		opacity: 0.3;
	}
	40% {
		opacity: 0.5;
		box-shadow: 0 0 0 2px rgba(255,255,255,0), 0 0 0 4px <?php echo esc_attr( $primary_color ) ?>;
	}
	100% {
		box-shadow: 0 0 0 2px rgba(255,255,255,0), 0 0 0 4px <?php echo esc_attr( $primary_color ) ?>;
		transform: scale(1.3);
		opacity: 0;
	}
}
<?php 

/* Woocommerce */

?>
<?php /* Archive */ ?>
.woocommerce .woocommerce-result-count,
.woocommerce-page .woocommerce-result-count {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce select.orderby,
.woocommerce-page select.orderby {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	color: <?php echo esc_attr( $woocommerce_catalog_color ) ?>;
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	font-size: <?php echo esc_attr( $woocommerce_catalog_font_size ) ?>px;
}
.woocommerce div.product.in-loop {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product span.onsale {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce div.product .cart-loading i {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce div.product .buttons .button {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce div.product .buttons .see_details_button:hover {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce div.product .buttons .add_to_cart_button {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .buttons .add_to_cart_button:hover {
	background-color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.woocommerce div.product .product-content {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product .product-content .star-rating-container .line {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product .product-content .star-rating {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .product-content .star-rating:before {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .product-content .star-rating.no-ratings {
	color: <?php echo esc_attr( $woocommerce_rating_zero_color ) ?>;
}
.woocommerce div.product .product-content .star-rating.no-ratings:before {
	color: <?php echo esc_attr( $woocommerce_rating_zero_color ) ?>;
}
.woocommerce div.product .product-content .product-title a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .product-content .product-categories {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce div.product .product-content .product-categories a:not(:hover) {
	color: <?php echo esc_attr( $woocommerce_product_category_color ) ?>;
}
.woocommerce div.product .product-content span.price ins,
.woocommerce div.product .product-content span.price .amount {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce div.product .product-content span.price del {
	color: <?php echo esc_attr( $woocommerce_price_before_sale_color ) ?>;
}
.woocommerce div.product .product-content span.price del .amount {
	color: <?php echo esc_attr( $woocommerce_price_before_sale_color ) ?>;
}
.woocommerce div.product .product-content span.price ins,
.woocommerce div.product .product-content span.price del,
.woocommerce div.product .product-content span.price .amount {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce .product-category .category-title .count {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Single */ ?>
.woocommerce div.product .summary .star-rating {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .summary .categories a {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	color: <?php echo esc_attr( $woocommerce_product_category_color ) ?>;
}
.woocommerce div.product .summary .categories a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .summary .price {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce div.product .summary .price del {
	color: <?php echo esc_attr( $woocommerce_price_before_sale_color ) ?>;
}
.woocommerce div.product .summary .price > .amount,
.woocommerce div.product .summary .price ins,
.woocommerce div.product .summary .price del {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce div.product .summary .sku-info .sku_wrapper {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce div.product .summary .short-desc {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product .summary .variations td.value > select {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
	color: <?php echo esc_attr( $woocommerce_catalog_color ) ?>;
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	font-size: <?php echo esc_attr( $woocommerce_catalog_font_size ) ?>px;
}
.woocommerce div.product .summary .reset-variations-link-wrapper .reset_variations {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce div.product .summary .reset-variations-link-wrapper .reset_variations:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .summary .button.alt,
.woocommerce div.product .summary .single_view_cart_button.alt {
	background-image: -webkit-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -moz-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: -o-linear-gradient(-45deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
	background-image: linear-gradient(135deg, <?php echo esc_attr( $gradient2_start_color ); ?> 10%, <?php echo esc_attr( $gradient2_end_color ); ?> 90%);
}
.woocommerce div.product .summary .cart {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product .summary .product_meta {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce div.product .summary .product-meta-table tr td.label {
	color: <?php echo esc_attr( $woocommerce_meta_name_color ) ?>;
}
.woocommerce div.product .summary .product-meta-table tr:last-child {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product .summary .product-meta-table a {
	color: <?php echo esc_attr( $text_color ) ?>;
}
.woocommerce div.product .summary .product-meta-table a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce .sm-quantity-input .block {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce .sm-quantity-input .quantity-inc,
.woocommerce .sm-quantity-input .quantity-dec {
	color: <?php echo esc_attr( $text_color ) ?>;
}
.sm-woocommerce-social-share .sm-sharer-link {
	color: <?php echo esc_attr( $portfolio_social_link_color ) ?>;
}
.sm-woocommerce-social-share .sm-sharer-link:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce div.product .woocommerce-tabs h2,
.woocommerce div.product .woocommerce-tabs h3,
.woocommerce div.product .woocommerce-tabs h4 {
	font-size: <?php echo intval( $h3_font_size ) + 2 ?>px;
}
.woocommerce div.product .woocommerce-tabs ul.tabs > li {
	background-color: <?php echo sm_change_hsl( $bg_color2, 0, 0, -3 ) ?>;
	color: <?php echo esc_attr( $accordion_hdr_color ) ?>;
}
.woocommerce div.product .woocommerce-tabs ul.tabs > li.active {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.woocommerce div.product .woocommerce-tabs .shop_attributes th,
.woocommerce div.product .woocommerce-tabs .shop_attributes td {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce div.product .woocommerce-tabs .shop_attributes th {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce #reviews #comments ol.commentlist li.comment {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce #reviews #comments ol.commentlist li.comment img.avatar {
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.woocommerce #reviews #comments ol.commentlist li.comment .star-rating {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce #reviews #comments ol.commentlist li.comment time {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce #reviews #review_form_wrapper label {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce #reviews #review_form_wrapper .comment-form-rating .stars a {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.woocommerce #reviews #review_form_wrapper .required {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.woocommerce #reviews #review_form_wrapper input[type=submit] {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce #reviews #review_form_wrapper input[type=submit]:hover {
	background-color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
div.related.products > h2 {
	font-size: <?php echo intval( $h3_font_size ) + 2 ?>px;
}
<?php /* Pagination */ ?>
.woocommerce nav.woocommerce-pagination ul.page-numbers .page-numbers {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	font-size: <?php echo esc_attr( $text_font_size ) ?>px;
	border-color: <?php echo esc_attr( $border_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
.woocommerce nav.woocommerce-pagination ul.page-numbers .page-numbers.current {
	background-color: <?php echo esc_attr( $heading_color ) ?>;
	border-color: <?php echo esc_attr( $heading_color ) ?>;
	color: <?php echo esc_attr( $bg_color ) ?>;
}
.woocommerce nav.woocommerce-pagination ul.page-numbers a.page-numbers:hover {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
	border-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Cart */ ?>
.woocommerce table.shop_table {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	font-size: <?php echo esc_attr( $text_font_size ) ?>px;
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce table.shop_table thead {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce table.shop_table td.product-name a {
	font-size: <?php echo intval( $text_font_size ) + 1 ?>px;
}
.woocommerce table.shop_table td.product-name a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce table.shop_table td.product-name .variation td {
	font-size: <?php echo intval( $text_font_size ) - 1 ?>px;
}
.woocommerce table.shop_table td.product-price {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	font-size: <?php echo intval( $text_font_size ) + 2 ?>px;
}
.woocommerce table.shop_table td.product-quantity .block {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce table.shop_table td.product-subtotal {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	font-size: <?php echo intval( $text_font_size ) + 2 ?>px;
}
.woocommerce table.shop_table .row-actions {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
.woocommerce table.shop_table td.actions #coupon_code {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce table.shop_table td.actions .coupon input[type=submit] {
	background-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.woocommerce table.shop_table td.actions .buttons input[type=submit] {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: -o-linear-gradient(left, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
	background-image: linear-gradient(to right, <?php echo esc_attr( $gradient1_start_color ) ?>, <?php echo esc_attr( $gradient1_end_color ) ?>);
}
.woocommerce table.shop_table td.actions .checkout-button {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce-cart .cart-collaterals .col-cart-shipping-calc .shipping-calculator-form .button {
	background-color: <?php echo esc_attr( $grey_color ) ?>;
}
.woocommerce-cart .cart-collaterals .cart_totals {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce-cart .cart-collaterals .cart_totals table th,
.woocommerce-cart .cart-collaterals .cart_totals table td {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
.woocommerce-cart .cart-collaterals .cart_totals table tr:not(:last-child) th,
.woocommerce-cart .cart-collaterals .cart_totals table tr:not(:last-child) td {
	border-bottom-color: <?php echo esc_attr( $bg_color ) ?>;
}
.woocommerce-cart .cart-collaterals .cart_totals table .cart-subtotal td,
.woocommerce-cart .cart-collaterals .cart_totals table .order-total td {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce-cart .cart-collaterals .cart_totals table .shipping td {
	color: <?php echo esc_attr( $text_color_lightened ) ?>;
}
<?php /* Checkout */ ?>
.woocommerce form.checkout .select2-container .select2-choice {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce form.checkout label {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce form.checkout #payment ul.payment_methods li {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce form.checkout #payment div.payment_box {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
.woocommerce form.checkout #payment div.payment_box:after {
	border-bottom-color: <?php echo esc_attr( $bg_color2 ) ?>;
}
.woocommerce form.checkout_coupon {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce form.checkout input[type=submit],
.woocommerce form.checkout_coupon input[type=submit] {
	background-color: <?php echo esc_attr( $primary_color ) ?> !important;
}
<?php /* Widgets */ ?>
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {
	background-color: <?php echo sm_change_hsl( $bg_color2, 0, 0, -5 ) ?>;
}
.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider-range {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider-handle {
	background-color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount span {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce ul.product_list_widget li {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce ul.product_list_widget li .product-info {
	color: <?php echo esc_attr( $woocommerce_widget_price_color ) ?>;
}
.woocommerce ul.product_list_widget li .product-info .product-link {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.woocommerce ul.product_list_widget li .product-info .product-link:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.woocommerce ul.product_list_widget li .product-info .star-rating {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce ul.product_list_widget li .product-info span.amount {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
}
.woocommerce ul.product_list_widget li .product-info del {
	color: <?php echo esc_attr( $text_color ) ?>;
}
.widget_recent_reviews ul.product_list_widget li > a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.widget_recent_reviews ul.product_list_widget li > a:hover {
	color: <?php echo esc_attr( $secondary_color ) ?>;
}
.widget_recent_reviews ul.product_list_widget li .star-rating {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Messages */ ?>
.woocommerce .woocommerce-message,
.woocommerce .woocommerce-info,
.woocommerce .woocommerce-error {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.woocommerce .woocommerce-message:before {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.woocommerce .woocommerce-message a.button {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
<?php /* Mini cart */ ?>
.sm-minicart li {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-minicart li .remove {
	color: <?php echo esc_attr( $heading_color ) ?> !important;
}
.sm-minicart li .product-info span.quantity {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-mini-cart-container .total .label,
.widget_shopping_cart_content .total .label {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
.sm-mini-cart-container .total .amount,
.widget_shopping_cart_content .total .amount {
	font-family: <?php echo esc_attr( $text_font2 ) ?>, sans-serif;
	color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-mini-cart-container .buttons .button,
.widget_shopping_cart_content .buttons .button {
	background-color: <?php echo esc_attr( $primary_color ) ?> !important;
}
.sm-mini-cart-container .buttons .button.view-cart-button,
.widget_shopping_cart_content .buttons .button.view-cart-button {
	background-color: <?php echo esc_attr( $grey_color ) ?> !important;
}
<?php

/* bbPress */

?>
#bbpress-forums a {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
#bbpress-forums a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results {
	border-color: <?php echo esc_attr( $border_color ) ?>;
	font-size: <?php echo esc_attr( $text_font_size ) ?>px;
}
#bbpress-forums li.bbp-header {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
	color: <?php echo esc_attr( $heading_color ) ?>;
}
#bbpress-forums li.bbp-body ul.forum,
#bbpress-forums li.bbp-body ul.topic {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
	background-color: <?php echo esc_attr( $bg_color ) ?>;
}
#bbpress-forums fieldset.bbp-form legend {
	color: <?php echo esc_attr( $heading_color ) ?>;
	font-size: <?php echo esc_attr( $h4_font_size ) ?>px;
	font-family: <?php echo esc_attr( $heading_font ) ?>, sans-serif;
}
div.bbp-template-notice,
div.bbp-template-notice,
div.indicator-hint {
	background-color: <?php echo esc_attr( $bg_color2 ) ?> !important;
}
<?php

/* BuddyPress */

?>
#buddypress div.item-list-tabs ul li a,
#buddypress div.item-list-tabs ul li span {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
#buddypress div.item-list-tabs ul li.current a,
#buddypress div.item-list-tabs ul li.current span {
	color: <?php echo esc_attr( $heading_color ) ?>;
}
#buddypress div.item-list-tabs ul li a:hover {
	color: <?php echo esc_attr( $primary_color ) ?>;
}
#buddypress table {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
#buddypress table.forum thead tr,
#buddypress table.messages-notices thead tr,
#buddypress table.notifications thead tr,
#buddypress table.notifications-settings thead tr,
#buddypress table.profile-fields thead tr,
#buddypress table.profile-settings thead tr,
#buddypress table.wp-profile-fields thead tr {
	background-color: <?php echo esc_attr( $bg_color2 ) ?>;
	color: <?php echo esc_attr( $heading_color ) ?>;
}
#buddypress .avatar-nav-items li.current a {
	color: <?php echo crf_change_hsl( esc_attr( $heading_color ), 0, 0, -20 ); ?>;
}
<?php 

/* New blog styles */

?>
.sm-posts.sm-posts-simple-style .sm-post .sm-sticky-meta-wrapper a {
	color: <?php echo esc_attr( $post_readmore_link_color ) ?>;	
}
.sm-posts.sm-posts-simple-style .sm-post .sm-simple-more {
	color: <?php echo esc_attr( $post_readmore_link_color ) ?>;	
}
.sm-posts.sm-posts-simple-style .sm-post .sm-sticky-meta-wrapper a:hover {
	color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-posts.sm-posts-simple-style .sm-post .sm-simple-more:hover {
	color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-posts-simple-style .sm-post .sm-sticky-meta-wrapper {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-posts-simple-style .sm-post .sm-sticky-meta-wrapper .sm-sticky-meta-social {
	border-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-posts-simple-list-style .sm-post {
	border-bottom-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-posts-simple-list-style .sm-post.sticky {
	border-bottom-color: <?php echo esc_attr( $secondary_color ) ?>;
}
.sm-posts-simple-list-style .sm-post.sm-post-quote.smaller + .sm-post {
	border-top-color: <?php echo esc_attr( $border_color ) ?>;
}
.sm-posts-modern-style .sm-post ul.post-categories > li {
	background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.sm-posts-modern-style .sm-post ul.post-categories > li:hover {
	background-color: <?php echo esc_attr( $primary_hover_color ) ?>;
}
.sm-posts-simple-style .sm-post h3.title {
	font-weight: <?php echo esc_attr( $post_heading_font_weight ) ?>;
}
.sm-posts-modern-style .sm-post .hover-overlay h3.title {
	font-weight: <?php echo esc_attr( $post_heading_font_weight ) ?>;
}