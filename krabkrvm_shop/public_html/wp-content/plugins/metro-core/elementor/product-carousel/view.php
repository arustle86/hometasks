<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-slider/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.1
 */

namespace radiustheme\Metro_Core;
$query = $data['query'];

if ( !empty( $data['cat'] ) ) {
	$shop_permalink = get_category_link( $data['cat'] );
}
else {
	$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
}	
$block_data = array(
	'layout'         => $data['style'],
	'cat_display'    => $data['cat_display'] ? true : false,
	'rating_display' => $data['rating_display'] ? true : false,
	'v_swatch'       => $data['vswatch_display'],
	'quickview'      => $data['quickview'],
	'wishlist'       => $data['wishlist'],		
	'gallery'        => true,
);
?>
<div class="rt-el-product-carousel rtin-style-<?php echo esc_attr( $data['style'] );?>">	
	<?php if ( $data['section_title_display'] ): ?>
		<div class="rt-sec-title-area-2 section-heading">
			<?php if ( $data['title'] ): ?>
				<h3 class="rtin-sec-title section-title"><?php echo esc_html( $data['title'] );?></h3>
			<?php endif; ?>

			<?php if ( $data['sub_title'] ): ?>
				<div class="section-subtitle section-subtitle"><?php echo esc_html( $data['sub_title'] );?></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( $query->have_posts() ) :?>
		<div class="rtin-items owl-theme owl-custom-nav-top owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] );?>">
			<?php
				while ( $query->have_posts() ) {
					$query->the_post();
					$id = get_the_ID();
					$product = wc_get_product( $id );
					wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
				}
			?>
		</div>
	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'metro-core' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>