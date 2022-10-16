<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( !woocommerce_products_will_display() ) {
	return;
}
?>
<div class="woo-shop-top">
	<div class="rtin-left">
		<div class="limit-show"><?php woocommerce_result_count();?></div>
	</div>
	<div class="rtin-right">
		<?php if( RDTheme::$options['metro_wc_top_widget'] ): ?>
		<div class="mobile-filter-button"><i class="fa fa-filter" aria-hidden="true"></i></div>
		<?php endif; ?>
		<div class="sort-list"><?php woocommerce_catalog_ordering();?></div>
		<div class="view-mode" id="shop-view-mode">
			<ul>
				<li class="grid-view-nav"><a href="<?php echo esc_url( Helper::shop_grid_page_url() );?>" ><i class="fa fa-th"></i></a></li> 
				<li class="list-view-nav"><a href="<?php echo esc_url( Helper::shop_list_page_url() );?>"><i class="fa fa-th-list"></i></a></li>
			</ul>
		</div>
	</div>
</div>