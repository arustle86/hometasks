<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/video/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
?>
<div class="rt-el-video">
	<div class="rtin-content">
		<h2 class="rtin-title"><?php echo esc_html( $data['title'] );?></h2>
		<a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $data['url']['url'] );?>"><span><?php echo esc_html( $data['label'] );?></span><i class="flaticon-play-button"></i></a>		
	</div>
</div>