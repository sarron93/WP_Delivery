<?php

/* Get blog page url */

function crf_get_blog_url() {
	if( get_option( 'show_on_front' ) == 'page' ) {
		return get_permalink( get_option( 'page_for_posts' ) );
	} else {
		return esc_url( home_url() );
	}
}