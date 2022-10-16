<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post();

	global $product;
	?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

		<div class="single-product-top-1">
			<div class="rtin-left">
				<?php
				woocommerce_show_product_sale_flash();
				woocommerce_show_product_images();
				?>
			</div>
			<div class="rtin-right">
				<?php
				woocommerce_template_single_title();
				woocommerce_template_single_rating();
				woocommerce_template_single_price();
				woocommerce_template_single_meta();
				woocommerce_template_single_excerpt();
				/*if( $product->is_type( 'simple' ) ) woocommerce_template_loop_add_to_cart();
				else */woocommerce_template_single_add_to_cart();
				?>
			</div>
		</div>

	</div>

<?php endwhile; // end of the loop.