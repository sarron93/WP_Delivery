<div class='sm-isotope-filter'>
	<a class='filter' href='#' data-filter='*'><?php echo esc_html__( 'All', 'semona' ) ?></a><?php
	global $sm_pf_categories;
	$args = array( 'hide_empty' => true );
	$categories = array();
	if ( isset( $sm_pf_categories ) ) {
		foreach( $sm_pf_categories as $cat_id ) {
			$categories[$cat_id] = $cat_id;
		}

		$args['include'] = $sm_pf_categories;
		$filter_categories = get_terms( 'portfolio_category', $args );
		foreach( $filter_categories as $category ) {
			$categories[$category->term_id] = (object) array(
				'slug' => $category->slug,
				'name' => $category->name
			);
		}
	} else {
		$categories = get_terms( 'portfolio_category', $args );
	}

	foreach( $categories as $cat ) {
		printf( "<a class='filter' href='#' data-filter='.portfolio_category-%s'>%s</a>", esc_attr( $cat->slug ), esc_html( $cat->name ) );
	}
	?>
</div>