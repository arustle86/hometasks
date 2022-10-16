<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/countdown-1/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$img = wp_get_attachment_image( $data['image']['id'], 'full' );
?>
<div class="rt-el-countdown-1 rtjs-coutdown coutdown-new-<?php echo esc_attr( $data['style'] );?>">
	<div class="rtin-left">
		
		<?php if ( $data['title'] || $data['subtitle'] ): ?>
			<div class="rtin-title-area">
				
				<?php if ( $data['style'] == "1" ){ ?>
						<?php if ( $data['title'] ): ?>
							<div class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></div>
						<?php endif; ?>
					<?php }else{ ?>
						<?php if ( $data['title'] ): ?>
							<h3 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h3>
						<?php endif; ?>
					<?php } ?>

				<?php if ( $data['style'] == "1" ){ ?>
					<?php if ( $data['subtitle'] ): ?>
						<div class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></div>
					<?php endif; ?>
				<?php }else{ ?>
					<?php if ( $data['subtitle'] ): ?>
						<h4 class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] );?></h4>
					<?php endif; ?>
				<?php } ?>
			</div>
		<?php endif; ?>

		<?php if ( $data['regular_price'] || $data['sale_price'] ): ?>
			<div class="rtin-price">
				<?php if ( $data['regular_price'] ): ?>
					<span class="rtin-reg-price"><?php echo esc_html( $data['regular_price'] );?></span>
				<?php endif; ?>
				<?php if ( $data['sale_price'] ): ?>
					<span class="rtin-sale-price"><?php echo esc_html( $data['sale_price'] );?></span>
				<?php endif; ?>
				
			</div>
		<?php endif; ?>

		<?php if ( $data['date'] ): ?>
			<div class="rtin-coutdown rtjs-date clearfix" data-time="<?php echo esc_attr( $data['date'] ); ?>"></div>
		<?php endif; ?>

	</div>
	<div class="rtin-right"><?php echo wp_kses_post( $img );?></div>
</div>