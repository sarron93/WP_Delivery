<?php

require_once FRAMEWORK_PATH . '/lib/metaboxes/views/metaboxes/common_options.php';

class Crystal_Metaboxes {
	
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_custom_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_data' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}
	
	public function add_custom_meta_boxes () {
		$post_types = get_post_types( array( 'public' => true ) );
		foreach ( $post_types as $post_type ) {
			if ( $post_type == 'post' ) {
				add_meta_box( 'crf_post_options', esc_html__( 'Post Options', 'semona'), array( $this, 'post_options' ), $post_type );
			} else if ( $post_type == 'page' ) {
				add_meta_box( 'crf_page_options', esc_html__( 'Page Options', 'semona'), array( $this, 'page_options' ), $post_type );
			} else if ( $post_type == 'crf_portfolio' ) {
				add_meta_box( 'crf_portfolio_options', esc_html__( 'Portfolio Options', 'semona'), array( $this, 'portfolio_options' ), $post_type );
			} else {
				add_meta_box( 'crf_default_options', esc_html__( 'Post Options', 'semona'), array( $this, 'default_options' ), $post_type );
			}
		}
	}
	
	public function save_meta_data( $post_id ) {
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		foreach($_POST as $key => $value) {
			if(strstr($key, 'crf_')) {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
	
	public function admin_scripts () {
		wp_enqueue_style( 'wp-color-picker' );

		wp_register_script('metabox_script', FRAMEWORK_URI . '/assets/js/metaboxes.js', array( 'wp-color-picker'), false, true );
		wp_enqueue_script('metabox_script');
	}
	
	public function post_options() {
		include __DIR__ . '/views/metaboxes/post_options.php';
	}
	
	public function page_options() {
		include __DIR__ . '/views/metaboxes/page_options.php';
	}
	
	public function portfolio_options() {
		include __DIR__ . '/views/metaboxes/portfolio_options.php';
	}
	
	public function default_options() {
		include __DIR__ . '/views/metaboxes/page_options.php';
	}
	
	// --------------------------------
	
	protected function build_dependency_atts( $dependency ) {
		if( empty( $dependency ) || !is_array( $dependency ) ) {
			return false;
		}
		$dep_string = "";
		if( !empty( $dependency['option'] ) ) {
			$dep_string .= sprintf( " data-dep-option='%s'", $dependency['option'] );
		}
		if( !empty( $dependency['value'] ) ) {
			$dep_string .= sprintf( " data-dep-value='%s'", $dependency['value'] );
		}
		if( !empty( $dependency['current_default'] ) ) {
			$dep_string .= sprintf( " data-dep-default='%s'", $dependency['current_default'] );
		}
		if( !empty( $dependency['value_in'] ) && is_array( $dependency['value_in'] ) ) {
			$dep_string .= sprintf( " data-dep-value-in='%s'", implode( ',', $dependency['value_in'] ) );
		}
		if( !empty( $dependency['value_not_in'] ) && is_array( $dependency['value_not_in'] ) ) {
			$dep_string .= sprintf( " data-dep-value-not-in='%s'", implode( ',', $dependency['value_not_in'] ) );
		}
		return $dep_string;
	}
	
	protected function metabox_field_start( $dependency ) {
		return "<div class='crf_metabox_field'" . $this->build_dependency_atts( $dependency ) . ">";
	}
	
	protected function metabox_field_end() {
		return "</div>";
	}
	
	public function text( $id, $label, $desc = '', $dependency = false )
	{
		global $post;
		
		$html = $this->metabox_field_start( $dependency );
		
		$html .= '<div class="crf_desc">';
		$html .= '<label for="crf_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="crf_field">';
		$html .= '<input type="text" class="crf-meta-value" id="crf_' . $id . '" name="crf_' . $id . '" value="' . get_post_meta($post->ID, 'crf_' . $id, true) . '" />';
		$html .= '</div>';
		
		$html .= $this->metabox_field_end();
	
		echo ( $html );
	}
	
	public function select( $id, $label, $options, $desc = '', $dependency = false )
	{
		global $post;

		$id = esc_attr( $id );
		$label = esc_attr( $label );
		$desc = esc_html( $desc );
		
		$html = $this->metabox_field_start( $dependency );
		
		$html .= '<div class="crf_desc">';
		$html .= '<label for="crf_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="crf_field">';
		$html .= '<select class="crf-meta-value" id="crf_' . $id . '" name="crf_' . $id . '">';
		foreach($options as $key => $option) {
			if(get_post_meta($post->ID, 'crf_' . $id, true) == $key) {
				$selected = 'selected="selected" ';
			} else {
				$selected = '';
			}
	
			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		
		$html .= $this->metabox_field_end();
	
		echo ( $html );
	}

	public function textarea( $id, $label, $desc = '', $default = '', $dependency = false )
	{
		global $post;

		$id = esc_attr( $id );
		$label = esc_attr( $label );
		$desc = esc_html( $desc );
		
		$db_value = get_post_meta($post->ID, 'crf_' . $id, true);
	
		if( metadata_exists( 'post', $post->ID, 'crf_'. $id ) ) {
			$value = $db_value;
		} else {
			$value = $default;
		}
	
		$html = $this->metabox_field_start( $dependency );
		
		$html .= '<div class="crf_desc">';
		$html .= '<label for="crf_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="crf_field">';
		$html .= '<textarea class="crf-meta-value" cols="120" rows="10" id="crf_' . $id . '" name="crf_' . $id . '">' . esc_textarea( $value ) . '</textarea>';
		$html .= '</div>';
		
		$html .= $this->metabox_field_end();
	
		echo ( $html );
	}
	
	public function upload( $id, $label, $desc = '', $dependency = false )
	{
		global $post;
		
		$html = $this->metabox_field_start( $dependency );
		
		$html .= '<div class="crf_desc">';
		$html .= '<label for="crf_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="crf_field">';
		$html .= '<div class="crf_upload">';
		$html .= '<div><input name="crf_' . $id . '" class="upload_field crf-meta-value" id="crf_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'crf_' . $id, true) . '" /></div>';
		$html .= '<div class="crf_upload_button_container"><input class="crf_upload_button" type="button" value="Browse" /></div>';
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= $this->metabox_field_end();

		echo ( $html );
	}

	public function color( $id, $label, $desc = '', $dependency = false )
	{
		global $post;
	
		$html = $this->metabox_field_start( $dependency );
		
		$html .= '<div class="crf_desc">';
		$html .= '<label for="crf_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if( $desc ) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="crf_field">';
		$html .= '<input type="text" id="crf_' . $id . '" name="crf_' . $id . '" value="' . get_post_meta($post->ID, 'crf_' . $id, true) . '" class="crf-metabox-color-picker crf-meta-value"/>';
		$html .= '</div>';
		
		$html .= $this->metabox_field_end();
	
		echo ( $html );
	}
	
	public function subsection_start( $title, $dependency = false ) {
		$html = "<div class='crf-metabox-subsection opened'" . $this->build_dependency_atts( $dependency ) . ">";
		$html .= "<div class='subsection-title'>";
		$html .= "<h4 class='title'>" . $title . "</h4>";
		$html .= "</div>";
		$html .= "<div class='subsection-content'>";
		
		echo ( $html );
	}
	
	public function subsection_end() {
		echo "</div></div>\n";
	}
}

$metaboxes = new Crystal_Metaboxes();