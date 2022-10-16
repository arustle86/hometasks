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
	$btn = '<a class="item-btn" '.$attr.'>'.$data['btntext'].'</a>';
}
?>

<div class="rt-el-info-box-3">

	<div class="product-box <?php echo esc_attr( $data['style2'] );?>">
	    <div class="item-img">
	       <?php echo wp_get_attachment_image( $data['image']['id'], 'full' );?>
	    </div>
	    <div class="item-content" data-sal="slide-left" data-sal-duration="800" data-sal-delay="200">
	    	<?php if ( $data['title'] ): ?>
					<h2 class="item-title rtin-title"><?php echo wp_kses_post( $data['title'] );?></h2>
				<?php endif; ?>
				<?php if ( $data['subtitle'] ): ?>
					<p class="item-subtitle rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></p>
				<?php endif; ?>
	       <?php echo $btn;?>        
	    </div>
	</div>

</div>