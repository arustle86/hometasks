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

?>
<div class="wooc-category-layout-wrp">
	<div class="rtin-items owl-theme owl-custom-nav owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] );?>">
	<?php 
		foreach ($product_categories as $product_category) :

		$cat_thumb = get_term_meta($product_category->term_id, 'thumbnail_id', true);	

		$cat_thumnail_url  = wp_get_attachment_image( $cat_thumb, array( 120, 120 ) ) 

		//$cat_thumnail_url = wp_get_attachment_url($cat_thumb);
		?>
		<div class="items">				
			<div class="items-wrp">

		       <?php echo wp_kses_post( $cat_thumnail_url );?>

	            <div class="overlay">
	                <a href="<?php echo get_term_link($product_category->term_id);?>"><h3><?php echo esc_html( $product_category->name );?></h3></a>
					<p>
						<a href="<?php echo get_term_link($product_category->term_id);?>"><?php echo esc_html( $button_text );?></a>
					</p>
	            </div>
		    </div>
		</div>
		<?php 	
	endforeach; ?>
	</div>
</div>
<?php 
wp_reset_postdata();?>