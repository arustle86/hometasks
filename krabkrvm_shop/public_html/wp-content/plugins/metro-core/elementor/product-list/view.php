<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-list/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

if($data['style'] == '1'){
	$thumb_size = array( 110, 110 );
}elseif($data['style'] == '2'){
	$thumb_size = array( 150, 150 );
}else{
	$thumb_size = array( 110, 110 );
}
$query = $data['query'];
?>
<div class="rt-el-product-list">
	<?php if ( $data['title'] ){ ?>
		<h3 class="rtin-sec-title"><?php echo esc_html( $data['title'] );?></h3>
	<?php } ?>
	<?php if ( $query->have_posts() ) :?>
		<div class="rtin-items">
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$cat = '';
				$id = get_the_ID();
				$product = wc_get_product( $id );

				if ( $data['cat_display'] ) {
					$terms = get_the_terms( $id, 'product_cat' );
					if ( $terms ) {
						$term = array_pop( $terms );
						$cat  = $term->name;
					}
				}

				if ( $data['sale_price_only'] ) {
					$price = wc_price( wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
				}
				else {
					$price = $product->get_price_html();
				}
				?>
				<div class="rtin-item media pimg-border-<?php echo esc_html( $data['product_img_border'] );?>">
					<a class="rtin-thumb" href="<?php the_permalink();?>">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( $thumb_size );
						}
						?>
						<div class="rtin-icon"><i class="flaticon-plus-symbol"></i></div>
					</a>
					<div class="media-body">					
						<h4 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>						
						<?php if ( $cat ): ?>
							<div class="rtin-cat"><?php echo esc_html( $cat );?></div>
						<?php endif; ?>
						<div class="rtin-price"><?php echo wp_kses_post( $price );?></div>
					</div>
				</div>
			<?php endwhile;?>
		</div>
	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'metro-core' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>