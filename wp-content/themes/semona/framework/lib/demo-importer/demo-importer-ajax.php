<?php

define( 'CRF_DEMO_PATH', get_template_directory() . '/inc/demo/' );

function crf_ajax_finish( $result, $message ) {
	echo esc_html( $message );
	die();
}
function crf_get_demo_file_path( $filename ) {
	$path = CRF_DEMO_PATH;
	if( !empty( $_POST['demo'] ) ) {
		if( $_POST['demo'] != 'default' ) {
			$path .= $_POST['demo'] . '/';
		}
	}
	$path .= $filename;
	return $path;
}

function crf_import_xml( $demo_xml_file ) {
	if( function_exists( 'check_ajax_referer' ) ) {
		check_ajax_referer( DEMO_IMPORTER_NONCE, 'security' );
	}
	
	header( 'Content-type: text/html; charset=utf-8' );
	
	define( 'WP_LOAD_IMPORTERS', true );

	require_once ABSPATH . 'wp-admin/includes/import.php';
	$import_error = false;
	
	if( !class_exists( 'WP_Importer' ) ) {
		$wp_importer_file = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if( file_exists( $wp_importer_file ) ) {
			require_once $wp_importer_file;
		} else {
			$import_error = true;
		}
	}
	if( !class_exists( 'WP_Import' ) ) {
		require_once FRAMEWORK_PATH . '/lib/demo-importer/wordpress-importer/wordpress-importer.php';
	}
	
	if( $import_error || !class_exists( 'WP_Import' ) ) {
		crf_ajax_finish( false, esc_html__( 'Failed to load importer php files. Use WordPress Importer plugin to manually load demo content xml file.', 'semona' ) );
	}
	if( !is_file( $demo_xml_file ) ) {
		crf_ajax_finish( true, "done" );
	}
	
	$wp_import = new WP_Import();
	$wp_import->fetch_attachments = true;
	set_time_limit( 0 );
	ob_start();
	$wp_import->import( $demo_xml_file );
	ob_get_clean();
	
	crf_ajax_finish( true, "done" );
}

function crf_set_home_and_menu() {
	$options_data = file_get_contents( crf_get_demo_file_path( 'options.json' ) );
	if( $options_data ) {
		$options = json_decode( $options_data, true );

		if( !empty( $options['home'] ) ) {
			$homepage = get_page_by_title( $options['home'] );
			if( $homepage ) {
				update_option( 'page_on_front', $homepage->ID );
				update_option( 'show_on_front', 'page' );
			}
		}

		if( !empty( $options['menus'] ) && is_array( $options['menus'] ) ) {
			$menus = $options['menus'];
			$theme_menu_locations = get_theme_mod( 'nav_menu_locations' );
			if( empty( $theme_menu_locations ) || !is_array( $theme_menu_locations ) ) {
				$theme_menu_locations = array();
			}
			foreach( $menus as $location => $menu_name ) {
				$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
				if( isset( $menu ) ) {
					$theme_menu_locations[$location] = $menu->term_id;
				}
			}
			set_theme_mod( 'nav_menu_locations', $theme_menu_locations );
		}
	}
}

/* Import posts */
add_action( 'wp_ajax_crf_demo_import_posts', 'crf_import_posts' );
function crf_import_posts() {
	crf_import_xml( crf_get_demo_file_path( 'posts.xml' ) );
}

/* Import pages */
add_action( 'wp_ajax_crf_demo_import_pages', 'crf_import_pages' );
function crf_import_pages() {
	crf_import_xml( crf_get_demo_file_path( 'pages.xml' ) );
}

/* Import portfolios */
add_action( 'wp_ajax_crf_demo_import_portfolios', 'crf_import_portfolios' );
function crf_import_portfolios() {
	crf_import_xml( crf_get_demo_file_path( 'portfolios.xml' ) );
}

/* Import menus */
add_action( 'wp_ajax_crf_demo_import_menus', 'crf_import_menus' );
function crf_import_menus() {
	crf_import_xml( crf_get_demo_file_path( 'menus.xml' ) );
}

/* Import contact forms */
add_action( 'wp_ajax_crf_demo_import_cf', 'crf_import_cf' );
function crf_import_cf() {
	crf_import_xml( crf_get_demo_file_path( 'cf.xml' ) );
}

/* Import products */
add_action( 'wp_ajax_crf_demo_import_products', 'crf_import_products' );
function crf_import_products() {
	crf_import_xml( crf_get_demo_file_path( 'products.xml' ) );
}

/* Import attachments */
add_action( 'wp_ajax_crf_demo_import_attachments', 'crf_import_attachments' );
function crf_import_attachments() {
	crf_import_xml( crf_get_demo_file_path( 'attachments.xml' ) );
}

/* Import widgets */
add_action( 'wp_ajax_crf_demo_widgets_import', 'crf_demo_widgets_import' );
function crf_demo_widgets_import() {
	if( function_exists( 'check_ajax_referer' ) ) {
		check_ajax_referer( DEMO_IMPORTER_NONCE, 'security' );
	}
	if( !function_exists( 'wie_process_import_file' ) ) {
		require_once FRAMEWORK_PATH . '/lib/demo-importer/widget-importer/widget-importer.php';
	}
	$widget_file = crf_get_demo_file_path( 'widgets.wie' );
	if( !is_file( $widget_file ) ) {
		crf_ajax_finish( true, "done" );
	}
	set_time_limit( 0 );
	ob_start();
	wie_process_import_file( $widget_file );
	ob_get_clean();
	crf_ajax_finish( true, "done" );
}

/* Import customizer settings */
add_action( 'wp_ajax_crf_demo_import_theme_options', 'crf_demo_import_theme_options_ajax' );
function crf_demo_import_theme_options_ajax() {
	if( function_exists( 'check_ajax_referer' ) ) {
		check_ajax_referer( DEMO_IMPORTER_NONCE, 'security' );
	}
	
	crf_import_tc_settings( crf_get_demo_file_path( 'theme-options.json' ) );
	
	crf_set_home_and_menu();
	
	crf_ajax_finish( true, "done" );
}

/* Import sliders */
function crf_rev_clear_error_in_string($m){
	return 's:'.strlen($m[2]).':"'.$m[2].'";';
}
function crf_import_revslider( $filepath ) {
	global $wpdb;
	if( !class_exists( 'RevSlider' ) ) {
		return;
	}
	$zip = new ZipArchive;
	$importZip = $zip->open($filepath, ZIPARCHIVE::CREATE);
	
	$updateAnim = "true";
	$updateStatic = "true";

	if($importZip === true){ //true or integer. If integer, its not a correct zip file

		//check if files all exist in zip
		$slider_export = $zip->getStream('slider_export.txt');
		$custom_animations = $zip->getStream('custom_animations.txt');
		$dynamic_captions = $zip->getStream('dynamic-captions.css');
		$static_captions = $zip->getStream('static-captions.css');

		$content = '';
		$animations = '';
		$dynamic = '';
		$static = '';

		while (!feof($slider_export)) $content .= fread($slider_export, 1024);
		if($custom_animations){ while (!feof($custom_animations)) $animations .= fread($custom_animations, 1024); }
		if($dynamic_captions){ while (!feof($dynamic_captions)) $dynamic .= fread($dynamic_captions, 1024); }
		if($static_captions){ while (!feof($static_captions)) $static .= fread($static_captions, 1024); }

		fclose($slider_export);
		if($custom_animations){ fclose($custom_animations); }
		if($dynamic_captions){ fclose($dynamic_captions); }
		if($static_captions){ fclose($static_captions); }

		//check for images!

	}else{ //check if fallback
		//get content array
		$content = @file_get_contents($filepath);
	}

	if($importZip === true){ //we have a zip
		$db = new UniteDBRev();

		//update/insert custom animations
		$animations = @unserialize($animations);
		if(!empty($animations)){
			foreach($animations as $key => $animation){ //$animation['id'], $animation['handle'], $animation['params']
				$exist = $db->fetch(GlobalsRevSlider::$table_layer_anims, "handle = '".$animation['handle']."'");
				if(!empty($exist)){ //update the animation, get the ID
					if($updateAnim == "true"){ //overwrite animation if exists
						$arrUpdate = array();
						$arrUpdate['params'] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
						$db->update(GlobalsRevSlider::$table_layer_anims, $arrUpdate, array('handle' => $animation['handle']));

						$id = $exist['0']['id'];
					}else{ //insert with new handle
						$arrInsert = array();
						$arrInsert["handle"] = 'copy_'.$animation['handle'];
						$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

						$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
					}
				}else{ //insert the animation, get the ID
					$arrInsert = array();
					$arrInsert["handle"] = $animation['handle'];
					$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

					$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
				}

				//and set the current customin-oldID and customout-oldID in slider params to new ID from $id
				$content = str_replace(array('customin-'.$animation['id'], 'customout-'.$animation['id']), array('customin-'.$id, 'customout-'.$id), $content);
			}
		}else{
		}

		//overwrite/append static-captions.css
		if(!empty($static)){
			if(isset( $updateStatic ) && $updateStatic == "true"){ //overwrite file
				RevOperations::updateStaticCss($static);
			}else{ //append
				$static_cur = RevOperations::getStaticCss();
				$static = $static_cur."\n".$static;
				RevOperations::updateStaticCss($static);
			}
		}
		//overwrite/create dynamic-captions.css
		//parse css to classes
		$dynamicCss = UniteCssParserRev::parseCssToArray($dynamic);

		if(is_array($dynamicCss) && $dynamicCss !== false && count($dynamicCss) > 0){
			foreach($dynamicCss as $class => $styles){
				//check if static style or dynamic style
				$class = trim($class);
				
				if(strpos($class, ',') !== false && strpos($class, '.tp-caption') !== false){ //we have something like .tp-caption.redclass, .redclass
					$class_t = explode(',', $class);
					foreach($class_t as $k => $cl){
						if(strpos($cl, '.tp-caption') !== false) $class = $cl;
					}
				}

				if((strpos($class, ':hover') === false && strpos($class, ':') !== false) || //before, after
					strpos($class," ") !== false || // .tp-caption.imageclass img or .tp-caption .imageclass or .tp-caption.imageclass .img
					strpos($class,".tp-caption") === false || // everything that is not tp-caption
					(strpos($class,".") === false || strpos($class,"#") !== false) || // no class -> #ID or img
					strpos($class,">") !== false){ //.tp-caption>.imageclass or .tp-caption.imageclass>img or .tp-caption.imageclass .img
					continue;
				}

				//is a dynamic style
				if(strpos($class, ':hover') !== false){
					$class = trim(str_replace(':hover', '', $class));
					$arrInsert = array();
					$arrInsert["hover"] = json_encode($styles);
					$arrInsert["settings"] = json_encode(array('hover' => 'true'));
				}else{
					$arrInsert = array();
					$arrInsert["params"] = json_encode($styles);
				}
				//check if class exists
				$result = $db->fetch(GlobalsRevSlider::$table_css, "handle = '".$class."'");

				if(!empty($result)){ //update
					$db->update(GlobalsRevSlider::$table_css, $arrInsert, array('handle' => $class));
				}else{ //insert
					$arrInsert["handle"] = $class;
					$db->insert(GlobalsRevSlider::$table_css, $arrInsert);
				}
			}
		}else{
		}
	}

	//$content = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $content); //clear errors in string
	$content = preg_replace_callback('!s:(\d+):"(.*?)";!', 'crf_rev_clear_error_in_string', $content); //clear errors in string

	$arrSlider = @unserialize($content);
	$sliderParams = $arrSlider["params"];

	if(isset($sliderParams["background_image"]))
		$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath($sliderParams["background_image"]);

	$json_params = json_encode($sliderParams);

	//new slider
	$arrInsert = array();
	$arrInsert["params"] = $json_params;
	$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
	$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");
	$sliderID = $wpdb->insert(GlobalsRevSlider::$table_sliders,$arrInsert);
	$sliderID = $wpdb->insert_id;

	//-------- Slides Handle -----------

	//create all slides
	$arrSlides = $arrSlider["slides"];

	$alreadyImported = array();

	foreach($arrSlides as $slide){

		$params = $slide["params"];
		$layers = $slide["layers"];

		//convert params images:
		if(isset($params["image"])){
			//import if exists in zip folder
			if(trim($params["image"]) !== ''){
				if($importZip === true){ //we have a zip, check if exists
					$image = $zip->getStream('images/'.$params["image"]);
					if(!$image){
						echo $params["image"].' not found!<br>';
					}else{
						if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]])){
							$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$params["image"], $sliderParams["alias"].'/');

							if($importImage !== false){
								$alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]] = $importImage['path'];

								$params["image"] = $importImage['path'];
							}
						}else{
							$params["image"] = $alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]];
						}
					}
				}
			}
			$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
		}

		//convert layers images:
		foreach($layers as $key=>$layer){
			if(isset($layer["image_url"])){
				//import if exists in zip folder
				if(trim($layer["image_url"]) !== ''){
					if($importZip === true){ //we have a zip, check if exists
						$image_url = $zip->getStream('images/'.$layer["image_url"]);
						if(!$image_url){
							echo $layer["image_url"].' not found!<br>';
						}else{
							if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]])){
								$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$layer["image_url"], $sliderParams["alias"].'/');

								if($importImage !== false){
									$alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]] = $importImage['path'];

									$layer["image_url"] = $importImage['path'];
								}
							}else{
								$layer["image_url"] = $alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]];
							}
						}
					}
				}
				$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
				$layers[$key] = $layer;
			}
		}

		//create new slide
		$arrCreate = array();
		$arrCreate["slider_id"] = $sliderID;
		$arrCreate["slide_order"] = $slide["slide_order"];
		$arrCreate["layers"] = json_encode($layers);
		$arrCreate["params"] = json_encode($params);

		$wpdb->insert(GlobalsRevSlider::$table_slides,$arrCreate);
	}
}
add_action( 'wp_ajax_crf_demo_import_sliders', 'crf_import_sliders_ajax' );
function crf_import_sliders_ajax() {
	global $wpdb;
	
	if( function_exists( 'check_ajax_referer' ) ) {
		check_ajax_referer( DEMO_IMPORTER_NONCE, 'security' );
	}

	if( !class_exists('UniteFunctionsRev') ) {
		crf_ajax_finish( false, esc_html__( 'Revolution Slider plugin is not installed or activated.', 'semona' ) );
	} else if( !class_exists( 'ZipArchive' ) ) {
		crf_ajax_finish( false, esc_html__( 'zipArchive extension is not enabled in your hosting. You need this extension for Revolution Slider import.', 'semona' ) );
	} else {
		$rev_directory = CRF_DEMO_PATH;
		if( !empty( $_POST['demo'] ) ) {
			if( $_POST['demo'] != 'default' ) {
				$rev_directory .= $_POST['demo'] . '/';
			}
		}
		$rev_directory .= 'sliders/';

		$rev_files = array();
		foreach( glob( $rev_directory . '*.zip' ) as $filename ) {
			$filename = basename($filename);
			$rev_files[] = $rev_directory . $filename ;
		}

		foreach( $rev_files as $rev_file ) {
			crf_import_revslider( $rev_file );
		}
		crf_ajax_finish( true, "done" );
	}
}
