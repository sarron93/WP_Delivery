<?php
if( crf_get_option_value( '', 'display_footer' ) != 'no' && !wp_script_is( 'multiscroll' ) ) :
	$footer_classes = array();
	$footer_style = crf_get_option_value( 'footer-style', 'footer_style' );
	$footer_classes[] = $footer_style;
	$footer_bg_image = crf_get_option_value( 'footer-bg-style3', 'footer_bg' );
	$footer_bar_shortcode = crf_get_option_value( 'footer-bar-shortcode', 'footer_bar_shortcode' );
	$footer_display_widget_area = crf_get_option_value( 'widget-area-show', 'footer_display_widget_area' );
	$footer_display_bar = crf_get_option_value( '', 'footer_display_bar' );
	?>
	<?php if( $footer_bar_shortcode && $footer_display_bar != 'no' ): ?>
	<div class='sm-footer-bar'>
		<?php echo do_shortcode( $footer_bar_shortcode ) ?>
	</div>
	<?php endif; ?>
	<footer class="<?php echo esc_attr( implode( ' ', $footer_classes ) ) ?>">
		<?php if( $footer_style == 'style3' ): ?>
			<div class='footer-bg' style='background-image: url("<?php echo esc_url( $footer_bg_image ) ?>")'></div>
		<?php endif; ?>
		<div class="style3-social-links-area">
			<div class="container">
				<div class="style3-social-links-container clearfix">
					<?php
					$theme_options = array( 'social-facebook', 'social-twitter', 'social-googleplus', 'social-instagram', 'social-pinterest', 'social-dribbble', 'social-skype', 'social-youtube', 'social-rss', 'social-tumblr', 'social-behance', 'social-vimeo', 'social-github', 'social-linkedin' );
					$icons = array( 'fa-facebook', 'fa-twitter', 'fa-google-plus', 'fa-instagram', 'fa-pinterest-p', 'fa-dribbble', 'fa-skype', 'fa-youtube-play', 'fa-rss', 'fa-tumblr', 'fa-behance', 'fa-vimeo-square', 'fa-github-alt', 'fa-linkedin' );
					$i = 0;
					foreach( $theme_options as $theme_option ) {
						$link = esc_url( crf_get_theme_mod_value( $theme_option ) );
						if( $link ) {
							echo "<div class='social-link-col'>";
							echo "<a href='{$link}'><i class='fa {$icons[$i]}'></i></a>";
							echo "</div>";
						}
						$i++;
					}
					?>
				</div>
			</div>
		</div>
		<?php if( $footer_display_widget_area != 'no' && $footer_display_widget_area != 'hide' ) : ?>
		<div class="widget-area">
			<div class="widget-area-bg"></div>
			<div class="widget-area-container">
				<div class="container">
					<div class="row">
					<?php
						$columns = crf_get_theme_mod_value( 'widget-area-columns' );
						$col_class = apply_filters( 'sm_footer_column_class', sm_get_column_class( $columns ), $columns );
						$col_class .= ' widget-area-column';
						for( $i = 1; $i <= $columns; $i++ ) { ?>
							<div class="<?php echo esc_attr( $col_class ) ?>">
								<?php
								$footer_column = 'crf-footer-widget-' . $i;
								if( is_active_sidebar( $footer_column ) ) { 
									dynamic_sidebar( $footer_column );
								}
								?>
							</div>
							<?php if( $i == 2 && $columns == 4 ): ?>
							<div class='sm-footer-4col-layout-fix'></div>
							<?php endif;?>
					<?php
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="copyright">
			<div class="container">
				<div class="totop-handle">
					<i class="fa fa-angle-double-up animated medium-short infinite totop-animation"></i>
				</div>
				<?php sm_output_footer_logo() ?>
				<div class="copyright-text"><?php echo crf_do_kses( crf_get_theme_mod_value( 'footer-copyright-text' ) ); ?></div>
				<div class="copyright-right-side">
					<?php
					$right_content = crf_get_theme_mod_value( 'footer-copyright-right' );
					if( $right_content == 'menu' ):
						if( has_nav_menu( 'footer-menu' ) ):
							wp_nav_menu( array (
								'theme_location' => 'footer-menu',
								'container_id' => 'footer-menu-wrapper',
								'container_class' => 'footer-menu clearfix',
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth' => 1,
								'walker' => new Crystal_Footer_Nav_Walker()
							) );
						endif;
					elseif( $right_content == 'social' ):
						echo "\t\t\t\t<div class=\"social-links\">";
						$theme_options = array( 'social-facebook', 'social-twitter', 'social-googleplus', 'social-instagram', 'social-pinterest', 'social-youtube', 'social-rss', 'social-tumblr', 'social-behance', 'social-vimeo', 'social-github', 'social-linkedin' );
						$icons = array( 'fa-facebook-square', 'fa-twitter-square', 'fa-google-plus-square', 'fa-instagram', 'fa-pinterest-square', 'fa-youtube-square', 'fa-rss-square', 'fa-tumblr-square', 'fa-behance-square', 'fa-vimeo-square', 'fa-github-square', 'fa-linkedin-square' );
						$i = 0;
						foreach( $theme_options as $theme_option ) {
							$link = esc_url( crf_get_theme_mod_value( $theme_option ) );
							if( $link != '' ) {
								echo "<a href='{$link}'><i class='fa {$icons[$i]}'></i></a>";
							}
							$i++;
						}
						echo "</div>\n";
					endif; ?>
				</div>
			</div>
		</div>
	</footer>
<?php
endif;