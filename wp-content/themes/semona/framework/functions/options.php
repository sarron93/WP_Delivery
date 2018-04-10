<?php

/* Get theme options value */

function crf_get_theme_mod_value( $id ) {
	global $crf_default_options;
	$default_value = '';
	if( !empty( $crf_default_options[$id] ) ) {
		$default_value = $crf_default_options[$id];
	}
	$value = get_theme_mod( $id, $default_value );
	return apply_filters( 'crf_get_theme_mod_value', $value, $id );
}

function crf_get_option_value( $theme_option, $page_option ) {
	global $crf_page_option_data;
	$pv = '';
	if( is_singular() && isset( $crf_page_option_data['crf_' . $page_option][0] ) ) {
		$pv = $crf_page_option_data['crf_' . $page_option][0];
		if( ( !empty( $pv ) || strlen( $pv ) != 0 ) && $pv != 'default' ) {
			return $pv;
		}
	}
	if( $theme_option != '' ) {
		return crf_get_theme_mod_value( $theme_option );
	}
	return $pv;
}