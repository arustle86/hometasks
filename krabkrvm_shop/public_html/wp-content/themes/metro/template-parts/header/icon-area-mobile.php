<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( !RDTheme::$options['search_icon'] && !( RDTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) && !( RDTheme::$options['cart_icon'] && class_exists( 'WooCommerce' ) ) ) {
	return;
}
?>
<div class="header-icon-area clearfix">
	<?php
	if ( RDTheme::$options['cart_icon'] && class_exists( 'WooCommerce' ) ){
		?>
		<div class="icon-area-content cart-icon-area">
			<a href="<?php echo esc_url( wc_get_cart_url() );?>"><i class="flaticon-shopping-cart"></i><span class="cart-icon-num"><?php echo WC()->cart->get_cart_contents_count();?></span></a>
		</div>
		<?php
	}
	if ( RDTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) {
		get_template_part( 'template-parts/header/icon', 'account' );
	}
	if ( RDTheme::$options['search_icon'] ){
		get_template_part( 'template-parts/header/icon', 'search' );
	}
	?>
</div>