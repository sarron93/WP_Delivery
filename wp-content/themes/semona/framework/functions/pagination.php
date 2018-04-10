<?php

/* Pagination */

function crf_pagination( $pages = '', $range = 2 )
{
	$showitems = ( $range * 2 ) + 1;
	global $paged;
	if( empty( $paged ) ) {
		$paged = 1;
	}
	if( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if( !$pages ) {
			$pages = 1;
		}
	}
	if( $pages != 1 ) {
		echo "<div class='crf-pagination'>";
		if( $paged > 1 && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link($paged - 1) . "' class='pagelink prev'><i class='fa fa-angle-left'></i></a>";
		}
		for( $i = 1; $i <= $pages; $i++ ) {
			if( $pages != 1 && ( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i )? "<span class='pagelink current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='pagelink' >".$i."</a>";
			}
		}
		if( $paged < $pages && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link($paged + 1) . "' class='pagelink next'><i class='fa fa-angle-right'></i></a>";
		}
		echo "</div>\n";
	}
}

function crf_pagination_archive() {
	global $wp_query;

	echo "<div class='crf-pagination'>";
	$pagelinks = paginate_links( array(
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type' => 'array',
			'prev_text' => "<i class='fa fa-angle-left'></i>",
			'next_text' => "<i class='fa fa-angle-right'></i>",
	) );
	if( is_array( $pagelinks ) ) {
		$pagelinks_html = '';
		foreach( $pagelinks as $pagelink ) {
			$pagelinks_html .= $pagelink;
		}
		echo str_replace( 'page-numbers', 'pagelink', $pagelinks_html );
	}
	echo "</div>\n";
}