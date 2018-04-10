<?php

if( isset( $_POST['import'] ) ) {
	if( check_admin_referer( 'crf-customizer-import-settings' ) ) {
		crf_import_customizer_settings();
		function crf_imported_notice() {
			$class = "updated";
			$message = esc_html__( "Customizer settings successfully imported.", 'semona' );
			echo "<div class=\"$class\"><p>$message</p></div>";
		}
		add_action( 'admin_notices', 'crf_imported_notice', 11 );
	}
}
if( isset( $_POST['export'] ) ) {
	if( check_admin_referer( 'crf-customizer-export-settings' ) ) {
		crf_export_customizer_settings();
	}
}
if( isset( $_POST['reset'] ) ) {
	if( check_admin_referer( 'crf-customizer-reset-settings' ) ) {
		crf_reset_customizer_settings();
		function crf_imported_notice() {
			$class = "updated";
			$message = esc_html__( "Customizer settings successfully reseted to defaults.", 'semona' );
			echo "<div class=\"$class\"><p>$message</p></div>";
		}
		add_action( 'admin_notices', 'crf_imported_notice', 11 );
	}
}

add_action( 'admin_menu', 'crf_customizer_menu', 11 );
function crf_customizer_menu() {
	add_theme_page( 
		__( 'Settings Manager', 'semona' ), 
		__( 'Settings Manager', 'semona' ), 
		'manage_options', 
		THEME_SLUG . '-customizer',
		'crf_customizer_admin'
	);
}

function crf_customizer_admin() {
?>
<h1 class='crf-pagetitle'><?php echo THEME_NAME . ' ' . esc_html__( 'Theme Settings Manager', 'semona' ) ?></h1>
<p class='crf-subtitle'><?php _e( 'You can manage your customizer settings here.', 'semona' ) ?></p>
<div class="metabox-holder crf-admin-section clear">
	<div class='crf-customizer-admin postbox col-one-third'>
		<h3 class='hndle ui-sortable-handle'>
			<span class="dashicons dashicons-upload"></span>
			<span><?php _e( 'Import Settings', 'semona' ) ?></span>
		</h3>
		<div class='inside'>
			<p><?php _e( 'Upload your customizer settings file here, and we\'ll import the options into this site.', 'semona' ) ?></p>
			<p><?php _e( 'Choose a JSON file that was exported in this theme settings manager, and then click "Upload and Import."', 'semona' ) ?></p>
			<form method="post" enctype="multipart/form-data" id="import-form">
				<?php wp_nonce_field( 'crf-customizer-import-settings' ); ?>
				<input type="file" id="tc_settings_file" name="tc_settings_file">
				<input type="submit" name="import" class="button button-primary smaller button-import-tc-settings" value="<?php _e( 'Upload and Import', 'semona' ) ?>">
			</form>
		</div>
	</div>
	<div class='crf-customizer-admin postbox col-one-third'>
		<h3 class='hndle ui-sortable-handle'>
			<span class="dashicons dashicons-download"></span>
			<span><?php _e( 'Export Settings', 'semona' ) ?></span>
		</h3>
		<div class='inside'>
			<p><?php _e( 'Click the button below to export your customizer settings to JSON file and save it on your computer.', 'semona' ) ?></p>
			<p><?php _e( 'Once you\'ve saved the downloaded file, you can import it in Import Settings section later.', 'semona' ) ?></p>
			<form method="post">
				<?php wp_nonce_field( 'crf-customizer-export-settings' ); ?>
				<input type="submit" name="export" class="button button-primary smaller button-export-tc-settings" value="<?php _e( 'Download Export File', 'semona' ) ?>">
			</form>
		</div>
	</div>
	<div class='crf-customizer-admin postbox col-one-third'>
		<h3 class='hndle ui-sortable-handle'>
			<span class="dashicons dashicons-update"></span>
			<span><?php _e( 'Reset Settings', 'semona' ) ?></span>
		</h3>
		<div class='inside'>
			<p><?php _e( 'If you click the button below, all customizer settings will be resetted to default values.', 'semona' ) ?></p>
			<form method="post" id="reset-form">
				<?php wp_nonce_field( 'crf-customizer-reset-settings' ); ?>
				<input type="submit" name="reset" class="button button-primary smaller button-reset-tc-settings" value="<?php _e( 'Reset Customizer Settings', 'semona' ) ?>">
			</form>
		</div>
	</div>
</div>
<script type='text/javascript'>
"use strict";

( function( $, window, undefined ) {
	$('#import-form').on( 'submit', function() {
		if( !confirm( '<?php _e( 'Do you really want to import customizer settings from file?', 'semona' ) ?>' ) ) {
			return false;
		}
	} );
	$('#reset-form').on( 'submit', function() {
		if( !confirm( '<?php _e( 'Do you really want to reset your customizer settings?', 'semona' ) ?>' ) ) {
			return false;
		}
	} );
} )( jQuery, window );
</script>
<?php
}

function crf_import_tc_settings( $file ) {
	remove_theme_mods();
	$options_json = file_get_contents( $file );
	$options = json_decode( $options_json );
	foreach( $options as $key => $value ) {
		if( $key != "0" && ( is_string( $value ) || is_numeric( $value ) ) ) {
			set_theme_mod( $key, $value );
		}
	}
}

function crf_import_customizer_settings() {
	if( $_FILES['tc_settings_file']['error'] > 0 ) {
		wp_die( 'An import error occured. Please try again.' );
	} else {
		crf_import_tc_settings( $_FILES['tc_settings_file']['tmp_name'] );
	}
}

function crf_export_customizer_settings() {
	$blogname  = strtolower( str_replace( ' ', '-', get_option( 'blogname' ) ) );
	$file_name = $blogname . '-theme-options.json';
	header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
	header( 'Content-Disposition: attachment; filename="' . $file_name );
	
	ob_clean();
	$options = get_theme_mods();
	echo json_encode( $options );
	exit();
}
function crf_reset_customizer_settings() {
	remove_theme_mods();
}
