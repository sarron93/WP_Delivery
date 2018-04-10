<?php

if( ! class_exists( 'Crystal_Footer_Nav_Walker' ) ) {
	class Crystal_Footer_Nav_Walker extends Walker_Nav_Menu {

		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( isset( $args[0] ) && is_object( $args[0] ) )
			{
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}

			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( is_object($args) )
			{
				$link_after = $args->link_after;
				$link_before = $args->link_before;
				$before = $args->before;
				$after = $args->after;

				$args->link_before = '';
			}

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