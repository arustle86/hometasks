<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/info-box/view-2.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$class = 'rtin-style-'.$data['style'];

$wrapper_start = '<span class="rtin-title-inner">';
$wrapper_end   = '</span>';

if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	$wrapper_start = '<a class="rtin-title-inner" ' . $attr . '>';
	$wrapper_end   = '</a>';
}
?>
<div class="rt-el-info-box <?php echo esc_attr( $class );?>">
	<div class="rtin-item">
		<div class="rtin-img rtin-pos-<?php echo esc_attr( $data['pos_y_type'] );?>"><?php echo wp_get_attachment_image( $data['image']['id'], 'full' );?></div>
		<h3 class="rtin-title">
			<?php echo $wrapper_start;?>
			<?php echo wp_kses_post( $data['title'] );?>
			<?php echo $wrapper_end;?>
		</h3>
	</div>
</div>