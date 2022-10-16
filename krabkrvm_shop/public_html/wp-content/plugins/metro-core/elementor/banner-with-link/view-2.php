<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/banner-with-link/view.php
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
?>
<div class="rt-el-banner-with-link rtin-pos-<?php echo esc_attr( $data['pos_y_type'] );?> rtin-pos-<?php echo esc_attr( $data['pos_x_type'] );?>">
	<a class="rtin-item" <?php echo $attr;?>>
		<div class="rtin-item-content">
		<?php if ( $data['title_before'] ): ?>
			<h5 class="rtin-sub-title"><?php echo esc_html( $data['title_before'] );?></h5>
			<h3 class="rtin-title"><?php echo esc_html( $data['title'] );?></h3>
		<?php endif; ?>	
	</div>
	</a>
</div>