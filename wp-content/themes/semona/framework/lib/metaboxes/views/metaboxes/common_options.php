<?php

/*
 * This content can be changed, but be careful - some framework functions are using options here (e.g. slider_type)
 */
function sm_metabox_common_options_li( $first_active = false ) {
	?>
	<li<?php if( $first_active ){ echo ' class="active"'; } ?>><a href="#header"><?php echo esc_html__( "Header", 'semona' ) ?></a></li>
	<li><a href="#pagetitlebar"><?php echo esc_html__( "Page Title Bar", 'semona' ) ?></a></li>
	<li><a href="#sliders"><?php echo esc_html__( "Sliders", 'semona' ) ?></a></li>
	<li><a href="#footer"><?php echo esc_html__( "Footer", 'semona' ) ?></a></li>
	<li><a href="#sidebars"><?php echo esc_html__( "Sidebars", 'semona' ) ?></a></li>
	<li><a href="#background"><?php echo esc_html__( "Background", 'semona' ) ?></a></li>
	<li><a href="#paddings"><?php echo esc_html__( "Paddings", 'semona' ) ?></a></li>
	<?php
}
function sm_metabox_common_options_body( $metabox, $first_active = false ) {
	?>
	<div class="crf_metabox_tab<?php if( $first_active ){ echo ' active'; } ?>" id="crf_tab_header">
		<?php
		$metabox->select ( 'display_header', __ ( 'Display Header', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'show' => __ ( 'Show', 'semona' ),
				'hide' => __ ( 'Hide', 'semona' ) 
		), __ ( 'Choose to show or hide the header.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'header_style', __ ( 'Header Style', 'semona' ), sm_add_option_default( sm_header_styles() ), 
			__ ( 'Choose header style. This option overrides theme customizer option value.', 'semona' ) );
		?>
		
		<?php
		/* Header v1 options */
		$metabox->subsection_start( esc_html__( 'Header v1 options', 'semona' ), array(
				'option' => 'header_style',
				'value' => 'v1',
				'current_default' => crf_get_theme_mod_value( 'header-style' ),
		) ); 
		?>
		<?php
		$metabox->select ( 'transparent_header', esc_html__( 'Transparent Header', 'semona' ), array (
				'default' => esc_html__( 'Default', 'semona' ),
				'yes' => esc_html__( 'Yes', 'semona' ),
				'no' => esc_html__( 'No' , 'semona' )
		), esc_html__( 'Choose to enable transparent header skin. Note: transparent header works only when header is below slider. You can configure header position in Sliders tab of this option panels.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'transparent_header_skin', __ ( 'Transparent Header Skin', 'semona' ), sm_transparent_header_skins(), 
			__ ( 'Choose transparent header skin. Use Light for light background, and Dark for dark background. This option will override theme customizer option value.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'display_top_border', __ ( 'Display Header Top Border', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'show' => __ ( 'Show', 'semona' ),
				'hide' => __ ( 'Hide', 'semona' ) 
		), __ ( 'Choose to show or hide top border of header.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'display_topbar', __ ( 'Display Topbar', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'show' => __ ( 'Show', 'semona' ),
				'hide' => __ ( 'Hide', 'semona' ) 
		), __ ( 'Choose to show or hide topbar.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'topbar_skin', __ ( 'Topbar Skin', 'semona' ), sm_add_option_default( sm_topbar_skins() ), 
			__ ( 'Choose topbar skin. This option will override theme customizer option value.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'topbar_bottom_border', __ ( 'Display Topbar Bottom Border', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'show' => __ ( 'Show', 'semona' ),
				'hide' => __ ( 'Hide', 'semona' ) 
		), __ ( 'Choose to show or hide bottom border of topbar.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'main_nav_hover_style', __ ( 'Main Menu Hover Style', 'semona' ), sm_add_option_default( sm_main_nav_hover_styles() ), 
			__ ( 'Choose main menu hover style. This option will override theme customizer option value.', 'semona' ) );
		?>
		<?php
		$metabox->subsection_end(); 
		?>
		
		<?php
		/* Header v2 options */
		$metabox->subsection_start( esc_html__( 'Header v2 options', 'semona' ), array(
				'option' => 'header_style',
				'value' => 'v2',
				'current_default' => crf_get_theme_mod_value( 'header-style' ),
		) ); 
		?>
		<?php
		$metabox->select ( 'header_v2_skin', __ ( 'Header v2 Skin', 'semona' ), sm_add_option_default( sm_transparent_header_skins() ), 
			__ ( 'Choose header v2 skin. Use Light for light background, and Dark for dark background. This option will override theme customizer option value.', 'semona' )
		);
		?>
		<?php
		$metabox->select ( 'header_v2_stretch', __ ( 'Stretch header to browser width', 'semona' ), array(
				'no' => esc_html__( 'No', 'semona' ),
				'yes' => esc_html__( 'Yes', 'semona' ),
			),	 
			__ ( 'Choose header v2 skin. Use Light for light background, and Dark for dark background. This option will override theme customizer option value.', 'semona' )
		);
		?>
		<?php
		$metabox->select ( 'header_v2_hide_logo', __ ( 'Hide Logo', 'semona' ), array(
				'no' => esc_html__( 'No', 'semona' ),
				'yes' => esc_html__( 'Yes', 'semona' ),
			),	 
			__ ( 'Choose Yes to hide logo in header v2 layout.', 'semona' )
		);
		?>
		<?php
		$metabox->subsection_end(); 
		?>
		
		<?php
		/* Header v3 options */
		$metabox->subsection_start( esc_html__( 'Header v3 options', 'semona' ), array(
				'option' => 'header_style',
				'value' => 'v3',
				'current_default' => crf_get_theme_mod_value( 'header-style' ),
		) ); 
		?>
		<?php
		$metabox->color ( 'v3_logoarea_bg_color', __ ( 'Logo Area Background Color (Hex Code)', 'semona' ), 
				__ ( 'Controls the background color of header v3 logo area.', 'semona' )
		);
		?>
		<?php
		$metabox->subsection_end(); 
		?>
	</div>
	<div class="crf_metabox_tab" id="crf_tab_pagetitlebar">
		<?php
		$metabox->select ( 
				'titlebar_style', 
				__( 'Title Bar', 'semona' ), 
				sm_add_option_default( sm_titlebar_styles() ),
				__( 'Choose title bar style. Select None to hide titlebar.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 
				'titlebar_bg_type', 
				__( 'Title Bar Background Type', 'semona' ),
				sm_add_option_default( sm_titlebar_bg_types() ),
				__( 'Choose title bar background type. Note that only image background works for Large style.', 'semona' ),
				array(
						'option' => 'titlebar_style',
						'value_in' => array( 'small', 'small2', 'small3' ),
				)
		);
		?>
		<?php
		$metabox->upload ( 'titlebar_bg', 
			__( 'Titlebar Background Image', 'semona' ), 
			__( 'Select an image for titlebar background. This option will override background image set in theme customizer, but if left empty theme customizer value will be used.', 'semona' )
		);
		?>
		<?php
		$metabox->text( 'titlebar_subtitle', 
			__( 'Titlebar Subtitle', 'semona' ), 
			__( 'Input subtitle for this post/page/portfolio for titlebar style Large.', 'semona' ),
			array(
					'option' => 'titlebar_style',
					'value_in' => array( 'large', 'large2' ),
			)
		);
		?>
		<?php
		$metabox->select( 'titlebar_large1_hide_nav', 
			__( 'Hide Navigation', 'semona' ),
			array (
				'no' => __ ( 'No', 'semona' ),
				'yes' => __ ( 'Yes', 'semona' ),
			),
			__( 'Choose Yes to hide navigation links at the bottom of large-style titlebar.', 'semona' ),
			array(
					'option' => 'titlebar_style',
					'value' => 'large',
			)
		);
		?>
		<?php
		$metabox->select( 'titlebar_breadcrumbs', 
			__( 'Show Titlebar Breadcrumbs', 'semona' ),
			array (
				'no' => __ ( 'No', 'semona' ),
				'yes' => __ ( 'Yes', 'semona' ),
			),
			__( 'Choose Yes to show Breadcrumbs bar', 'semona' ),
			array(
					'option' => 'titlebar_style',
					'value' => 'large2',
			)
		);
		?>
	</div>
	<div class="crf_metabox_tab" id="crf_tab_sliders">
		<?php
		$metabox->select ( 'slider_type', __ ( 'Slider Type', 'semona' ), array (
				'no' => __ ( '- No Slider -', 'semona' ),
				'layer' => __ ( 'LayerSlider', 'semona' ),
				'rev' => __ ( 'Revolution Slider', 'semona' ),
				'custom' => esc_html__( 'Custom Slider', 'semona' ), 
		), __ ( 'Select the type of slider that displays.', 'semona' ) );
		?>
		<?php
		global $wpdb;
		$slides_array [0] = __ ( '- Select a slider -', 'semona' );
		if( function_exists( 'layerslider_loaded' ) ) {
			$table_name = $wpdb->prefix . "layerslider";
			$sliders = $wpdb->get_results( ( "SELECT * FROM $table_name
												WHERE flag_hidden = '0' AND flag_deleted = '0'
												ORDER BY date_c ASC" ) );
			if (! empty ( $sliders )) :
				foreach ( $sliders as $key => $item ) :
					$slides [$item->id] = '';
				endforeach;
			endif;
		}
		if( isset( $slides ) && $slides ) {
			foreach ( $slides as $key => $val ) {
				$slides_array [$key] = esc_html__( 'LayerSlider #', 'semona' ) . ($key);
			}
		}
		$metabox->select ( 
				'layerslider', 
				__ ( 'Select LayerSlider', 'semona' ), 
				$slides_array, 
				__ ( 'Select the unique name of the slider.', 'semona' ),
				array(
						'option' => 'slider_type',
						'value' => 'layer',
				)
		);
		?>
		<?php
		global $wpdb;
		$revsliders [0] = __ ( '- Select a slider -', 'semona' );
		if (function_exists ( 'rev_slider_shortcode' )) {
			$get_sliders = $wpdb->get_results( ( 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders' ) );
			if ($get_sliders) {
				foreach ( $get_sliders as $slider ) {
					$revsliders [$slider->alias] = $slider->title;
				}
			}
		}
		$metabox->select ( 
				'revslider', 
				__ ( 'Select Revolution Slider', 'semona' ), 
				$revsliders, 
				__ ( 'Select the unique name of the slider.', 'semona' ),
				array(
						'option' => 'slider_type',
						'value' => 'rev',
				)
		);
		?>
		<?php
		$metabox->text ( 
				'custom_slider', 
				__ ( 'Custom Slider Shortcode', 'semona' ), 
				__ ( 'Enter custom slider shortcode here.', 'semona' ),
				array(
						'option' => 'slider_type',
						'value' => 'custom',
				)
		);
		?>
		<?php
		$metabox->select ( 'slider_position', __ ( 'Slider Position', 'semona' ), array (
						'below' => __ ( 'Below', 'semona' ),
						'above' => __ ( 'Above', 'semona' ),
				), 
				__ ( 'Choose to place slider below or above header.', 'semona' ),
				array(
						'option' => 'slider_type',
						'value_not_in' => array( 'no' ),
				)
		);
		?>
		<?php
		$metabox->select ( 'slider_decoration', __ ( 'Slider Decoration', 'semona' ), array (
						'none' => __ ( 'None', 'semona' ),
						'triangle-down' => __ ( 'Rounded Triangle Downwards', 'semona' ),
				),
				__ ( 'Choose Slider Decoration Style.', 'semona' ),
				array(
						'option' => 'slider_type',
						'value_not_in' => array( 'no' ),
				)
		);
		?>
		<?php
		$metabox->select ( 'slider_decoration_skin', __ ( 'Decoration Skin For', 'semona' ), array (
						'light' => __ ( 'Dark Colored Slider', 'semona' ),
						'dark' => __ ( 'Light Colored Slider', 'semona' ),
				),
				__ ( 'Choose color skin for slide down icon.', 'semona' ),
				array(
						'option' => 'slider_decoration',
						'value_in' => array( 'triangle-down' ),
				)
		);
		?>
	</div>
	<div class="crf_metabox_tab" id="crf_tab_footer">
		<?php
		$metabox->select ( 'display_footer', esc_html__( 'Display Footer', 'semona' ), array (
				'default' => esc_html__( 'Default', 'semona' ),
				'yes' => esc_html__( 'Yes', 'semona' ),
				'no' => esc_html__( 'No', 'semona' ),
		), esc_html__( 'Choose to show or hide the footer.','semona' ) );
		?>
		<?php
		$metabox->select ( 'footer_style', esc_html__( 'Footer Style', 'semona' ), 
			sm_add_option_default( sm_footer_styles() ), esc_html__( 'Choose footer style.','semona' ) );
		?>
		<?php
		$metabox->select ( 'footer_display_widget_area', __ ( 'Display Widget Area', 'semona' ), array (
				'default' => esc_html__( 'Default', 'semona' ),
				'yes' => esc_html__ ( 'Yes', 'semona' ),
				'no' => esc_html__ ( 'No', 'semona' ),
		), __ ( 'Choose to show or hide widget area.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'footer_display_bar', __ ( 'Display Footer Bar', 'semona' ), array (
				'yes' => esc_html__ ( 'Yes', 'semona' ),
				'no' => esc_html__ ( 'No', 'semona' ),
		), __ ( 'Choose to show or hide footer bar.', 'semona' ) );
		?>
		<?php
		$metabox->textarea ( 
			'footer_bar_shortcode', 
			__( 'Footer Bar Shortcode', 'semona' ), 
			__( 'Place one or more shortcodes above the footer, for example, callout shortcode or logo carousel. Leave empty to use theme option settings.', 'semona' )
		);
		?>
		
		<?php
		$metabox->subsection_start(
				esc_html__( 'Footer v3 options', 'semona' ),
				array(
						'option' => 'footer_style',
						'value' => 'style3',
						'current_default' => crf_get_theme_mod_value( 'footer-style' ),
				)
		); 
		?>
		<?php
		$metabox->upload ( 'footer_bg', 
			__( 'Background Image', 'semona' ), 
			__( 'Select an image to use for the footer background. Note: this options only works for style 3.', 'semona' ) 
		);
		?>
		<?php
		$metabox->text ( 
			'footer_bg_image_opacity', 
			__( 'Background Image Opacity (%)', 'semona' ), 
			__( 'Controls background image opacity in footer in percent, e.g.10. Leave blank to use theme option value. Note: this options only works for style 3.', 'semona' )
		);
		?>
		<?php
		$metabox->subsection_end(); 
		?>
	</div>
	<div class="crf_metabox_tab" id="crf_tab_sidebars">
		<?php
		sidebar_generator::edit_form ();
		?>
		<?php
		$metabox->select ( 'sidebar_position', __ ( 'Sidebar Position', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'right' => __ ( 'Right', 'semona' ),
				'left' => __ ( 'Left', 'semona' ),
		), __ ( 'Select the sidebar position.', 'semona' ) );
		?>
	</div>
	<div class="crf_metabox_tab" id="crf_tab_background">
		<?php
		$metabox->upload ( 'content_bg_image', __ ( 'Content Background Image', 'semona' ), __ ( 'Select an image to use for the main content area.', 'semona' ) );
		?>
		<?php
		$metabox->color ( 'content_bg_color', __ ( 'Content Background Color (Hex Code)', 'semona' ), __ ( 'Controls the background color of the main content area. Note: you can use theme background color by entering #bg, and theme background color 2 by entering #bg2.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'content_bg_repeat', __ ( 'Content Background Repeat', 'semona' ), 
				sm_add_option_default( sm_bg_repeats() ), 
				__ ( 'Select how the content area background image repeats.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'outer_bg_type', __ ( 'Outer Background Type', 'semona' ), 
				sm_add_option_default( sm_outer_bg_types() ), 
				__ ( 'Choose to use pattern or imge for outer area background. Note: all outer area background options are effective in boxed mode only.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'outer_bg_pattern', __ ( 'Outer Background Pattern', 'semona' ), 
				sm_add_option_default( sm_outer_bg_patterns() ), 
				__ ( 'Select background pattern of outer area.', 'semona' ) );
		?>
		<?php
		$metabox->upload ( 'outer_bg_image', __ ( 'Outer Background Image', 'semona' ), __ ( 'Select an image to use for the outer area in boxed mode.', 'semona' ) );
		?>
		<?php
		$metabox->select ( 'outer_bg_repeat', __ ( 'Outer Background Repeat', 'semona' ), 
				sm_add_option_default( sm_bg_repeats() ), 
				__ ( 'Select how the outer area background image repeats.', 'semona' ) );
		?>
	</div>
	<div class="crf_metabox_tab" id="crf_tab_paddings">
		<?php
		$metabox->text ( 'content_padding_top', __ ( 'Content Top Padding (px)', 'semona' ), __ ( 'Padding top of main content. Leave empty to use default value 80.', 'semona' ) );
		$metabox->text ( 'content_padding_bottom', __ ( 'Content Bottom Padding (px)', 'semona' ), __ ( 'Padding bottom of main content. Leave empty to use default value 80.', 'semona' ) );
		?>
	</div>
	<?php
}