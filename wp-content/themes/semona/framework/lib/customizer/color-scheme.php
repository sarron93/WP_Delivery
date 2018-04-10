<?php

global $crf_default_options;
global $crf_color_scheme_colors;
global $crf_color_scheme_options;
global $crf_default_color_scheme;

/* Default color scheme */
$crf_default_color_scheme = 'light';

/* Color scheme options (meaning these options will be changed based on color scheme) */
$crf_color_scheme_options = array(
		'text-color',
		'heading-color',
		'heading-light-color',
		'border-color',
		'heading-underline-color',
		'bg-color',
		'bg-color2',
		
		'blog-bg-color',
		'post-box-shadow-color',
		
		'portfolio-grid2-shadow-color',
		
		'main-nav-font-color',
		'main-nav-hover-color',
		'main-nav-bg-color',
		'dropdown-item-color',
		'dropdown-item-arrow-color',
		'dropdown-bg-color',
		'dropdown-bg-color-hover',
		'dropdown-separator-color',
		'dropdown-hover-color',
		
		'outer-bg-pattern',
);

/* Save original default colors for color schemes */
$crf_color_scheme_colors = $crf_default_options;

/* Set default values based on current color scheme */
$color_scheme = crf_get_theme_mod_value( 'color-scheme' );
if( $color_scheme != $crf_default_color_scheme ) {
	foreach( $crf_color_scheme_options as $option ) {
		$crf_default_options[$option] = $crf_default_options[$option . '-' . $color_scheme];
	}
}