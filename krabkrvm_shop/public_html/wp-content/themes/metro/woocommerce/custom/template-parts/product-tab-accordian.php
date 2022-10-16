<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$iterated = false;

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper single-product-tab-accordion">
		<div id="single-product-accordian-area">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<?php
					if ( !$iterated ) {
						$acc_class  = ' show';
						$link_class = '';
					}
					else {
						$link_class = ' collapsed';
						$acc_class  = '';
					}
					$iterated = true;
				?>
				<div class="card">
					<div class="card-header">
						<a class="card-link<?php echo esc_attr( $link_class );?>" data-toggle="collapse" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $tab['title'] );?></a>
					</div>
					<div id="tab-<?php echo esc_attr( $key ); ?>" class="collapse<?php echo esc_attr( $acc_class );?>" data-parent="#single-product-accordian-area">
						<div class="card-body">
							<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>