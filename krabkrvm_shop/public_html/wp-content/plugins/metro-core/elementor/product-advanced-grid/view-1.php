<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-fullscreen-grid/view-1.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
$thumb_size = 'rdtheme-size6';
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
	'quickview'      => $data['quickview'] ? true : false,
	'wishlist'       => $data['wishlist'] ? true : false,
	'v_swatch'       => $data['vswatch_display'] ? true : false,
	'compare'        => $data['compare'] ? true : false,
);
global $post;
$col_class  = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_mobile']} ";?>
<div class="rt-el-product-advanced-grid-1">
	<?php if ( $data['section_title_display'] ): ?>
		<div class="rtin-sec-title-area">
			<div class="section-heading">
                <h2 class="section-title"><?php echo esc_html( $data['title'] );?></h2>
                <?php if ( $data['sub_title'] ): ?>
                	<div class="section-subtitle"><?php echo esc_html( $data['sub_title'] );?></div>
                <?php endif; ?>
            </div>						
		</div>
	<?php endif; ?>
	<?php if ( $query->have_posts() ) :?>		
		<div class="rtin-items">
			<div class="row">
				<?php while ( $query->have_posts() ) :?>					
					<div class="<?php echo esc_attr(  $col_class );?>">
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