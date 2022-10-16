<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-isotope/view-1.php
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$col_class  = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_mobile']} ";

$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );

if ( !empty( $data['cat'] ) ) {
	$id = intval( $data['cat'] );
	$shop_permalink = get_term_link( $id );
}


$block_data = array(	
	'layout'         => $data['style'],
	'cat_display'    => $data['cat_display'] ? true : false,
	'rating_display' => $data['rating_display'] ? true : false,
	'v_swatch'       => $data['vswatch_display'] ? true : false,
);

$query_ids = array();



foreach ( $data['queries'] as $key => $query ) {
	$class = $key;
	foreach ( $query->posts as $post ) {
		$id = $post->ID;
		if ( array_key_exists( $id , $query_ids ) ) {
			$query_ids[$id] .= ' '. $class;
		}
		else {
			$query_ids[$id] = $class;
		}
	}
}

global $post;
?>
<div class="rt-el-product-isotope rt-el-isotope-container rtin-layout-<?php echo esc_attr( $data['layout'] );?>">
	<div class="rtin-navs-area">
		<div class="rt-el-isotope-tab rtin-navs">
			<?php if ( $data['allfilter_display'] ): ?>
				<a href="#" data-filter="*" class="current"><?php echo esc_html_e( 'All', 'metro-core' );?></a>
			<?php endif; ?>
				
			<?php foreach ( $data['navs'] as $key => $value ): ?>
				<a href="#" data-filter=".<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a>
			<?php endforeach; ?>
		</div>

		<?php if ( $data['layout'] == '1' && $data['all_link_display'] ): ?>
			<div class="rtin-viewall"><a href="<?php echo esc_url( $shop_permalink ); ?>"><?php echo esc_html( $data['all_link_text'] );?><i class="fa fa-chevron-right"></i></a></div>
		<?php endif; ?>
	</div>

	<div class="row rt-el-isotope-wrapper">
		<?php foreach ( $query_ids as $id => $class ):
			$post    = get_post( $id );
			$product = wc_get_product( $id );
			setup_postdata( $post );
			?>
			<div <?php wc_product_class( $col_class.$class, $product ); ?>>
				<?php wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) ); ?>
			</div>
			<?php
			wp_reset_postdata();
		endforeach; ?>
	</div>

	<?php if ( in_array( $data['layout'], array( '2','3' ) ) && $data['all_link_display'] ): ?>
		<div class="rtin-viewall-2"><a href="<?php echo esc_url( $shop_permalink ); ?>"><?php echo esc_html( $data['all_link_text'] );?></a></div>
	<?php endif; ?>
</div>
