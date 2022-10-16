<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

Helper::requires( 'class-tgm-plugin-activation.php' );
Helper::requires( 'tgm-config.php' );
Helper::requires( 'activation.php' );
Helper::requires( 'options/init.php' );
Helper::requires( 'rdtheme.php' );
Helper::requires( 'loadmore.php' );
Helper::requires( 'general.php' );
Helper::requires( 'scripts.php' );
Helper::requires( 'layout-settings.php' );

if ( class_exists( 'WooCommerce' ) ) {
	Helper::requires( 'custom/functions.php', 'woocommerce' );
}

if ( function_exists( 'dokan' ) ) {
	Helper::requires( 'custom/functions.php', 'dokan' );
}

Helper::requires( 'ajax-template-file-loader.php' );
Helper::requires( 'widgets/RTShopWidget.php' );
Helper::requires( 'widgets/RTVerticalMenu.php' );