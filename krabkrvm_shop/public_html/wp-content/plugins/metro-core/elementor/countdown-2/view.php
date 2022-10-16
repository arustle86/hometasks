<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/countdown-2/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$attr = $class = '';

if ( !empty( $data['btnurl']['url'] ) ) {
	$attr  = ' href="' . $data['btnurl']['url'] . '"';
	$attr .= !empty( $data['btnurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['btnurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

$img = wp_get_attachment_image( $data['image']['id'], 'full' );

if ( $data['ripple'] ) {
	$class = ' rtin-ripple';
}
?>
<div class="rt-el-countdown-2 rtjs-coutdown-2<?php echo esc_attr( $class );?>">
	<div class="rtin-left">
		<?php echo wp_kses_post( $img );?>
	</div>

	<div class="rtin-middle">

		<?php if ( $data['title'] ): ?>
			<h3 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h3>
		<?php endif; ?>

		<?php if ( $data['subtitle'] ): ?>
			<p class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></p>
		<?php endif; ?>

		<?php if ( $data['content'] ): ?>
			<div class="rtin-content"><?php echo wp_kses_post( $data['content'] );?></div>
		<?php endif; ?>

		<?php if ( $data['btntext'] ): ?>
			<a class="rdtheme-button-2 rtin-btn"<?php echo wp_kses_post( $attr );?>><?php echo esc_html( $data['btntext'] );?></a>
		<?php endif; ?>

	</div>

	<div class="rtin-right">
		<?php if ( $data['date'] ): ?>
			<div class="rtin-coutdown rtjs-date clearfix" data-time="<?php echo esc_attr( $data['date'] ); ?>"></div>
		<?php endif; ?>
	</div>
</div>