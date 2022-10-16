<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-list/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$thumb_size = array( 158, 155 );
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
$category_layout           = $data['category_layout'] ? $data['category_layout'] : 'layout-1' ;
$hide_empty_category       = $data['hide_empty_category'] ? $data['hide_empty_category'] : 0;
$cate_list 					= $data['select_categories'];
$number 					= $data['number'];
$show_product_count        	= $data['product_count'];
$product_text        		= $data['product_text'];
$button_text        		= $data['button_text'];
$cat_image_show 		   = $data['cat_image_show'];
	$show_description       = $data['show_description'];
$parent_cat = array(
	'parent' => 0,
);
$filter_cat_arg = array(
	'include'    => $cate_list,
);
$cat_arg = array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => 1,
	'orderby'    => 'date',
	'order'      => 'DESC',
	'number'     => $number,
);
$cat_args    = array_merge( $cat_arg, $filter_cat_arg, $parent_cat );
$product_categories   = get_categories( $cat_args );
$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']}";
?>
<div class="category-layout-wrp">
	<div class="row">
	<?php 
		foreach ($product_categories as $product_category) :
		$cat_thumb = get_term_meta($product_category->term_id, 'thumbnail_id', true);			
		$cat_thumnail_url = wp_get_attachment_url($cat_thumb);
		?>
		<div class="mb-30px <?php echo esc_attr( $col_class);?>">
			<?php if ('1' == $category_layout) : ?>	
			
				<div class="p-c-l-wrp">
					<div class="single-pcat p-c-l-one">
						<a href="<?php echo get_term_link($product_category->term_id);?>">
							<div class="product-cat-with-thumb" style="background-image: url(<?php echo esc_url( $cat_thumnail_url );?>);">
								<?php if (true == $show_product_count): ?>
								<h5 class="product-count"><?php echo esc_html( $product_category->count ); ?>&nbsp;<?php echo esc_html( $product_text ); ?></h5>
								<?php endif; ?>
								<h5 class="product-title"><?php echo esc_html( $product_category->name );?></h5>
							</div>
						</a>
					</div>
				</div>
				<?php elseif('2' == $category_layout) : ?>

				<div class="single-pcat p-c-l-2">
				<?php if (!empty($cat_thumnail_url) && true == $cat_image_show) : ?>
					<img class="card-img-top" src="<?php echo esc_url( $cat_thumnail_url );?>" alt="<?php echo esc_html( $product_category->name );?>">
					<?php endif; ?>
					<div class="single-pcat-body">
						<a href="<?php echo get_term_link($product_category->term_id);?>"><h5 class="card-title"><?php echo esc_html( $product_category->name );?></h5>
						</a>
						<?php if (true == $show_product_count): ?>
								<h5 class="product-count"><?php echo esc_html( $product_category->count ); ?>&nbsp;<?php echo esc_html( $product_text ); ?></h5>
								<?php endif; ?>
						<?php 
						if ($show_description == true):
						?>
						<p class="card-text"><?php echo esc_html( $product_category->description );?></p>
						<?php endif; ?>
						<?php if ( $button_text ): ?>
						<a href="<?php echo get_term_link($product_category->term_id);?>" class="rtin-btn rdtheme-button-2">
						<?php echo esc_html( $button_text );?></a>
						<?php endif; ?>

					</div>
				</div>
			<?php elseif ('3' == $category_layout):?>
			
						<div class="hovereffect  p-c-l-3">
		        <img class="img-responsive" src="<?php echo esc_url( $cat_thumnail_url );?>" alt="">
	            <div class="overlay">
	                <a href="<?php echo get_term_link($product_category->term_id);?>"><h3><?php echo esc_html( $product_category->name );?></h3></a>
					<p>
						<a href="<?php echo get_term_link($product_category->term_id);?>"><?php echo esc_html( $button_text );?></a>
					</p>
	            </div>
		    </div>			
		 		
			
			<?php endif; ?>			
		</div>
		<?php 	
	endforeach; ?>
	</div>
</div>
<?php 
wp_reset_postdata();?>