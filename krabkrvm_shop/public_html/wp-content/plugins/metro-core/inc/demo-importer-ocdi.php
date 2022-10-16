<?php
/**
 * @author  RadiusTheme
 * @since   1.2
 * @version 1.2
 */

namespace radiustheme\Metro_Core;

use \WPCF7_ContactFormTemplate;

if ( ! defined( 'ABSPATH' ) ) exit;

class Demo_Importer_OCDI {

	public function __construct() {
		add_filter( 'pt-ocdi/import_files',          array( $this, 'demo_config' ) );
		add_filter( 'pt-ocdi/after_import',          array( $this, 'after_import' ) );
		add_filter( 'pt-ocdi/disable_pt_branding',   '__return_true' );
		add_action( 'init',                          array( $this, 'rewrite_flush_check' ) );
	}

	public function demo_config() {

		$demos_array = array(
			'demo1' => array(
				'title' => __( 'Home 1', 'metro-core' ),
				'page'  => __( 'Home 1', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot1.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/',
				'categories'    	=> 'Multi Pages',
			),
			'demo2' => array(
				'title' => __( 'Home 2', 'metro-core' ),
				'page'  => __( 'Home 2', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home-2/',
			),
			'demo3' => array(
				'title' => __( 'Home 3', 'metro-core' ),
				'page'  => __( 'Home 3', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home-3/',
			),
			'demo4' => array(
				'title' => __( 'Home 4', 'metro-core' ),
				'page'  => __( 'Home 4', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home-4/',
			),
			'demo5' => array(
				'title' => __( 'Home 5', 'metro-core' ),
				'page'  => __( 'Home 5', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home-5/',
			),
			'demo6' => array(
				'title' => __( 'Home-6-New', 'metro-core' ),
				'page'  => __( 'Home-6-New', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home-6-new/',
			),
			'demo7' => array(
				'title' => __( 'Home-7-New', 'metro-core' ),
				'page'  => __( 'Home-7-New', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home-7-new/',
			),
			'demo8' => array(
				'title' => __( 'Home8', 'metro-core' ),
				'page'  => __( 'Home8', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot8.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home8/',
			),
			'demo9' => array(
				'title' => __( 'Home9', 'metro-core' ),
				'page'  => __( 'Home9', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot9.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home9/',
			),
			'demo10' => array(
				'title' => __( 'home10-jewellery/', 'metro-core' ),
				'page'  => __( 'home10-jewellery/', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot10.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home10-jewellery//',
			),
			'demo11' => array(
				'title' => __( 'home11-winter', 'metro-core' ),
				'page'  => __( 'home11-winter', 'metro-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot11.png', dirname(__FILE__) ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/metro/home11-winter/',
			),
		);

		$config = array();
		$import_path  = trailingslashit( get_template_directory() ) . 'sample-data/';
		$redux_option = 'metro';

		foreach ( $demos_array as $key => $demo ) {
			$config[] = array(
				'import_file_id'               => $key,
				'import_page_name'             => $demo['page'],
				'import_file_name'             => $demo['title'],
				'local_import_file'            => $import_path . 'contents.xml',
				'local_import_widget_file'     => $import_path . 'widgets.wie',
				'local_import_customizer_file' => $import_path . 'customizer.dat',
				'local_import_redux'           => array(
					array(
						'file_path'   => $import_path . 'options.json',
						'option_name' => $redux_option,
					),
				),
				'import_preview_image_url'   => $demo['screenshot'],
				'preview_url'                => $demo['preview_link'],
			);
		}

		return $config;
	}

	public function after_import( $selected_import ) {
		$this->assign_menu();
		$this->assign_frontpage( $selected_import );
		$this->assign_woocommerce_pages();
		$this->instagram_feed_settings();
		$this->update_contact_form_sender_email();
		$this->update_permalinks();
		update_option( 'metro_ocdi_importer_rewrite_flash', true );
	}

	private function assign_menu() {
		$primary  = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$vertical = get_term_by( 'name', 'CATEGORIES', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'primary'  => $primary->term_id,
			'vertical' => $vertical->term_id,
		));
	}

	private function assign_frontpage( $selected_import ) {
		$blog_page  = get_page_by_title( 'Blog' );
		$front_page = get_page_by_title( $selected_import['import_page_name'] );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front',  $front_page->ID );
		update_option( 'page_for_posts', $blog_page->ID );
	}

	private function assign_woocommerce_pages() {
		$shop     = get_page_by_title( 'Shop' );
		$cart     = get_page_by_title( 'Cart' );
		$checkout = get_page_by_title( 'Checkout' );
		$account  = get_page_by_title( 'My Account' );

		update_option( 'woocommerce_shop_page_id',      $shop->ID );
		update_option( 'woocommerce_cart_page_id',      $cart->ID );
		update_option( 'woocommerce_checkout_page_id',  $checkout->ID );
		update_option( 'woocommerce_myaccount_page_id', $account->ID );
	}

	private function instagram_feed_settings() {
		$settings = array (
			'sb_instagram_at' => '',
			'sb_instagram_user_id' => array (),
			'sb_instagram_preserve_settings' => '',
			'sb_instagram_cache_time' => '1',
			'sb_instagram_cache_time_unit' => 'hours',
			'sbi_caching_type' => 'background',
			'sbi_cache_cron_interval' => '24hours',
			'sbi_cache_cron_time' => '1',
			'sbi_cache_cron_am_pm' => 'am',
			'sb_instagram_width' => '100',
			'sb_instagram_width_unit' => '%',
			'sb_instagram_feed_width_resp' => false,
			'sb_instagram_height' => '',
			'sb_instagram_num' => '20',
			'sb_instagram_height_unit' => '',
			'sb_instagram_cols' => '4',
			'sb_instagram_disable_mobile' => false,
			'sb_instagram_image_padding' => '5',
			'sb_instagram_image_padding_unit' => 'px',
			'sb_instagram_sort' => 'none',
			'sb_instagram_background' => '',
			'sb_instagram_show_btn' => true,
			'sb_instagram_btn_background' => '',
			'sb_instagram_btn_text_color' => '',
			'sb_instagram_btn_text' => 'Load More...',
			'sb_instagram_image_res' => 'auto',
			'sb_instagram_show_header' => true,
			'sb_instagram_header_size' => 'small',
			'sb_instagram_header_color' => '',
			'sb_instagram_custom_bio' => '',
			'sb_instagram_custom_avatar' => '',
			'sb_instagram_show_follow_btn' => true,
			'sb_instagram_folow_btn_background' => '',
			'sb_instagram_follow_btn_text_color' => '',
			'sb_instagram_follow_btn_text' => 'Follow on Instagram',
			'sb_instagram_custom_css' => '',
			'sb_instagram_custom_js' => '',
			'sb_instagram_cron' => 'no',
			'sb_instagram_backup' => true,
			'sb_ajax_initial' => false,
			'enqueue_css_in_shortcode' => false,
			'sb_instagram_ajax_theme' => false,
			'sb_instagram_disable_resize' => false,
			'sb_instagram_favor_local' => false,
			'sb_instagram_minnum' => 0,
			'disable_js_image_loading' => false,
			'enqueue_js_in_head' => false,
			'sb_instagram_disable_mob_swipe' => false,
			'sbi_font_method' => 'svg',
			'sb_instagram_disable_awesome' => false,
			'custom_template' => false,
			'connected_accounts' => array (
				17841405334285399 => array (
					'access_token' => '',
					'user_id' => '17841405334285399',
					'username' => 'parvez301',
					'is_valid' => true,
					'last_checked' => 1583306096,
					'expires_timestamp' => 1590318795,
					'profile_picture' => 'https://scontent.cdninstagram.com/v/t51.2885-19/s150x150/18162040_214499989046504_690791879779811328_a.jpg?_nc_ht=scontent.cdninstagram.com&_nc_ohc=5tp88zU8uMMAX94Iy4E&oh=bb412be1f25a1b821c9e3e134a95e322&oe=5EDFDDFA',
					'account_type' => 'personal',
					'type' => 'basic',
					'old_user_id' => '5403193809',
					'local_avatar' => true,
					'last_refresh_attempt' => 1585134794,
				),
			),
		);

		$ajax_status = array (
			'tested' => true,
			'successful' => true,
		);

		update_option( 'sb_instagram_settings', $settings );
		update_option( 'sb_instagram_ajax_status', $ajax_status );
	}

	private function update_contact_form_sender_email() {
		$form1 = get_page_by_title( 'Contact', OBJECT, 'wpcf7_contact_form' );
		$form2 = get_page_by_title( 'Newsletter 1', OBJECT, 'wpcf7_contact_form' );
		$form3 = get_page_by_title( 'Newsletter 2', OBJECT, 'wpcf7_contact_form' );
		$form4 = get_page_by_title( 'Newsletter 3', OBJECT, 'wpcf7_contact_form' );

		$forms = array( $form1, $form2, $form3, $form4 );
		foreach ( $forms as $form ) {
			if ( !$form ) {
				continue;
			}
			$cf7id = $form->ID;
			$mail  = get_post_meta( $cf7id, '_mail', true );
			if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
				$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
				$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
				$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
			}
			update_post_meta( $cf7id, '_mail', $mail );		
		}
	}

	private function update_permalinks() {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	public function rewrite_flush_check() {
		if ( get_option( 'metro_ocdi_importer_rewrite_flash' ) == true  ) {
			flush_rewrite_rules();
			delete_option( 'metro_ocdi_importer_rewrite_flash' );
		}
	}
}

new Demo_Importer_OCDI;