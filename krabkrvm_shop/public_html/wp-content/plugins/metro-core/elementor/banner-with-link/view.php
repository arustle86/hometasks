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

if ( !empty( $data['curl']['url'] ) ) {
	$attr  = 'href="' . $data['curl']['url'] . '"';
	$attr .= !empty( $data['curl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['curl']['nofollow'] ) ? ' rel="nofollow"' : '';
}
?>
<div class="rt-el-banner-with-link">
	<a class="rtin-item" <?php echo $attr;?>>
		<?php if ( $data['linktext'] ): ?>
			<div class="rtin-btn-area"><div class="rtin-btn"><?php echo esc_html( $data['linktext'] );?></div></div>
		<?php endif; ?>		
	</a>
</div>
