<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/info-box/view-1.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$attr = $btn = '';
$class = 'rtin-style-'.$data['style'];

if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( $data['btntext'] ) {
	$btn = '<div class="rtin-btn-area"><a class="rtin-btn" '.$attr.'>'.$data['btntext'].'</a></div>';
}

?>
<div class="rt-el-info-box-2 <?php echo esc_attr( $class );?>">
	<div class="rtin-item">

		<div class="rtin-content">
			<?php if ( $data['title'] ): ?>
				<h3 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h3>
			<?php endif; ?>

			<?php if ( $data['subtitle'] ): ?>
				<p class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></p>
			<?php endif; ?>

			<?php echo $btn;?>
		</div>
	</div>
</div>