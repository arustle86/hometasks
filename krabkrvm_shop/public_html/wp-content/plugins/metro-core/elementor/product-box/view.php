<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-box/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$id = intval( $data['p_id'] );

$product  = wc_get_product( $id );

if ( !$product ) {
	return;
}

global $post;
$post = get_post( $id );

if ( $data['thumbnail_size'] == 'custom' ) {
	$size = array_values( $data['thumbnail_custom_dimension'] );
}
else {
	$size = $data['thumbnail_size'];
}

if ( $data['style'] == '13') {	
	
$block_data = array(
	'layout'         => $data['style'],
	'thumb_size'     => $size,
	'cat_display'    => $data['cat_display'] ? true : false,
	'rating_display' => false,
	'v_swatch'       => $data['vswatch_display'],
	'quickview'        => false,
	
	'wishlist'        => false,
	'gallery'        => false,
	);
}else{
	$block_data = array(
	'layout'         => $data['style'],
	'thumb_size'     => $size,
	'cat_display'    => $data['cat_display'] ? true : false,
	'rating_display' => false,
	'v_swatch'       => $data['vswatch_display'],
	'quickview'      => false,
	'wishlist'       => false,
	'gallery'        => false,
	);
}

$image = !empty( $data['image']['id'] ) ? wp_get_attachment_image( $data['image']['id'], 'full' ) : false;
?>
<div class="rt-el-product-box">
	<?php
	setup_postdata( $post );
	if ( !$image ) {
		wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
	}
	else {
		ob_start();
		wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
		$content = ob_get_clean();
		$content = preg_replace( '/<img.+?>/', $image, $content, 1 );// replace image
		echo $content;
	}
	?>
</div>
<?php wp_reset_postdata();?>