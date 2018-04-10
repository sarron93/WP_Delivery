<?php

/* Render shortcodes in text widget */
if( !is_admin() ) {
	add_filter( 'widget_text', 'do_shortcode', 11 );
}

require_once get_template_directory() . '/widgets/useful-links.php';
require_once get_template_directory() . '/widgets/social-links.php';
require_once get_template_directory() . '/widgets/accordion.php';
require_once get_template_directory() . '/widgets/instagram.php';
require_once get_template_directory() . '/widgets/flickr.php';

/* Change search form button caption */
add_filter( 'get_search_form', 'sm_change_search_button' );
function sm_change_search_button( $text ) {
	$text = str_replace( 'value="Search"', 'value="&#xf002;"', $text );
	return $text;
}