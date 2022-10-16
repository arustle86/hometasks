<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

class Custom_Widgets_Init {

	public $widgets;
	protected static $instance = null;

	public function __construct() {

		// Widgets -- filename=>classname /@dev
		$widgets1 =  array(
			'about'   => 'About_Widget',
			'post'    => 'Post_Widget',
			'socials' => 'Socials_Widget',
		);

		$widgets2 = array();
		if ( class_exists( 'WooCommerce' ) && defined( 'RTWPVS_PRO_VERSION' ) ) {
			$widgets2 =  array(
				'product-attr'  => 'Product_Attr',
			);
		}

		$this->widgets = array_merge( $widgets1, $widgets2 );

		add_action( 'widgets_init', array( $this, 'custom_widgets' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function custom_widgets() {
		if ( !class_exists( 'RT_Widget_Fields' ) ) return;

		foreach ( $this->widgets as $filename => $classname ) {
			$file  = dirname(__FILE__) . '/' . $filename . '.php';
			$class = __NAMESPACE__ . '\\' . $classname;

			require_once $file;

			register_widget( $class );
		}
	}
}

Custom_Widgets_Init::instance();