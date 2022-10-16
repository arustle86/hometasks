<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.1
 */

if ( !isset( $content_width ) ) {
	$content_width = 1300;
}

class Metro_Main {

	public $theme  = 'metro';
	public $action = 'metro_theme_init';

	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) );
		add_action( 'admin_notices',     array( $this, 'plugin_update_notices' ) );
		$this->includes();

	}

	public function load_textdomain() {
		load_theme_textdomain( $this->theme, get_template_directory() . '/languages' );
	}

	public function pre_insert_post($post, \WP_REST_Request $request) {
        $body = $request->get_body();
        if ($body) {
            $body = json_decode($body);
            if (isset($body->menu_order)) {
                $post->menu_order = $body->menu_order;
            }
        }

        return $post;
    }


	public function includes() {
		require_once get_template_directory() . '/inc/constants.php';
		require_once get_template_directory() . '/inc/traits/init.php';
		require_once get_template_directory() . '/inc/helper.php';
		require_once get_template_directory() . '/inc/includes.php';
		require_once get_template_directory() . '/inc/class-search-product.php';
		do_action( $this->action );
	}

	public function plugin_update_notices() {
		$plugins = array();

		if ( defined( 'METRO_CORE' ) ) {
			if ( version_compare( METRO_CORE, '1.2', '<' ) ) {
				$plugins[] = 'Metro Core';
			}
		}

		foreach ( $plugins as $plugin ) {
			$notice = '<div class="error"><p>' . sprintf( __( "Please update plugin <b><i>%s</b></i> to the latest version otherwise some functionalities will not work properly. You can update it from <a href='%s'>here</a>", 'metro' ), $plugin, menu_page_url( 'classima-install-plugins', false ) ) . '</p></div>';
			echo wp_kses_post( $notice );
		}
	}
}

new Metro_Main;