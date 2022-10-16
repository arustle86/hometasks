<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/text-with-button/view.php
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
<div class="rt-el-text-with-btn">
	<h3 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h3>
	<?php if ( $data['subtitle'] ): ?>
		<p class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></p>
	<?php endif; ?>
	<?php if ( $data['btntext'] ): ?>
		<a <?php echo $attr;?> class="rtin-btn"><?php echo esc_html( $data['btntext'] );?></a>
	<?php endif; ?>
</div>