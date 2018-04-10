<?php

/* Like Post */
add_action( 'wp_ajax_nopriv_sm_request_like_post', 'sm_request_like_post' );
add_action( 'wp_ajax_sm_request_like_post', 'sm_request_like_post' );
function sm_request_like_post() {
	if( !empty( $_POST['nonce'] ) ) {
		check_ajax_referer( SM_LIKE_POST_NONCE, 'nonce' );
	} else {
		die();
	}
	
	if( !is_user_logged_in() ) {
		echo "0";
		die();
	}
    $postid = $_POST['postid'];
    sm_lp_do_like_post( $postid );
    echo sm_lp_get_post_likes( $postid );
    die();
}

/* Posts loadmore with ajax (including custom post types) */
add_action( 'wp_ajax_nopriv_sm_loadmore_posts', 'sm_loadmore_posts' );
add_action( 'wp_ajax_sm_loadmore_posts', 'sm_loadmore_posts' );
function sm_loadmore_posts() {
	if( !empty( $_POST['nonce'] ) ) {
		check_ajax_referer( SM_AJAX_PAGINATION_NONCE, 'nonce' );
	} else {
		die();
	}
	
	$query_vars = isset( $_POST['params']['query_vars'] ) ? $_POST['params']['query_vars'] : '';
	$query_vars = str_replace( '%27', "'", $query_vars );
	$query_vars = str_replace( '\\', '', $query_vars );
	$query_vars = unserialize( $query_vars );
	$offset = $_POST['params']['offset'];
	$template = $_POST['params']['template'];
	$use_postformat = $_POST['params']['useformat'];

	unset( $query_vars['paged'] );
	$query_vars['post_status'] = array( 'publish', 'private' );
	if( $offset >= 0 ) {
		$query_vars['offset'] = $offset;
	}
	
	$posts = new WP_Query( $query_vars );
	if( !$posts->have_posts() ) {
		echo 'allloaded';
		die();
	}
	if( $use_postformat ) {
		while( $posts->have_posts() ):
			$posts->the_post();
		// echo "--".$template."--";
			get_template_part( $template, get_post_format() );
		endwhile;
	} else {
		while( $posts->have_posts() ):
			$posts->the_post();
			get_template_part( $template );
		endwhile;
	}
	die();
}