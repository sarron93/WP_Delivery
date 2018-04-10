<?php

/****************************************************
 *				WP Theme Customizer					*
 ****************************************************/

require_once FRAMEWORK_PATH . '/lib/customizer/customizer-library/customizer-library.php';
require_once FRAMEWORK_PATH . '/lib/customizer/customizer-admin.php';
require_once FRAMEWORK_PATH . '/lib/customizer/default-options.php';
require_once FRAMEWORK_PATH . '/lib/customizer/color-scheme.php';

function crf_remove_default_sections( $wp_customize ) {
	$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'themes' );
	$wp_customize->remove_control( 'title_tagline' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_control( 'blogname' );
	$wp_customize->remove_control( 'blogdescription' );
}
add_action( 'customize_register', 'crf_remove_default_sections' );

function crf_customizer_interface_js() {
	wp_enqueue_script( 
			'crystal-customizer-interface', 
			FRAMEWORK_URI . '/assets/js/customizer.js',
			array( 'jquery' ),
			false,
			true
	);
	
	global $crf_color_scheme_colors;
	global $crf_color_scheme_options;
	global $crf_default_color_scheme;
	wp_localize_script( 
		'crystal-customizer-interface', 
		'crf_customizer_options',
		array(
			'color_scheme_colors' => $crf_color_scheme_colors,
			'default_color_scheme' => $crf_default_color_scheme,
			'color_scheme_options' => $crf_color_scheme_options
		)
	);
}
add_action( 'customize_controls_print_footer_scripts', 'crf_customizer_interface_js' );

function crf_customizer_library_options() {
	global $crf_default_options;

	// Stores all the controls that will be added
	$options = array();
	// Stores all the sections to be added
	$sections = array();
	// Stores all the panels to be added
	$panels = array();
	// Adds the sections to the $options array
	$options['sections'] = $sections;
	
	$priority = 10;
	
	/* Some common option choices */
	$show_hide = array(
			'show' => esc_html__( 'Show', 'semona' ),
			'hide' => esc_html__( 'Hide', 'semona' ),
	);
	$yes_no = array(
			'yes' => esc_html__( 'Yes', 'semona' ),
			'no' => esc_html__( 'No', 'semona' ),
	);
	$font_choices = customizer_library_get_font_choices();
	$font_weights = crf_get_font_weights();
	$sidebars = sm_get_all_sidebars();
	$sidebar_positions = sm_sidebar_positions();
	
	/* General */
	
	$panel = 'panel-general';
	$panels[] = array(
			'id' => $panel,
			'title' => esc_html__( 'General', 'semona' ),
			'priority' => $priority++
	);
	
	// General - Site Layout
	$section = 'general-sitelayout';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Site Layout', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Choose Wide/Boxed site layout here.', 'semona' ),
	);
	$options['site-layout'] = array(
			'id' => 'site-layout',
			'label'   => esc_html__( 'Site Layout', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_site_layouts(),
			'default' => $crf_default_options['site-layout'],
	);
	
	// General - Site Width
	$section = 'general-sitewidth';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Container & Sidebar Width', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Change content and sidebar width here. Width of contents will be limited by Main Container Width and placed in center, but you can use stretched rows in page builder to fill content in browser width. Sidebar width will be calculated as percentage of Main Container Width. Enter all values without unit, e.g. 1200', 'semona' ),
	);
	$options['main-width'] = array(
			'id' => 'main-width',
			'label'   => esc_html__( 'Main Container Width (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['main-width'],
	);
	$options['sidebar-width'] = array(
			'id' => 'sidebar-width',
			'label'   => esc_html__( 'Sidebar Width (%)', 'semona' ),
			'section' => $section,
			'type'	  => "slider",
			'input_attrs' => array(
					'min'   => 15,
					'max'   => 50,
					'step'  => 1
			),
			'default' => $crf_default_options['sidebar-width'],
			'description' => esc_html__( "In Percent ( Min: 5%, Max: 50% )", 'semona' ),
	);
	
	// General - Logo
	$section = 'general-logo';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Logo', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Please select logo images here. You need to choose logo images for light and dark main menu skins, and also retina logo images.', 'semona' ),
	);
	$options['logo-light'] = array(
			'id' => 'logo-light',
			'label'   => esc_html__( 'Logo For Light Skin', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['logo-light'],
	);
	$options['logo-light-retina'] = array(
			'id' => 'logo-light-retina',
			'label'   => esc_html__( 'Retina Logo For Light Skin', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['logo-light-retina'],
	);
	$options['logo-dark'] = array(
			'id' => 'logo-dark',
			'label'   => esc_html__( 'Logo For Dark Skin', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['logo-dark'],
	);
	$options['logo-dark-retina'] = array(
			'id' => 'logo-dark-retina',
			'label'   => esc_html__( 'Retina Logo For Dark Skin', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['logo-dark-retina'],
	);
	
	// General - Colors
	$section = 'general-colors';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Colors', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Change overall color settings here. These settings will be applied to all elements, but specific color settings such as shortcode color options will have higher priority.', 'semona' ),
	);
	$options['color-scheme'] = array(
			'id' => 'color-scheme',
			'label'   => esc_html__( 'Color Scheme', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices'  => array(
					'light' => esc_html__( 'Light', 'semona' ),
					'dark' => esc_html__( 'Dark', 'semona' ),
			),
			'default' => $crf_default_options['color-scheme'],
			'transport' => 'postMessage',
	);
	$options['primary-color'] = array(
			'id' => 'primary-color',
			'label'   => esc_html__( 'Primary Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['primary-color'],
	);
	$options['secondary-color'] = array(
			'id' => 'secondary-color',
			'label'   => esc_html__( 'Secondary Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['secondary-color'],
	);
	$options['gradient1-start-color'] = array(
			'id' => 'gradient1-start-color',
			'label'   => esc_html__( 'Gradient 1 Start Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['gradient1-start-color'],
	);
	$options['gradient1-end-color'] = array(
			'id' => 'gradient1-end-color',
			'label'   => esc_html__( 'Gradient 1 End Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['gradient1-end-color'],
	);
	$options['gradient2-start-color'] = array(
			'id' => 'gradient2-start-color',
			'label'   => esc_html__( 'Gradient 2 Start Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['gradient2-start-color'],
	);
	$options['gradient2-end-color'] = array(
			'id' => 'gradient2-end-color',
			'label'   => esc_html__( 'Gradient 2 End Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['gradient2-end-color'],
	);
	$options['text-color'] = array(
			'id' => 'text-color',
			'label'   => esc_html__( 'Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['text-color'],
	);
	$options['heading-color'] = array(
			'id' => 'heading-color',
			'label'   => esc_html__( 'Heading Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['heading-color'],
	);
	$options['heading-light-color'] = array(
			'id' => 'heading-light-color',
			'label'   => esc_html__( 'Thin Heading Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['heading-light-color'],
	);
	$options['heading-underline-color'] = array(
			'id' => 'heading-underline-color',
			'label'   => esc_html__( 'Heading Underline Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['heading-underline-color'],
	);
	$options['border-color'] = array(
			'id' => 'border-color',
			'label'   => esc_html__( 'Border Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['border-color'],
	);
	$options['bg-color'] = array(
			'id' => 'bg-color',
			'label'   => esc_html__( 'Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['bg-color'],
	);
	$options['bg-color2'] = array(
			'id' => 'bg-color2',
			'label'   => esc_html__( 'Secondary Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['bg-color2'],
	);
	
	// General - Content Background
	$section = 'general-content-bg';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Content Background', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can choose background image for content area here.', 'semona' ),
	);
	$options['content-bg-image'] = array(
			'id' => 'content-bg-image',
			'label'   => esc_html__( 'Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['content-bg-image'],
	);
	$options['content-bg-repeat'] = array(
			'id' => 'content-bg-repeat',
			'label'   => esc_html__( 'Background Repeat', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_bg_repeats(),
			'default' => $crf_default_options['content-bg-repeat'],
	);
	
	// General - Boxed Outer Background
	$section = 'general-boxed-outer-bg';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Boxed Outer Background', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change outer background in boxed mode here.', 'semona' ),
			'active_callback' => 'crf_is_layout_boxed',
	);
	$options['outer-bg-type'] = array(
			'id' => 'outer-bg-type',
			'label'   => esc_html__( 'Outer Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_outer_bg_types(),
			'default' => $crf_default_options['outer-bg-type'],
	);
	$options['outer-bg-pattern'] = array(
			'id' => 'outer-bg-pattern',
			'label'   => esc_html__( 'Outer Background Pattern', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_outer_bg_patterns(),
			'default' => $crf_default_options['outer-bg-pattern'],
			'active_callback' => 'crf_is_outer_bg_pattern',
	);
	$options['outer-bg-image'] = array(
			'id' => 'outer-bg-image',
			'label'   => esc_html__( 'Outer Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['outer-bg-image'],
			'active_callback' => 'crf_is_outer_bg_image',
	);
	$options['outer-bg-repeat'] = array(
			'id' => 'outer-bg-repeat',
			'label'   => esc_html__( 'Outer Background Repeat', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_bg_repeats(),
			'default' => $crf_default_options['outer-bg-repeat'],
			'active_callback' => 'crf_is_outer_bg_image',
	);
	
	// General - 404 Error Page
	$section = 'general-404-bg';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( '404 Error Page Background', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change background image of 404 error page here.', 'semona' ),
	);
	$options['error404-bg-image'] = array(
			'id' => 'error404-bg-image',
			'label'   => esc_html__( '404 Error Page Bg Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['error404-bg-image'],
	);
	$options['error404-bg-repeat'] = array(
			'id' => 'error404-bg-repeat',
			'label'   => esc_html__( '404 Error Page Bg Repeat', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_bg_repeats(),
			'default' => $crf_default_options['error404-bg-repeat'],
	);
	
	// General - Extra
	$section = 'general-extra';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Extra', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Configure extra generic settings here, such as Page Comments, Smooth Scroll and CSS3 Animations on mobile.', 'semona' ),
	);
	$options['page-comments-enable'] = array(
			'id' => 'page-comments-enable',
			'label'   => esc_html__( 'Enable Page Comments', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $yes_no,
			'default' => $crf_default_options['page-comments-enable'],
	);
	$options['css3-animation-on-mobile'] = array(
			'id' => 'css3-animation-on-mobile',
			'label'   => esc_html__( 'CSS3 Animations On Mobile Device', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $yes_no,
			'default' => $crf_default_options['css3-animation-on-mobile'],
	);

	/* Header options */
	
	$panel = 'panel-header';
	$panels[] = array(
			'id' => $panel,
			'title' => esc_html__( 'Header', 'semona' ),
			'priority' => $priority++
	);
	
	// Header - General
	$section = 'header-general';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'General', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can choose header style and configure generic header settings.', 'semona' ),
	);
	$options['header-style'] = array(
			'id' => 'header-style',
			'label'   => esc_html__( 'Header Style', 'semona' ),
			'section' => $section,
			'type'    => 'imageradio',
			'choices'  => array(
					'v1' => get_template_directory_uri() . '/images/admin/header-v1.png',
					'v2' => get_template_directory_uri() . '/images/admin/header-v2.png',
					'v3' => get_template_directory_uri() . '/images/admin/header-v3.png',
					'v4' => get_template_directory_uri() . '/images/admin/header-v4.png',
			),
			'default' => $crf_default_options['header-style'],
	);
	$options['header-bg-color'] = array(
			'id' => 'header-bg-color',
			'label'   => esc_html__( 'Header Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['header-bg-color'],
			'active_callback' => 'crf_is_header_v1_v3_or_v4',
	);
	$options['header-top-border'] = array(
			'id' => 'header-top-border',
			'label'   => esc_html__( 'Show Header Top Border', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $show_hide,
			'default' => $crf_default_options['header-top-border'],
			'active_callback' => 'crf_is_header_v1_v3_or_v4',
	);
	$options['header-show-search-icon'] = array(
			'id' => 'header-show-search-icon',
			'label'   => esc_html__( 'Show Search Icon', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $show_hide,
			'default' => $crf_default_options['header-show-search-icon'],
			'active_callback' => 'crf_is_header_v1_v3_or_v4',
	);
	$options['header-show-shop-icon'] = array(
			'id' => 'header-show-shop-icon',
			'label'   => esc_html__( 'Show WooCommerce Shop Icon', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $show_hide,
			'default' => $crf_default_options['header-show-shop-icon'],
			'active_callback' => 'crf_is_header_v1_v3_or_v4',
	);
	$options['header-v2-bg-image'] = array(
			'id' => 'header-v2-bg-image',
			'label'   => esc_html__( 'Header v2 Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['header-v2-bg-image'],
			'active_callback' => 'crf_is_header_v2',
	);
	$options['header-v2-skin'] = array(
			'id' => 'header-v2-skin',
			'label'   => esc_html__( 'Header v2 Skin', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_transparent_header_skins(),
			'default' => $crf_default_options['header-v2-skin'],
			'active_callback' => 'crf_is_header_v2',
	);
	$options['header-enable-sticky'] = array(
			'id' => 'header-enable-sticky',
			'label'   => esc_html__( 'Enable Sticky Menu', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $yes_no,
			'default' => $crf_default_options['header-enable-sticky'],
	);
	
	// Header - Contact
	$section = 'header-contact';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Contact Info', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change header contact informations here, phone number and email.', 'semona' ),
	);
	$options['topbar-phone'] = array(
			'id' => 'topbar-phone',
			'label'   => esc_html__( 'Phone Number', 'semona' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $crf_default_options['topbar-phone'],
			'transport' => 'postMessage',
	);
	$options['topbar-email'] = array(
			'id' => 'topbar-email',
			'label'   => esc_html__( 'Email Address', 'semona' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $crf_default_options['topbar-email'],
			'transport' => 'postMessage',
	);

	// Header - Topbar
	$section = 'header-topbar';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Topbar', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change topbar styles here. You can select preset color style or select default or secondary background style and use custom colors.', 'semona' ),
			'active_callback' => 'crf_is_header_v1_or_v4',
	);
	$options['topbar-show'] = array(
			'id' => 'topbar-show',
			'label'   => esc_html__( 'Show Topbar', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'default' => $crf_default_options['topbar-show'],
			'choices' => $show_hide,
	);
	$options['topbar-skin'] = array(
			'id' => 'topbar-skin',
			'label'   => esc_html__( 'Topbar Skin', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'default' => $crf_default_options['topbar-skin'],
			'choices' => sm_topbar_skins(),
	);
	$options['topbar-height'] = array(
			'id' => 'topbar-height',
			'label'   => esc_html__( 'Topbar Height (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['topbar-height'],
	);
	$options['topbar-text-color'] = array(
			'id' => 'topbar-text-color',
			'label'   => esc_html__( 'Topbar Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['topbar-text-color'],
			'active_callback' => 'crf_is_topbar_color_options_available',
	);
	$options['topbar-bg-color'] = array(
			'id' => 'topbar-bg-color',
			'label'   => esc_html__( 'Topbar Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['topbar-bg-color'],
			'active_callback' => 'crf_is_topbar_bottom_border_available',
	);
	$options['topbar-icon-social-color'] = array(
			'id' => 'topbar-icon-social-color',
			'label'   => esc_html__( 'Topbar Social Icon Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['topbar-icon-social-color'],
			'active_callback' => 'crf_is_topbar_color_options_available',
	);
	$options['topbar-bottom-border'] = array(
			'id' => 'topbar-bottom-border',
			'label'   => esc_html__( 'Show Topbar Bottom Border', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $show_hide,
			'default' => $crf_default_options['topbar-bottom-border'],
			'active_callback' => 'crf_is_topbar_bottom_border_available',
	);
	
	// Header - Main menu
	$section = 'header-mainnav';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Main Menu', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can select light or dark style. Note that all color option values are saved separately for light and dark styles.', 'semona' ),
			'active_callback' => 'crf_is_header_v1_v3_or_v4',
	);
	$options['main-nav-hover-style'] = array(
			'id' => 'main-nav-hover-style',
			'label'   => esc_html__( 'Main Menu Hover Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_main_nav_hover_styles(),
			'default' => $crf_default_options['main-nav-hover-style'],
	);
	$options['main-nav-height'] = array(
			'id' => 'main-nav-height',
			'label'   => esc_html__( 'Main Menu Height (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['main-nav-height'],
			'active_callback' => 'crf_is_header_v1_or_v3',
	);
	$options['header-v4-logoarea-height'] = array(
			'id' => 'header-v4-logoarea-height',
			'label'   => esc_html__( 'Logo Area Height (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['header-v4-logoarea-height'],
			'active_callback' => 'crf_is_header_v4',
	);
	$options['header-v4-main-nav-height'] = array(
			'id' => 'header-v4-main-nav-height',
			'label'   => esc_html__( 'Main Menu Height (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['header-v4-main-nav-height'],
			'active_callback' => 'crf_is_header_v4',
	);
	$options['main-nav-font-color'] = array(
			'id' => 'main-nav-font-color',
			'label'   => esc_html__( 'Main Menu Font Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['main-nav-font-color'],
	);
	$options['main-nav-hover-color'] = array(
			'id' => 'main-nav-hover-color',
			'label'   => esc_html__( 'Main Menu Font Hover Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['main-nav-hover-color'],
	);
	$options['main-nav-bg-color'] = array(
			'id' => 'main-nav-bg-color',
			'label'   => esc_html__( 'Main Menu Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['main-nav-bg-color'],
	);
	
	// Header - logo area (header v3)
	$section = 'header-logoarea';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Logo Area', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change options about header v3 logo area.', 'semona' ),
			'active_callback' => 'crf_is_header_v3',
	);
	$options['v3-logoarea-top-padding'] = array(
			'id' => 'v3-logoarea-top-padding',
			'label'   => esc_html__( 'Top Padding (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['v3-logoarea-top-padding'],
	);
	$options['v3-logoarea-bottom-padding'] = array(
			'id' => 'v3-logoarea-bottom-padding',
			'label'   => esc_html__( 'Bottom Padding (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['v3-logoarea-bottom-padding'],
	);
	$options['v3-logoarea-bg-color'] = array(
			'id' => 'v3-logoarea-bg-color',
			'label'   => esc_html__( 'Logo Area Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['v3-logoarea-bg-color'],
	);
	
	// Header - Dropdown
	$section = 'header-dropdown';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Dropdown', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change dropdown menu skin and style here. Megamenu uses these option values too.', 'semona' ),
	);
	$options['dropdown-item-width'] = array(
			'id' => 'dropdown-item-width',
			'label'   => esc_html__( 'Dropdown Width (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['dropdown-item-width'],
	);
	$options['dropdown-item-height'] = array(
			'id' => 'dropdown-item-height',
			'label'   => esc_html__( 'Dropdown Item Height (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['dropdown-item-height'],
	);
	$options['dropdown-item-padding'] = array(
			'id' => 'dropdown-item-padding',
			'label'   => esc_html__( 'Dropdown Item Padding (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['dropdown-item-padding'],
	);
	$options['dropdown-item-color'] = array(
			'id' => 'dropdown-item-color',
			'label'   => esc_html__( 'Dropdown Font Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['dropdown-item-color'],
	);
	$options['dropdown-item-arrow-color'] = array(
			'id' => 'dropdown-item-arrow-color',
			'label'   => esc_html__( 'Dropdown Item Arrow Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['dropdown-item-arrow-color'],
	);
	$options['dropdown-bg-color'] = array(
			'id' => 'dropdown-bg-color',
			'label'   => esc_html__( 'Dropdown Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['dropdown-bg-color'],
	);
	$options['dropdown-separator-color'] = array(
			'id' => 'dropdown-separator-color',
			'label'   => esc_html__( 'Dropdown Separator Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['dropdown-separator-color'],
	);
	$options['dropdown-hover-color'] = array(
			'id' => 'dropdown-hover-color',
			'label'   => esc_html__( 'Dropdown Font Hover Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['dropdown-hover-color'],
	);
	$options['dropdown-bg-color-hover'] = array(
			'id' => 'dropdown-bg-color-hover',
			'label'   => esc_html__( 'Dropdown Item Bg Hover Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['dropdown-bg-color-hover'],
	);

	/* Titlebar */
	
	$panel = 'panel-titlebar';
	$panels[] = array(
			'id' => $panel,
			'title' => esc_html__( 'Titlebar', 'semona' ),
			'priority' => $priority++,
			'active_callback' => 'crf_is_header_v1_v3_or_v4',
	);
	
	// Titlebar - Blog
	$section = 'titlebar-blog';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Blog', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['titlebar-blog-style'] = array(
			'id' => 'titlebar-blog-style',
			'label'   => esc_html__( 'Titlebar Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_archive_titlebar_styles(),
			'default' => $crf_default_options['titlebar-blog-style'],
	);
	$options['titlebar-blog-bg-type'] = array(
			'id' => 'titlebar-blog-bg-type',
			'label'   => esc_html__( 'Titlebar Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_titlebar_bg_types(),
			'default' => $crf_default_options['titlebar-blog-bg-type'],
	);
	$options['titlebar-blog-bg'] = array(
			'id' => 'titlebar-blog-bg',
			'label'   => esc_html__( 'Titlebar Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['titlebar-blog-bg'],
	);
	$options['titlebar-small3-hide-single-title'] = array(
			'id' => 'titlebar-small3-hide-single-title',
			'label'   => esc_html__( 'Hide Title In Single Posts', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'no' => __( 'No', 'semona' ),
					'yes' => __( 'Yes', 'semona' ),
			),
			'default' => $crf_default_options['titlebar-small3-hide-single-title'],
	);
	
	// Titlebar - Portfolio
	$section = 'titlebar-portfolio';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Portfolio', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['titlebar-portfolio-style'] = array(
			'id' => 'titlebar-portfolio-style',
			'label'   => esc_html__( 'Titlebar Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_archive_titlebar_styles(),
			'default' => $crf_default_options['titlebar-portfolio-style'],
	);
	$options['titlebar-portfolio-bg-type'] = array(
			'id' => 'titlebar-portfolio-bg-type',
			'label'   => esc_html__( 'Titlebar Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_titlebar_bg_types(),
			'default' => $crf_default_options['titlebar-portfolio-bg-type'],
	);
	$options['titlebar-portfolio-bg'] = array(
			'id' => 'titlebar-portfolio-bg',
			'label'   => esc_html__( 'Titlebar Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['titlebar-portfolio-bg'],
	);

	// Titlebar - Page
	$section = 'titlebar-page';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Page', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['titlebar-page-style'] = array(
			'id' => 'titlebar-page-style',
			'label'   => esc_html__( 'Titlebar Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_archive_titlebar_styles(),
			'default' => $crf_default_options['titlebar-page-style'],
	);
	$options['titlebar-page-bg-type'] = array(
			'id' => 'titlebar-page-bg-type',
			'label'   => esc_html__( 'Titlebar Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_titlebar_bg_types(),
			'default' => $crf_default_options['titlebar-page-bg-type'],
	);
	$options['titlebar-page-bg'] = array(
			'id' => 'titlebar-page-bg',
			'label'   => esc_html__( 'Titlebar Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['titlebar-page-bg'],
	);

	// Titlebar - Search
	$section = 'titlebar-search';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Search', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['titlebar-search-style'] = array(
			'id' => 'titlebar-search-style',
			'label'   => esc_html__( 'Titlebar Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_archive_titlebar_styles(),
			'default' => $crf_default_options['titlebar-search-style'],
	);
	$options['titlebar-search-bg-type'] = array(
			'id' => 'titlebar-search-bg-type',
			'label'   => esc_html__( 'Titlebar Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_titlebar_bg_types(),
			'default' => $crf_default_options['titlebar-search-bg-type'],
	);
	$options['titlebar-search-bg'] = array(
			'id' => 'titlebar-search-bg',
			'label'   => esc_html__( 'Titlebar Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['titlebar-search-bg'],
	);

	// Titlebar - WooCommerce
	$section = 'titlebar-woocommerce';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'WooCommerce', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['titlebar-woocommerce-style'] = array(
			'id' => 'titlebar-woocommerce-style',
			'label'   => esc_html__( 'Titlebar Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_archive_titlebar_styles(),
			'default' => $crf_default_options['titlebar-woocommerce-style'],
	);
	$options['titlebar-woocommerce-bg-type'] = array(
			'id' => 'titlebar-woocommerce-bg-type',
			'label'   => esc_html__( 'Titlebar Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_titlebar_bg_types(),
			'default' => $crf_default_options['titlebar-woocommerce-bg-type'],
	);
	$options['titlebar-woocommerce-bg'] = array(
			'id' => 'titlebar-woocommerce-bg',
			'label'   => esc_html__( 'Titlebar Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['titlebar-woocommerce-bg'],
	);

	// Titlebar - 404 Not Found
	$section = 'titlebar-404';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Error 404 Page', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['titlebar-404-style'] = array(
			'id' => 'titlebar-404-style',
			'label'   => esc_html__( 'Titlebar Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_archive_titlebar_styles(),
			'default' => $crf_default_options['titlebar-404-style'],
	);
	$options['titlebar-404-bg-type'] = array(
			'id' => 'titlebar-404-bg-type',
			'label'   => esc_html__( 'Titlebar Background Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_titlebar_bg_types(),
			'default' => $crf_default_options['titlebar-404-bg-type'],
	);
	$options['titlebar-404-bg'] = array(
			'id' => 'titlebar-404-bg',
			'label'   => esc_html__( 'Titlebar Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['titlebar-404-bg'],
	);

	/* Footer options */
	
	$panel = 'panel-footer';
	$panels[] = array(
			'id' => $panel,
			'title' => esc_html__( 'Footer', 'semona' ),
			'priority' => $priority++
	);
	
	// Footer - Style
	$section = 'footer-style-sec';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Style', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['footer-style'] = array(
			'id' => 'footer-style',
			'label'   => esc_html__( 'Footer Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_footer_styles(),
			'default' => $crf_default_options['footer-style'],
	);
	$options['footer-bg-style3'] = array(
			'id' => 'footer-bg-style3',
			'label'   => esc_html__( 'Background Image', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['footer-bg-style3'],
			'active_callback' => 'crf_is_footer_style3',
	);
	$options['footer-bg-image-opacity'] = array(
			'id' => 'footer-bg-image-opacity',
			'label'   => esc_html__( 'Background Image Opacity (%)', 'semona' ),
			'section' => $section,
			'type'	  => "slider",
			'input_attrs' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['footer-bg-image-opacity'],
			'active_callback' => 'crf_is_footer_style3',
	);
	$options['footer-text-color'] = array(
			'id'      => 'footer-text-color',
			'label'   => esc_html__( 'Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['footer-text-color'],
	);
	$options['footer-bg-color'] = array(
			'id'      => 'footer-bg-color',
			'label'   => esc_html__( 'Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['footer-bg-color'],
	);
	$options['footer-border-color'] = array(
			'id'      => 'footer-border-color',
			'label'   => esc_html__( 'Border Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['footer-border-color'],
	);
	$options['widget-area-title-color'] = array(
			'id'      => 'widget-area-title-color',
			'label'   => esc_html__( 'Widget Title Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['widget-area-title-color'],
	);
	$options['footer-copyright-bg-color'] = array(
			'id'      => 'footer-copyright-bg-color',
			'label'   => esc_html__( 'Copyright Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['footer-copyright-bg-color'],
	);
	
	// Footer - Bar
	$section = 'footer-bar';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Footer Bar', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Place one or more shortcodes above the footer, for example, callout shortcode or logo carousel.', 'semona' ),
	);
	$options['footer-bar-shortcode'] = array(
			'id' => 'footer-bar-shortcode',
			'label'   => esc_html__( 'Footer Bar Shortcodes', 'semona' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $crf_default_options['footer-bar-shortcode'],
	);
	
	// Footer - Widget area
	$section = 'footer-widget-area';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Widget Area', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can change options about footer widget area such as number of columns or padding.', 'semona' ),
	);
	$options['widget-area-show'] = array(
			'id'      => 'widget-area-show',
			'label'   => esc_html__( 'Show Widget Area', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices'  => $show_hide,
			'default' => $crf_default_options['widget-area-show'],
	);
	$options['widget-area-columns'] = array(
			'id' => 'widget-area-columns',
			'label'   => esc_html__( 'Number of Columns', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'1' => esc_html__( '1 Column', 'semona' ),
					'2' => esc_html__( '2 Columns', 'semona' ),
					'3' => esc_html__( '3 Columns', 'semona' ),
					'4' => esc_html__( '4 Columns', 'semona' ),
			),
			'default' => $crf_default_options['widget-area-columns'],
	);
	$options['widget-area-padding-top'] = array(
			'id' => 'widget-area-padding-top',
			'label'   => esc_html__( 'Padding Top (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['widget-area-padding-top'],
	);
	$options['widget-area-padding-bottom'] = array(
			'id' => 'widget-area-padding-bottom',
			'label'   => esc_html__( 'Padding Bottom (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['widget-area-padding-bottom'],
	);
	
	// Footer - Copyright bar
	$section = 'footer-copyright-bar';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Copyright Bar', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'You can enter copyright text and set footer logo here. You can also choose to put menu or social icons in the right side of the bar.', 'semona' ),
	);
	$options['footer-copyright-text'] = array(
			'id' => 'footer-copyright-text',
			'label'   => esc_html__( 'Copyright Text', 'semona' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $crf_default_options['footer-copyright-text'],
			'transport' => 'postMessage',
	);
	$options['style1-copyright-logo'] = array(
			'id' => 'style1-copyright-logo',
			'label'   => esc_html__( 'Copyright Bar Logo', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['style1-copyright-logo'],
	);
	$options['style1-copyright-logo-retina'] = array(
			'id' => 'style1-copyright-logo-retina',
			'label'   => esc_html__( 'Copyright Bar Logo Retina', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['style1-copyright-logo-retina'],
	);
	$options['footer-copyright-right'] = array(
			'id' => 'footer-copyright-right',
			'label'   => esc_html__( 'Right Side Content', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'menu' => esc_html__( 'Navigation Menu', 'semona' ),
					'social' => esc_html__( 'Social Link Icons', 'semona' ),
			),
			'default' => $crf_default_options['footer-copyright-right'],
	);
	$options['footer-copyright-bar-padding-top'] = array(
			'id' => 'footer-copyright-bar-padding-top',
			'label'   => esc_html__( 'Top Padding (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['footer-copyright-bar-padding-top'],
	);
	$options['footer-copyright-bar-padding-bottom'] = array(
			'id' => 'footer-copyright-bar-padding-bottom',
			'label'   => esc_html__( 'Bottom Padding (px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['footer-copyright-bar-padding-bottom'],
	);
	
	/* Elements */
	
	$panel = 'panel-elements';
	$panels[] = array(
			'id' => $panel,
			'title' => esc_html__( 'Elements', 'semona' ),
			'priority' => $priority++
	);

	// Accordion
	$section = 'accordion';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Accordion', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['accordion-hdr-color'] = array(
			'id' => 'accordion-hdr-color',
			'label'   => esc_html__( 'Header Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['accordion-hdr-color'],
	);
	$options['accordion-active-hdr-color'] = array(
			'id' => 'accordion-active-hdr-color',
			'label'   => esc_html__( 'Active Header Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['accordion-active-hdr-color'],
	);
	
	// Button
	$section = 'button';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Button', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['button-shape'] = array(
			'id' => 'button-shape',
			'label'   => esc_html__( 'Default Button Shape', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					'sm-shape-rounded' => esc_html__( 'Rounded', 'semona' ),
					'sm-shape-square' => esc_html__( 'Square', 'semona' ),
					'sm-shape-round' => esc_html__( 'Round', 'semona' ),
			),
			'default' => $crf_default_options['button-shape'],
	);
	$options['button-size'] = array(
			'id' => 'button-size',
			'label'   => esc_html__( 'Default Button Size', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					'sm-size-xs' => esc_html__( 'Extra Small', 'semona' ),
					'sm-size-sm' => esc_html__( 'Small', 'semona' ),
					'sm-size-md' => esc_html__( 'Medium', 'semona' ),
					'sm-size-lg' => esc_html__( 'Large', 'semona' ),
					'sm-size-xl' => esc_html__( 'Extra Large', 'semona' ),
			),
			'default' => $crf_default_options['button-size'],
	);
	$options['button-letter-spacing'] = array(
			'id' => 'button-letter-spacing',
			'label'   => esc_html__( 'Default Letter Spacing (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 0,
					'max'   => 5,
					'step'  => 1
			),
			'default' => $crf_default_options['button-letter-spacing'],
	);
	$options['button-light-color'] = array(
			'id' => 'button-light-color',
			'label'   => esc_html__( 'Light Scheme Default Button Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['button-light-color'],
			'description' => esc_html__( 'Leave blank to use primary color as default button color.' , 'semona' ),
	);
	$options['button-dark-color'] = array(
			'id' => 'button-dark-color',
			'label'   => esc_html__( 'Dark Scheme Default Button Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['button-dark-color'],
			'description' => esc_html__( 'Leave blank to use primary color as default button color.' , 'semona' ),
	);
	$options['button-min-width'] = array(
			'id' => 'button-min-width',
			'label'   => esc_html__( 'Minimum Width(px)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
	);

	// Callout
	$section = 'callout';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Callout', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['callout-bg-color'] = array(
			'id' => 'callout-bg-color',
			'label'   => esc_html__( 'Default Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => '',
			'description' => esc_html__( 'Leave blank to use primary color as default background color.' , 'semona' ),
	);
	/*
	$options['callout-button-color'] = array(
			'id' => 'callout-button-color',
			'label'   => esc_html__( 'Button Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => '',
			'description' => esc_html__( 'Leave blank to use default color of button element.' , 'semona' ),
	);*/

	// Feature Box
	$section = 'feature-box';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Feature Box', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['featurebox-title-font-family'] = array(
			'id' => 'featurebox-title-font-family',
			'label'   => esc_html__( 'Default Title Tag Font Family', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['featurebox-title-font-family'],
	);

	$options['featurebox-title-font-size'] = array(
			'id' => 'featurebox-title-font-size',
			'label'   => esc_html__( 'Default Title Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 14,
					'max'   => 50,
					'step'  => 1
			),
			'default' => $crf_default_options['featurebox-title-font-size'],
	);
	
	$options['featurebox-title-font-weight'] = array(
			'id' => 'featurebox-title-font-weight',
			'label'   => esc_html__( 'Default Title Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['featurebox-title-font-weight'],
	);

	$options['featurebox-title-letter-spacing'] = array(
			'id' => 'featurebox-title-letter-spacing',
			'label'   => esc_html__( 'Default Title Letter Spacing (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 0,
					'max'   => 5,
					'step'  => 1
			),
			'default' => $crf_default_options['featurebox-title-letter-spacing'],
	);

	// Horizontal Tabs
	$section = 'tabs';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Horizontal Tabs', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['tabs-hdr-color1'] = array(
			'id' => 'tabs-hdr-color1',
			'label'   => esc_html__( 'Header Text Color 1', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['tabs-hdr-color1'],
			'description' => esc_html__( 'Used for Default Theme Background Colors.' , 'semona' ),
	);
	$options['tabs-hdr-color2'] = array(
			'id' => 'tabs-hdr-color2',
			'label'   => esc_html__( 'Header Text Color 2', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['tabs-hdr-color2'],
			'description' => esc_html__( 'Used for Custom Background Colors.' , 'semona' ),
	);

	// Latest Tweets
	$section = 'latest-tweet';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Latest Tweets', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['latest-tweet-twitter_id'] = array(
			'id' => 'latest-tweet-twitter_id',
			'label'   => esc_html__( 'Twitter ID', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
	);
	$options['latest-tweet-consumer_key'] = array(
			'id' => 'latest-tweet-consumer_key',
			'label'   => esc_html__( 'Consumer Key', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
	);
	$options['latest-tweet-consumer_secret'] = array(
			'id' => 'latest-tweet-consumer_secret',
			'label'   => esc_html__( 'Consumer Secret', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
	);
	$options['latest-tweet-access_token'] = array(
			'id' => 'latest-tweet-access_token',
			'label'   => esc_html__( 'Access Token', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
	);
	$options['latest-tweet-access_token_secret'] = array(
			'id' => 'latest-tweet-access_token_secret',
			'label'   => esc_html__( 'Access Token Secret', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
	);
	
	// Pricing Table
	$section = 'pricing-table';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Pricing Table', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['pt-featured-color'] = array(
			'id' => 'pt-featured-color',
			'label'   => esc_html__( 'Default Featured Column Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-featured-color'],
	);
	$options['pt-theme-light-bg1'] = array(
			'id' => 'pt-theme-light-bg1',
			'label'   => esc_html__( 'Light Skin - Background Color 1', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-light-bg1'],
	);
	$options['pt-theme-light-bg2'] = array(
			'id' => 'pt-theme-light-bg2',
			'label'   => esc_html__( 'Light Skin - Background Color 2', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-light-bg2'],
	);
	$options['pt-theme-light-heading-text'] = array(
			'id' => 'pt-theme-light-heading-text',
			'label'   => esc_html__( 'Light Skin - Heading Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-light-heading-text'],
	);
	$options['pt-theme-light-feature-text'] = array(
			'id' => 'pt-theme-light-feature-text',
			'label'   => esc_html__( 'Light Skin - Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-light-feature-text'],
	);
	$options['pt-theme-light-border'] = array(
			'id' => 'pt-theme-light-border',
			'label'   => esc_html__( 'Light Skin - Border Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-light-border'],
	);
	$options['pt-theme-dark-bg1'] = array(
			'id' => 'pt-theme-dark-bg1',
			'label'   => esc_html__( 'Dark Skin - Background Color 1', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-dark-bg1'],
	);
	$options['pt-theme-dark-bg2'] = array(
			'id' => 'pt-theme-dark-bg2',
			'label'   => esc_html__( 'Dark Skin - Background Color 2', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-dark-bg2'],
	);
	$options['pt-theme-dark-heading-text'] = array(
			'id' => 'pt-theme-dark-heading-text',
			'label'   => esc_html__( 'Dark Skin - Heading Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-dark-heading-text'],
	);
	$options['pt-theme-dark-feature-text'] = array(
			'id' => 'pt-theme-dark-feature-text',
			'label'   => esc_html__( 'Dark Skin - Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-dark-feature-text'],
	);
	$options['pt-theme-dark-border'] = array(
			'id' => 'pt-theme-dark-border',
			'label'   => esc_html__( 'Dark Skin - Border Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['pt-theme-dark-border'],
	);
	
	// Quotes Slider
	$section = 'quotes-slider';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Quotes Slider', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['quotes-content-font-family'] = array(
			'id' => 'quotes-content-font-family',
			'label'   => esc_html__( 'Content Font Family', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['quotes-content-font-family'],
	);
	
	// Section Header
	$section = 'section-header';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Section Header', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['section-header-title-font-size'] = array(
			'id' => 'section-header-title-font-size',
			'label'   => esc_html__( 'Title Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 20,
					'max'   => 50,
					'step'  => 1
			),
			'default' => $crf_default_options['section-header-title-font-size'],
	);
	$options['section-header-letter-spacing'] = array(
			'id' => 'section-header-letter-spacing',
			'label'   => esc_html__( 'Letter Spacing (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 0,
					'max'   => 5,
					'step'  => 1
			),
			'default' => $crf_default_options['section-header-letter-spacing'],
	);
	$options['section-header-underline-thickness'] = array(
			'id' => 'section-header-underline-thickness',
			'label'   => esc_html__( 'Underline Thickness (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 1,
					'max'   => 10,
					'step'  => 1
			),
			'default' => $crf_default_options['section-header-underline-thickness'],
	);
	$options['section-header-underline-shape'] = array(
			'id' => 'section-header-underline-shape',
			'label'   => esc_html__( 'Underline Shape', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					'sm-shape-square' => esc_html__( 'Square', 'semona' ),
					'sm-shape-rounded' => esc_html__( 'Rounded', 'semona' ),
			),
			'default' => $crf_default_options['section-header-underline-shape'],
	);
	$options['section-header-uppercase'] = array(
			'id' => 'section-header-uppercase',
			'label'   => esc_html__( 'Uppercase Heading', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					'yes' => esc_html__( 'Yes', 'semona' ),
					'no' => esc_html__( 'No', 'semona' ),
			),
			'default' => $crf_default_options['section-header-uppercase'],
	);
	
	// Timeline
	$section = 'timeline';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Timeline Posts', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['timeline-spine-color'] = array(
			'id' => 'timeline-spine-color',
			'label'   => esc_html__( 'Default Spine Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['timeline-spine-color'],
	);
	$options['timeline-border-color'] = array(
			'id' => 'timeline-border-color',
			'label'   => esc_html__( 'Default Border Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['timeline-border-color'],
	);
	$options['timeline-spine-hover-color'] = array(
			'id' => 'timeline-spine-hover-color',
			'label'   => esc_html__( 'Default Spine Circle Hover Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['timeline-spine-hover-color'],
	);

	// Vertical Tabs
	$section = 'vtabs';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Vertical Tabs', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
	);
	$options['vtabs-light-text-color'] = array(
			'id' => 'vtabs-light-text-color',
			'label'   => esc_html__( 'Light Style Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['vtabs-light-text-color'],
	);
	$options['vtabs-light-inactive-color'] = array(
			'id' => 'vtabs-light-active-color',
			'label'   => esc_html__( 'Light Style Active Header Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['vtabs-light-active-color']
	);
	$options['vtabs-light-inactive-color'] = array(
			'id' => 'vtabs-light-inactive-color',
			'label'   => esc_html__( 'Light Style Inactive Header Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['vtabs-light-inactive-color']
	);
	$options['vtabs-dark-text-color'] = array(
			'id' => 'vtabs-dark-text-color',
			'label'   => esc_html__( 'Dark Style Text Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['vtabs-dark-text-color'],
	);
	$options['vtabs-dark-inactive-color'] = array(
			'id' => 'vtabs-dark-active-color',
			'label'   => esc_html__( 'Dark Style Active Header Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['vtabs-dark-active-color']
	);
	$options['vtabs-dark-inactive-color'] = array(
			'id' => 'vtabs-dark-inactive-color',
			'label'   => esc_html__( 'Dark Style Inactive Header Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['vtabs-dark-inactive-color']
	);
	
	
	/* Typography */
	
	$panel = 'panel-typography';
	$panels[] = array(
			'id' => $panel,
			'title' => esc_html__( 'Typography', 'semona' ),
			'priority' => $priority++
	);
	
	// Typography - Headings
	$section = 'typo-headings';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Headings', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Change general font options for headings.' , 'semona' ),
	);
	$options['heading-font'] = array(
			'id' => 'heading-font',
			'label'   => esc_html__( 'Heading Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['heading-font'],
	);
	$options['heading-font-weight'] = array(
			'id' => 'heading-font-weight',
			'label'   => esc_html__( 'Heading Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['heading-font-weight'],
	);
	$options['post-heading-font-weight'] = array(
			'id' => 'post-heading-font-weight',
			'label'   => esc_html__( 'Blog & Portfolio Heading Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['post-heading-font-weight'],
	);
	$options['h1-font-size'] = array(
			'id' => 'h1-font-size',
			'label'   => esc_html__( 'H1 Tag Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['h1-font-size'],
	);
	$options['h2-font-size'] = array(
			'id' => 'h2-font-size',
			'label'   => esc_html__( 'H2 Tag Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['h2-font-size'],
	);
	$options['h3-font-size'] = array(
			'id' => 'h3-font-size',
			'label'   => esc_html__( 'H3 Tag Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['h3-font-size'],
	);
	$options['h4-font-size'] = array(
			'id' => 'h4-font-size',
			'label'   => esc_html__( 'H4 Tag Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['h4-font-size'],
	);
	$options['h5-font-size'] = array(
			'id' => 'h5-font-size',
			'label'   => esc_html__( 'H5 Tag Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['h5-font-size'],
	);
	$options['h6-font-size'] = array(
			'id' => 'h6-font-size',
			'label'   => esc_html__( 'H6 Tag Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['h6-font-size'],
	);
	
	// Typography - Text
	$section = 'typo-text';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Text', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Change font options for general texts.' , 'semona' ),
	);
	$options['text-font'] = array(
			'id' => 'text-font',
			'label'   => esc_html__( 'Text Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['text-font'],
	);
	$options['text-font2'] = array(
			'id' => 'text-font2',
			'label'   => esc_html__( 'Text Font 2', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['text-font2'],
	);
	$options['text-font-weight'] = array(
			'id' => 'text-font-weight',
			'label'   => esc_html__( 'Text Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['text-font-weight'],
	);
	$options['text-font-size'] = array(
			'id' => 'text-font-size',
			'label'   => esc_html__( 'Text Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['text-font-size'],
	);
	$options['text-line-height'] = array(
			'id' => 'text-line-height',
			'label'   => esc_html__( 'Text Line Height (em)', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['text-line-height'],
	);
	
	// Typography - Header
	$section = 'typo-header';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Header', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Change header font options. You can change fonts for topbar, main menu, mobile menu and dropdown menus.' , 'semona' ),
	);
	$options['topbar-font'] = array(
			'id' => 'topbar-font',
			'label'   => esc_html__( 'Topbar Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['topbar-font'],
	);
	$options['topbar-font-weight'] = array(
			'id' => 'topbar-font-weight',
			'label'   => esc_html__( 'Topbar Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['topbar-font-weight'],
	);
	$options['topbar-font-size'] = array(
			'id' => 'topbar-font-size',
			'label'   => esc_html__( 'Topbar Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['topbar-font-size'],
	);
	$options['topbar-icon-size'] = array(
			'id' => 'topbar-icon-size',
			'label'   => esc_html__( 'Topbar Icon Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['topbar-icon-size'],
	);
	$options['nav-font'] = array(
			'id' => 'nav-font',
			'label'   => esc_html__( 'Menu Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['nav-font'],
	);
	$options['nav-font-size'] = array(
			'id' => 'nav-font-size',
			'label'   => esc_html__( 'Menu Font Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['nav-font-size'],
	);
	$options['main-nav-font-weight'] = array(
			'id' => 'main-nav-font-weight',
			'label'   => esc_html__( 'Main Menu Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['main-nav-font-weight'],
	);
	$options['dropdown-item-font-weight'] = array(
			'id' => 'dropdown-item-font-weight',
			'label'   => esc_html__( 'Dropdown Menu Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['dropdown-item-font-weight'],
	);
	
	// Typography - Footer
	$section = 'typo-footer';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Footer', 'semona' ),
			'priority' => $priority++,
			'panel' => $panel,
			'description' => esc_html__( 'Change footer font options. You can change fonts of general text and widget headings.' , 'semona' ),
	);
	$options['footer-heading-font'] = array(
			'id' => 'footer-heading-font',
			'label'   => esc_html__( 'Widget Heading Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['footer-heading-font'],
	);
	$options['footer-heading-font-size1'] = array(
			'id' => 'footer-heading-font-size1',
			'label'   => esc_html__( 'Widget Heading Font Size 1 (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['footer-heading-font-size1'],
			'description' => esc_html__( 'Controls widget heading font size in footer style 1.', 'semona' ),
	);
	$options['footer-heading-font-size2'] = array(
			'id' => 'footer-heading-font-size2',
			'label'   => esc_html__( 'Widget Heading Font Size 2 (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['footer-heading-font-size2'],
			'description' => esc_html__( 'Controls widget heading font size in footer style 2,3,4.', 'semona' ),
	);
	$options['footer-heading-font-weight'] = array(
			'id' => 'footer-heading-font-weight',
			'label'   => esc_html__( 'Widget Heading Font Weight', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $font_weights,
			'default' => $crf_default_options['footer-heading-font-weight'],
	);
	$options['footer-text-font'] = array(
			'id' => 'footer-text-font',
			'label'   => esc_html__( 'Footer Text Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['footer-text-font'],
	);
	$options['footer-copyright-font'] = array(
			'id' => 'footer-copyright-font',
			'label'   => esc_html__( 'Copyright Bar Font', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $crf_default_options['footer-copyright-font'],
	);
	$options['footer-social-icon-size'] = array(
			'id' => 'footer-social-icon-size',
			'label'   => esc_html__( 'Social Icon Size (px)', 'semona' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 10,
					'max'   => 100,
					'step'  => 1
			),
			'default' => $crf_default_options['footer-social-icon-size'],
	);
	
	/* Preloader */
	
	$section = 'section-preloader';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Preloader', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( 'Choose to show or hide preloader, and configure progress bar color.', 'semona' ),
	);
	$options['preloader-enable'] = array(
			'id' => 'preloader-enable',
			'label'   => esc_html__( 'Enable Preloader', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $show_hide,
			'default' => $crf_default_options['preloader-enable'],
	);
	$options['preloader-logo'] = array(
			'id' => 'preloader-logo',
			'label'   => esc_html__( 'Preloader logo', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['preloader-logo'],
	);
	$options['preloader-logo-retina'] = array(
			'id' => 'preloader-logo-retina',
			'label'   => esc_html__( 'Preloader logo Retina', 'semona' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $crf_default_options['preloader-logo-retina'],
	);
	$options['preloader-bar-color'] = array(
			'id' => 'preloader-bar-color',
			'label'   => esc_html__( 'Preloader Progress Bar Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['preloader-bar-color'],
	);
	
	/* Blog */
	
	$section = 'section-blog';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Blog', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( 'You can configure settings for blog archive/category and single pages here.', 'semona' ),
	);
	$options['blog-layout'] = array(
			'id' => 'blog-layout',
			'label'   => esc_html__( 'Blog Archive Layout', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_blog_layouts(),
			'default' => $crf_default_options['blog-layout'],
	);
	$options['blog-columns'] = array(
			'id' => 'blog-columns',
			'label'   => esc_html__( 'Blog Grid/Masonry/Simple/Modern Columns', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'2' => esc_html__( '2 Columns', 'semona' ),
					'3' => esc_html__( '3 Columns', 'semona' ),
					'4' => esc_html__( '4 Columns', 'semona' ),
			),
			'default' => $crf_default_options['blog-columns'],
			'active_callback' => 'crf_is_blog_grid_or_masonry',
	);
	$options['blog-index-title'] = array(
			'id' => 'blog-index-title',
			'label'   => esc_html__( 'Blog Index Page Title', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['blog-index-title'],
	);
	$options['blog-excerpt-length'] = array(
			'id' => 'blog-excerpt-length',
			'label'   => esc_html__( 'Post Excerpt Length', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['blog-excerpt-length'],
	);
	$options['blog-dateformat'] = array(
			'id' => 'blog-dateformat',
			'label'   => esc_html__( 'Blog Date Format', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['blog-dateformat'],
	);
	$options['blog-pagination'] = array(
			'id' => 'blog-pagination',
			'label'   => esc_html__( 'Archive Pagination Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_pagination_modes(),
			'default' => $crf_default_options['blog-pagination'],
	);
	$options['blog-bg-color'] = array(
			'id' => 'blog-bg-color',
			'label'   => esc_html__( 'Blog Background Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['blog-bg-color'],
	);
	$options['post-format-box-color'] = array(
			'id' => 'post-format-box-color',
			'label'   => esc_html__( 'Post Format Box Bg Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['post-format-box-color'],
	);
	$options['post-readmore-link-color'] = array(
			'id' => 'post-readmore-link-color',
			'label'   => esc_html__( 'Read More Link Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['post-readmore-link-color'],
	);
	$options['post-box-shadow-color'] = array(
			'id' => 'post-box-shadow-color',
			'label'   => esc_html__( 'Post Bottom Shadow Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['post-box-shadow-color'],
	);
	
	/* Portfolio */
	
	$section = 'section-portfolio';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Portfolio', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( 'You can configure settings for portfolio pages here.', 'semona' ),
	);
	$options['portfolio-layout'] = array(
			'id' => 'portfolio-layout',
			'label'   => esc_html__( 'Portfolio Archive Layout', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_portfolio_layouts(),
			'default' => $crf_default_options['portfolio-layout'],
	);
	$options['portfolio-masonry-columns'] = array(
			'id' => 'portfolio-masonry-columns',
			'label'   => esc_html__( 'Portfolio Masonry Columns', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'2' => esc_html__( '2 Columns', 'semona' ),
					'4' => esc_html__( '4 Columns', 'semona' ),
					'6' => esc_html__( '6 Columns', 'semona' ),
			),
			'default' => $crf_default_options['portfolio-masonry-columns'],
			'active_callback' => 'crf_is_portfolio_masonry',
	);
	$options['portfolio-grid-columns'] = array(
			'id' => 'portfolio-grid-columns',
			'label'   => esc_html__( 'Portfolio Grid Columns', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'1' => esc_html__( '1 Column', 'semona' ),
					'2' => esc_html__( '2 Columns', 'semona' ),
					'3' => esc_html__( '3 Columns', 'semona' ),
					'4' => esc_html__( '4 Columns', 'semona' ),
			),
			'default' => $crf_default_options['portfolio-grid-columns'],
			'active_callback' => 'crf_is_portfolio_grid',
	);
	$options['portfolio-items-per-page'] = array(
			'id' => 'portfolio-items-per-page',
			'label'   => esc_html__( 'Portfolio Items Per Page', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['portfolio-items-per-page'],
	);
	$options['portfolio-pagination'] = array(
			'id' => 'portfolio-pagination',
			'label'   => esc_html__( 'Archive Pagination Type', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_pagination_modes(),
			'default' => $crf_default_options['portfolio-pagination'],
	);
	$options['portfolio-show-related'] = array(
			'id' => 'portfolio-show-related',
			'label'   => esc_html__( 'Show Related Portfolios', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'yes' => esc_html__( 'Yes', 'semona' ),
					'no' => esc_html__( 'No', 'semona' ),
			),
			'default' => $crf_default_options['portfolio-show-related'],
	);
	$options['portfolio-related-style'] = array(
			'id' => 'portfolio-related-style',
			'label'   => esc_html__( 'Related Portfolios Style', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => sm_portfolio_related_styles(),
			'default' => $crf_default_options['portfolio-related-style'],
	);
	$options['portfolio-show-comments'] = array(
			'id' => 'portfolio-show-comments',
			'label'   => esc_html__( 'Show Comments', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
					'yes' => esc_html__( 'Yes', 'semona' ),
					'no' => esc_html__( 'No', 'semona' ),
			),
			'default' => $crf_default_options['portfolio-show-comments'],
	);
	$options['portfolio-grid2-shadow-color'] = array(
			'id' => 'portfolio-grid2-shadow-color',
			'label'   => esc_html__( 'Grid v2 Post Shadow Color', 'semona' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $crf_default_options['portfolio-grid2-shadow-color'],
	);
	$options['portfolio-slug'] = array(
			'id' => 'portfolio-slug',
			'label'   => esc_html__( 'Portfolio Slug', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['portfolio-slug'],
			'description' => esc_html__( 'Note: you must update your permalink structure after changing this option. Go to Admin, then Settings / Permalinks. Click Save Changes.', 'semona' ),
	);
	
	/* Sidebars */

	$section = 'section-sidebars';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Sidebars', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( "Select sidebar and its position for pages, blog, portfolio, search and woocommerce pages.", 'semona' ),
	);
	$options['sidebar-blog'] = array(
			'id' => 'sidebar-blog',
			'label'   => esc_html__( 'Blog Sidebar', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $sidebars,
			'default' => $crf_default_options['sidebar-blog'],
	);
	$options['sidebar-blog-pos'] = array(
			'id' => 'sidebar-blog-pos',
			'label'   => esc_html__( 'Blog Sidebar Position', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $sidebar_positions,
			'default' => $crf_default_options['sidebar-blog-pos'],
	);
	$options['sidebar-portfolio'] = array(
			'id' => 'sidebar-portfolio',
			'label'   => esc_html__( 'Portfolio Sidebar', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $sidebars,
			'default' => $crf_default_options['sidebar-portfolio'],
	);
	$options['sidebar-portfolio-pos'] = array(
			'id' => 'sidebar-portfolio-pos',
			'label'   => esc_html__( 'Portfolio Sidebar Position', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $sidebar_positions,
			'default' => $crf_default_options['sidebar-portfolio-pos'],
	);
	$options['sidebar-page'] = array(
			'id' => 'sidebar-page',
			'label'   => esc_html__( 'Page Sidebar', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $sidebars,
			'default' => $crf_default_options['sidebar-page'],
	);
	$options['sidebar-page-pos'] = array(
			'id' => 'sidebar-page-pos',
			'label'   => esc_html__( 'Page Sidebar Position', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $sidebar_positions,
			'default' => $crf_default_options['sidebar-page-pos'],
	);
	$options['sidebar-search'] = array(
			'id' => 'sidebar-search',
			'label'   => esc_html__( 'Search Page Sidebar', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $sidebars,
			'default' => $crf_default_options['sidebar-search'],
	);
	$options['sidebar-search-pos'] = array(
			'id' => 'sidebar-search-pos',
			'label'   => esc_html__( 'Search Page Sidebar Position', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $sidebar_positions,
			'default' => $crf_default_options['sidebar-search-pos'],
	);
	$options['sidebar-woocommerce'] = array(
			'id' => 'sidebar-woocommerce',
			'label'   => esc_html__( 'WooCommerce Sidebar', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $sidebars,
			'default' => $crf_default_options['sidebar-woocommerce'],
	);
	$options['sidebar-woocommerce-pos'] = array(
			'id' => 'sidebar-woocommerce-pos',
			'label'   => esc_html__( 'WooCommerce Sidebar Position', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $sidebar_positions,
			'default' => $crf_default_options['sidebar-woocommerce-pos'],
	);
	$options['sidebar-bbpress'] = array(
			'id' => 'sidebar-bbpress',
			'label'   => esc_html__( 'bbPress Sidebar', 'semona' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $sidebars,
			'default' => $crf_default_options['sidebar-bbpress'],
	);
	$options['sidebar-bbpress-pos'] = array(
			'id' => 'sidebar-bbpress-pos',
			'label'   => esc_html__( 'bbPress Sidebar Position', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => $sidebar_positions,
			'default' => $crf_default_options['sidebar-bbpress-pos'],
	);
	
	
	/* Social Links */
	
	$section = 'social-links';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Social Links', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( 'Type in social link addresses. Enter full urls in the fields.', 'semona' ),
	);
	$options['social-facebook'] = array(
			'id' => 'social-facebook',
			'label'   => esc_html__( 'Facebook', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-facebook'],
	);
	$options['social-twitter'] = array(
			'id' => 'social-twitter',
			'label'   => esc_html__( 'Twitter', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-twitter'],
	);
	$options['social-googleplus'] = array(
			'id' => 'social-googleplus',
			'label'   => esc_html__( 'Google+', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-googleplus'],
	);
	$options['social-instagram'] = array(
			'id' => 'social-instagram',
			'label'   => esc_html__( 'Instagram', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-instagram'],
	);
	$options['social-pinterest'] = array(
			'id' => 'social-pinterest',
			'label'   => esc_html__( 'Pinterest', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-pinterest'],
	);
	$options['social-dribbble'] = array(
			'id' => 'social-dribbble',
			'label'   => esc_html__( 'Dribbble', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-dribbble'],
	);
	$options['social-skype'] = array(
			'id' => 'social-skype',
			'label'   => esc_html__( 'Skype', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-skype'],
	);
	$options['social-youtube'] = array(
			'id' => 'social-youtube',
			'label'   => esc_html__( 'Youtube', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-youtube'],
	);
	$options['social-rss'] = array(
			'id' => 'social-rss',
			'label'   => esc_html__( 'RSS', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-rss'],
	);
	$options['social-tumblr'] = array(
			'id' => 'social-tumblr',
			'label'   => esc_html__( 'Tumblr', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-tumblr'],
	);
	$options['social-behance'] = array(
			'id' => 'social-behance',
			'label'   => esc_html__( 'Behance', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-behance'],
	);
	$options['social-vimeo'] = array(
			'id' => 'social-vimeo',
			'label'   => esc_html__( 'Vimeo', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-vimeo'],
	);
	$options['social-github'] = array(
			'id' => 'social-github',
			'label'   => esc_html__( 'Github', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-github'],
	);
	$options['social-linkedin'] = array(
			'id' => 'social-linkedin',
			'label'   => esc_html__( 'LinkedIn', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['social-linkedin'],
	);
	
	/* WooCommerce */
	
	$section = 'woocommerce';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'WooCommerce', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( 'Configure WooCommerce settings in this section.', 'semona' ),
	);
	$options['woocommerce-product-columns'] = array(
			'id' => 'woocommerce-product-columns',
			'label'   => esc_html__( 'Product Grid Columns', 'semona' ),
			'section' => $section,
			'type'    => 'radio',
			'choices'  => array(
					'2' => esc_html__( '2 Columns', 'semona' ),
					'3' => esc_html__( '3 Columns', 'semona' ),
					'4' => esc_html__( '4 Columns', 'semona' ),
			),
			'default' => $crf_default_options['woocommerce-product-columns'],
	);
	$options['woocommerce-products-per-page'] = array(
			'id' => 'woocommerce-products-per-page',
			'label'   => esc_html__( 'Products Per Page', 'semona' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $crf_default_options['woocommerce-products-per-page'],
	);

	/* Custom Code options */
	
	$section = 'custom-code';
	$sections[] = array(
			'id' => $section,
			'title' => esc_html__( 'Custom Code', 'semona' ),
			'priority' => $priority++,
			'description' => esc_html__( "Enter your custom CSS and JS code here. You can use custom codes to quickly make small changes or put analytics js code. Do not place any <script> or <style> tags as they're already added.", 'semona' ),
	);
	$options['custom-css'] = array(
			'id' => 'custom-css',
			'label'   => esc_html__( 'Custom CSS', 'semona' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $crf_default_options['custom-css'],
	);
	$options['custom-js'] = array(
			'id' => 'custom-js',
			'label'   => esc_html__( 'Custom JS', 'semona' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $crf_default_options['custom-js'],
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;
	// Adds the panels to the $options array
	$options['panels'] = $panels;
	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );
	// To delete custom mods use: customizer_library_remove_theme_mods();
}
add_action( 'init', 'crf_customizer_library_options' );

function crf_is_header_v1_only( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v1' );
}

function crf_is_header_v1( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v1' || $option->value() == 'v3' );
}
function crf_is_header_v2( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v2' );
}
function crf_is_header_v3( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v3' );
}
function crf_is_header_v1_or_v4( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v1' || $option->value() == 'v4' );
}
function crf_is_header_v1_or_v3( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v1' || $option->value() == 'v3' );
}
function crf_is_header_v1_v3_or_v4( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v1' || $option->value() == 'v3' || $option->value() == 'v4' );
}
function crf_is_header_v4( $control ) {
	$option = $control->manager->get_setting( 'header-style' );
	return ( $option->value() == 'v4' );
}
function crf_is_topbar_color_options_available( $control ) {
	$option = $control->manager->get_setting( 'topbar-skin' );
	return ( $option->value() == 'default-bg' || $option->value() == 'bg2-bg' );
}
function crf_is_topbar_bottom_border_available( $control ) {
	$option = $control->manager->get_setting( 'topbar-skin' );
	return ( $option->value() == 'default-bg' );
}
function crf_is_footer_style3( $control ) {
	$option = $control->manager->get_setting( 'footer-style' );
	return $option->value() == 'style3';
}
function crf_is_blog_grid_or_masonry( $control ) {
	$option = $control->manager->get_setting( 'blog-layout' );
	return ( $option->value() == 'grid' ) || ( $option->value() == 'masonry' ) || ( $option->value() == 'simple' ) || ( $option->value() == 'modern' );
}
function crf_is_portfolio_masonry( $control ) {
	$option = $control->manager->get_setting( 'portfolio-layout' );
	return $option->value() == 'masonry';
}
function crf_is_portfolio_grid( $control ) {
	$option = $control->manager->get_setting( 'portfolio-layout' );
	return ( $option->value() == 'grid' ) || ( $option->value() == 'grid2' ) || ( $option->value() == 'grid3' ) || ( $option->value() == 'grid4' );
}
function crf_is_layout_boxed( $control ) {
	$option = $control->manager->get_setting( 'site-layout' );
	return ( $option->value() == 'boxed' );
}
function crf_is_outer_bg_pattern( $control ) {
	$option = $control->manager->get_setting( 'outer-bg-type' );
	return ( $option->value() == 'pattern' );
}
function crf_is_outer_bg_image( $control ) {
	$option = $control->manager->get_setting( 'outer-bg-type' );
	return ( $option->value() == 'image' );
}