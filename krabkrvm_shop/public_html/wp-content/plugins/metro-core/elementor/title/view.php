<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/title/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
?>
<div class="rt-el-title rtin-style-<?php echo esc_attr( $data['style'] );?> rtin-align-<?php echo esc_attr( $data['align'] );?>">
	<h2 class="rtin-title"><?php echo esc_html( $data['title'] );?></h2>
	<?php if ( $data['subtitle'] ): ?>
		<p class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></p>
	<?php endif; ?>
</div>