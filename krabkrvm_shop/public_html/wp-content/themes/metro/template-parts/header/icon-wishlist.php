<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
if(!function_exists('YITH_WCWL')) return;
?>
<div class="icon-area-content wishlist-icon-area">
	<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() );?>"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="wishlist-icon-num"><?php echo yith_wcwl_count_all_products();?></span></a>
</div>