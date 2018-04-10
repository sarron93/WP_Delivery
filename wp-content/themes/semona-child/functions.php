<?php

add_action( 'wp_enqueue_scripts', 'sm_child_theme_enqueue_style', 11 );
function sm_child_theme_enqueue_style() {
	wp_enqueue_style( 'sm-child-theme', get_stylesheet_directory_uri() . '/style.css' );
}

add_action( 'after_setup_theme', 'sm_child_load_textdomain' );
function sm_child_load_textdomain() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'semona', $lang );
}
