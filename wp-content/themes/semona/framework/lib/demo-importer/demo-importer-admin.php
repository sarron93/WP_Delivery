<?php

add_action( 'admin_menu', 'crf_demo_importer_menu', 11 );
function crf_demo_importer_menu() {
	add_theme_page(
		__( 'Demo Importer', 'semona' ),
		__( 'Demo Importer', 'semona' ),
		'manage_options',
		THEME_SLUG . '-demo-content',
		'crf_demo_importer_admin'
	);
}
function crf_demo_importer_admin() {
?>
<h1 class='crf-pagetitle'><?php echo THEME_NAME . ' ' . esc_html__( 'Demo Content Importer', 'semona' ) ?></h1>
<div class="metabox-holder">
	<div class='crf-demo-importer-admin postbox crf-admin-section'>
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class='hndle ui-sortable-handle'>
			<span><?php _e( 'Demo Content Importer', 'semona' ); ?></span>
		</h3>
		<div class='content inside import-form'>
			<div class='section'>
				<?php _e( 'Select which demo you would like to import:', 'semona' ) ?>
				<select id="demo" name="demo">
					<option value="business"><?php echo esc_html__( 'Business Demo', 'semona' ) ?></option>
					<option value="agency"><?php echo esc_html__( 'Agency Demo', 'semona' ) ?></option>
					<option value="fashion"><?php echo esc_html__( 'Fashion Demo', 'semona' ) ?></option>
					<option value="app01"><?php echo esc_html__( 'App Demo 01', 'semona' ) ?></option>
					<option value="app02"><?php echo esc_html__( 'App Demo 02', 'semona' ) ?></option>
					<option value="blogstyles"><?php echo esc_html__( 'New Blog Styles Demo', 'semona' ) ?></option>
					<option value="onepage"><?php echo esc_html__( 'One Page Agency Demo', 'semona' ) ?></option>
					<option value="resume"><?php echo esc_html__( 'Personal Resume Demo', 'semona' ) ?></option>
					<option value="shop"><?php echo esc_html__( 'Ecommerce Demo', 'semona' ) ?></option>
					<option value="construction"><?php echo esc_html__( 'Construction Demo', 'semona' ) ?></option>
					<option value="restaurant"><?php echo esc_html__( 'Restaurant Demo', 'semona' ) ?></option>
					<option value="creative"><?php echo esc_html__( 'Creative Demo', 'semona' ) ?></option>
					<option value="ebook"><?php echo esc_html__( 'Ebook Demo', 'semona' ) ?></option>
					<option value="movie"><?php echo esc_html__( 'Movie Demo', 'semona' ) ?></option>
					<option value="gym"><?php echo esc_html__( 'Gym Demo', 'semona' ) ?></option>
					<option value="travel"><?php echo esc_html__( 'Travel Demo', 'semona' ) ?></option>
					<option value="cleaning"><?php echo esc_html__( 'Cleaning Demo', 'semona' ) ?></option>
				</select>
			</div>
			<!--<div class='section'>
				<?php _e( 'Click the button below to load demo content.', 'semona' ) ?>
			</div>-->
			<a class="button button-primary button-demo-import" href="#"><?php _e( 'Import Demo Content', 'semona' ) ?></a>
			<div class='clear'></div>
			<div class='note'>
				<strong><?php _e( 'Important Notes', 'semona' ) ?></strong>
				<ul>
					<li><?php _e( 'All customizer settings will be overwritten.', 'semona' ) ?></li>
					<li><?php _e( 'Please install all required plugins before loading demo content.', 'semona' ) ?></li>
					<li><?php _e( 'It will take a few minutes to download all attachments from demo website.', 'semona' ) ?></li>
				</ul>
			</div>
			<div class='clear'></div>
		</div>
		<div class='content inside progress'>
		</div>
	</div>
</div>
<?php

$ajax_nonce = wp_create_nonce( DEMO_IMPORTER_NONCE );
?>
<script type="text/javascript">
"use strict";

( function( $, window, undefined ) {
	var admin_ajax_url = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
	var demo = '';
	function crf_import_one_type( name, slug, complete_handler ) {
		$('.progress').append( '<p><?php echo esc_html__( 'Importing', 'semona' ) ?> ' + name + '...' + '</p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'crf_demo_import_' + slug,
				demo: demo,
				security: '<?php echo ( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing', 'semona' ) ?> ' + name + ': ' + data + '</p>' );
				}
				complete_handler();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Error occurred during import process. Possible server error.', 'semona' ) ?></p>' );
				complete_handler();
			}
		} );
	}
	function crf_import_posts() {
		crf_import_one_type( '<?php echo esc_html__( 'Posts', 'semona' ) ?>', 'posts', crf_import_pages );
	}
	function crf_import_pages() {
		crf_import_one_type( '<?php echo esc_html__( 'Pages', 'semona' ) ?>', 'pages', crf_import_portfolio );
	}
	function crf_import_portfolio() {
		crf_import_one_type( '<?php echo esc_html__( 'Portfolio', 'semona' ) ?>', 'portfolios', crf_import_cf );
	}
	function crf_import_cf() {
		crf_import_one_type( '<?php echo esc_html__( 'Contact Forms', 'semona' ) ?>', 'cf', crf_import_products );
	}
	function crf_import_products() {
		crf_import_one_type( '<?php echo esc_html__( 'Products', 'semona' ) ?>', 'products', crf_widget_import );
	}
	function crf_widget_import() {
		$('.progress').append( '<p><?php _e( 'Importing Widgets...', 'semona' ) ?></p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'crf_demo_widgets_import',
				demo: demo,
				security: '<?php echo ( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing widgets:', 'semona' ) ?> ' + data + '</p>' );
				}
				crf_import_theme_options();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Failed to connect to server.', 'semona' ) ?></p>' );
				crf_import_theme_options();
			}
		} );
	}
	function crf_import_theme_options() {
		$('.progress').append( '<p><?php _e( 'Importing Customizer Settings...', 'semona' ) ?></p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'crf_demo_import_theme_options',
				demo: demo,
				security: '<?php echo ( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing customizer settings:', 'semona' ) ?> ' + data + '</p>' );
				}
				crf_import_sliders();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Failed to connect to server.', 'semona' ) ?></p>' );
				crf_import_sliders();
			}
		} );
	}
	function crf_import_sliders() {
		$('.progress').append( '<p><?php _e( 'Importing Sliders...', 'semona' ) ?></p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'crf_demo_import_sliders',
				demo: demo,
				security: '<?php echo ( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing sliders:', 'semona' ) ?> ' + data + '</p>' );
				}
				crf_import_attachments();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Failed to connect to server.', 'semona' ) ?></p>' );
				crf_import_attachments();
			}
		} );
	}
	function crf_import_attachments() {
		crf_import_one_type( '<?php echo esc_html__( 'Attachments', 'semona' ) ?>', 'attachments', crf_import_menu );
	}
	function crf_import_menu() {
		crf_import_one_type( '<?php echo esc_html__( 'Menu', 'semona' ) ?>', 'menus', crf_import_finished );
	}
	function crf_import_finished() {
		$('.progress').append( '<p><?php _e( 'Import finished.', 'semona' ) ?></p>' );
	}
	/* Start import process */
	function crf_start_import() {
		crf_import_posts();
	}
	$(window).load( function() {
		$('.button-demo-import').on( 'click', function() {
			demo = $('#demo').val();
			$('.import-form').fadeOut( 600, function() {
				$('.progress').fadeIn( 300 );
				crf_start_import();
			} );
			return false;
		} );
	} );
} )( jQuery, window );
</script>
<?php
}
