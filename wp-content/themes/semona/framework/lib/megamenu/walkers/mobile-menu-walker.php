<?php

if( ! class_exists( 'Crystal_Mobile_Nav_Walker' ) ) {
	class Crystal_Mobile_Nav_Walker extends Walker_Nav_Menu {
		protected $megaColumnCount = 0;
	
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( isset( $args[0] ) && is_object( $args[0] ) )
			{
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
	
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$mega_icon = get_post_meta( $item->ID, 'menu-item-crf_fa_icons', true );
			
			$menu_icon_html = '';
	
			if ( is_object($args) )
			{
				$link_after = $args->link_after;
				$link_before = $args->link_before;
				$before = $args->before;
				$after = $args->after;
	
				$args->link_before = '<div class="container">' . str_repeat( '<span class="sm-mbmnu-indent"></span>', $depth );
	
				$menu_item_icon = get_post_meta( $item->ID, 'menu-item-crf_menu_item_icon', true );
				if ( !empty( $menu_item_icon ) ) {
					$menu_icon_html = "<i class='fa {$menu_item_icon}'></i> ";
				}
			}

			$icon = 'angle-right';
			if( $depth == 0 ) {
				$icon = 'chevron-right';
			}
			$item->title = '<span>' . $menu_icon_html . $item->title . "</span><span class='chevron'><i class='fa fa-fw fa-{$icon}'></i></span>";
			
			$args->link_after = '</div>';
	
			parent::start_el($output, $item, $depth, $args, $id);
	
			if ( is_object($args) ) {
				$args->link_after = $link_after;
				$args->link_before = $link_before;
				$args->before = $before;
				$args->after = $after;
			}
		}
	}
}