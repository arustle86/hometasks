<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if(!function_exists('YITH_WCWL')) return;

global $product;
$product_id      = $product->get_id();
$is_in_wishlist  = YITH_WCWL()->is_product_in_wishlist( $product_id, false );
$wishlist_url    = YITH_WCWL()->get_wishlist_url();

$title_before = esc_html__( 'Add to Wishlist', 'metro' );
$title_after  = esc_html__( 'Aleady exists in Wishlist! Click here to view Wishlist', 'metro' );

if ( $is_in_wishlist ) {
	$class      = 'rdtheme-remove-from-wishlist';
	$icon_font  = 'fa fa-heart';
	$title      = $title_after;
}
else {
	$class      = 'rdtheme-add-to-wishlist';
	$icon_font  = 'fa fa-heart-o';
	$title      = $title_before;
}

$html = '';

if ( $icon ) {
	$html .= '<i class="wishlist-icon '.$icon_font.'"></i>';
}

$html .= '<i class="ajax-loading fa fa-spinner fa-spin"></i>';

if ( $text ) {
	$html .= '<span>' . esc_html__( 'WishList', 'metro' ) . '</span>';
}

$nonce =  wp_create_nonce( 'metro_wishlist_nonce' );
?>
<a href="<?php echo esc_url( $wishlist_url );?>" title="<?php echo esc_attr( $title );?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id );?>" data-title-after="<?php echo esc_attr( $title_after );?>" class="rdtheme-wishlist-icon <?php echo esc_attr( $class );?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" target="_blank">
	<?php echo wp_kses_post( $html ); ?>
</a>