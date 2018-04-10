<?php

function fg_enqueue_stuff() {

	wp_enqueue_media();

	wp_enqueue_script( 'fg-admin-script',  FEATURED_GALLERIES_URI . 'js/admin.js' );

	wp_localize_script( 'fg-admin-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	wp_enqueue_style( 'fg-admin-style',  FEATURED_GALLERIES_URI . 'css/admin.css' );

}
