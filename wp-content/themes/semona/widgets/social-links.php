<?php
add_action( 'widgets_init', 'sm_load_widget_social_links' );

function sm_load_widget_social_links()
{
	register_widget( 'Semona_Social_Links_Widget' );
}

class Semona_Social_Links_Widget extends WP_Widget {
	
	private $options = array();
	private $option_names = array();
	private $icons = array();
	
	function __construct() {
		$this->options = array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'instagram', 'dribbble', 'tumblr', 'reddit', 'vimeo', 'pinterest', 'flickr', 'skype' );
		$this->option_names = array( esc_html__( 'Facebook', 'semona' ), esc_html__( 'Twitter', 'semona' ), esc_html__( 'Google+', 'semona' ), esc_html__( 'LinkedIn', 'semona' ), esc_html__( 'Instagram', 'semona' ), esc_html__( 'Dribbble', 'semona' ), esc_html__( 'Tumblr', 'semona' ), esc_html__( 'Reddit', 'semona' ), esc_html__( 'Vimeo', 'semona' ), esc_html__( 'Pinterest', 'semona' ), esc_html__( 'Flickr', 'semona' ), esc_html__( 'Skype', 'semona' ) );
		
		$id_base = 'sm-widget-social-links';
		$widget_opts = array(
				'classname' => 'sm-widget-social-links',
				'description' => '',
		);
		$control_opts = array( 'id_base' => $id_base );
		parent::__construct( $id_base, esc_html__( 'Semona: Social Links', 'semona' ), $widget_opts, $control_opts );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo ( $before_widget );
		if($title) {
			echo ( $before_title . $title . $after_title );
		}
		
		do_action( 'sm_before_widget_social_links', $instance );

		$shortcode = "[sm_social_links";
		$shortcode .= " style='sm-style-outline'";
		$shortcode .= " shape='{$instance['shape']}'";
		$shortcode .= " align='{$instance['align']}'";
		foreach( $this->options as $option ) {
			$shortcode .= " {$option}='{$instance[$option]}'";
		}
		$shortcode .= "]";
		echo do_shortcode( $shortcode );
		
		do_action( 'sm_after_widget_social_links', $instance );
		
		echo ( $after_widget );
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = crf_do_kses( $new_instance['title'] );
		$instance['shape'] = esc_attr( $new_instance['shape'] );
		$instance['align'] = esc_attr( $new_instance['align'] );
		foreach( $this->options as $option ) {
			$instance[$option] = esc_url( $new_instance[$option] );
		}
		return $instance;
	}
	
	function output_select( $id, $value, $options ) {
		?>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>">
			<?php foreach( $options as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ) ?>"<?php if( $value == $option_key ) { echo " selected"; } ?>><?php echo esc_html( $option_value ) ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

	function form($instance)
	{
		$defaults = array( 'title' => '', 'shape' => 'sm-shape-round', 'align' => '' );
		foreach( $this->options as $option ) {
			$defaults[$option] = '';
		}
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo esc_html__( "Title", 'semona' ) ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('shape') ); ?>"><?php echo esc_html__( "Shape", 'semona' ) ?>:</label>
			<?php
			$this->output_select( 'shape', $instance['shape'], 
				array(
					'sm-shape-round' => esc_html__( 'Round', 'semona' ),
					'sm-shape-rounded' => esc_html__( 'Rounded', 'semona' ),
				)
			); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('align') ); ?>"><?php echo esc_html__( "Align", 'semona' ) ?>:</label>
			<?php
			$this->output_select( 'align', $instance['align'], 
				array(
					'' => esc_html__( 'Left', 'semona' ),
					'sm-center' => esc_html__( 'Center', 'semona' ),
					'sm-right' => esc_html__( 'Right', 'semona' ),
				)
			); ?>
		</p>
		<?php
		$i = 0; 
		foreach( $this->options as $option ) {
			$option_name = $this->option_names[$i]; 
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id($option) ); ?>"><?php echo esc_attr( $option_name ) ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id($option) ); ?>" name="<?php echo esc_attr( $this->get_field_name($option) ); ?>" value="<?php echo esc_attr( $instance[$option] ); ?>" />
		</p>
		<?php
		$i++; 
		} ?>
	<?php
	}
}
