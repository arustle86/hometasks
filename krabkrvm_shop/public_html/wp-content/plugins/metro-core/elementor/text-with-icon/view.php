<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/text-with-icon/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use radiustheme\Lib\WP_SVG;

$attr = $icon = '';

if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	$wrapper_start = '<a class="rtin-item" ' . $attr . '>';
	$wrapper_end   = '</a>';
}
else {
	$wrapper_start = '<div class="rtin-item">';
	$wrapper_end   = '</div>';
}

if ( $data['icontype'] == 'image' ) {
	$icon = WP_SVG::get_attachment_image( $data['image']['id'], 'full' );
}
else {
	$icon = '<i class="'.$data['icon'].'" aria-hidden="true"></i>';
}
?>
<div class="rt-el-text-with-icon elementwidth elwidth-305-320-360 rtin-style-<?php echo esc_attr( $data['style'] );?> rtin-bgtype-<?php echo esc_attr( $data['bgtype'] );?>">
	<?php echo $wrapper_start;?>
	<div class="rtin-icon"><?php echo $icon;?></div>
	<div class="rtin-content">
		<h3 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h3>
		<?php if ( $data['subtitle'] ): ?>
			<p class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></p>
		<?php endif; ?>
	</div>
	<?php echo $wrapper_end;?>
</div>