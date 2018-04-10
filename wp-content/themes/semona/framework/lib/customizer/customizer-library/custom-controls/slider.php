<?php

if( class_exists( 'WP_Customize_Control' ) ) {
	class Crystal_Customize_Control_Slider extends WP_Customize_Control {
		public $type = 'slider';
		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
		}
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="text" id="input_<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>/>
			</label>
			<div id="slider_<?php echo esc_attr( $this->id ); ?>" class="crf-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( "#slider_<?php echo esc_attr( $this->id ); ?>" ).slider( {
					value : <?php echo esc_attr( $this->value() ); ?>,
					min   : <?php echo esc_attr( $this->input_attrs['min'] ); ?>,
					max   : <?php echo esc_attr( $this->input_attrs['max'] ); ?>,
					step  : <?php echo esc_attr( $this->input_attrs['step'] ); ?>,
					slide : function( event, ui ) { $( "#input_<?php echo esc_attr( $this->id ); ?>" ).val(ui.value).keyup(); }
				} );
				$( "#input_<?php echo esc_attr( $this->id ); ?>" ).val( $( "#slider_<?php echo esc_attr( $this->id ); ?>" ).slider( "value" ) );
			});
			</script>
		<?php
		}
	}
}