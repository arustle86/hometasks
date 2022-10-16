<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

global $wp_query;

$max_num_pages = isset( $max_num_pages ) ? $max_num_pages : false;

$max = $max_num_pages ? $max_num_pages : $wp_query->max_num_pages;
$max = intval( $max );

/** Stop execution if there's only 1 page */
if( $max <= 1 ) return;

if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}
else {
	$paged = 1;
}

/**	Add current page to the array */
if ( $paged >= 1 )
	$links[] = $paged;

/**	Add the pages around the current page to the array */
if ( $paged >= 3 ) {
	$links[] = $paged - 1;
	$links[] = $paged - 2;
}

if ( ( $paged + 2 ) <= $max ) {
	$links[] = $paged + 2;
	$links[] = $paged + 1;
}

$previous_text = '<i class="fa fa-angle-left" aria-hidden="true"></i><em>' . esc_html__( 'Previous', 'metro' ) . '</em>';
$next_text     = '<em>' . esc_html__( 'Next', 'metro' ) . '</em><i class="fa fa-angle-right" aria-hidden="true"></i>';

echo '<div class="pagination-area"><ul class="clearfix">';

/**	Previous Post Link */
$previous_posts_link = get_previous_posts_link( $previous_text );
if ( $previous_posts_link ){
	printf( '<li class="pagi pagi-previous">%s</li>' . "\n", $previous_posts_link );
}
else {
	printf( '<li class="pagi pagi-previous disabled"><span>%s</span></li>', $previous_text );
}

/**	Link to first page, plus ellipses if necessary */
if ( ! in_array( 1, $links ) ) {

	if ( $paged == 1 ) {
		printf( '<li class="active"><span>%s</span></li>', '1' );
	}
	else {
		printf( '<li><a href="%s">%s</a></li>', esc_url( get_pagenum_link( 1 ) ), '1' );
	}

	if ( ! in_array( 2, $links ) )
		echo '<li class="dot"><span>...</span></li>';
}

/**	Link to current page, plus 2 pages in either direction if necessary */
sort( $links );
foreach ( (array) $links as $link ) {

	if ( $paged == $link ) {
		printf( '<li class="active"><span>%s</span></li>', $link );
	}
	else {
		printf( '<li><a href="%s">%s</a></li>', esc_url( get_pagenum_link( $link ) ), $link );
	}
}

/**	Link to last page, plus ellipses if necessary */
if ( ! in_array( $max, $links ) ) {
	if ( ! in_array( $max - 1, $links ) )
		echo '<li class="dot"><span>...</span></li>' . "\n";

	if ( $paged == $max ) {
		printf( '<li class="active"><span>%s</span></li>', $max );
	}
	else {
		printf( '<li><a href="%s">%s</a></li>', esc_url( get_pagenum_link( $max ) ), $max );
	}
}

/**	Next Post Link */
$next_posts_link = get_next_posts_link( $next_text, $max );
if ( $next_posts_link ){
	printf( '<li class="pagi pagi-next">%s</li>', $next_posts_link );
}
else {
	printf( '<li class="pagi pagi-next disabled"><span>%s</span></li>', $next_text );
}

echo '</ul></div>';