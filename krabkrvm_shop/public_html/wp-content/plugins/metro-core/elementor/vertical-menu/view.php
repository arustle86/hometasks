<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/vertical-menu/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use radiustheme\Metro\Helper;
?>
<div class="rt-el-vertical-menu">
	<?php Helper::get_template_part( 'template-parts/vertical-menu', array( 'icon_display' => $data['icon_display'] ) );?>
</div>