<?php

function crf_breadcrumb() {

	if( function_exists( 'woocommerce_breadcrumb' ) && is_woocommerce() ) {
		woocommerce_breadcrumb( array(
			'delimiter'		=> '',
			'wrap_before'	=> '<ul class="crf-breadcrumbs">',
			'wrap_after'	=> '</ul>',
			'before'		=> '<li>',
			'after'			=> '</li>',
			'home'			=> __( 'Home', 'semona' ),
		) );
		return;
	}

	if( function_exists( 'bbp_breadcrumb' ) && is_bbpress() ) {
		bbp_breadcrumb( array(
			'before'		=> '<div class="crf-breadcrumbs">',
			'after'			=> '</div>',
			'sep'			=> '/',
			'pad_sep'		=> 0,
			'sep_before'      => '<span class="bbp-breadcrumb-sep">',
			'sep_after'       => '</span>',
			'current_before'	=> '',
			'current_after'		=> '',
		) );
		return;
	}
		
	global $post;

	echo '<ul class="crf-breadcrumbs">';

	if( !is_front_page() ) {
		echo '<li><a href="';
		echo esc_url( home_url() );
		echo '">' . esc_html__( 'Home', 'semona' ) . "</a></li>";
	}

	$params['link_none'] = '';
	$separator = '';

	if( is_category() && !is_singular( 'crf_portfolio' ) ) {
		$category = get_the_category();
		$ID = $category[0]->cat_ID;
		echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.$cat_parents.'</li>';
	}

	if( is_singular( 'crf_portfolio' ) ) {
		echo get_the_term_list($post->ID, 'portfolio_category', '<li>', ',&nbsp;', '</li>');
		echo '<li>'.get_the_title().'</li>';
	}

	if( is_singular( 'event' ) ) {
		$terms = get_the_term_list($post->ID, 'event-categories', '<li>', ',&nbsp;', '</li>');
		if( ! is_wp_error( $terms ) ) {
			echo get_the_term_list($post->ID, 'event-categories', '<li>', ',&nbsp;', '</li>');
		}
		echo '<li>' . get_the_title() . '</li>';
	}

	if( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$link = get_term_link( $term );
			
		if ( is_wp_error( $link ) ) {
			echo sprintf( '<li>%s</li>', esc_html( $term->name ) );
		} else {
			echo sprintf( '<li><a href="%s" title="%s">%s</a></li>', esc_url( $link ), esc_attr( $term->name ), esc_html( $term->name ) );
		}
	}

	if( is_home() ) { 
		echo '<li>' . crf_get_theme_mod_value( 'blog-index-title' ) . '</li>';
	}
	
	if( is_page() && !is_front_page() ) {
		$parents = array();
		$parent_id = $post->post_parent;
		while ( $parent_id ) :
		$page = get_page( $parent_id );
		if ( $params["link_none"] )
			$parents[]  = get_the_title( $page->ID );
		else
			$parents[]  = '<li><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
		$parent_id  = $page->post_parent;
		endwhile;
		$parents = array_reverse( $parents );
		echo join( '', $parents );
		echo '<li>'.get_the_title().'</li>';
	}

	if( is_single() && !is_singular( 'crf_portfolio' ) 
			&& !is_singular( 'tribe_events' ) 
			&& !is_singular( 'event' ) 
			&& !is_singular( 'wpfc_sermon' ) ) {
		$categories_1 = get_the_category( $post->ID );
		if( $categories_1 ):
			foreach( $categories_1 as $cat_1 ):
				$cat_1_ids[] = $cat_1->term_id;
			endforeach;
			$cat_1_line = implode( ',', $cat_1_ids );
		endif;
		if( isset( $cat_1_line ) && $cat_1_line ) {
			$categories = get_categories( array(
					'include' => $cat_1_line,
					'orderby' => 'id'
			) );
			if ( $categories ) :
				echo '<li>';
				$cats = '';
				$count = 0;
				foreach ( $categories as $cat ) :
					if( $cats != '' ) {
						$cats .= ', ';
					}
					$count++;
					if( $count > 3 ) {
						$cats .= '...';
						break;
					}
					$cats .= '<a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a>';
				endforeach;
				echo ( $cats );
				echo '</li>';
			endif;
		}
		echo apply_filters( 'sm_breadcrumb_single_title', '<li>' . get_the_title() . '</li>' );
	}
	if( is_tag() ) {
		echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>';
	}
	if( is_search() ) {
		echo '<li>'.__("Search", 'semona').'</li>';
	}
	if( is_year() ) {
		echo '<li>'.get_the_time('Y').'</li>';
	}

	if( is_404() ) {
		echo '<li>' . esc_html__( "404 - Page not Found", 'semona' ) . '</li>';
	}

	if( is_archive() && is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
			
		$sermon_settings = get_option('wpfc_options');
		if( is_array( $sermon_settings ) ) {
			$title = $sermon_settings['archive_title'];
		}
		echo '<li>'. ( $title ) .'</li>';
	}

	echo "</ul>";
}

function crf_page_title() {
	$title = get_the_title();
	
	if( is_home() ) {
		return crf_get_theme_mod_value( 'blog-index-title' );
	}
	if( is_search() ) {
		return esc_html__( 'Search results for: ', 'semona' ) . get_search_query();
	}
	if( is_404() ) {
		return esc_html__( 'Error 404 Page', 'semona' );
	}

	if( is_archive() ) {
		if ( is_day() ) {
			return esc_html__( 'Daily Archives: ', 'semona' ) . '<span> ' . get_the_date() . '</span>';
		} else if ( is_month() ) {
			return esc_html__( 'Monthly Archives:', 'semona' ) . '<span> ' . get_the_date( 'F Y' ) . '</span>';
		} else if ( is_year() ) {
			return esc_html__( 'Yearly Archives:', 'semona' ) . '<span> ' . get_the_date( 'Y' ) . '</span>';
		} else if ( is_author() ) {
			$curauth = get_user_by( 'id', get_query_var( 'author' ) );
			return $curauth->nickname;
		} else if( is_post_type_archive() ) {
			$sermon_settings = get_option('wpfc_options');
			if( is_array( $sermon_settings ) ) {
				return $sermon_settings['archive_title'];
			} else {
				return post_type_archive_title( '', false );
			}
		} else {
			return single_cat_title( '', false );
		}
	}
	if( class_exists( 'Woocommerce' ) && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
		if( ! is_product() ) {
			return woocommerce_page_title( false );
		}
	}
	return get_the_title();
}