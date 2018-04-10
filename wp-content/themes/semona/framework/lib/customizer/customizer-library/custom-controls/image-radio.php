<?php

if( class_exists( 'WP_Customize_Control' ) ) {
	class Crystal_Customize_Control_Image_Radio extends WP_Customize_Control {
		public $type = 'imageradio';
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="hidden" id="input_<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>/>
			</label>
			<div class='image-radio-options clearfix'>
				<?php foreach( $this->choices as $key => $value ) : ?>
					<a class='option-image<?php if( $this->value() == $key ): echo ' selected'; endif; ?>' data-value='<?php echo esc_attr( $key ) ?>' href='#'>
						<img src='<?php echo esc_url( $value ); ?>' alt='<?php echo esc_attr( $key ) ?>'>
					</a>
				<?php endforeach; ?>
			</div>
		<?php
		}
	}
}