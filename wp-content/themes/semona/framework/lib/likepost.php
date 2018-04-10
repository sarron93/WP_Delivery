<?php

function sm_lp_do_like_post ( $post_id ) {
	$user_id = get_current_user_id();

	$count = get_post_meta( $post_id, '_lp_likes_count' , true );

	if ( sm_lp_did_I_liked_post( $post_id ) ) {
		return true;
	}

	if($count)
		$count++;
	else
		$count = 1;

	if( update_post_meta($post_id, '_lp_likes_count', $count) ) {
		$liked = get_user_meta( $user_id, '_lp_I_liked', true );

		if ( is_array($liked) ) {
			if ( in_array( $post_id, $liked ) ) return true;
			$liked[] = $post_id;
		} else {
			$liked = array( $post_id );
		}

		if ( update_user_meta( $user_id, '_lp_I_liked', $liked ) ) {
			return true;
		}
		/* no roll back for post meta */
		return false;
	}
	return false;
}

function sm_lp_get_post_likes ( $post_id ) {
	return intval( get_post_meta( $post_id, '_lp_likes_count' , true ) );
}

function sm_lp_did_I_liked_post( $post_id ) {
	$user_id = get_current_user_id();
	
	$liked = get_user_meta( $user_id, '_lp_I_liked', true );

	if ( is_array($liked ) ) {
		return in_array($post_id, $liked);
	} else {
		return $liked == $post_id;
	}
}
