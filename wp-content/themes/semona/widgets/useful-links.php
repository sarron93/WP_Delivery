<?php

add_action( 'widgets_init', 'sm_load_widget_useful_links' );

function sm_load_widget_useful_links()
{
	register_widget( 'Semona_Widget_Useful_Links' );
}

class Semona_Widget_Useful_Links extends WP_Widget {

	function __construct() {
		$id_base = 'sm-widget-useful-links';
		$widget_opts = array(
			'classname' => 'sm-widget-useful-links', 
			'description' => esc_html__( 'Enter some a tag with links.', 'semona' )
		);
		$control_opts = array( 'id_base' => $id_base );
		parent::__construct( $id_base, esc_html__( 'Semona: Useful Links', 'semona' ), $widget_opts, $control_opts );
	}

	function widget( $args, $instance )
	{
		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo ( $before_widget );
		if($title) {
			echo ( $before_title . $title . $after_title );
		}
		
		do_action( 'sm_before_widget_useful_links', $instance );
		
		echo ( $instance['links'] );
		
		do_action( 'sm_after_widget_useful_links', $instance );
		
		echo ( $after_widget );
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = crf_do_kses( $new_instance['title'] );
		$instance['links'] = crf_do_kses( $new_instance['links'] );

		return $instance;
	}

	function form($instance)
	{
		$defaults = array( 
				'title' => esc_html__( 'Useful Links', 'semona' ), 
				'links' => '', 
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo esc_html__( "Title", 'semona' ) ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('links') ); ?>"><?php echo esc_html__( "Links", 'semona' ) ?>:</label>
			<textarea class="widefat" rows="16" id="<?php echo esc_attr( $this->get_field_id('links') ); ?>" name="<?php echo esc_attr( $this->get_field_name('links') ); ?>"><?php echo ( $instance['links'] ); ?></textarea>
		</p>

	<?php
	}
}
