<?php   

function sm_site_layouts() {
	return array(
			'wide' => esc_html__( 'Wide', 'semona' ),
			'boxed' => esc_html__( 'Boxed', 'semona' ),
	);
}
function sm_outer_bg_patterns() {
	return array(
			'01' => esc_html__( 'Pattern 1', 'semona' ),
			'02' => esc_html__( 'Pattern 2', 'semona' ),
			'03' => esc_html__( 'Pattern 3', 'semona' ),
	);
}
function sm_outer_bg_types() {
	return array(
			'pattern' => esc_html__( 'Pattern', 'semona' ),
			'image' => esc_html__( 'Image', 'semona' ),
	);
}
function sm_bg_repeats() {
	return array(
			'no-repeat' => esc_html__( 'No Repeat', 'semona' ),
			'repeat' => esc_html__( 'Repeat', 'semona' ),
			'repeat-x' => esc_html__( 'Repeat Horizontally', 'semona' ),
			'repeat-y' => esc_html__( 'Repeat Vertically', 'semona' ),
	);
}
function sm_header_styles() {
	return array(
			'v1' => esc_html__( 'Style 1', 'semona' ),
			'v2' => esc_html__( 'Style 2', 'semona' ),
			'v3' => esc_html__( 'Style 3', 'semona' ),
			'v4' => esc_html__( 'Style 4', 'semona' ),
	);
}
function sm_topbar_skins() {
	return array(
			'default-bg' => esc_html__( 'Default Skin', 'semona' ),
			'bg2-bg' => esc_html__( 'Secondary Background Color', 'semona' ),
			'primary-bg' => esc_html__( 'Primary Color Background', 'semona' ),
			'gradient1-bg' => esc_html__( 'Gradient Background 1', 'semona' ),
			'gradient2-bg' => esc_html__( 'Gradient Background 2', 'semona' ),
			'black-bg' => esc_html__( 'Black Background', 'semona' ),
	);
}
function sm_transparent_header_skins() {
	return array(
			'light' => esc_html__( 'Light', 'semona' ),
			'dark' => esc_html__( 'Dark', 'semona' ),
	);
}
function sm_main_nav_hover_styles() {
	return apply_filters( 'sm_main_nav_hover_styles', array(
			'hover1' => esc_html__( 'Hover Style 1', 'semona' ),
			'hover2' => esc_html__( 'Hover Style 2', 'semona' ),
			'hover3' => esc_html__( 'Hover Style 3', 'semona' ),
	) );
}
function sm_dropdown_skins() {
	return apply_filters( 'sm_dropdown_skins', array(
			'light-dropdown' => esc_html__( 'Light', 'semona' ),
			'dark-dropdown' => esc_html__( 'Dark', 'semona' ),
	) );
}

function sm_footer_styles() {
	return array(
			'style1' => esc_html__( 'Style 1', 'semona' ),
			'style2' => esc_html__( 'Style 2', 'semona' ),
			'style3' => esc_html__( 'Style 3', 'semona' ),
			'style4' => esc_html__( 'Style 4', 'semona' ),
	);
}

function sm_blog_layouts() {
	return array(
			'classic' => esc_html__( 'Classic', 'semona' ),
			'grid' => esc_html__( 'Grid', 'semona' ),
			'masonry' => esc_html__( 'Masonry', 'semona' ),
			'simple' => esc_html__( 'Simple Grid', 'semona' ),
			'simple-list' => esc_html__( 'Simple List', 'semona' ),
			'modern' => esc_html__( 'Modern', 'semona' ),
	);
}

function sm_portfolio_layouts() {
	return array(
			'masonry' => esc_html__( 'Masonry v1', 'semona' ),
			'masonry2' => esc_html__( 'Masonry v2', 'semona' ),
			'grid' => esc_html__( 'Grid v1', 'semona' ),
			'grid2' => esc_html__( 'Grid v2', 'semona' ),
			'grid3' => esc_html__( 'Grid v3', 'semona' ),
			'grid4' => esc_html__( 'Grid v4', 'semona' ),
	);
}

function sm_portfolio_related_styles() {
	return array(
			'grid' => esc_html__( 'Style 1', 'semona' ),
			'grid2' => esc_html__( 'Style 2', 'semona' ),
			'grid3' => esc_html__( 'Style 3', 'semona' ),
	);
}

function sm_get_all_sidebars( $with_default = false ) {
	global $wp_registered_sidebars;
	if( $with_default ) {
		$list = array( "0" => $default );
	} else {
		$list = array();
	}
	$list['-1'] = esc_html__( 'No Sidebar', 'semona' );
	foreach( $wp_registered_sidebars as $sidebar ) {
		$list[$sidebar['id']] = $sidebar['name'];
	}
	return $list;
}

function sm_sidebar_positions() {
	return array(
			'left' => esc_html__( 'Left', 'semona' ),
			'right' => esc_html__( 'Right', 'semona' )
	);
}

function sm_pagination_modes() {
	return array(
			'pagination' => esc_html__( 'Pagination', 'semona' ),
			'loadmore' => esc_html__( 'Load More Button', 'semona' ),
			'infinitescroll' => esc_html__( 'Infinte Scroll', 'semona' ),
	);
}
function sm_archive_titlebar_styles() {
	return array(
			'none' => esc_html__( 'None', 'semona' ),
			'small' => esc_html__( 'Small 1', 'semona' ),
			'small2' => esc_html__( 'Small 2', 'semona' ),
			'small3' => esc_html__( 'Small 3', 'semona' ),
	);
}
function sm_titlebar_styles() {
	return sm_add_option_default( array(
			'none' => esc_html__( 'None', 'semona' ),
			'small' => esc_html__( 'Small 1', 'semona' ),
			'small2' => esc_html__( 'Small 2', 'semona' ),
			'small3' => esc_html__( 'Small 3', 'semona' ),
			'large' => esc_html__( 'Large 1', 'semona' ),
			'large2' => esc_html__( 'Large 2', 'semona' ),
	) );
}
function sm_titlebar_bg_types() {
	return array(
			'bg2' => esc_html__( 'Background Color 2', 'semona' ),
			'gradient1' => esc_html__( 'Gradient 1', 'semona' ),
			'gradient2' => esc_html__( 'Gradient 2', 'semona' ),
			'image' => esc_html__( 'Image', 'semona' ),
	);
}

/* Some helper functions */

function sm_add_option_default( $option_values ) {
	return array_merge( array(
			'default' => esc_html__( 'Default', 'semona' ),
	), $option_values );
}