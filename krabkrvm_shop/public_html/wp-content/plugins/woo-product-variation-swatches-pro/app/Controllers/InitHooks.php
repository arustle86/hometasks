<?php

namespace Rtwpvs\Controllers;

class InitHooks {

	static function init() {
		add_filter( 'body_class', array( __CLASS__, 'body_class' ) );
	}

	static function body_class( $classes ) {
		array_push( $classes, 'rtwpvs' );
		if ( wp_is_mobile() ) {
			array_push( $classes, 'rtwpvs-is-mobile' );
		}
		array_push( $classes, sprintf( 'rtwpvs-%s', rtwpvs()->get_option( 'style' ) ) );
		array_push( $classes, sprintf( 'rtwpvs-attribute-behavior-%s', rtwpvs()->get_option( 'attribute_behavior' ) ) );
		array_push( $classes, sprintf( 'rtwpvs-archive-align-%s', rtwpvs()->get_option( 'archive_swatches_align' ) ) );
		if ( is_shop() && rtwpvs()->get_option( 'archive_swatches_tooltip' ) ) {
			array_push( $classes, 'rtwpvs-tooltip' );
		}
		if ( ! is_shop() && rtwpvs()->get_option( 'tooltip' ) ) {
			array_push( $classes, 'rtwpvs-tooltip' );
		}


		return array_unique( $classes );
	}

}