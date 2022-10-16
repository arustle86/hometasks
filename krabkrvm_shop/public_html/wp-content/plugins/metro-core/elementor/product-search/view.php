<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-search/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$class = $data['autocomplete'] ? ' ps-autocomplete-js' : '';
?>
<div class="rt-el-product-search<?php echo esc_attr( $class );?>">
	<?php get_template_part( 'template-parts/header/header-search' );?>
</div>