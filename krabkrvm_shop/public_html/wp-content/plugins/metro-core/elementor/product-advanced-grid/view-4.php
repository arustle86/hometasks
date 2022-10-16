<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-fullscreen-grid/view-4.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
$thumb_size = 'rdtheme-size3';

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
	'thumb_size'     => $thumb_size,
	'wishlist'       => in_array( $data['style'], array( '3', '7', '11' ) ) ? true : false,
	'quickview'      => in_array( $data['style'], array( '3', '7', '11' ) ) ? true : false,
	'compare'        => in_array( $data['style'], array( '7' ) ) ? true : false,
);
global $post;
?>

<div class="rt-el-product-fullscreen-grid-1 product-fullscreen-grid-4">
	<?php if ( $data['section_title_display'] ): ?>
		<div class="rtin-sec-title-area row">
			<div class="col-md-6 col-8">
				<h3 class="rtin-sec-title"><?php echo esc_html( $data['title'] );?></h3>
			</div>
			
			<?php if ( $data['all_link_display'] ): ?>
				<div class="col-md-6 col-4">
					<div class="rtin-viewall"><a href="<?php echo esc_url( $shop_permalink ); ?>"><?php esc_html_e( 'See More', 'metro-core' );?> <i class="fa fa-chevron-right"></i></a></div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

		<?php if ( $query->have_posts() ) :?>
			<div class="rtin-items">
				<div class="row">
					<?php while ( $query->have_posts() ) :?>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
							<?php
							$query->the_post();
							$id = get_the_ID();
							$product = wc_get_product( $id );
							wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
							?>
						</div>
					<?php endwhile;?>
				</div>
			</div>
		<?php else:?>

		<div><?php esc_html_e( 'No products available', 'metro-core' ); ?></div>
	<?php endif;?>
</div>

<?php wp_reset_postdata();?>