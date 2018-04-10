<?php

if( ! class_exists('Crystal_Nav_Walker') ) {
	class Crystal_Nav_Walker extends Walker_Nav_Menu {
		protected $is_megamenu_item = 0;
		protected $megamenu_cols = 0;
		protected $is_fullwidth = 0;
		protected $megamenu_bg = 0;

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

			if( $this->is_megamenu_item == '1' ) {
				if( $depth == 0 ) {
					$more_class = '';
					if( $this->is_fullwidth == '1' ) {
						$more_class .= ' fullwidth';
					}
					if( $this->megamenu_cols > 0 ) {
						$more_class .= ' megamenu-columns-' . $this->megamenu_cols;
					}
					$style = '';
					if( $this->megamenu_bg > 0 ) {
						$bg_url = wp_get_attachment_image_src( $this->megamenu_bg, 'full' );
						if( !empty( $bg_url[0] ) ) {
							$style = " style=\"background-image:url('" . esc_url( $bg_url[0] ) . "')\"";
						}
					}
					$output .= "\n$indent<ul class=\"crf-megamenu-wrapper" . esc_attr( $more_class ) . "\"{$style}>\n";
				} else {
					$output .= "\n$indent<ul class=\"crf-megamenu-sub-menu sub-menu\">\n";
				}
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( $depth == 0 ) {
				$this->is_megamenu_item = get_post_meta( $item->ID, 'menu-item-crf_enable_megamenu', true );
				$this->is_fullwidth = get_post_meta( $item->ID, 'menu-item-crf_megamenu_fullwidth', true );
				$this->megamenu_cols = get_post_meta( $item->ID, 'menu-item-crf_megamenu_columns', true );
				$this->megamenu_bg = get_post_meta( $item->ID, 'menu-item-crf_megamenu_bg', true );
			}
			
			$menu_icon_html = '';

			if ( is_object($args) )
			{
				$link_after = $args->link_after;
				$link_before = $args->link_before;
				$before = $args->before;
				$after = $args->after;

				$args->link_before = '';

				$menu_item_icon = get_post_meta( $item->ID, 'menu-item-crf_menu_item_icon', true );
				if ( !empty( $menu_item_icon ) ) {
					$menu_icon_html = "<i class='fa {$menu_item_icon}'></i> ";
				}

				if ( $this->is_megamenu_item == '1' ) {
					if ( $depth == 0 ) {
						$item->classes[] = 'crf-megamenu';
					}
					else if ( $depth == 1 ) {
						$item->classes[] = 'crf-megamenu-column';
					}
				}
			}

			$item->title = '<span>' . $menu_icon_html . $item->title . '</span>';

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