<?php
if( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( is_admin() ) {
	require_once FRAMEWORK_PATH . '/lib/megamenu/megamenu/menu-item-custom-fields.php';
	add_action( 'admin_enqueue_scripts', 'crf_add_admin_style_script_4megamenu' );

	function crf_add_admin_style_script_4megamenu() {
		wp_enqueue_style( 'select2css-for-crf-megamenu', FRAMEWORK_URI . '/assets/js/jquery.select2/css/select2.min.css' );
		wp_enqueue_style( 'crf-fontawesome', get_template_directory_uri() . '/vendor/font-awesome-4.3.0/css/font-awesome.min.css', false, '4.3', 'screen' );
		
		wp_enqueue_script( 'select2js-for-crf-megamenu', FRAMEWORK_URI . '/assets/js/jquery.select2/js/select2.min.js', array(), false, true );
		wp_enqueue_script( 'crf-megamenu-script', FRAMEWORK_URI . '/assets/js/megamenu.js', array(), false, true );
	}
}

require_once FRAMEWORK_PATH . '/lib/megamenu/walkers/main-menu-walker.php';
require_once FRAMEWORK_PATH . '/lib/megamenu/walkers/mobile-menu-walker.php';
require_once FRAMEWORK_PATH . '/lib/megamenu/walkers/footer-menu-walker.php';

if ( is_admin() ) {
	class Crystal_MegaMenu_Custom_Fields {
		protected static $fields = array();

		public static function init() {
			add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
			add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
			global $wp_customize;
			if ( !isset( $wp_customize ) ) {
				add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
			}

			$faicons = self::getAllFontAwesomeIcons ();
			
			$sidebars = array();
			global $wp_registered_sidebars;
			if( !empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
				foreach( $wp_registered_sidebars as $sidebar ) {
					$sidebars[$sidebar['id']] = $sidebar['name'];
				}
			}

			self::$fields = array(
					'crf_menu_item_icon' => array(
							'type' 	=> 'select',
							'label'	=> esc_html__( 'Menu Item Icon', 'semona' ),
							'values' => self::getAllFontAwesomeIcons(),
					),
					'crf_enable_megamenu' => array (
							'type' 	=> 'checkbox',
							'label'	=> esc_html__( 'Enable Mega Menu', 'semona' ),
							'level' => 0,
					),
					'crf_megamenu_fullwidth' => array (
							'type' 	=> 'checkbox',
							'label'	=> esc_html__( 'Full Width Mega Menu', 'semona' ),
							'level' => 0,
					),
					'crf_megamenu_columns' => array (
							'type' 	=> 'select',
							'label'	=> esc_html__( 'Mega Menu Columns', 'semona' ),
							'values' => array(
									'1' => esc_html__( '1 Column', 'semona' ),
									'2' => esc_html__( '2 Columns', 'semona' ),
									'3' => esc_html__( '3 Columns', 'semona' ),
									'4' => esc_html__( '4 Columns', 'semona' ),
							),
							'level' => 0,
					),
					'crf_megamenu_bg' => array(
							'type'	=> 'image',
							'label'	=> esc_html__( 'Mega Menu Background', 'semona' ),
							'level'	=> 0,
					),
			);
		}

		public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return;
			}

			foreach ( self::$fields as $_key => $label ) {
				$key = sprintf( 'menu-item-%s', $_key );

				if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
					$value = $_POST[ $key ][ $menu_item_db_id ];
				}
				else {
					$value = null;
				}

				if ( ! is_null( $value ) ) {
					update_post_meta( $menu_item_db_id, $key, $value );
				}
				else {
					delete_post_meta( $menu_item_db_id, $key );
				}
			}
		}

		public static function _fields( $id, $item, $depth, $args ) {
			echo "<p style=''>&nbsp;</p>";

			foreach ( self::$fields as $_key => $label ) :
				$key   = sprintf( 'menu-item-%s', $_key );
				$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
				$name  = sprintf( '%s[%s]', $key, $item->ID );
				$value = get_post_meta( $item->ID, $key, true );

				$class = sprintf( 'field-%s', $_key );
				if( isset( $label['level'] ) ) {
					$class .= ' level-' . $label['level'];
				} else {
					$class .= ' level-all';
				}
				?>
					<p class="description description-wide <?php echo esc_attr( $class ) ?> megamenu-item">
					<?php
						if ( $label['type'] == 'checkbox' ) {
							printf( 
								'<label for="%1$s"><input type="checkbox" id="%1$s" class="widefat %1$s" name="%3$s" value="1" %4$s/>%2$s</label>',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name ),
								( $value == 1 ) ? "checked" : ""
							);
						} else if ( $label['type'] == 'select' ) {
							printf(
								'<label for="%1$s">%2$s<br /><select id="%1$s" class="widefat %1$s" name="%3$s">',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name )
							);

							foreach ( $label['values'] as $key=>$val ) {
								printf( '<option value="%s" data-icon="%s" %s>%s</option>',
									esc_attr($key),
									$key,
									( $value == $key ) ? "selected" : "",
									$val
								);
							}
							echo "</select></label>";
						} else if ( $label['type'] == 'image' ) {
							printf(
								'<label for="%1$s">%2$s<br /><input type="hidden" id="%1$s" name="%3$s" value="%4$s">',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name ),
								esc_attr( $value )
							);
							echo "<span class='crf-megamenu-bg-image-wrapper'>";
							$bg_img = wp_get_attachment_image_src( $value, 'full' );
							$style = '';
							if( !empty( $bg_img[0] ) ) {
								$style = ' style="display: none;"';
							}
							echo "<img class='crf-megamenu-bg' src='" . esc_url( $bg_img[0] )  . "'" . $style . ">";
							echo "</span>";
							echo "<a class='crf-select-megamenu-bg button button-primary' href='#'>" . esc_html__( 'Set Background Image', 'semona' ) . "</a>";
							echo "<a class='crf-remove-megamenu-bg button' href='#'>" . esc_html__( 'Remove Image', 'semona' ) . "</a>";
							echo "</label>";
						} else {
							printf(
								'<label for="%1$s">%2$s<input type="text" id="%1$s" class="widefat %1$s" name="%3$s" value="%4$s"></label>',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name ),
								esc_attr( $value )
							);
						} ?>
					</p>
				<?php
			endforeach;
		}

		public static function _columns( $columns ) {
			$columns = array_merge( $columns, self::$fields );
			return $columns;
		}

		public static function getAllFontAwesomeIcons() {
			$fa_icons = array(	
				'0' => 'No Icon',
				'fa-adjust' => 'fa-adjust',	
				'fa-adn' => 'fa-adn',	
				'fa-align-center' => 'fa-align-center',	
				'fa-align-justify' => 'fa-align-justify',	
				'fa-align-left' => 'fa-align-left',	
				'fa-align-right' => 'fa-align-right',	
				'fa-ambulance' => 'fa-ambulance',	
				'fa-anchor' => 'fa-anchor',	
				'fa-android' => 'fa-android',	
				'fa-angellist' => 'fa-angellist',	
				'fa-angle-double-down' => 'fa-angle-double-down',	
				'fa-angle-double-left' => 'fa-angle-double-left',	
				'fa-angle-double-right' => 'fa-angle-double-right',	
				'fa-angle-double-up' => 'fa-angle-double-up',	
				'fa-angle-down' => 'fa-angle-down',	
				'fa-angle-left' => 'fa-angle-left',	
				'fa-angle-right' => 'fa-angle-right',	
				'fa-angle-up' => 'fa-angle-up',	
				'fa-apple' => 'fa-apple',	
				'fa-archive' => 'fa-archive',	
				'fa-area-chart' => 'fa-area-chart',	
				'fa-arrow-circle-down' => 'fa-arrow-circle-down',	
				'fa-arrow-circle-left' => 'fa-arrow-circle-left',	
				'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down',	
				'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left',	
				'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right',	
				'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up',	
				'fa-arrow-circle-right' => 'fa-arrow-circle-right',	
				'fa-arrow-circle-up' => 'fa-arrow-circle-up',	
				'fa-arrow-down' => 'fa-arrow-down',	
				'fa-arrow-left' => 'fa-arrow-left',	
				'fa-arrow-right' => 'fa-arrow-right',	
				'fa-arrow-up' => 'fa-arrow-up',	
				'fa-arrows' => 'fa-arrows',	
				'fa-arrows-alt' => 'fa-arrows-alt',	
				'fa-arrows-h' => 'fa-arrows-h',	
				'fa-arrows-v' => 'fa-arrows-v',	
				'fa-asterisk' => 'fa-asterisk',	
				'fa-at' => 'fa-at',	
				'fa-backward' => 'fa-backward',	
				'fa-ban' => 'fa-ban',	
				'fa-bar-chart' => 'fa-bar-chart',	
				'fa-barcode' => 'fa-barcode',	
				'fa-bars' => 'fa-bars',	
				'fa-beer' => 'fa-beer',	
				'fa-behance' => 'fa-behance',	
				'fa-behance-square' => 'fa-behance-square',	
				'fa-bell' => 'fa-bell',	
				'fa-bell-o' => 'fa-bell-o',	
				'fa-bell-slash' => 'fa-bell-slash',	
				'fa-bell-slash-o' => 'fa-bell-slash-o',	
				'fa-bicycle' => 'fa-bicycle',	
				'fa-binoculars' => 'fa-binoculars',	
				'fa-birthday-cake' => 'fa-birthday-cake',	
				'fa-bitbucket' => 'fa-bitbucket',	
				'fa-bitbucket-square' => 'fa-bitbucket-square',	
				'fa-bold' => 'fa-bold',	
				'fa-bolt' => 'fa-bolt',	
				'fa-bomb' => 'fa-bomb',	
				'fa-book' => 'fa-book',	
				'fa-bookmark' => 'fa-bookmark',	
				'fa-bookmark-o' => 'fa-bookmark-o',	
				'fa-briefcase' => 'fa-briefcase',	
				'fa-btc' => 'fa-btc',	
				'fa-bug' => 'fa-bug',	
				'fa-building' => 'fa-building',	
				'fa-building-o' => 'fa-building-o',	
				'fa-bullhorn' => 'fa-bullhorn',	
				'fa-bullseye' => 'fa-bullseye',	
				'fa-bus' => 'fa-bus',	
				'fa-calculator' => 'fa-calculator',	
				'fa-calendar' => 'fa-calendar',	
				'fa-calendar-o' => 'fa-calendar-o',	
				'fa-camera' => 'fa-camera',	
				'fa-camera-retro' => 'fa-camera-retro',	
				'fa-car' => 'fa-car',	
				'fa-caret-down' => 'fa-caret-down',	
				'fa-caret-left' => 'fa-caret-left',	
				'fa-caret-right' => 'fa-caret-right',	
				'fa-caret-square-o-down' => 'fa-caret-square-o-down',	
				'fa-caret-square-o-left' => 'fa-caret-square-o-left',	
				'fa-caret-square-o-right' => 'fa-caret-square-o-right',	
				'fa-caret-square-o-up' => 'fa-caret-square-o-up',	
				'fa-caret-up' => 'fa-caret-up',	
				'fa-cc' => 'fa-cc',	
				'fa-cc-amex' => 'fa-cc-amex',	
				'fa-cc-discover' => 'fa-cc-discover',	
				'fa-cc-mastercard' => 'fa-cc-mastercard',	
				'fa-cc-paypal' => 'fa-cc-paypal',	
				'fa-cc-stripe' => 'fa-cc-stripe',	
				'fa-cc-visa' => 'fa-cc-visa',	
				'fa-certificate' => 'fa-certificate',	
				'fa-chain-broken' => 'fa-chain-broken',	
				'fa-check' => 'fa-check',	
				'fa-check-circle' => 'fa-check-circle',	
				'fa-check-circle-o' => 'fa-check-circle-o',	
				'fa-check-square' => 'fa-check-square',	
				'fa-check-square-o' => 'fa-check-square-o',	
				'fa-chevron-circle-down' => 'fa-chevron-circle-down',	
				'fa-chevron-circle-left' => 'fa-chevron-circle-left',	
				'fa-chevron-circle-right' => 'fa-chevron-circle-right',	
				'fa-chevron-circle-up' => 'fa-chevron-circle-up',	
				'fa-chevron-down' => 'fa-chevron-down',	
				'fa-chevron-left' => 'fa-chevron-left',	
				'fa-chevron-right' => 'fa-chevron-right',	
				'fa-chevron-up' => 'fa-chevron-up',	
				'fa-child' => 'fa-child',	
				'fa-circle' => 'fa-circle',	
				'fa-circle-o' => 'fa-circle-o',	
				'fa-circle-o-notch' => 'fa-circle-o-notch',	
				'fa-circle-thin' => 'fa-circle-thin',	
				'fa-clipboard' => 'fa-clipboard',	
				'fa-clock-o' => 'fa-clock-o',	
				'fa-cloud' => 'fa-cloud',	
				'fa-cloud-download' => 'fa-cloud-download',	
				'fa-cloud-upload' => 'fa-cloud-upload',	
				'fa-code' => 'fa-code',	
				'fa-code-fork' => 'fa-code-fork',	
				'fa-codepen' => 'fa-codepen',	
				'fa-coffee' => 'fa-coffee',	
				'fa-cog' => 'fa-cog',	
				'fa-cogs' => 'fa-cogs',	
				'fa-columns' => 'fa-columns',	
				'fa-comment' => 'fa-comment',	
				'fa-comment-o' => 'fa-comment-o',	
				'fa-comments' => 'fa-comments',	
				'fa-comments-o' => 'fa-comments-o',	
				'fa-compass' => 'fa-compass',	
				'fa-compress' => 'fa-compress',	
				'fa-copyright' => 'fa-copyright',	
				'fa-credit-card' => 'fa-credit-card',	
				'fa-crop' => 'fa-crop',	
				'fa-crosshairs' => 'fa-crosshairs',	
				'fa-css3' => 'fa-css3',	
				'fa-cube' => 'fa-cube',	
				'fa-cubes' => 'fa-cubes',	
				'fa-cutlery' => 'fa-cutlery',	
				'fa-database' => 'fa-database',	
				'fa-delicious' => 'fa-delicious',	
				'fa-desktop' => 'fa-desktop',	
				'fa-deviantart' => 'fa-deviantart',	
				'fa-digg' => 'fa-digg',	
				'fa-dot-circle-o' => 'fa-dot-circle-o',	
				'fa-download' => 'fa-download',	
				'fa-dribbble' => 'fa-dribbble',	
				'fa-dropbox' => 'fa-dropbox',	
				'fa-drupal' => 'fa-drupal',	
				'fa-eject' => 'fa-eject',	
				'fa-ellipsis-h' => 'fa-ellipsis-h',	
				'fa-ellipsis-v' => 'fa-ellipsis-v',	
				'fa-empire' => 'fa-empire',	
				'fa-envelope' => 'fa-envelope',	
				'fa-envelope-o' => 'fa-envelope-o',	
				'fa-envelope-square' => 'fa-envelope-square',	
				'fa-eraser' => 'fa-eraser',	
				'fa-eur' => 'fa-eur',	
				'fa-exchange' => 'fa-exchange',	
				'fa-exclamation' => 'fa-exclamation',	
				'fa-exclamation-circle' => 'fa-exclamation-circle',	
				'fa-exclamation-triangle' => 'fa-exclamation-triangle',	
				'fa-expand' => 'fa-expand',	
				'fa-external-link' => 'fa-external-link',	
				'fa-external-link-square' => 'fa-external-link-square',	
				'fa-eye' => 'fa-eye',	
				'fa-eye-slash' => 'fa-eye-slash',	
				'fa-eyedropper' => 'fa-eyedropper',	
				'fa-facebook' => 'fa-facebook',	
				'fa-facebook-square' => 'fa-facebook-square',	
				'fa-fast-backward' => 'fa-fast-backward',	
				'fa-fast-forward' => 'fa-fast-forward',	
				'fa-fax' => 'fa-fax',	
				'fa-female' => 'fa-female',	
				'fa-fighter-jet' => 'fa-fighter-jet',	
				'fa-file' => 'fa-file',	
				'fa-file-archive-o' => 'fa-file-archive-o',	
				'fa-file-audio-o' => 'fa-file-audio-o',	
				'fa-file-code-o' => 'fa-file-code-o',	
				'fa-file-excel-o' => 'fa-file-excel-o',	
				'fa-file-image-o' => 'fa-file-image-o',	
				'fa-file-o' => 'fa-file-o',	
				'fa-file-pdf-o' => 'fa-file-pdf-o',	
				'fa-file-powerpoint-o' => 'fa-file-powerpoint-o',	
				'fa-file-text' => 'fa-file-text',	
				'fa-file-text-o' => 'fa-file-text-o',	
				'fa-file-video-o' => 'fa-file-video-o',	
				'fa-file-word-o' => 'fa-file-word-o',	
				'fa-files-o' => 'fa-files-o',	
				'fa-film' => 'fa-film',	
				'fa-filter' => 'fa-filter',	
				'fa-fire' => 'fa-fire',	
				'fa-fire-extinguisher' => 'fa-fire-extinguisher',	
				'fa-flag' => 'fa-flag',	
				'fa-flag-checkered' => 'fa-flag-checkered',	
				'fa-flag-o' => 'fa-flag-o',	
				'fa-flask' => 'fa-flask',	
				'fa-flickr' => 'fa-flickr',	
				'fa-floppy-o' => 'fa-floppy-o',	
				'fa-folder' => 'fa-folder',	
				'fa-folder-o' => 'fa-folder-o',	
				'fa-folder-open' => 'fa-folder-open',	
				'fa-folder-open-o' => 'fa-folder-open-o',	
				'fa-font' => 'fa-font',	
				'fa-forward' => 'fa-forward',	
				'fa-foursquare' => 'fa-foursquare',	
				'fa-frown-o' => 'fa-frown-o',	
				'fa-futbol-o' => 'fa-futbol-o',	
				'fa-gamepad' => 'fa-gamepad',	
				'fa-gavel' => 'fa-gavel',	
				'fa-gbp' => 'fa-gbp',	
				'fa-gift' => 'fa-gift',	
				'fa-git' => 'fa-git',	
				'fa-git-square' => 'fa-git-square',	
				'fa-github' => 'fa-github',	
				'fa-github-alt' => 'fa-github-alt',	
				'fa-github-square' => 'fa-github-square',	
				'fa-gittip' => 'fa-gittip',	
				'fa-glass' => 'fa-glass',	
				'fa-globe' => 'fa-globe',	
				'fa-google' => 'fa-google',	
				'fa-google-plus' => 'fa-google-plus',	
				'fa-google-plus-square' => 'fa-google-plus-square',	
				'fa-google-wallet' => 'fa-google-wallet',	
				'fa-graduation-cap' => 'fa-graduation-cap',	
				'fa-h-square' => 'fa-h-square',	
				'fa-hacker-news' => 'fa-hacker-news',	
				'fa-hand-o-down' => 'fa-hand-o-down',	
				'fa-hand-o-left' => 'fa-hand-o-left',	
				'fa-hand-o-right' => 'fa-hand-o-right',	
				'fa-hand-o-up' => 'fa-hand-o-up',	
				'fa-hdd-o' => 'fa-hdd-o',	
				'fa-header' => 'fa-header',	
				'fa-headphones' => 'fa-headphones',	
				'fa-heart' => 'fa-heart',	
				'fa-heart-o' => 'fa-heart-o',	
				'fa-history' => 'fa-history',	
				'fa-home' => 'fa-home',	
				'fa-hospital-o' => 'fa-hospital-o',	
				'fa-html5' => 'fa-html5',	
				'fa-ils' => 'fa-ils',	
				'fa-inbox' => 'fa-inbox',	
				'fa-indent' => 'fa-indent',	
				'fa-info' => 'fa-info',	
				'fa-info-circle' => 'fa-info-circle',	
				'fa-inr' => 'fa-inr',	
				'fa-instagram' => 'fa-instagram',	
				'fa-ioxhost' => 'fa-ioxhost',	
				'fa-italic' => 'fa-italic',	
				'fa-joomla' => 'fa-joomla',	
				'fa-jpy' => 'fa-jpy',	
				'fa-jsfiddle' => 'fa-jsfiddle',	
				'fa-key' => 'fa-key',	
				'fa-keyboard-o' => 'fa-keyboard-o',	
				'fa-krw' => 'fa-krw',	
				'fa-language' => 'fa-language',	
				'fa-laptop' => 'fa-laptop',	
				'fa-lastfm' => 'fa-lastfm',	
				'fa-lastfm-square' => 'fa-lastfm-square',	
				'fa-leaf' => 'fa-leaf',	
				'fa-lemon-o' => 'fa-lemon-o',	
				'fa-level-down' => 'fa-level-down',	
				'fa-level-up' => 'fa-level-up',	
				'fa-life-ring' => 'fa-life-ring',	
				'fa-lightbulb-o' => 'fa-lightbulb-o',	
				'fa-line-chart' => 'fa-line-chart',	
				'fa-link' => 'fa-link',	
				'fa-linkedin' => 'fa-linkedin',	
				'fa-linkedin-square' => 'fa-linkedin-square',	
				'fa-linux' => 'fa-linux',	
				'fa-list' => 'fa-list',	
				'fa-list-alt' => 'fa-list-alt',	
				'fa-list-ol' => 'fa-list-ol',	
				'fa-list-ul' => 'fa-list-ul',	
				'fa-location-arrow' => 'fa-location-arrow',	
				'fa-lock' => 'fa-lock',	
				'fa-long-arrow-down' => 'fa-long-arrow-down',	
				'fa-long-arrow-left' => 'fa-long-arrow-left',	
				'fa-long-arrow-right' => 'fa-long-arrow-right',	
				'fa-long-arrow-up' => 'fa-long-arrow-up',	
				'fa-magic' => 'fa-magic',	
				'fa-magnet' => 'fa-magnet',	
				'fa-male' => 'fa-male',	
				'fa-map-marker' => 'fa-map-marker',	
				'fa-maxcdn' => 'fa-maxcdn',	
				'fa-meanpath' => 'fa-meanpath',	
				'fa-medkit' => 'fa-medkit',	
				'fa-meh-o' => 'fa-meh-o',	
				'fa-microphone' => 'fa-microphone',	
				'fa-microphone-slash' => 'fa-microphone-slash',	
				'fa-minus' => 'fa-minus',	
				'fa-minus-circle' => 'fa-minus-circle',	
				'fa-minus-square' => 'fa-minus-square',	
				'fa-minus-square-o' => 'fa-minus-square-o',	
				'fa-mobile' => 'fa-mobile',	
				'fa-money' => 'fa-money',	
				'fa-moon-o' => 'fa-moon-o',	
				'fa-music' => 'fa-music',	
				'fa-newspaper-o' => 'fa-newspaper-o',	
				'fa-openid' => 'fa-openid',	
				'fa-outdent' => 'fa-outdent',	
				'fa-pagelines' => 'fa-pagelines',	
				'fa-paint-brush' => 'fa-paint-brush',	
				'fa-paper-plane' => 'fa-paper-plane',	
				'fa-paper-plane-o' => 'fa-paper-plane-o',	
				'fa-paperclip' => 'fa-paperclip',	
				'fa-paragraph' => 'fa-paragraph',	
				'fa-pause' => 'fa-pause',	
				'fa-paw' => 'fa-paw',	
				'fa-paypal' => 'fa-paypal',	
				'fa-pencil' => 'fa-pencil',	
				'fa-pencil-square' => 'fa-pencil-square',	
				'fa-pencil-square-o' => 'fa-pencil-square-o',	
				'fa-phone' => 'fa-phone',	
				'fa-phone-square' => 'fa-phone-square',	
				'fa-picture-o' => 'fa-picture-o',	
				'fa-pie-chart' => 'fa-pie-chart',	
				'fa-pied-piper' => 'fa-pied-piper',	
				'fa-pied-piper-alt' => 'fa-pied-piper-alt',	
				'fa-pinterest' => 'fa-pinterest',	
				'fa-pinterest-square' => 'fa-pinterest-square',	
				'fa-plane' => 'fa-plane',	
				'fa-play' => 'fa-play',	
				'fa-play-circle' => 'fa-play-circle',	
				'fa-play-circle-o' => 'fa-play-circle-o',	
				'fa-plug' => 'fa-plug',	
				'fa-plus' => 'fa-plus',	
				'fa-plus-circle' => 'fa-plus-circle',	
				'fa-plus-square' => 'fa-plus-square',	
				'fa-plus-square-o' => 'fa-plus-square-o',	
				'fa-power-off' => 'fa-power-off',	
				'fa-print' => 'fa-print',	
				'fa-puzzle-piece' => 'fa-puzzle-piece',	
				'fa-qq' => 'fa-qq',	
				'fa-qrcode' => 'fa-qrcode',	
				'fa-question' => 'fa-question',	
				'fa-question-circle' => 'fa-question-circle',	
				'fa-quote-left' => 'fa-quote-left',	
				'fa-quote-right' => 'fa-quote-right',	
				'fa-random' => 'fa-random',	
				'fa-rebel' => 'fa-rebel',	
				'fa-recycle' => 'fa-recycle',	
				'fa-reddit' => 'fa-reddit',	
				'fa-reddit-square' => 'fa-reddit-square',	
				'fa-refresh' => 'fa-refresh',	
				'fa-renren' => 'fa-renren',	
				'fa-repeat' => 'fa-repeat',	
				'fa-reply' => 'fa-reply',	
				'fa-reply-all' => 'fa-reply-all',	
				'fa-retweet' => 'fa-retweet',	
				'fa-road' => 'fa-road',	
				'fa-rocket' => 'fa-rocket',	
				'fa-rss' => 'fa-rss',	
				'fa-rss-square' => 'fa-rss-square',	
				'fa-rub' => 'fa-rub',	
				'fa-scissors' => 'fa-scissors',	
				'fa-search' => 'fa-search',	
				'fa-search-minus' => 'fa-search-minus',	
				'fa-search-plus' => 'fa-search-plus',	
				'fa-share' => 'fa-share',	
				'fa-share-alt' => 'fa-share-alt',	
				'fa-share-alt-square' => 'fa-share-alt-square',	
				'fa-share-square' => 'fa-share-square',	
				'fa-share-square-o' => 'fa-share-square-o',	
				'fa-shield' => 'fa-shield',	
				'fa-shopping-cart' => 'fa-shopping-cart',	
				'fa-sign-in' => 'fa-sign-in',	
				'fa-sign-out' => 'fa-sign-out',	
				'fa-signal' => 'fa-signal',	
				'fa-sitemap' => 'fa-sitemap',	
				'fa-skype' => 'fa-skype',	
				'fa-slack' => 'fa-slack',	
				'fa-sliders' => 'fa-sliders',	
				'fa-slideshare' => 'fa-slideshare',	
				'fa-smile-o' => 'fa-smile-o',	
				'fa-sort' => 'fa-sort',	
				'fa-sort-alpha-asc' => 'fa-sort-alpha-asc',	
				'fa-sort-alpha-desc' => 'fa-sort-alpha-desc',	
				'fa-sort-amount-asc' => 'fa-sort-amount-asc',	
				'fa-sort-amount-desc' => 'fa-sort-amount-desc',	
				'fa-sort-asc' => 'fa-sort-asc',	
				'fa-sort-desc' => 'fa-sort-desc',	
				'fa-sort-numeric-asc' => 'fa-sort-numeric-asc',	
				'fa-sort-numeric-desc' => 'fa-sort-numeric-desc',	
				'fa-soundcloud' => 'fa-soundcloud',	
				'fa-space-shuttle' => 'fa-space-shuttle',	
				'fa-spinner' => 'fa-spinner',	
				'fa-spoon' => 'fa-spoon',	
				'fa-spotify' => 'fa-spotify',	
				'fa-square' => 'fa-square',	
				'fa-square-o' => 'fa-square-o',	
				'fa-stack-exchange' => 'fa-stack-exchange',	
				'fa-stack-overflow' => 'fa-stack-overflow',	
				'fa-star' => 'fa-star',	
				'fa-star-half' => 'fa-star-half',	
				'fa-star-half-o' => 'fa-star-half-o',	
				'fa-star-o' => 'fa-star-o',	
				'fa-steam' => 'fa-steam',	
				'fa-steam-square' => 'fa-steam-square',	
				'fa-step-backward' => 'fa-step-backward',	
				'fa-step-forward' => 'fa-step-forward',	
				'fa-stethoscope' => 'fa-stethoscope',	
				'fa-stop' => 'fa-stop',	
				'fa-strikethrough' => 'fa-strikethrough',	
				'fa-stumbleupon' => 'fa-stumbleupon',	
				'fa-stumbleupon-circle' => 'fa-stumbleupon-circle',	
				'fa-subscript' => 'fa-subscript',	
				'fa-suitcase' => 'fa-suitcase',	
				'fa-sun-o' => 'fa-sun-o',	
				'fa-superscript' => 'fa-superscript',	
				'fa-table' => 'fa-table',	
				'fa-tablet' => 'fa-tablet',	
				'fa-tachometer' => 'fa-tachometer',	
				'fa-tag' => 'fa-tag',	
				'fa-tags' => 'fa-tags',	
				'fa-tasks' => 'fa-tasks',	
				'fa-taxi' => 'fa-taxi',	
				'fa-tencent-weibo' => 'fa-tencent-weibo',	
				'fa-terminal' => 'fa-terminal',	
				'fa-text-height' => 'fa-text-height',	
				'fa-text-width' => 'fa-text-width',	
				'fa-th' => 'fa-th',	
				'fa-th-large' => 'fa-th-large',	
				'fa-th-list' => 'fa-th-list',	
				'fa-thumb-tack' => 'fa-thumb-tack',	
				'fa-thumbs-down' => 'fa-thumbs-down',	
				'fa-thumbs-o-down' => 'fa-thumbs-o-down',	
				'fa-thumbs-o-up' => 'fa-thumbs-o-up',	
				'fa-thumbs-up' => 'fa-thumbs-up',	
				'fa-ticket' => 'fa-ticket',	
				'fa-times' => 'fa-times',	
				'fa-times-circle' => 'fa-times-circle',	
				'fa-times-circle-o' => 'fa-times-circle-o',	
				'fa-tint' => 'fa-tint',	
				'fa-toggle-off' => 'fa-toggle-off',	
				'fa-toggle-on' => 'fa-toggle-on',	
				'fa-trash' => 'fa-trash',	
				'fa-trash-o' => 'fa-trash-o',	
				'fa-tree' => 'fa-tree',	
				'fa-trello' => 'fa-trello',	
				'fa-trophy' => 'fa-trophy',	
				'fa-truck' => 'fa-truck',	
				'fa-try' => 'fa-try',	
				'fa-tty' => 'fa-tty',	
				'fa-tumblr' => 'fa-tumblr',	
				'fa-tumblr-square' => 'fa-tumblr-square',	
				'fa-twitch' => 'fa-twitch',	
				'fa-twitter' => 'fa-twitter',	
				'fa-twitter-square' => 'fa-twitter-square',	
				'fa-umbrella' => 'fa-umbrella',	
				'fa-underline' => 'fa-underline',	
				'fa-undo' => 'fa-undo',	
				'fa-university' => 'fa-university',	
				'fa-unlock' => 'fa-unlock',	
				'fa-unlock-alt' => 'fa-unlock-alt',	
				'fa-upload' => 'fa-upload',	
				'fa-usd' => 'fa-usd',	
				'fa-user' => 'fa-user',	
				'fa-user-md' => 'fa-user-md',	
				'fa-users' => 'fa-users',	
				'fa-video-camera' => 'fa-video-camera',	
				'fa-vimeo-square' => 'fa-vimeo-square',	
				'fa-vine' => 'fa-vine',	
				'fa-vk' => 'fa-vk',	
				'fa-volume-down' => 'fa-volume-down',	
				'fa-volume-off' => 'fa-volume-off',	
				'fa-volume-up' => 'fa-volume-up',	
				'fa-weibo' => 'fa-weibo',	
				'fa-weixin' => 'fa-weixin',	
				'fa-wheelchair' => 'fa-wheelchair',	
				'fa-wifi' => 'fa-wifi',	
				'fa-windows' => 'fa-windows',	
				'fa-wordpress' => 'fa-wordpress',	
				'fa-wrench' => 'fa-wrench',	
				'fa-xing' => 'fa-xing',	
				'fa-xing-square' => 'fa-xing-square',	
				'fa-yahoo' => 'fa-yahoo',	
				'fa-yelp' => 'fa-yelp',	
				'fa-youtube' => 'fa-youtube',	
				'fa-youtube-play' => 'fa-youtube-play',	
				'fa-youtube-square' => 'fa-youtube-square',	
			);

			return $fa_icons;
		}
	}
	//Crystal_MegaMenu_Custom_Fields::init();
	add_action( 'init', array( 'Crystal_MegaMenu_Custom_Fields', 'init' ) );
}