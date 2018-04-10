<?php

if( is_admin() ) {
	
	/*
	 * TGM Plugin Activation
	 */
	
	add_action ( 'tgmpa_register', 'crf_register_required_plugins' );
	function crf_register_required_plugins() {
		
		/**
		 * Array of plugin arrays.
		 * Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array (
				array (
						'name' => 'Semona Extension',
						'slug' => 'semona-extension',
						'source' => get_template_directory_uri() . '/plugins/semona-extension.zip',
						'required' => true,
						'version' => '1.4.4',
						'external_url' => '' 
				),
				array (
						'name' => 'Visual Composer',
						'slug' => 'js_composer',
						'source' => get_template_directory_uri() . '/plugins/js_composer.zip',
						'required' => true,
						'version' => '4.8.0.1',
						'external_url' => '' 
				),
				array (
						'name' => 'Revolution Slider',
						'slug' => 'revslider',
						'source' => get_template_directory_uri() . '/plugins/revslider.zip',
						'required' => false,
						'version' => '5.0.8.5',
						'external_url' => '' 
				),
				array (
						'name' => 'Layer Slider',
						'slug' => 'LayerSlider',
						'source' => get_template_directory_uri() . '/plugins/layerslider.zip',
						'required' => false,
						'version' => '5.6.2',
						'external_url' => '' 
				),
				array(
						'name'		=> 'Contact Form 7',
						'slug'		=> 'contact-form-7',
						'required'	=> false,
				),
		);
		
		/**
		 * Array of configuration settings.
		 * Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array (
				'default_path' => '', // Default absolute path to pre-packaged plugins.
				'menu' => 'tgmpa-install-plugins', // Menu slug.
				'has_notices' => true, // Show admin notices or not.
				'dismissable' => true, // If false, a user cannot dismiss the nag message.
				'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false, // Automatically activate plugins after installation or not.
				'message' => '', // Message to output right before the plugins table.
				'strings' => array (
						'page_title' => __ ( 'Install Required Plugins', 'semona' ),
						'menu_title' => __ ( 'Install Plugins', 'semona' ),
						'installing' => __ ( 'Installing Plugin: %s', 'semona' ),
						'oops' => __ ( 'Something went wrong with the plugin API.', 'semona' ),
						'notice_can_install_required' => _n_noop ( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'semona' ), // %1$s = plugin name(s).
						'notice_can_install_recommended' => _n_noop ( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'semona' ), // %1$s = plugin name(s).
						'notice_cannot_install' => _n_noop ( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'semona' ), // %1$s = plugin name(s).
						'notice_can_activate_required' => _n_noop ( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'semona' ), // %1$s = plugin name(s).
						'notice_can_activate_recommended' => _n_noop ( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'semona' ), // %1$s = plugin name(s).
						'notice_cannot_activate' => _n_noop ( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'semona' ), // %1$s = plugin name(s).
						'notice_ask_to_update' => _n_noop ( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'semona' ), // %1$s = plugin name(s).
						'notice_cannot_update' => _n_noop ( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'semona' ), // %1$s = plugin name(s).
						'install_link' => _n_noop ( 'Begin installing plugin', 'Begin installing plugins', 'semona' ),
						'activate_link' => _n_noop ( 'Begin activating plugin', 'Begin activating plugins', 'semona' ),
						'return' => __ ( 'Return to Required Plugins Installer', 'semona' ),
						'plugin_activated' => __ ( 'Plugin activated successfully.', 'semona' ),
						'complete' => __ ( 'All plugins installed and activated successfully. %s', 'semona' ),
						'nag_type' => 'updated' 
				) 
		);
		
		tgmpa ( $plugins, $config );
	}
	
	/* Theme admin css */
	if( !function_exists( 'crf_admin_css' ) ) {
		add_action( 'admin_enqueue_scripts', 'crf_admin_css' );
		function crf_admin_css() {
			wp_enqueue_style( 'crf-admin', FRAMEWORK_URI . '/assets/css/admin.css' );
			wp_enqueue_style( 'crf-admin-editor-styles', FRAMEWORK_URI . '/assets/css/editor-style.css' );
			wp_enqueue_style( 'crf-fontawesome', get_template_directory_uri() . '/vendor/font-awesome-4.3.0/css/font-awesome.min.css', false, '4.3', 'screen' );
			if( !wp_style_is( 'sm_pe_icon_7_stroke' ) ) {
				wp_enqueue_style( 'sm_pe_icon_7_stroke', get_template_directory_uri() . '/vendor/pe-icon-7-stroke/css/pe-icon-7-stroke.css' );
			}
		}
	}

	/*
	 * Register admin scripts
	 */
	function crf_register_admin_scripts() {
		wp_register_script( 'crf-widgets', FRAMEWORK_URI . '/assets/js/widgets.js' );
	}
	add_action( 'admin_enqueue_scripts', 'crf_register_admin_scripts' );
}

/*
 * Theme Initialization
 */
function crf_init() {
	register_nav_menu ( 'main-menu', __ ( 'Main Navigation Menu', 'semona' ) );
	register_nav_menu ( 'footer-menu', __ ( 'Footer Menu', 'semona' ) );
}
add_action ( 'init', 'crf_init' );

/*
 * Widget area initialization
 */
function semona_widgets_init() {
	/* Sidebars */
	register_sidebar ( array (
			'name' => __ ( 'Sidebar', 'semona' ),
			'id' => 'crf-sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget crf-widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
	) );
	register_sidebar ( array (
			'name' => __ ( 'Shop Sidebar', 'semona' ),
			'id' => 'crf-shop-sidebar',
			'before_widget' => '<div id="%1$s" class="widget crf-widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
	) );
	
	/* Footer widget columns */
	register_sidebar ( array (
			'name' => __ ( 'Footer Widget Area 1', 'semona' ),
			'id' => 'crf-footer-widget-1',
			'before_widget' => '<div id="%1$s" class="widget crf-widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
	) );
	register_sidebar ( array (
		'name' => __ ( 'Footer Widget Area 2', 'semona' ),
		'id' => 'crf-footer-widget-2',
		'before_widget' => '<div id="%1$s" class="widget crf-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	) );
	register_sidebar ( array (
		'name' => __ ( 'Footer Widget Area 3', 'semona' ),
		'id' => 'crf-footer-widget-3',
		'before_widget' => '<div id="%1$s" class="widget crf-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	) );
	register_sidebar ( array (
		'name' => __ ( 'Footer Widget Area 4', 'semona' ),
		'id' => 'crf-footer-widget-4',
		'before_widget' => '<div id="%1$s" class="widget crf-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	) );
}
add_action ( 'widgets_init', 'semona_widgets_init' );

/* 
 * Add font control to MCE editor
 */
function crf_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	array_unshift( $buttons, 'fontsizeselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'crf_mce_buttons_2');

function crf_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
			array(
					'title' => 'Lightweight Text',
					'inline' => 'span',
					'classes' => 'light',
					'wrapper' => true,
						
			),
			array(
					'title' => 'Uppercased Text',
					'inline' => 'span',
					'classes' => 'uppercase',
					'wrapper' => true,
			),
			array(
					'title' => 'Primary Color',
					'inline' => 'span',
					'classes' => 'primary-color',
					'wrapper' => true,
			
			),
			array(
					'title' => 'Secondary Color',
					'inline' => 'span',
					'classes' => 'secondary-color',
					'wrapper' => true,
			
			),
			array(
					'title' => 'Text With Shadow',
					'inline' => 'span',
					'classes' => 'text-shadow',
					'wrapper' => true,
			),
			array(
					'title' => 'Theme Text Font 2',
					'inline' => 'span',
					'classes' => 'text-font2',
					'wrapper' => true,
			),
	);
	$init_array['style_formats'] = json_encode( $style_formats );
	$init_array['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 20px 24px 26px 28px 30px 32px 36px 40px 44px 50px 60px 72px 100px";

	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'crf_mce_before_init_insert_formats' );

function crf_add_editor_styles() {
	add_editor_style( FRAMEWORK_URI . '/assets/css/editor-style.css' );
}
add_action( 'init', 'crf_add_editor_styles' );
