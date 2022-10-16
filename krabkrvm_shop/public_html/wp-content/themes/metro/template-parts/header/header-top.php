<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<div class="top-header-inner">
	<?php if ( $has_top_info ): ?>
		<div class="tophead-left">
			<ul class="tophead-info">
				<?php if ( RDTheme::$options['phone'] ): ?>
					<li><i class="flaticon-phone-call"></i><a href="tel:<?php echo esc_attr( str_replace(' ', '', RDTheme::$options['phone'] ) );?>"><?php echo esc_html( RDTheme::$options['phone'] );?></a></li>
				<?php endif; ?>
				<?php if ( RDTheme::$options['email'] ): ?>
					<li><i class="flaticon-envelope"></i><a href="mailto:<?php echo esc_attr( RDTheme::$options['email'] );?>"><?php echo esc_html( RDTheme::$options['email'] );?></a></li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php if (  RDTheme::$top_bar_style == '4' ): ?>
			<?php do_action('wpml_add_language_selector'); ?>
	<?php else: ?>
		<?php if ( $socials ): ?>
			<div class="tophead-right">
				<ul class="tophead-social">
					<?php foreach ( $socials as $social ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $social['url'] );?>"><i class="fa <?php echo esc_attr( $social['icon'] );?>"></i></a></li>
					<?php endforeach; ?>					
				</ul>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>