<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
$class = RDTheme::$options['carticon'] ? RDTheme::$options['carticon'] : 'offscreen';

?>
<div class="cart-icon-total"><?php echo WC()->cart->get_cart_total();?></div>
<div class="icon-area-content cart-icon-area <?php echo esc_attr($class); ?>">
	<a href="<?php echo esc_url( wc_get_cart_url() );?>"><i class="flaticon-shopping-cart"></i><span class="cart-icon-num"><?php echo WC()->cart->get_cart_contents_count();?></span></a>
	<div class="cart-icon-products">
		<?php the_widget( 'WC_Widget_Cart' ); ?>
	</div>
</div>