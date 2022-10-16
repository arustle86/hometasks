<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<div class="single-product-top-2">
	<div class="rtin-left">
	<?php do_action( 'woocommerce_before_single_product_summary' );?>
	<div class="clear"></div>
	</div>
	<div class="rtin-right">
		<?php do_action( 'woocommerce_single_product_summary' );?>
	</div>
</div>
<div class="single-product-bottom-2">
	<?php do_action( 'woocommerce_after_single_product_summary' );?>
</div>