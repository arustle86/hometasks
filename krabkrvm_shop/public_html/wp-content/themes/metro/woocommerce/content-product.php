<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */


use radiustheme\Metro\WC_Functions;
use radiustheme\Metro\RDTheme;

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


$wc_product_columns_update 		= RDTheme::$options['wc_product_columns_update'];

$wc_desktops_product_columns 	= RDTheme::$options['wc_desktops_product_columns'];
$wc_mobile_product_columns 		= RDTheme::$options['wc_mobile_product_columns'];
$wc_tab_product_columns 		= RDTheme::$options['wc_tab_product_columns'];

if($wc_product_columns_update){

$product_col_class  = ( RDTheme::$layout == 'full-width' ) ? "col-xl-{$wc_desktops_product_columns} col-lg-{$wc_desktops_product_columns} col-md-{$wc_tab_product_columns} col-sm-{$wc_tab_product_columns} col-{$wc_mobile_product_columns}" : "col-xl-{$wc_desktops_product_columns} col-lg-{$wc_desktops_product_columns} col-md-{$wc_tab_product_columns} col-sm-{$wc_tab_product_columns} col-{$wc_mobile_product_columns}";

}else{

$product_col_class  = ( RDTheme::$layout == 'full-width' ) ? "col-xl-3 col-lg-3 col-md-{$wc_tab_product_columns} col-sm-{$wc_tab_product_columns} col-{$wc_mobile_product_columns}" : "col-xl-4 col-lg-4 col-md-{$wc_tab_product_columns} col-sm-{$wc_tab_product_columns} col-{$wc_mobile_product_columns}";
}

$product_class      = '';
global $metro_shortcode_called;

if (is_shop() || is_product_taxonomy() || $metro_shortcode_called = "products" || isset($_REQUEST['ajax_product_loadmore'])) {
    $product_class = $product_col_class;
}

if ( function_exists( 'dokan' ) ) {
	if ( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
		$product_class = $product_col_class;
	}

	$backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 5 );
	foreach ( $backtrace as $trace ) {
		if ( $trace['function'] == 'dokan_get_more_products_from_seller' ) {
			$product_class = $product_col_class;
			break;
		}
	}
}

if ( !isset( $block_data ) ) {
	$block_data = array();
}

if (!empty($view)) {

    $shopview = $view;

} else {

    $shopview = isset($_GET["shopview"]) && $_GET["shopview"] == 'list' ? 'list' : 'grid';

}


$block_data_defaults = array(
	'type'           => $shopview,
	'layout'         => RDTheme::$options['wc_product_layout'],
	'list_layout'    => 1,
	'cat_display'    => RDTheme::$options['wc_shop_cat'] ? true : false,
	'rating_display' => RDTheme::$options['wc_shop_review'] ? true : false,
	'v_swatch'       => true,
);
$block_data_defaults['type'] = apply_filters( 'rdtheme_shop_view_type', $block_data_defaults['type'] );

$block_data = wp_parse_args( $block_data, $block_data_defaults );

if ( $block_data['type'] == 'list' ) {
	$product_class = 'col-12';
}

if ( !empty( $isloadmore ) ) {
	$product_class .= ' product_loaded';
}
?>
<div <?php wc_product_class( $product_class, $product ); ?>>
	<?php
	do_action( 'woocommerce_before_shop_loop_item' );
	wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>
