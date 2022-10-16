<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<div class="single-product-top-3">
	<?php do_action( 'woocommerce_before_single_product_summary' );?>
	<div class="clear"></div>
	<div class="rtin-top-item">
		<div class="rtin-top-left">
			<?php do_action( 'woocommerce_single_product_summary' );?>
		</div>
		<div class="rtin-top-right">
			<?php woocommerce_output_product_data_tabs();?>
		</div>		
	</div>
</div>
<div class="single-product-bottom-3">
	<?php do_action( 'woocommerce_after_single_product_summary' );?>
</div>