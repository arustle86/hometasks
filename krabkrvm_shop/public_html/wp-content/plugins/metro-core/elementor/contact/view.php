<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/contact/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
?>
<div class="rt-el-contact">
	<ul>
		<?php if ( $data['address'] ): ?>
			<li>
				<div class="rtin-icon"><i class="flaticon-placeholder"></i></div>
				<div class="rtin-content">
					<h4 class="rtin-label"><?php esc_html_e( 'Адрес', 'metro-core' )?></h4>
					<p class="rtin-value"><?php echo wp_kses_post( $data['address'] ); ?></p>
				</div>
			</li>
		<?php endif; ?>

		<?php if ( $data['phone'] ): ?>
			<li>
				<div class="rtin-icon"><i class="flaticon-phone-call"></i></div>
				<div class="rtin-content">
					<h4 class="rtin-label"><?php esc_html_e( 'Телефон', 'metro-core' )?></h4>
					<p class="rtin-value"><a href="tel:<?php echo esc_attr( str_replace( array( ' ', '-' ) , '', $data['phone'] ) ); ?>"><?php echo esc_html( $data['phone'] ); ?></a></p>
				</div>
			</li>
		<?php endif; ?>

		<?php if ( $data['email'] ): ?>
			<li>
				<div class="rtin-icon"><i class="flaticon-envelope"></i></div>
				<div class="rtin-content">
					<h4 class="rtin-label"><?php esc_html_e( 'Email', 'metro-core' )?></h4>
					<p class="rtin-value"><a href="mailto:<?php echo esc_attr( $data['email'] ); ?>"><?php echo esc_html( $data['email'] ); ?></a></p>
				</div>
			</li>
		<?php endif; ?>
	</ul>
</div>
