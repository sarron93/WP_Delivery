<!DOCTYPE html>
<html <?php language_attributes( 'html' ) ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	
	<?php 
	/* Page option(metabox) data */
	global $crf_page_option_data;
	$crf_page_option_data = get_post_meta( get_the_ID() );

	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		function sm_render_title() {
			?><title><?php wp_title( '-', true, 'right' ); ?></title><?php
		}
		add_action( 'wp_head', 'sm_render_title' );
	}
	
	wp_head();
	?>
	
	<?php include_once("analyticstracking.php") ?>
	<?php include_once("podmena/utm-podmena.php") ?>
</head>
<body <?php body_class(); ?>>
	<div class="sm-wrapper">
	<?php 
	
	if( crf_get_theme_mod_value( 'preloader-enable' ) == 'show' ) {
		get_template_part( 'templates/preloader' );
	}
	
	if( !sm_is_blank_page() ) {
		get_template_part( 'templates/header' );
	}
