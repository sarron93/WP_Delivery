<?php   
/*
 * Crystal Framework
 *
 * Developed by Theme-Paradise
 * 
 */

if( !defined( 'ABSPATH' ) ) {
	die( 'Do not access this file directly.' );
}

/********************  Constants  ********************/

define ( 'FRAMEWORK_PATH', get_template_directory () . '/framework' );
define ( 'FRAMEWORK_URI', get_template_directory_uri () . '/framework' );

define ( 'THEME_NAME', 'Semona' );
define ( 'THEME_SLUG', 'semona' );
define ( 'THEME_ADMIN_MENU_SLUG', THEME_SLUG . '-customizer' );

define ( 'MAX_IMPORTING_TIME', 600 );


/********************  Functions  ********************/

/* Breadcrumb */
require_once FRAMEWORK_PATH . '/functions/breadcrumb.php';

/* Color functions */
require_once FRAMEWORK_PATH . '/functions/color.php';

/* Helpers */
require_once FRAMEWORK_PATH . '/functions/helpers.php';

/* Theme and meta options  */
require_once FRAMEWORK_PATH . '/functions/options.php';

/* Pagination */
require_once FRAMEWORK_PATH . '/functions/pagination.php';

/* Url */
require_once FRAMEWORK_PATH . '/functions/url.php';


/********************  Libraries  ********************/

/* TGMPA */
require_once FRAMEWORK_PATH . '/lib/class-tgm-plugin-activation.php';

/* Sidebar generator */
require_once FRAMEWORK_PATH . '/lib/sidebar_generator.php';

/* Megamenu */
require_once FRAMEWORK_PATH . '/lib/megamenu/megamenu.php';

/* Featured Galleries */
require_once FRAMEWORK_PATH . '/lib/featured-galleries/featured-galleries.php';

/* Metaboxes */
require_once FRAMEWORK_PATH . '/lib/metaboxes/metaboxes.php';

/* WP Customizer */
require_once FRAMEWORK_PATH . '/lib/customizer/customizer.php';

/* Demo Importer */
require_once FRAMEWORK_PATH . '/lib/demo-importer/demo-importer.php';

/* Like Post */
require_once FRAMEWORK_PATH . '/lib/likepost.php';


/****************  Framework initialization  ****************/

require_once FRAMEWORK_PATH . '/functions/init.php';
