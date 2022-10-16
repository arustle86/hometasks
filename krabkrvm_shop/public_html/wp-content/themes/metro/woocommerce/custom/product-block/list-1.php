<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$id  = $product->get_id();
$cat = $block_data['cat_display'] ? WC_Functions::get_top_category_name() : false;
?>
<div class="rt-product-list rt-product-list-1">

	<div class="rtin-thumb-wrapper">
		<a href="<?php echo esc_attr( $product->get_permalink() );?>" class="rtin-thumb">
			<?php echo WC_Functions::get_product_thumbnail( $product, $block_data['thumb_size'] );?>
		</a>
		<?php woocommerce_show_product_loop_sale_flash();?>
	</div>

	<div class="rtin-content">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>



		<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

		<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>

		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<div class="rtin-price price"><?php echo wp_kses_post( $price_html ); ?></div>
		<?php endif; ?>

		<?php
		if ( $block_data['rating_display'] ) {
			wc_get_template( 'loop/rating.php' );
		}
		?>

		<?php if ( $cat ): ?>
			<div class="rtin-cat"><?php echo esc_html( $cat );?></div>
		<?php endif; ?>

		<div class="rtin-excerpt"><?php the_excerpt();?></div>

		<div class="rtin-buttons">
			<?php
			if ( $block_data['wishlist'] ) WC_Functions::print_add_to_wishlist_icon();
			WC_Functions::print_add_to_cart_icon();
			if ( $block_data['quickview'] ) WC_Functions::print_quickview_icon();
			if ( $block_data['compare'] ) WC_Functions::print_compare_icon();
			?>
		</div>		
	</div>

</div>