<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

use \Redux;
use \ReduxFrameworkPlugin;

class RDTheme {

	protected static $instance;

	// Sitewide static variables
	public static $options;

	// Template specific variables
	public static $layout;
	public static $sidebar;
	public static $has_top_bar;
	public static $top_bar_style;
	public static $header_style;
	public static $has_banner;
	public static $has_breadcrumb;
	public static $bgtype;
	public static $bgimg;
	public static $bgcolor;
	public static $footer_area_style;

	private function __construct() {
		add_action( 'after_setup_theme', array( $this, 'set_options' ) );
		add_action( 'after_setup_theme', array( $this, 'set_redux_compability_options' ) );
		//$this->redux_init();
		$this->layerslider_init();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function set_options(){
		include Constants::$theme_inc_dir . 'predefined-data.php';
		$options    = json_decode( $predefined_options, true );
		if ( class_exists( 'Redux' ) && isset( $GLOBALS[Constants::$theme_options] ) ) {
			$options    = wp_parse_args( $GLOBALS[Constants::$theme_options], $options );
		}
		self::$options  = $options;
	}


	// Backward compatibility for newly added options
	public function set_redux_compability_options(){
		$new_options = array(
			'wc_product_columns_update'   		=> false,
			'wc_desktops_product_columns' 		=> '3',
		);

		foreach ( $new_options as $key => $value ) {
			if ( !isset( self::$options[$key] ) ) {
				self::$options[$key] = $value;
			}
		}
	}

	public function redux_init() {
		$options = Constants::$theme_options;

		// Remove Redux Ads
		add_filter( "redux/{$options}/aURL_filter", '__return_empty_string' );

		// Remove Redux Menu
		add_action( 'admin_menu', function(){
			remove_submenu_page( 'tools.php','redux-about' );
		}, 12 ); 
		
		// If Redux is running as a plugin, this will remove the demo notice and links
		add_action( 'redux/loaded', function(){
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				add_filter( 'plugin_row_meta', array( $this, 'redux_remove_extra_meta' ), 12, 2 );
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}	
		} ); 
	}

	public function redux_remove_extra_meta( $links, $file ){
		if ( strpos( $file, 'redux-framework.php' ) !== false ) {
			$links = array_slice( $links, 0, 3 );
		}

		return $links;
	}

	public function layerslider_init() {

		if( function_exists( 'layerslider_set_as_theme' ) ) {
			layerslider_set_as_theme();
		}

		if( function_exists( 'layerslider_hide_promotions' ) ) {
			layerslider_hide_promotions();
		}

		add_filter( 'option_ls-latest-version', '__return_false' ); // Disable LayerSlider update notice

		// Add more skins
		if ( class_exists( '\LS_Sources' ) ) {
			\LS_Sources::addSkins( Constants::$theme_inc_dir. 'layerslider-skins/' );
		}

		// Remove purchase notice from plugins page
		add_action( 'admin_init', function(){
			if ( defined( 'LS_PLUGIN_BASE' ) ) {
				remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
			}
		} );
	}

}

RDTheme::instance();