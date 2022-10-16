<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/sale-banner/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

$count = count( $data['items'] );

if ( !$count ) return;

$navs = '';
foreach (range(1, $count) as $number) {
	$active = $number == 1 ? 'active' : '';
	$navs .= sprintf('<span class="%s" data-num="%s">%02d</span>', $active, $number-1, $number);
}

$owl_data = array( 
	'nav'                => false,
	'dots'               => false,
	'autoplay'           => false,
	'autoplayTimeout'    => '5000',
	'autoplaySpeed'      => '200',
	'autoplayHoverPause' => true,
	'loop'               => false,
	'margin'             => 30,
	'responsive'         => array(
		'0' => array( 'items' => 1 ),
	)
);
$owl_data = json_encode( $owl_data );
?>
<div class="rt-el-sale-banner-slider owl-wrap owl-numbered-dots">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php foreach ( $data['items'] as $item ) : ?>
			<?php
			$attr = '';
			if ( !empty( $item['url']['url'] ) ) {
				$attr  = 'href="' . $item['url']['url'] . '"';
				$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
			}

			$img = !empty( $item['bgimg']['url'] ) ? $item['bgimg']['url'] : '';
			$title = sprintf( '%s <span>%s</span>' , $item['title1'], $item['title2'] );
			?>
			<div class="rtin-item">
				<div class="rtin-left">
					<div class="rtin-left-inner">
						<div class="rtin-contents">
							<h3 class="rtin-title"><?php echo wp_kses_post( $title );?></h3>
							<?php if ( $item['subtitle'] ): ?>
								<p class="rtin-subtitle"><?php echo wp_kses_post( $item['subtitle'] );?></p>
							<?php endif; ?>
							<?php if ( $item['linktext'] ): ?>
								<a <?php echo $attr;?> class="rtin-btn"><?php echo esc_html( $item['linktext'] );?></a>
							<?php endif; ?>	
						</div>

						<div class="owl-numbered-dots-items">
							<?php echo wp_kses_post( $navs ); ?>
						</div>		
					</div>
				</div>
				<div class="rtin-right" style="background: url(<?php echo esc_url( $img );?>) no-repeat center right;"></div>
			</div>
		<?php endforeach; ?>
	</div>
</div>