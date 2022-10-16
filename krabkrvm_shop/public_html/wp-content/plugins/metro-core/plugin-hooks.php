<?php
class Metro_Core_Plugin_Hooks  {

	protected static $instance = null;

	private function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init' ), 3 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init() {
		$this->fix_layerslider_tgm_compability(); // Fix issue of Layerslider update via TGM
		add_action( 'wp_enqueue_scripts', array( $this, 'deregister_scripts' ), 12 );
	}

	public function deregister_scripts() {
		wp_deregister_script( 'rtwpvg-slider' );
	}

	public function fix_layerslider_tgm_compability(){
		if ( !is_admin() || !apply_filters( 'rdtheme_disable_layerslider_autoupdate', true ) || get_option( 'layerslider-authorized-site' ) ) return;

		global $LS_AutoUpdate;
		if ( isset( $LS_AutoUpdate ) && defined( 'LS_ROOT_FILE' ) ) {
			remove_filter( 'pre_set_site_transient_update_plugins', array( $LS_AutoUpdate, 'set_update_transient' ) );
			remove_filter( 'plugins_api', array( $LS_AutoUpdate, 'set_updates_api_results'), 10, 3 );
			remove_filter( 'upgrader_pre_download', array( $LS_AutoUpdate, 'pre_download_filter' ), 10, 4 );
			remove_filter( 'in_plugin_update_message-'.plugin_basename( LS_ROOT_FILE ), array( $LS_AutoUpdate, 'update_message' ) );
			remove_filter( 'wp_ajax_layerslider_authorize_site', array( $LS_AutoUpdate, 'handleActivation' ) );
			remove_filter( 'wp_ajax_layerslider_deauthorize_site', array( $LS_AutoUpdate, 'handleDeactivation' ) );
		}
	}
}

Metro_Core_Plugin_Hooks::instance();