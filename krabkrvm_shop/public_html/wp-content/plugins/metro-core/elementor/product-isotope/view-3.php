<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-isotope/view-2.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$col_class  = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_mobile']}";

$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
$size = 'woocommerce_thumbnail';

$block_data = array(
	'thumb_size'     => $size,
	'layout'         => $data['style'],
	'cat_display'    => $data['cat_display'] ? true : false,
	'rating_display' => $data['rating_display'] ? true : false,
	'v_swatch'       => $data['vswatch_display'] ? true : false,
);


$query = $data['query'];
$uniqueid = time().rand( 1, 99 ).'-';
?>
<div class="rt-el-product-isotope rt-el-isotope-container rtin-layout-<?php echo esc_attr( $data['layout'] );?>">	

	<div class="row rt-el-isotope-wrapper rt-isotope-box-shadow">
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$id = get_the_ID();
				$product = wc_get_product( $id );
				$term_slugs = array();				
				// get all top level term slug
				$terms = get_the_terms( $id, 'product_cat' );
				if ( $terms ) {
					foreach ( $terms as $term ) {
						$ancestors    = get_ancestors( $term->term_id, 'product_cat', 'taxonomy' );
						$ancestors    = array_reverse( $ancestors );
						$top_term     = $ancestors ? get_term( $ancestors[0], 'product_cat' ) : $term;
						$term_slugs[] = $top_term->slug;
					}
				}

				$class = '';
				foreach ( $term_slugs as $slug ) {
					$class .= ' '.$uniqueid.$slug;
				}
				?>
				<div <?php wc_product_class( $col_class.$class, $product ); ?>>
					<?php wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );?>
				</div>
			<?php endwhile;?>
		<?php endif;?>
		<?php wp_reset_postdata();?>
	</div>

	<?php if ( in_array( $data['layout'], array( '2','3' ) ) && $data['all_link_display'] ): ?>
		<div class="rtin-viewall-2"><a href="<?php echo esc_url( $shop_permalink ); ?>"><?php echo esc_html( $data['all_link_text'] );?></a></div>
	<?php endif; ?>
	
</div>