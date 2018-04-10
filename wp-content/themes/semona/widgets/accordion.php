<?php

add_action( 'widgets_init', 'sm_load_widget_accordion' );

function sm_load_widget_accordion()
{
	register_widget( 'Semona_Widget_Accordion' );
}

class Semona_Widget_Accordion extends WP_Widget {

	function __construct() {
		$id_base = 'crf-widget-accordion';
		$widget_opts = array(
			'classname' => 'crf-widget-accordion', 
			'description' => esc_html__( 'Enter some a tag with links.', 'semona' )
		);
		$control_opts = array( 'id_base' => $id_base );
		parent::__construct( $id_base, esc_html__( 'Semona: Accordion', 'semona' ), $widget_opts, $control_opts );
	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo ( $before_widget );
		if($title) {
			echo ( $before_title . $title . $after_title );
		}
		
		do_action( 'sm_before_widget_accordion', $instance );
		
		$tabs = '[sm_accordion style="sm-style-underline" ctrl_style="sm-ctrl-fa" ctrl_align="sm-ctrl-left"]';
		if( is_array( $instance['fields'] ) ) {
			foreach( $instance['fields'] as $field ) {
				$tabs .= sprintf( "[sm_accordion_tab title='%s']%s[/sm_accordion_tab]", $field['title'], $field['content'] );
			}
		}
		$tabs .= '[/sm_accordion]';
		echo do_shortcode( $tabs );
		
		do_action( 'sm_after_widget_accordion', $instance );
		
		echo ( $after_widget );
	}
	
	function validate_fields( $fields ) {
		if( is_array( $fields ) ) {
			foreach( $fields as $field ) {
				$field['title'] = crf_do_kses( $field['title'] );
				$field['content'] = crf_do_kses( $field['content'] );
			}
			unset( $field );
			return $fields;
		}
		return array();
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = crf_do_kses( $new_instance['title'] );
		$instance['fields'] = $this->validate_fields( $new_instance['fields'] );

		return $instance;
	}

	function form($instance) {
		$defaults = array( 
				'title' => esc_html__( 'Accordion', 'semona' ), 
				'fields' => array(), 
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'crf-widgets' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo esc_html__( "Title", 'semona' ) ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<div class="add-sortable-container">
			<a href='#' class="button button-primary crf-btn-add-accordion-tab"><?php _e( 'Add Tab', 'semona' ) ?></a>
		</div>
		<div class="crf-new-handle" data-field-name="<?php echo esc_attr( $this->get_field_name('fields') ) . "[*index]"; ?>">
			<div class="crf-widget-accordion-tab crf-sortable-handle ui-sortable-handle">
				<div class="accordion-tab-title crf-sortable-handle-title">
					<?php _e( 'Accordion Tab', 'semona' ) ?>: <span><?php _e( 'New Tab', 'semona' ) ?></span>
					<div class='delete'><i class='fa fa-close'></i></div>
					<div class='open'><i class='fa fa-caret-down'></i></div>
				</div>
				<div class="crf-sortable-content-wrapper">
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('fields') ) . "[data-index]"; ?>[title]"><?php echo esc_html__( "Title", 'semona' ) ?>:</label>
						<input class="widefat crf-sortable-title" type="text" id="<?php echo esc_attr( $this->get_field_id('fields') ) . "[data-index]"; ?>[title]" 
							data-name="<?php echo esc_attr( $this->get_field_name('fields') ) . "[data-index]"; ?>[title]" value="<?php _e( 'New Tab', 'semona' ) ?>" />
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('fields') ) . "[data-index]"; ?>[content]"><?php echo esc_html__( "Content", 'semona' ) ?>:</label>
						<textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id('fields') ) . "[data-index]"; ?>[content]" 
							data-name="<?php echo esc_attr( $this->get_field_name('fields') ) . "[data-index]"; ?>[content]"></textarea>
					</p>
				</div>
			</div>
		</div>
		<div class="crf-widget-accordion-tabs crf-sortable ui-sortable">
			<?php
			if( is_array( $instance['fields'] ) ):
				$index = 0; 
				foreach( $instance['fields'] as $field ) { ?>
				<div class="crf-widget-accordion-tab crf-sortable-handle ui-sortable-handle">
					<div class="accordion-tab-title crf-sortable-handle-title">
						<?php _e( 'Accordion Tab', 'semona' ) ?>: <span><?php echo esc_attr( $field['title'] ) ?></span>
						<div class='delete'><i class='fa fa-close'></i></div>
						<div class='open'><i class='fa fa-caret-down'></i></div>
					</div>
					<div class="crf-sortable-content-wrapper">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id('fields') ) . "[$index]"; ?>[title]"><?php echo esc_html__( "Title", 'semona' ) ?>:</label>
							<input class="widefat crf-sortable-title" type="text" id="<?php echo esc_attr( $this->get_field_id('fields') ) . "[$index]"; ?>[title]" 
								name="<?php echo esc_attr( $this->get_field_name('fields') ) . "[$index]"; ?>[title]" value="<?php echo esc_attr( $field['title'] ); ?>" />
						</p>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id('fields') ) . "[$index]"; ?>[content]"><?php echo esc_html__( "Content", 'semona' ) ?>:</label>
							<textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id('fields') ) . "[$index]"; ?>[content]" 
								name="<?php echo esc_attr( $this->get_field_name('fields') ) . "[$index]"; ?>[content]"><?php echo esc_attr( $field['content'] ); ?></textarea>
						</p>
					</div>
				</div>
				<?php 
					$index++;
				}
			endif;
			?>
		</div>

	<?php
	}
}
