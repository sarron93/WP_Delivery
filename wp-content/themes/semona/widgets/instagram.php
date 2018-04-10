<?php
/*
Plugin Name: WP Instagram Widget
Plugin URI: https://github.com/scottsweb/wp-instagram-widget
Description: A WordPress widget for showing your latest Instagram photos.
Version: 1.5.1
Author: Scott Evans
Author URI: http://scott.ee
Text Domain: wpiw
Domain Path: /assets/languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright © 2013 Scott Evans

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

/*
 * Modified by Theme-Paradise
 * 
 * - Text Domain
 * 
 */

function sm_load_instagram_widget() {
	register_widget( 'Semona_Instagram_Widget' );
}
add_action( 'widgets_init', 'sm_load_instagram_widget' );

class Semona_Instagram_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
				'classname' => 'sm-widget-instagram sm-widget-social-image', 
				'description' => esc_html__( 'Displays your latest Instagram photos', 'semona' ),
		);
		parent::__construct( 'sm-widget-instagram', esc_html__( 'Semona: Instagram', 'semona' ), $widget_ops );
	}

	function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];

		echo ( $before_widget );
		
		if ( !empty( $title ) ) { echo ( $before_title . $title . $after_title ); };
		
		do_action( 'sm_before_widget_instagram', $instance );

		if ( $username != '' ) {

			$media_array = $this->scrape_instagram( $username, $limit );

			if ( !is_wp_error( $media_array ) ) {
				?><ul class="sm-social-images clearfix"><?php
				foreach ( $media_array as $item ) {
					echo '<li><a href="'. esc_url( $item['thumbnail'] ) .'" data-rel="prettyPhoto"><img src="'. esc_url( $item['thumbnail'] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'" /></a>';
					echo '<a class="hover-link" href="'. esc_url( $item['thumbnail'] ) .'" data-rel="prettyPhoto" title="'. esc_attr( $item['description'] ).'" ></a>';
					echo '</li>';
				}
				?></ul><?php
			}
		}

		do_action( 'sm_after_widget_instagram', $instance );

		echo ( $after_widget );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__( 'Instagram', 'semona' ), 'username' => '', 'link' => esc_html__( 'Follow Us', 'semona' ), 'number' => 9, 'target' => '_self' ) );
		$title = esc_attr( $instance['title'] );
		$username = esc_attr( $instance['username'] );
		$number = absint( $instance['number'] );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'semona' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e( 'Username', 'semona' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of photos', 'semona' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label></p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number'] = !absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		return $instance;
	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 9 ) {

		$username = strtolower( $username );

		if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'semona' ) );

			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'semona' ) );

			$shards = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );

			if ( !$insta_array )
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'semona' ) );

			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', esc_html__( 'Instagram has returned invalid data.', 'semona' ) );
			}

			if ( !is_array( $images ) )
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'semona' ) );

			$instagram = array();

			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {

						if ( $image['user']['username'] == $username ) {

							$image['link']						  = preg_replace( "/^http:/i", "", $image['link'] );
							$image['images']['thumbnail']		   = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']	  = preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );

							$instagram[] = array(
								'description'   => $image['caption']['text'],
								'link'		  	=> $image['link'],
								'time'		  	=> $image['created_time'],
								'comments'	  	=> $image['comments']['count'],
								'likes'		 	=> $image['likes']['count'],
								'thumbnail'	 	=> $image['images']['thumbnail'],
								'large'		 	=> $image['images']['standard_resolution'],
								'small'		 	=> $image['images']['low_resolution'],
								'type'		  	=> $image['type']
							);
						}
					}
				break;
				default:
					foreach ( $images as $image ) {

						$image['display_src'] = preg_replace( "/^http:/i", "", $image['display_src'] );

						if ( $image['is_video']  == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}

						$instagram[] = array(
							'description'   => esc_html__( 'Instagram Image', 'semona' ),
							'link'		  	=> '//instagram.com/p/' . $image['code'],
							'time'		  	=> $image['date'],
							'comments'	  	=> $image['comments']['count'],
							'likes'		 	=> $image['likes']['count'],
							'thumbnail'	 	=> $image['display_src'],
							'type'		  	=> $type
						);
					}
				break;
			}

			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( base64_decode( $instagram ) );
			return array_slice( $instagram, 0, $slice );

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'semona' ) );

		}
	}

	function images_only( $media_item ) {

		if ( $media_item['type'] == 'image' )
			return true;

		return false;
	}
}
