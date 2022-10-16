<?php

namespace Rtwpvg\Controllers;


class Install {

	static function activated() {
		update_option( 'rtwpvg_pro_active', 'yes' );
		if ( ! get_option( 'RTWPVG_PRO_VERSION' ) ) {
			// acc some options
		}

		// Update version
		delete_option( 'RTWPVG_PRO_VERSION' );
		add_option( 'RTWPVG_PRO_VERSION', rtwpvg()->version() );
	}

	static function deactivated() {
		delete_option( 'rtwpvg_pro_active' );
	}

}