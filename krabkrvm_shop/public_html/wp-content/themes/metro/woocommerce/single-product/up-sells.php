<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

use radiustheme\Metro\WC_Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>
<?php WC_Functions::product_slider( $upsells, esc_html__( 'You may also like&hellip;', 'metro' ), 'up-sells' );?>
<?php endif;
wp_reset_postdata();