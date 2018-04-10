<?php   
/*
Plugin Name: Row Scroll Animation
Description: This is a template for all Gambit WP plugins
Author: Gambit Technologies
Version: 2.2
Author URI: http://gambit.ph
Plugin URI: http://codecanyon.net/user/gambittech/portfolio
Text Domain: row_scroll
Domain Path: /languages
SKU: ROWSCROLL
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Identifies the plugin itself. If already existing, it will not redefine itself.
defined( 'VERSION_GAMBIT_ROW_SCROLL' ) or define( 'VERSION_GAMBIT_ROW_SCROLL', '1.0' );

// Initializes the plugin translations.
defined( 'GAMBIT_ROW_SCROLL' ) or define( 'GAMBIT_ROW_SCROLL', 'row_scroll' );

// Plugin automatic updates
require_once( 'class-admin-license.php' );

// This is the main plugin functionality
require_once( 'class-row_scroll.php' );


// Initializes plugin class.
if ( ! class_exists( 'GambitRowScrollPlugin' ) ) {
	
	class GambitRowScrollPlugin {

		/**
		 * Hook into WordPress
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {

			// Admin pointer reminders for automatic updates
			require_once( 'class-admin-pointers.php' );
			if ( class_exists( 'GambitAdminPointers' ) ) {
				new GambitAdminPointers( array (
					'pointer_name' => 'GambitRowScrollPlugin', // This should also be placed in uninstall.php
					'header' => __( 'Automatic Updates', GAMBIT_ROW_SCROLL ),
					'body' => __( 'Keep Row Scroll Animation updated by entering your purchase code here.', GAMBIT_ROW_SCROLL ),
				) );
			}

			// Our translations
			add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ), 1 );

			// Gambit links
			add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );
		}


		/**
		 * Loads the translations
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function loadTextDomain() {
			load_plugin_textdomain( GAMBIT_ROW_SCROLL, false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Adds plugin links
		 *
		 * @access	public
		 * @param	array $plugin_meta The current array of links
		 * @param	string $plugin_file The plugin file
		 * @return	array The current array of links together with our additions
		 * @since	1.0
		 **/
		public function pluginLinks( $plugin_meta, $plugin_file ) {
			if ( $plugin_file == plugin_basename( __FILE__ ) ) {
				$pluginData = get_plugin_data( __FILE__ );

				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"http://support.gambit.ph?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get Customer Support", GAMBIT_ROW_SCROLL )
				);
				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"https://gambit.ph/plugins?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get More Plugins", GAMBIT_ROW_SCROLL )
				);
			}
			return $plugin_meta;
		}


	}

	new GambitRowScrollPlugin();
}