<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( !isset( $product ) ) {
	return;
}

if ( !isset( $block_data ) ) {
	$block_data = array();
}

$defaults = array(
	'type'           => 'grid',
	'layout'         => 1,
	'list_layout'    => 1,
	'thumb_size'     => 'woocommerce_thumbnail',
	'cat_display'    => true,
	'rating_display' => true,
	'wishlist'       => true,
	'compare'        => true,
	'quickview'      => true,
	'v_swatch'       => true,
	'gallery'        => true,
);
$block_data = wp_parse_args( $block_data, $defaults );
$block_data = apply_filters( 'metro_block_args', $block_data );

if ( $block_data['type'] == 'list' ) {
	wc_get_template( "custom/product-block/list-{$block_data['list_layout']}.php" , compact( 'product', 'block_data' ) );
}
else {
	wc_get_template( "custom/product-block/block-{$block_data['layout']}.php" , compact( 'product', 'block_data' ) );
}