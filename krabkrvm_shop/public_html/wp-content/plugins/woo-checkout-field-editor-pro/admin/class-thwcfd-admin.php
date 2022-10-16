<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themehigh.com
 *
 * @package    woo-checkout-field-editor-pro
 * @subpackage woo-checkout-field-editor-pro/admin
 */

if(!defined('WPINC')){	die; }

if(!class_exists('THWCFD_Admin')):
 
class THWCFD_Admin {
	private $plugin_name;
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.9.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	
	public function enqueue_styles_and_scripts($hook) {
		if(strpos($hook, 'page_checkout_form_designer') !== false) {
			$debug_mode = apply_filters('thwcfd_debug_mode', false);
			$suffix = $debug_mode ? '' : '.min';
			
			$this->enqueue_styles($suffix);
			$this->enqueue_scripts($suffix);		
		}
	}
	
	private function enqueue_styles($suffix) {
		wp_enqueue_style('woocommerce_admin_styles');
		wp_enqueue_style('thwcfd-admin-style', THWCFD_ASSETS_URL_ADMIN . 'css/thwcfd-admin'. $suffix .'.css', $this->version);
	}

	private function enqueue_scripts($suffix) {
		$deps = array('jquery', 'jquery-ui-dialog', 'jquery-ui-sortable', 'jquery-tiptip', 'woocommerce_admin', 'selectWoo', 'wp-color-picker', 'wp-i18n');
			
		wp_enqueue_script('thwcfd-admin-script', THWCFD_ASSETS_URL_ADMIN . 'js/thwcfd-admin'. $suffix .'.js', $deps, $this->version, false);
    	wp_set_script_translations('thwcfd-admin-script', 'woo-checkout-field-editor-pro', dirname(THWCFD_BASE_NAME) . '/languages/');
	}
	
	public function admin_menu() {
		$capability = THWCFD_Utils::wcfd_capability();
		$this->screen_id = add_submenu_page('woocommerce', __('WooCommerce Checkout Field Editor', 'woo-checkout-field-editor-pro'), __('Checkout Form', 'woo-checkout-field-editor-pro'), $capability, 'checkout_form_designer', array($this, 'output_settings'));
	}
	
	public function add_screen_id($ids) {
		$ids[] = 'woocommerce_page_checkout_form_designer';
		$ids[] = strtolower(__('WooCommerce', 'woo-checkout-field-editor-pro')) .'_page_checkout_form_designer';

		return $ids;
	}

	public function plugin_action_links($links) {
		$settings_link = '<a href="'.esc_url(admin_url('admin.php?page=checkout_form_designer')).'">'. __('Settings', 'woo-checkout-field-editor-pro') .'</a>';
		array_unshift($links, $settings_link);
		$pro_link = '<a style="color:green; font-weight:bold" target="_blank" href="https://www.themehigh.com/product/woocommerce-checkout-field-editor-pro/?utm_source=free&utm_medium=plugin_action_link&utm_campaign=wcfe_upgrade_link">'. __('Get Pro', 'woo-checkout-field-editor-pro') .'</a>';
		array_push($links,$pro_link);

		if (array_key_exists('deactivate', $links)) {
		    $links['deactivate'] = str_replace('<a', '<a class="thwcfd-deactivate-link"', $links['deactivate']);
		}
		return $links;
	}

	public function get_current_tab(){
		return isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'fields';
	}
	
	public function output_settings(){
		echo '<div class="wrap">';
		echo '<h2></h2>';

		$tab = $this->get_current_tab();

		echo '<div class="thwcfd-wrap">';
		if($tab === 'advanced_settings'){			
			$advanced_settings = THWCFD_Admin_Settings_Advanced::instance();	
			$advanced_settings->render_page();
		}elseif($tab === 'pro'){
			$pro_details = THWCFD_Admin_Settings_Pro::instance();	
			$pro_details->render_page();
		}elseif($tab === 'themehigh_plugins'){
			$themehigh_plugins = THWCFD_Admin_Settings_Themehigh_Plugins::instance();	
			$themehigh_plugins->render_page();
		}else{
			$general_settings = THWCFD_Admin_Settings_General::instance();	
			$general_settings->init();
		}
		echo '</div>';
		echo '</div>';
	}

	public function wcfd_notice_actions(){

		if( !(isset($_GET['thwcfd_remind']) || isset($_GET['thwcfd_dissmis']) || isset($_GET['thwcfd_reviewed'])) ) {
			return;
		}

		$nonse = isset($_GET['thwcfd_review_nonce']) ? $_GET['thwcfd_review_nonce'] : false;
		$capability = THWCFD_Utils::wcfd_capability();

		if(!wp_verify_nonce($nonse, 'thwcfd_notice_security') || !current_user_can($capability)){
			die();
		}

		$now = time();

		$thwcfd_remind = isset($_GET['thwcfd_remind']) ? sanitize_text_field( wp_unslash($_GET['thwcfd_remind'])) : false;
		if($thwcfd_remind){
			update_user_meta( get_current_user_id(), 'thwcfd_review_skipped', true );
			update_user_meta( get_current_user_id(), 'thwcfd_review_skipped_time', $now );
		}

		$thwcfd_dissmis = isset($_GET['thwcfd_dissmis']) ? sanitize_text_field( wp_unslash($_GET['thwcfd_dissmis'])) : false;
		if($thwcfd_dissmis){
			update_user_meta( get_current_user_id(), 'thwcfd_review_dismissed', true );
			update_user_meta( get_current_user_id(), 'thwcfd_review_dismissed_time', $now );
		}

		$thwcfd_reviewed = isset($_GET['thwcfd_reviewed']) ? sanitize_text_field( wp_unslash($_GET['thwcfd_reviewed'])) : false;
		if($thwcfd_reviewed){
			update_user_meta( get_current_user_id(), 'thwcfd_reviewed', true );
			update_user_meta( get_current_user_id(), 'thwcfd_reviewed_time', $now );
		}
	}

	public function output_review_request_link(){

		if(!apply_filters('thwcfd_show_dismissable_admin_notice', true)){
			return;
		}

		if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
		$current_screen = get_current_screen();
		// if($current_screen->id !== 'woocommerce_page_checkout_form_designer'){
		// 	return;
		// }

		$thwcfd_reviewed = get_user_meta( get_current_user_id(), 'thwcfd_reviewed', true );
		if($thwcfd_reviewed){
			return;
		}

		$now = time();
		$dismiss_life  = apply_filters('thwcfd_dismissed_review_request_notice_lifespan', 6 * MONTH_IN_SECONDS);
		$reminder_life = apply_filters('thwcfd_skip_review_request_notice_lifespan', 7 * DAY_IN_SECONDS);
		
		$is_dismissed   = get_user_meta( get_current_user_id(), 'thwcfd_review_dismissed', true );
		$dismisal_time  = get_user_meta( get_current_user_id(), 'thwcfd_review_dismissed_time', true );
		$dismisal_time  = $dismisal_time ? $dismisal_time : 0;
		$dismissed_time = $now - $dismisal_time;
		
		if( $is_dismissed && ($dismissed_time < $dismiss_life) ){
			return;
		}

		$is_skipped = get_user_meta( get_current_user_id(), 'thwcfd_review_skipped', true );
		$skipping_time = get_user_meta( get_current_user_id(), 'thwcfd_review_skipped_time', true );
		$skipping_time = $skipping_time ? $skipping_time : 0;
		$remind_time = $now - $skipping_time;
		
		if($is_skipped && ($remind_time < $reminder_life) ){
			return;
		}

		$thwcfd_since = get_option('thwcfd_since');
		if(!$thwcfd_since){
			$now = time();
			update_option('thwcfd_since', $now, 'no' );
		}
		$thwcfd_since = $thwcfd_since ? $thwcfd_since : $now;
		$render_time = apply_filters('thwcfd_show_review_banner_render_time' , 7 * DAY_IN_SECONDS);
		$render_time = $thwcfd_since + $render_time;
		if($now > $render_time ){
			$this->render_review_request_notice();
		}
		
	}

	public function review_banner_custom_css(){

		?>
        <style>
        	.thwvsf-review-wrapper {
                padding: 15px 28px 26px 10px !important;
                margin-top: 35px;
            }

            #thwcfd_review_request_notice{
                margin-bottom: 20px;
            }
            .thwcfd-review-wrapper {
			    padding: 15px 28px 26px 10px !important;
			    margin-top: 35px;
			}
			.thwcfd-review-image {
			    float: left;
			}
			.thwcfd-review-content {
			    padding-right: 180px;
			}
			.thwcfd-review-content p {
			    padding-bottom: 14px;
    			line-height: 1.4;
			}
			.thwcfd-notice-action{ 
			    padding: 8px 18px 8px 18px;
                background: #fff;
                color: #007cba;
                border-radius: 5px;
                border: 1px solid #007cba;
			}
			.thwcfd-notice-action.thwcfd-yes {
			    background-color: #2271b1;
			    color: #fff;
			}
			.thwcfd-notice-action:hover:not(.thwcfd-yes) {
			    background-color: #f2f5f6;
			}
			.thwcfd-notice-action.thwcfd-yes:hover {
			    opacity: .9;
			}
			.thwcfd-notice-action .dashicons{
			    display: none;
			}
			.thwcfd-themehigh-logo {
			    position: absolute;
			    right: 20px;
			    top: calc(50% - 13px);
			}
			.thwcfd-notice-action {
			    background-repeat: no-repeat;
                padding-left: 40px;
                background-position: 18px 8px;
                cursor: pointer;
			}
			.thwcfd-yes{
			    background-image: url(<?php echo THWCFD_URL; ?>admin/assets/css/tick.svg);
			}
			.thwcfd-remind{
			    background-image: url(<?php echo THWCFD_URL; ?>admin/assets/css/reminder.svg);
			}
			.thwcfd-dismiss{
			    background-image: url(<?php echo THWCFD_URL; ?>admin/assets/css/close.svg);
			}
			.thwcfd-done{
			    background-image: url(<?php echo THWCFD_URL; ?>admin/assets/css/done.svg);
			}
        </style>
    <?php    
	}

	public function review_banner_custom_js(){
		?>
		<script type="text/javascript">
        	(function($, window, document) { 
        		$( document ).on( 'click', '.thpladmin-notice .notice-dismiss', function() {
        			var wrapper = $(this).closest('div.thpladmin-notice');
					var nonce = wrapper.data("nonce");
					var data = {
						thwcfd_review_nonce: nonce,
						action: 'hide_thwcfd_admin_notice',
					};
					$.post( ajaxurl, data, function() {

					});
				});
			}(window.jQuery, window, document));
        </script>
        <?php
	}

	private function render_review_request_notice(){
		$current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general_settings';
		$current_section = isset( $_GET['section'] ) ? sanitize_key( $_GET['section'] ) : '';

		
		$remind_url = add_query_arg(array('thwcfd_remind' => true, 'thwcfd_review_nonce' => wp_create_nonce( 'thwcfd_notice_security')));
		$dismiss_url = add_query_arg(array('thwcfd_dissmis' => true, 'thwcfd_review_nonce' => wp_create_nonce( 'thwcfd_notice_security')));
		$reviewed_url= add_query_arg(array('thwcfd_reviewed' => true, 'thwcfd_review_nonce' => wp_create_nonce( 'thwcfd_notice_security')));
		?>

		<div class="notice notice-info thpladmin-notice is-dismissible thwcfd-review-wrapper" data-nonce="<?php echo wp_create_nonce( 'thwcfd_notice_security'); ?>">
			<div class="thwcfd-review-image">
				<img src="<?php echo esc_url(THWCFD_URL .'admin/assets/css/review-left.png'); ?>" alt="themehigh">
			</div>
			<div class="thwcfd-review-content">
				<h3><?php _e('We heard you!', 'woo-checkout-field-editor-pro'); ?></h3>
				<p><?php _e('The free version of the WooCommerce Checkout Field Editor plugin is now loaded with more field types. We would love to know how you feel about the improvements we made just for you. Help us to serve you and others best by simply leaving a genuine review.', 'woo-checkout-field-editor-pro'); ?></p>
				<div class="action-row">
			        <a class="thwcfd-notice-action thwcfd-yes" onclick="window.open('https://wordpress.org/support/plugin/woo-checkout-field-editor-pro/reviews/?rate=5#new-post', '_blank')" style="margin-right:16px; text-decoration: none">
			        	<?php _e("Yes, today", 'woo-checkout-field-editor-pro'); ?>
			        </a>

			        <a class="thwcfd-notice-action thwcfd-done" href="<?php echo esc_url($reviewed_url); ?>" style="margin-right:16px; text-decoration: none">
			        	<?php _e('Already, Did', 'woo-checkout-field-editor-pro'); ?>
			        </a>

			        <a class="thwcfd-notice-action thwcfd-remind" href="<?php echo esc_url($remind_url); ?>" style="margin-right:16px; text-decoration: none">
			        	<?php _e('Maybe later', 'woo-checkout-field-editor-pro'); ?>
			        </a>

			        <a class="thwcfd-notice-action thwcfd-dismiss" href="<?php echo esc_url($dismiss_url); ?>" style="margin-right:16px; text-decoration: none">
			        	<?php _e("Nah, Never", 'woo-checkout-field-editor-pro'); ?>
			        </a>
				</div>
			</div>
			<div class="thwcfd-themehigh-logo">
				<span class="logo" style="float: right">
            		<a target="_blank" href="https://www.themehigh.com">
                		<img src="<?php echo esc_url(THWCFD_URL .'admin/assets/css/logo.svg'); ?>" style="height:19px;margin-top:4px;" alt="themehigh"/>
                	</a>
                </span>
			</div>
	    </div>

		<?php
	}

}

endif;