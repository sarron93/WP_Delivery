<?php
	
/**
 * This is the main script that adds in the plugin's main shortcode/behavior/etc.
 * Each important component has it's own class-shortcode.php file. 
 *
 * For example, in Parallax, we have a class-parallax-row.php for the parallax row element, 
 * and class-fullwidth-row.php for the full-width row element
 */	

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( 'row_scroll/lib/row_scroll_exit_animations.php' );
require_once( 'row_scroll/lib/row_scroll_entrance_animations.php' );


// Initializes plugin class.
if ( ! class_exists( 'GambitRowScrollAnimation' ) ) {
	
	class GambitRowScrollAnimation {
		
		function __construct() {
			
			// Our admin-side scripts & styles
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdminScripts' ) );

			// Initializes as a Visual Composer addon
    		add_action( 'init', array( $this, 'createShortcode' ), 999 );

			// Makes the plugin function accessible as a shortcode
			add_shortcode( 'row_scroll', array( $this, 'renderShortcode' ) );
		}


		/**
		 * Includes admin scripts and styles needed
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function enqueueAdminScripts() {
			wp_enqueue_style( __CLASS__ . '-admin', plugins_url( 'row_scroll/css/admin.css', __FILE__ ), array(), GAMBIT_ROW_SCROLL );
		}


		/**
		 * Creates our shortcode settings in Visual Composer
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function createShortcode() {
			if ( ! is_admin() ) {
				return;
			}
			if ( ! function_exists( 'vc_map' ) ) {
				return;
			}
			
			vc_map( array(
			    "name" => __( 'Row Scroll Animation', GAMBIT_ROW_SCROLL ),
			    "base" => "row_scroll",
				"icon" => plugins_url( 'row_scroll/images/vc-row_scroll.png', __FILE__ ),
				"description" => __( 'Entrance & exit row animations.', GAMBIT_ROW_SCROLL ),
				"category" => __( 'Row Adjustments', GAMBIT_ROW_SCROLL ),
			    "params" => array(
					array(
						"type" => "dropdown",
						"heading" => __( 'Entrance animation', GAMBIT_ROW_SCROLL ),
						"param_name" => "entrance",
						"value" => array(
							__( 'None', GAMBIT_ROW_SCROLL ) => 'none',
							__( 'Content fly up (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fly-up',
							__( 'Content fade (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fade',
							__( 'Content fly left (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fly-left',
							__( 'Content fly right (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fly-right',
							__( 'Scale smaller', GAMBIT_ROW_SCROLL ) => 'scale-smaller',
							__( 'Fade in', GAMBIT_ROW_SCROLL ) => 'fade',
							__( '3D Rotate backward', GAMBIT_ROW_SCROLL ) => 'rotate-back',
							__( '3D Rotate forward', GAMBIT_ROW_SCROLL ) => 'rotate-forward',
							__( 'Carousel forward', GAMBIT_ROW_SCROLL ) => 'carousel',
							__( 'Fly up', GAMBIT_ROW_SCROLL ) => 'fly-up',
							__( 'Fly left', GAMBIT_ROW_SCROLL ) => 'fly-left',
							__( 'Fly right', GAMBIT_ROW_SCROLL ) => 'fly-right',
							__( 'Stick to bottom (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick',
							__( 'Stick & scale smaller (will make your row have at least half the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-scale',
							__( '3D cube (use 3D cube entrance animation on the next row to make this look good)', GAMBIT_ROW_SCROLL ) => 'cube',
						),
	                    "description" => __( 'The animation to play when your row is about to scroll upward into the viewable area.<br>The <strong>cube</strong> effect requires your row to be at least half the screen height.', GAMBIT_ROW_SCROLL ),
					),
					array(
						"type" => "dropdown",
						"heading" => __( 'Exit animation', GAMBIT_ROW_SCROLL ),
						"param_name" => "exit",
						"value" => array(
							__( 'Content fly up (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fly-up',
							__( 'None', GAMBIT_ROW_SCROLL ) => 'none',
							__( 'Content fade (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fade',
							__( 'Content fly left (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fly-left',
							__( 'Content fly right (animates only the content)', GAMBIT_ROW_SCROLL ) => 'content-fly-right',
							__( 'Scale smaller', GAMBIT_ROW_SCROLL ) => 'scale-smaller',
							__( 'Fade out', GAMBIT_ROW_SCROLL ) => 'fade',
							__( '3D Rotate backward', GAMBIT_ROW_SCROLL ) => 'rotate-back',
							__( '3D Rotate forward', GAMBIT_ROW_SCROLL ) => 'rotate-forward',
							__( 'Carousel forward', GAMBIT_ROW_SCROLL ) => 'carousel',
							__( 'Fly up', GAMBIT_ROW_SCROLL ) => 'fly-up',
							__( 'Fly left', GAMBIT_ROW_SCROLL ) => 'fly-left',
							__( 'Fly right', GAMBIT_ROW_SCROLL ) => 'fly-right',
							__( 'Stick to top (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick',
							__( 'Stick & scale smaller (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-scale',
							// __( 'Stick & flip left (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-flip-left',
							// __( 'Stick & flip right (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-flip-right',
							// __( 'Stick & flip top (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-flip-top',
							// __( 'Stick & flip bottom (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-flip-bottom',
							__( 'Stick & fly left (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-fly-left',
							__( 'Stick & fly right (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-fly-right',
							__( 'Stick & fly down (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-fly-down',
							__( 'Stick & rotate left (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-rotate-left',
							__( 'Stick & rotate right (will make your row have at least the height of the screen)', GAMBIT_ROW_SCROLL ) => 'stick-rotate-right',
							__( '3D cube (use 3D cube entrance animation on the next row to make this look good)', GAMBIT_ROW_SCROLL ) => 'cube',
						),
	                    "description" => __( 'The animation to play when your row is about to scroll upward outside the viewable area.<br>The <strong>cube</strong> effect requires your row to be at least half the screen height.', GAMBIT_ROW_SCROLL ),
					),
					// array(
// 						"type" => "textfield",
// 						"heading" => __( 'Fading Title', GAMBIT_ROW_SCROLL ),
// 						"param_name" => "title",
// 						"value" => '',
// 	                    "description" => __( 'You can enter a title here that will be displayed on top of the row whole and will fade out when the row is fully shown.', GAMBIT_ROW_SCROLL ),
// 					),
// 					array(
// 						"type" => "colorpicker",
// 						"heading" => __( 'Title Text Color', GAMBIT_ROW_SCROLL ),
// 						"param_name" => "title_color",
// 						"value" => '#ffffff',
// 					),
// 					array(
// 						"type" => "colorpicker",
// 						"heading" => __( 'Title Background Color', GAMBIT_ROW_SCROLL ),
// 						"param_name" => "title_bg_color",
// 						"value" => '#22A7F0',
// 					),
					array(
						"type" => "checkbox",
						"heading" => __( 'Fix Body Overflow', GAMBIT_ROW_SCROLL ),
						"param_name" => "body_overflow",
						"value" => array(
							__( 'Check this if you see an unwanted scrollbar that shows up for a very short time while scrolling with some effects & some themes.', GAMBIT_ROW_SCROLL ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"heading" => __( 'Entrance delay', GAMBIT_ROW_SCROLL ),
						"param_name" => "entrance_offset",
						"value" => '',
	                    "description" => __( 'The entrance animation ends when your container reaches more than 1/3th of the screen from the bottom (some effects are different, some are unchangeable).<br>Add a <strong>positive</strong> number here to make the entrance animation play longer, or a <strong>negative number to shorten it</strong> it. The value can be from -20 to 20.', GAMBIT_ROW_SCROLL ),
					),
					array(
						"type" => "textfield",
						"heading" => __( 'Exit delay', GAMBIT_ROW_SCROLL ),
						"param_name" => "exit_offset",
						"value" => '',
	                    "description" => __( 'The exit animation triggers when your container reaches more than 1/3th of the screen from the top (some effects are different, some are unchangeable).<br>Add a <strong>positive</strong> number here to make the entrance animation play longer, or a <strong>negative number to shorten it</strong> it. The value can be from -20 to 20.', GAMBIT_ROW_SCROLL ),
					),
				),
			) );
		}


		/**
		 * Shortcode logic
		 *
		 * @param	$atts array The attributes of the shortcode
		 * @param	$content string The content enclosed inside the shortcode if any
		 * @return	string The rendered html
		 * @since	1.0
		 */
		public function renderShortcode( $atts, $content = null ) {
	        $defaults = array(
				'exit' => '',
				'exit_offset' => '-5',
				'entrance' => '',
				'entrance_offset' => '5',
				// 'title' => '',
				// 'title_color' => '#ffffff',
				// 'title_bg_color' => '#22A7F0',
				'body_overflow' => '',
	        );
			if ( empty( $atts ) ) {
				$atts = array();
			}
			$atts = array_merge( $defaults, $atts );
			
			// Default values for the offset
			$atts['exit_offset'] = $atts['exit_offset'] == '' ? '-5' : (int) $atts['exit_offset'];
			$atts['entrance_offset'] = $atts['entrance_offset'] == '' ? '5' : (int) $atts['entrance_offset'] * -1;
						
			$dataAttributes = $this->generateScrollData( $atts['entrance'], $atts['exit'], $atts['entrance_offset'], $atts['exit_offset'] );
			if ( is_wp_error( $dataAttributes ) ) {
				return "<strong>" . $dataAttributes->get_error_message() . "</strong>";
			}

			// Skrollr script
			wp_enqueue_script( __CLASS__, plugins_url( 'row_scroll/js/min/script-min.js', __FILE__ ), array(), VERSION_GAMBIT_ROW_SCROLL, true );
			wp_enqueue_style( __CLASS__, plugins_url( 'row_scroll/css/style.css', __FILE__ ), array(), VERSION_GAMBIT_ROW_SCROLL );

			$contentManipulators = array(
				'content-fade',
				'content-fly-up',
				'content-fly-left',
				'content-fly-right',
			);
			
			wp_localize_script( __CLASS__, 'rowScrollParams', array(
				'content_manipulators' => $contentManipulators,
			) );

			return "<div class='gambit_row_scroll' " .
				"data-row-entrance='" . esc_attr( $atts['entrance'] ) . "' " .
				"data-row-exit='" . esc_attr( $atts['exit'] ) . "' " .
				( in_array( $atts['exit'], $contentManipulators ) ? "data-exit-do-children='true'" : '' ) .
				( in_array( $atts['entrance'], $contentManipulators ) ? "data-entrance-do-children='true'" : '' ) .
				// ( ! empty( $atts['title'] ) ? "data-title='" . esc_attr( $atts['title'] ) . "' " : '' ) .
				// ( ! empty( $atts['title'] ) ? "data-title-color='" . esc_attr( $atts['title_color'] ) . "' " : '' ) .
				// ( ! empty( $atts['title'] ) ? "data-title-bg-color='" . esc_attr( $atts['title_bg_color'] ) . "' " : '' ) .
				( ! empty( $atts['body_overflow'] ) ? "data-body-overflow='" . esc_attr( $atts['body_overflow'] ) . "' " : '' ) .
				$dataAttributes .
				">" . do_shortcode( $content ) . "</div>";
		}
		
		
		/**
		 * @param	$entrance		The slug name of the entrance animation
		 * @param	$exit			The slug name of the exit animation
		 * @param	$entranceOffset	The mount to offset the entrance animation
		 * @param	$exitOffset		The mount to offset the exit animation
		 */
		public function generateScrollData( $entrance, $exit, $entranceOffset = '', $exitOffset = '' ) {
			
			// All the possible exits
			$exits = gambit_row_scroll_exit_animations();
			
			
			// All the possible entrances
			$entrances = gambit_row_scroll_entrance_animations();
			
			
			// These animations have Skrollr smooth scrolling turned off
			$smoothScrollOff = array(
				// 'cube',
				'stick',
				'stick-flip-left',
				'stick-flip-right',
				'stick-flip-top',
				'stick-flip-bottom',
				'stick-fly-left',
				'stick-fly-right',
				'stick-rotate-left',
				'stick-rotate-right',
			);
			
			
			// These are the only allowed styles & transforms along with their default values
			$defaults = array(
				'transform-origin' => '50% 50%',
				'opacity' => 1,
				'scale' => 1,
				'perspective' => '1000px',
				'translateX' => '0vw',
				'translateY' => '0vh',
				'translateZ' => '0px',
				'rotate' => '0deg',
				'rotateX' => '0deg',
				'rotateY' => '0deg',
				'rotateZ' => '0deg',
				'box-shadow' => '0 0 0 rgba(0,0,0,0)',
				'z-index' => 1,
			);
			
			
			/**
			 * Generate a set of the default styles based on all stuff that's used
			 * by both the entrance and exit styles
			 *
			 * We need to do this since for Skrollr to work in both entrance & exit animations,
			 * ALL styles being manipulated should be present in all animation steps.
			 */
			$allKeys = array();
			$defaultStyles = array( 'transform' => array() );
			
			
			/**
			 * Apply the offsets
			 */
			
			// By default, offsets are % of the screen height which is designated by 'p' in Skrollr
			// If units are 
			if ( preg_match( '/px$/', $exitOffset ) ) {
				$exitOffset = str_replace( 'px', '', $exitOffset );
			} else if ( $exitOffset != '' ) {
				preg_match( '/([\-0-9.]*)/', $exitOffset, $matches );
				if ( count( $matches ) ) {
					$exitOffset = $matches[0] . 'p';
				}
			}
			if ( preg_match( '/px$/', $entranceOffset ) ) {
				$entranceOffset = str_replace( 'px', '', $entranceOffset );
			} else if ( $entranceOffset != '' ) {
				preg_match( '/([\-0-9.]*)/', $entranceOffset, $matches );
				if ( count( $matches ) ) {
					$entranceOffset = $matches[0] . 'p';
				}
			}
			
			$exitOffset .= $exitOffset != '' ? '-' : '';
			$entranceOffset .= $entranceOffset != '-' ? '-' : '';
			
			if ( ! isset( $entrances[ $entrance ] ) ) {
				return new WP_Error( 'attribute_error', __( "Row Scroll Error: Entrance animation " . $entrance . " is not valid", GAMBIT_ROW_SCROLL ) );
			}
			if ( ! isset( $exits[ $exit ] ) ) {
				return new WP_Error( 'attribute_error', __( "Row Scroll Error: Exit animation " . $exit . " is not valid", GAMBIT_ROW_SCROLL ) );
			}
			
			foreach ( $exits[ $exit ] as $location => $styles ) {
				$newLocation = sprintf( $location, $exitOffset ) . '-exit';
				if ( $location != $newLocation ) {
					$exits[ $exit ][ $newLocation ] = $styles;
					unset( $exits[ $exit ][ $location ] );
				}
			}
			foreach ( $entrances[ $entrance ] as $location => $styles ) {
				$newLocation = sprintf( $location, $entranceOffset ) . '-entrance';
				if ( $location != $newLocation ) {
					$entrances[ $entrance ][ $newLocation ] = $styles;
					unset( $entrances[ $entrance ][ $location ] );
				}
			}
			
			$animations = array_merge( $exits[ $exit ], $entrances[ $entrance ] );
			
			foreach ( $animations as $location => $styles ) {
				foreach ( array_keys( $styles ) as $styleKey ) {
					if ( is_array( $styles[ $styleKey ] ) ) {
						
						foreach ( array_keys( $styles[ $styleKey ] ) as $subStyleKey ) {

							if ( empty( $allKeys[ $styleKey ] ) ) {
								$allKeys[ $styleKey ] = array();
							}
							
							if ( ! in_array( $subStyleKey, $allKeys[ $styleKey ] ) ) {
								$allKeys[ $styleKey ][] = $subStyleKey;
								$defaultStyles[ $styleKey ][ $subStyleKey ] = $defaults[ $subStyleKey ];
							}
						}
						continue;
					}
					
					if ( ! in_array( $styleKey, $allKeys ) ) {
						$allKeys[] = $styleKey;
						$defaultStyles[ $styleKey ] = $defaults[ $styleKey ];
					}
				}
			}
			
			
			/**
			 * $defaultStyles should now contain all styles with default values
			 * $allKeys should now contain all the possible keys
			 */
			
			
			// Generate into data attributes
			$dataAttrib = '';
			foreach ( $animations as $location => $styles ) {
				
				
				$dataAttrib .= $location . '="';
				
				foreach ( $defaultStyles as $styleKey => $styleRule ) {
					if ( is_array( $styleRule ) ) {
						
						if ( empty( $styleRule ) ) {
							continue;
						}
						
						$dataAttrib .= esc_attr( $styleKey ) . ':';
						foreach ( $styleRule as $subStyleKey => $subStyleRule ) {
							
							$subStyleRule = isset( $styles[ $styleKey ][ $subStyleKey ] ) ? $styles[ $styleKey ][ $subStyleKey ] : $subStyleRule;
							
							$dataAttrib .= ' ' . esc_attr( $subStyleKey ) . '(' . esc_attr( $subStyleRule ) . ')';
						}
						$dataAttrib .= ';';
						
					} else {
						
						$styleRule = isset( $styles[ $styleKey ] ) ? $styles[ $styleKey ] : $styleRule;

						
						if ( $styleKey === 'transform-origin' ) {
							$dataAttrib .= esc_attr( $styleKey ) . ': !' . esc_attr( $styleRule ) . ';';
						} else {
							$dataAttrib .= esc_attr( $styleKey ) . ': ' . esc_attr( $styleRule ) . ';';
						}
					}
				}
				
				$dataAttrib .= '" ';
			}
			
			// Apply OFF Skrollr smooth scrolling
			if ( in_array( $exit, $smoothScrollOff ) ) {
				$dataAttrib .= 'data-smooth-scrolling-exit="off"';
			}
			if ( in_array( $entrance, $smoothScrollOff ) ) {
				$dataAttrib .= 'data-smooth-scrolling-entrance="off"';
			}
			
			return $dataAttrib;
		}
	}
	
	new GambitRowScrollAnimation();
	
}
?>