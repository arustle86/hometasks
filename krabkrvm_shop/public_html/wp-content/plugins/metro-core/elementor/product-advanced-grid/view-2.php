<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-fullscreen-grid/view-2.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
$item = $data['items'];

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
	'wishlist'       => in_array( $data['style'], array( '3', '7' ) ) ? true : false,
	'quickview'      => in_array( $data['style'], array( '3', '7' ) ) ? true : false,
	'compare'        => false,
	'gallery'        => false,
	'v_swatch'       => false,
);

global $post;
?>
<div class="rt-el-product-fullscreen-grid-2">

	<?php if ( $data['section_title_display'] ): ?>
		<div class="rt-sec-title-area-1">
			<h3 class="rtin-sec-title"><?php echo esc_html( $data['title'] );?></h3>
			<?php if ( $data['all_link_display'] ): ?>
				<div class="rtin-viewall">
					<a href="<?php echo esc_url( $shop_permalink ); ?>">
						<?php esc_html_e( 'См. далее', 'metro-core' );?>
						<i class="fa fa-chevron-right"></i>
				</a>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="rtin-items">
		<div class="row">
			<div class="col-12 col-lg-4 col-xl-5 rtin-big">
				<?php
				if ( isset($item[0]) ) {
					$block_data['thumb_size'] = 'rdtheme-size5';
					$post    = get_post( $item[0] );
					$product = wc_get_product( $item[0] );

					if ( $product ) {
						setup_postdata( $post );
						wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
						unset( $block_data['thumb_size'] );
					}
				}
				?>
			</div>
			<div class="col-12 col-lg-8 col-xl-7 rtin-small">
				<div class="row">
					<?php for ( $i = 1; $i <= 6; $i++ ): ?>
						<div class="col-12 col-sm-6 col-md-4 col-xl-4">
							<?php
							if ( !isset( $item[$i] ) ) break;

							$post    = get_post( $item[$i] );
							$product = wc_get_product( $item[$i] );

							if ( $product ) {
								setup_postdata( $post );
								wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
							}
							?>
						</div>
					<?php endfor;?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_reset_postdata();?>