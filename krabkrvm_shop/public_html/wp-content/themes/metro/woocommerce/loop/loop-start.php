<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

use radiustheme\Metro\RDTheme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$rdtheme_class = '';
if ( RDTheme::$options['wc_pagination'] == 'load-more' ) {
	$rdtheme_class .= ' rdtheme-loadmore-wrapper';
}
if ( RDTheme::$options['wc_pagination'] == 'infinity-scroll' ) {
	$rdtheme_class .= ' rdtheme-infscroll-wrapper';
}
?>
<div class="products rdtheme-archive-products row<?php echo esc_attr( $rdtheme_class );?>">
