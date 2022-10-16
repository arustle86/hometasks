<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/button/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( $data['btntext'] ) {
	$btn = '<a class="rtin-btn" '.$attr.'>'.$data['btntext'].'</a>';
}
?>
<div class="rt-el-btn rtin-style-<?php echo esc_attr( $data['style'] );?>">
	<a <?php echo $attr;?>><?php echo esc_html( $data['btntext'] );?></a>
</div>