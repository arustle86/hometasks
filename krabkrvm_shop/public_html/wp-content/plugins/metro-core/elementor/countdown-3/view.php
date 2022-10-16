<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/countdown-3/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$attr = '';

if ( !empty( $data['btnurl']['url'] ) ) {
	$attr  = ' href="' . $data['btnurl']['url'] . '"';
	$attr .= !empty( $data['btnurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['btnurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

$img1 = wp_get_attachment_image( $data['image1']['id'], 'full' );
$img2 = wp_get_attachment_image( $data['image2']['id'], 'full' );
?>
<div class="rt-el-countdown-3 rtjs-coutdown">

	<div class="rtin-left">
		<?php echo wp_kses_post( $img2 );?>

		<?php if ( $data['date'] ): ?>
			<div class="rtin-coutdown rtjs-date clearfix" data-time="<?php echo esc_attr( $data['date'] ); ?>"></div>
		<?php endif; ?>

		<?php if ( $data['btntext'] ): ?>
			<a class="rtin-btn rdtheme-button-2"<?php echo wp_kses_post( $attr );?>><?php echo esc_html( $data['btntext'] );?></a>
		<?php endif; ?>
	</div>

	<div class="rtin-right">
		<?php echo wp_kses_post( $img1 );?>
	</div>
</div>