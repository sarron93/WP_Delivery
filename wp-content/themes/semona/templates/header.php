<?php
$header_style = crf_get_option_value( 'header-style', 'header_style' );

if ( $header_style == "v3") {
	add_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu_v3', 10, 2 );
}
else {
	add_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu', 10, 2 );
}

get_template_part( 'templates/header/header', $header_style );
