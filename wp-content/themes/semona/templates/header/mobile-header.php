<?php 
$color_scheme = crf_get_theme_mod_value( 'color-scheme' );
?>
<div class='sm-mobile-header sticky-nav'>
	<div class='mobile-header'>
		<div class='container'>
			<?php
			sm_output_logo( $color_scheme );
			?>
			<div class='menu-toggle-container'>
				<a class='menu-toggle' href='#'>
					<span class='bar bar1'></span>
					<span class='bar bar2'></span>
					<span class='bar bar3'></span>
				</a>
			</div>
		</div>
	</div>
	<div class='mobile-menu'>
		<?php
		if( has_nav_menu( 'main-menu' ) ) {
			remove_filter( 'wp_nav_menu_items', 'sm_add_icon_to_main_nav_menu' );
			wp_nav_menu( array (
					'theme_location' => 'main-menu',
					'container_id' => 'mobile-menu-wrapper',
					'container_class' => 'mobile-menu-wrapper',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'walker' => new Crystal_Mobile_Nav_Walker() 
			) );
		}
		?>
		<div class='search-field-area'>
			<div class='search-field-wrapper'>
				<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<div class='search-input-wrapper'>
						<input type="text" class="search" name="s" placeholder="<?php _e( 'Search...', 'semona' ) ?>">
					</div>
				</form>
				<a class='search-icon' href='#'><i class='fa fa-search'></i></a>
			</div>
		</div>
	</div>
</div>