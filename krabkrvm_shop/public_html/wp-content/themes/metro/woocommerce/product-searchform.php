<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) );?>">
	<div class="custom-search-input">
		<div class="input-group">
			<input type="text" class="search-query form-control" placeholder="<?php esc_attr_e( 'Search products ...', 'metro' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<span class="input-group-btn">
				<button class="btn" type="submit">
					<span class="flaticon-search"></span>
				</button>
			</span>
		</div>
	</div>
	<input type="hidden" name="post_type" value="product" />
</form>