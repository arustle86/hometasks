<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use radiustheme\Metro\Helper;

$acc_id = Helper::uniqueid();
?>
<div class="rt-el-accordion">
	<div id="<?php echo esc_attr( $acc_id )?>">
		<?php foreach ( $data['items'] as $item ): ?>
			<?php
			$card_id = Helper::uniqueid();
			?>
			<div class="card">
				<div class="card-header">
					<a class="collapsed" href="#" data-toggle="collapse" data-target="#<?php echo esc_attr( $card_id )?>" aria-expanded="true"> <?php echo esc_html( $item['title'] )?></a>
				</div>
				<div id="<?php echo esc_attr( $card_id )?>" class="collapse" data-parent="#<?php echo esc_attr( $acc_id )?>">
					<div class="card-body"><?php echo wp_kses_post( $item['content'] )?></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>