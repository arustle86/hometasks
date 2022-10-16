<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$category_dropdown = array();
$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
foreach ( $terms as $term) {
	$attachment_id = get_term_meta( $term->term_id, 'metro_icon', true );
	$icon = Helper::get_attachment_image( $attachment_id );

	$category_dropdown[$term->slug] = array(
		'name' => $term->name,
		'icon' => $icon,
	);
}

$search      = isset( $_GET['s'] ) ? $_GET['s'] : '';
$product_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '';

$all_label = $label = esc_html__( 'Просмотр', 'metro' );
if ( isset( $_GET['product_cat'] ) ) {
	$pcat = $_GET['product_cat'];
	if ( isset( $category_dropdown[$pcat] ) ) {
		$label = $category_dropdown[$pcat]['name'];
	}
}

?>

<div class="product-search">
	<div class="search-dropdown header_auto_search">
		<div class="search-outer visible-mobile-menu-off">
			<form id="search__form" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<?php if(isset(RDTheme::$options['metro_header_auto_suggest_status']) 
				&& RDTheme::$options['metro_header_auto_suggest_status']){?>
					<input type="hidden" value="product" name="post_type" />
				<?php }?>
				<div class="input-outer input-group ">
					<input type="search" class="placeholder product-search-input form-control" name="s" id="s" value="" maxlength="128" placeholder="<?php esc_attr_e('SEARCH...', 'metro')?>"autocomplete="off"/>
					<button type="submit" class="btn rtin-btn-search"><i class="flaticon-search"></i></button>

				</div>
			</form>
		</div>
	</div>
</div>

