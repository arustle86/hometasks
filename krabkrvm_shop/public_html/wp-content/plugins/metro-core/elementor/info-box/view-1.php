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
$class .= ' rtin-'.$data['content_pos'];

$wrapper_start = '<div class="rtin-item">';
$wrapper_end   = '</div>';

if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( $data['hasbtn'] ) {
	$btn = '<div class="rtin-btn-area"><a class="rtin-btn" '.$attr.'>'.$data['btntext'].'</a></div>';
}

if ( in_array( $data['style'] , array( '1', '2', '3' ) ) ) {
	$wrapper_start = '<a class="rtin-item" ' . $attr . '>';
	$wrapper_end   = '</a>';
}
?>
<div class="rt-el-info-box <?php echo esc_attr( $class );?>">
	<?php echo $wrapper_start;?>
	<div class="rtin-img rtin-pos-<?php echo esc_attr( $data['pos_y_type'] );?> rtin-pos-<?php echo esc_attr( $data['pos_x_type'] );?>"><?php echo wp_get_attachment_image( $data['image']['id'], 'full' );?></div>
	<div class="rtin-content-area">
		<div class="rtin-content">
			<?php if ( $data['title'] ): ?>
				<h3 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h3>
			<?php endif; ?>

			<?php if ( $data['subtitle'] ): ?>
				<h5 class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></h5>
			<?php endif; ?>
		</div>
		<?php echo $btn;?>
	</div>
	<?php echo $wrapper_end;?>
</div>