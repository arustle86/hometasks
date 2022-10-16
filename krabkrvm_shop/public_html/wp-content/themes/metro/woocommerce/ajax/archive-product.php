<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

use radiustheme\Metro\RDTheme;
use radiustheme\Metro\Constants;

defined( 'ABSPATH' ) || die();

$per_page = 9;

$args = array(
	'post_type' => 'product',
	'status' => 'published',
	'posts_per_page' => $per_page,
	'paged' => 1,
	'tax_query' => array(),
	'meta_query' => array(),
);

$query_url = esc_url_raw($_POST['query_url']);
$query_path = parse_url($query_url, PHP_URL_PATH);
$wc_options = get_option('woocommerce_permalinks');
$product_category_base = $wc_options['category_base'];

// Checking if the url contains category
if(strpos($query_url, $product_category_base) !== FALSE){

	$category_expression = '/([A-Za-z0-9-_]*)\/?\??(?>filter|min|orderby.*)?$/m';
	preg_match_all($category_expression, preg_replace('/(page\/[0-9]*\/)/m' , '', $query_path ), $matches, PREG_SET_ORDER, 0);
	$cat_slug = $matches[0][1];
	$current_category = get_term_by( 'slug', $cat_slug, 'product_cat');

	$args['tax_query'][] = array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms' => $current_category->slug,
	);

}

// Retriving Query Parameter from url
parse_str(parse_url($query_url, PHP_URL_QUERY), $url_query_params);
if(isset($url_query_params) && !empty($url_query_params)){

	foreach($url_query_params as $key => $value){

		if($key == 'max_price' || $key == 'min_price' || $key == 'orderby') continue;

		$taxonomy = str_replace("filter","pa", $key);

		if( taxonomy_exists( $taxonomy ) ){

			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $value,
			);

		}

	}

}

// Price
if(isset($url_query_params['min_price']) && isset($url_query_params['max_price'])){

	$args['meta_query'][] = wc_get_min_max_price_meta_query(array(
		'min_price' => sanitize_text_field($url_query_params['min_price']),
		'max_price' => sanitize_text_field($url_query_params['max_price']),
	));

}

if(isset($url_query_params['orderby'])){

	switch(sanitize_text_field($url_query_params['orderby'])){
		case 'popularity':
			$args['meta_key'] = 'total_sales';
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
			break;
		case 'rating':
			$args['meta_key'] = '_wc_average_rating';
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
			break;
		case 'price':
			$args['meta_key'] = '_price';
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'ASC';
			break;
		case 'price-desc':
			$args['meta_key'] = '_price';
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
			break;
		case 'price-desc':
			$args['meta_key'] = 'date';
			$args['orderby'] = 'meta_value_num';
			$args['meta_type'] = 'DATE';
			$args['order'] = 'DESC';
			break;
		default:
			break;
	}

}

// Pagination
if(isset($url_query_params['paged']) && !empty($url_query_params['paged']) ) $args['paged'] = $url_query_params['paged'];

if( strpos($query_url, 'page') !== FALSE ){

	$page_expression = '/page\/([0-9]*)\//m';
	preg_match_all($page_expression, $query_path, $matches, PREG_SET_ORDER, 0);
	$paged = $matches[0][1];
	$args['paged'] = $paged;

}

// For other url passed data.
if( defined('RT_DEMO_SITE') ):
if( isset($url_query_params['sidebar']) && $url_query_params['sidebar'] == 'full' ){
	RDTheme::$options['wc_desktops_product_columns'] = '3';
	$args['posts_per_page'] = 8;
	$per_page = 8;
}

if( isset($url_query_params['pagination']) && $url_query_params['pagination'] == 'loadmore' ){
	RDTheme::$options['wc_pagination'] = 'load-more';
}

endif;

$loop = new WP_Query($args);
$total = $loop->found_posts;
$current = isset($paged) ? $paged : 1;

// echo "<pre>";
// $prefix = Constants::$theme_prefix;
// print_r(RDTheme::$options[ $prefix . '_sidebar']);
// $sidebars = get_option( "{$prefix}_custom_sidebars", array() );
// print_r(count($sidebars));
// print_r($sidebars);
// print_r('rdtheme-sidebar-woocommerce-sidebar');
// echo "</pre>";

?>

<!-- <pre>

<?php //print_r($query_url); ?>
<br>
<?php //print_r($args); ?>

</pre> -->

<p class="meta-data-for-ajax">
	<?php
	if ( 1 === $total ) {
		_e( 'Showing the single result', 'metro' );
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'metro' ), $total );
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		printf( 
			_nx( 
				'Showing the single result', 
				'Showing %1$d &ndash; <span class="wc-last-result-count">%2$d</span> of %3$d results', 
				$total, 
				'with first and last result', 'metro' 
			), $first, $last, $total );
	}
	?>
</p>

<?php
if($loop->have_posts()){

	while($loop->have_posts( )){

		$loop->the_post();

		/**
		 * Hook: woocommerce_shop_loop.
		 */
	
		do_action( 'woocommerce_shop_loop' );

		wc_get_template_part( 'content', 'product' );

	}

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */

	do_action( 'woocommerce_no_products_found' );
}

?>

<div class='load-more-meta-data' data-paged='<?php echo $current ?>' data-max='<?php echo ceil($total/$per_page) ;?>'></div>

<?php if( isset( RDTheme::$options['wc_pagination'] ) && RDTheme::$options['wc_pagination'] == 'numbered' ): ?>
<!-- Pagination Area -->
<div class="ajax-pagination-area">
<?php 
// echo $loop->max_num_pages;
$big = 999999;
echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, $args['paged'] ),
    'total' => $loop->max_num_pages,
) );
?>
</div>
<!-- Pagination Area Ends -->
<?php endif; ?>

<?php

wp_reset_postdata();

wp_die();