<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-search/view-2.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
$class = $data['autocomplete'] ? ' ps-autocomplete-js' : '';
?>
<div class="rt-el-product-search-2 header-search-area<?php echo esc_attr( $class );?>">
	<div class="row gap10">
		<div class="col-lg-3 col-md-4 col-sm-12 col-12">
			<?php get_template_part( 'template-parts/vertical-menu' );?>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-12 col-12">
			<?php get_template_part( 'template-parts/header/header-search' );?>
		</div>
	</div>
</div>