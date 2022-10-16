<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

use radiustheme\Metro\RDTheme;
use radiustheme\Metro\WC_Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$has_sku          = wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ? true : false;
$sku              = $product->get_sku();
$sku              = $sku? $sku : esc_html__( 'N/A', 'metro' );
$stock_status     = WC_Functions::get_stock_status();
$cats_title       = _n( 'Категория', 'Категории', count( $product->get_category_ids() ) , 'metro' );
$tags_title       = _n( 'Tag', 'Tags', count( $product->get_tag_ids() ) , 'metro' );
$cats_html        = wc_get_product_category_list( $product->get_id() );
$tags_html        = wc_get_product_tag_list( $product->get_id() );
$has_cats_n_tags  = RDTheme::$options['wc_cats'] && $cats_html && RDTheme::$options['wc_tags'] && $tags_html ? true : false;
$has_cats_or_tags = ( RDTheme::$options['wc_cats'] && $cats_html ) || ( RDTheme::$options['wc_tags'] && $tags_html ) ? true : false;
?>
<div class="product_meta-area product_meta-area-js">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<div class="product-meta-group">
		<?php if ( $has_sku ) : ?>
			<div class="product-meta-sku product_meta">	
				<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
					<span class="sku_wrapper product-meta-title"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> 
					<span class="product-meta-content sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
				<?php endif; ?>
			</div>
			<div class="product-meta-seperator"></div>
		<?php endif; ?>
	<?php if ( RDTheme::$options['in_stock_avaibility'] ) : ?>
		<div class="product-meta-avaibility">
			<span class="product-meta-title"><?php esc_html_e( 'Наличие', 'metro' ); ?>:</span>
			<span class="product-meta-content sku"><?php echo esc_html( $product->get_stock_quantity() ); ?> <?php echo esc_html( WC_Functions::get_stock_status() ); ?></span>
		</div>
	<?php endif; ?>	
	</div>
	<?php if ( $has_cats_or_tags ): ?>
		<div class="product-term-group">
			<?php if ( RDTheme::$options['wc_cats'] && $cats_html ): ?>
				<div class="product-meta-term">
					<span class="product-meta-title"><?php echo esc_html( $cats_title ); ?>:</span>
					<span class="product-meta-content"><?php echo wp_kses_post( $cats_html ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $has_cats_n_tags ): ?>
				<div class="product-meta-seperator"></div>
			<?php endif ?>

			<?php if ( RDTheme::$options['wc_tags'] && $tags_html ): ?>
				<div class="product-meta-term">
					<span class="product-meta-title"><?php echo esc_html( $tags_title ); ?>:</span>
					<span class="product-meta-content"><?php echo wp_kses_post( $tags_html ); ?></span>
				</div>
			<?php endif; ?>
		</div>		
	<?php endif ?>

<!--     <?php if ( RDTheme::$options['wc_social'] ): ?>
    <div class="product-social">
        <span class="product-social-title"><?php esc_html_e( 'Поделиться:', 'metro' );?></span>
        <ul class="product-social-items">
            <?php foreach ( WC_Functions::social_sharing() as $key => $sharer ): ?>
                <li class="social-<?php echo esc_attr( $key );?>"><a href="<?php echo esc_url( $sharer['url'] );?>" target="_blank"><i class="fa <?php echo esc_attr( $sharer['icon'] );?>"></i></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?> -->

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
</div>