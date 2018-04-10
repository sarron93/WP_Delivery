<?php

/* Demo Importer works only in admin */
if( is_admin() ) {
	define( 'DEMO_IMPORTER_NONCE', 'f82b4275587b3783' );
	define( 'DEMO_IMPORTER_PATH', FRAMEWORK_PATH . '/lib/demo-importer/' );
	
	require_once DEMO_IMPORTER_PATH . '/demo-importer-admin.php';
	require_once DEMO_IMPORTER_PATH . '/demo-importer-ajax.php';
}
