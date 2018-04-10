<?php

/********** Framework Helper Functions **********/

/* Slider functions */

function crf_insert_slider() {
	$slider_type = crf_get_option_value( '', 'slider_type' );

	$inserted = false;
	switch( $slider_type ) {
		case 'rev':
			if( function_exists('putRevSlider') ) {
				$revslider = crf_get_option_value( '', 'revslider' );
				if( $revslider ) {
					putRevSlider( $revslider );
					$inserted = true;
				}
			}
			break;
		case 'layer':
			$id = crf_get_option_value( '', 'layerslider' );
			if( $id ) {
				echo do_shortcode( "[layerslider id='{$id}']" );
				$inserted = true;
			}
			break;
		case 'custom':
			$shortcode = crf_get_option_value( '', 'custom_slider' );
			if( $shortcode ) {
				echo do_shortcode( $shortcode );
				$inserted = true;
			}
			break;
	}
	if ( $inserted ) {
		$slider_decoration = crf_get_option_value( '', 'slider_decoration' );
		if ( 'triangle-down' == $slider_decoration ) {
			crf_slider_decoration_triangle_down();
		}
	}
	return $inserted;
}

function crf_slider_decoration_triangle_down() {
	global $sm_theme_uri;
	$slider_decoration_skin = crf_get_option_value( '', 'slider_decoration_skin' );
	if ( empty( $slider_decoration_skin ) ) $slider_decoration_skin = 'light';
?>
<div class="sm-vstd-wrap">
	<svg height="50" width="110">
		<path d="M0 0 L5 0 L45 40 A10 8 0 0 0 60 40 L105 0 L110 0 L110 50 L0 50 Z" />
	</svg>
	<a href="javascript:;" class="slide-link"><img src="<?php echo esc_url( $sm_theme_uri . '/images/mouse-' . $slider_decoration_skin . '.png' ); ?>" alt="" /></a>
</div>
<?php
}

/* Theme Customizer option value functions */

function crf_get_font_weights() {
	return array(
			"300"	=> esc_html__( "Light", 'semona' ),
			"400"	=> esc_html__( "Normal", 'semona' ),
			"500"	=> esc_html__( "Medium", 'semona' ),
			"600"	=> esc_html__( "Semi-bold", 'semona' ),
			"700"	=> esc_html__( "Bold", 'semona' ),
			"800"	=> esc_html__( "Extra Bold", 'semona' ),
			"900"	=> esc_html__( "Black", 'semona' ),
	);
}

/* Simple tags escape */

function crf_do_kses( $string ) {
	return wp_kses( $string, array(
			'a' => array(
					'class' => array(),
					'href' => array(),
					'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'i' => array(
					'class' => array(),
			),
			'ul' => array(
					'class' => array(),
			),
			'li' => array(),
			'span' => array(
					'class' => array(),
			),
	) );
}
