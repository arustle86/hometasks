<?php


namespace Rtwpvs\Controllers;


class ProductMetaBox
{

    function __construct() {
        add_action('admin_enqueue_scripts', array(&$this, 'register_scripts'));
        add_action('woocommerce_product_data_tabs', array($this, 'product_swatches_tab'), 99, 1);
        add_action('woocommerce_product_data_panels', array($this, 'product_swatches_tab_content'));
        add_action('woocommerce_process_product_meta', array(
            $this,
            'process_product_switches_meta'
        ), 10, 2);
        add_action('wp_ajax_rtwpvs_save_product_attributes', array($this, 'rtwpvs_save_product_attributes'));
        add_action('wp_ajax_rtwpvs_reset_product_attributes', array($this, 'rtwpvs_reset_product_attributes'));
    }

    public function rtwpvs_reset_product_attributes() {
        if (!wp_verify_nonce($_POST['nonce'], 'rtwpvs_nonce')) {
            wp_send_json_error(esc_html__('Wrong Nonce', 'woo-product-variation-swatches'));
        }

        if (!current_user_can('edit_products')) {
            wp_die(-1);
        }
        $product_id = absint($_POST['post_id']);
        delete_post_meta($product_id, '_rtwpvs');
        do_action('rtwpvs_reset_product_attributes', $product_id);
        wp_send_json_success();
    }

    public function rtwpvs_save_product_attributes() {
        if (!wp_verify_nonce($_POST['nonce'], 'rtwpvs_nonce')) {
            wp_send_json_error(esc_html__('Wrong Nonce', 'woo-product-variation-swatches'));
        }

        if (!current_user_can('edit_products')) {
            wp_die(-1);
        }
        $product_id = absint($_POST['post_id']);
        parse_str($_REQUEST['data'], $data);
        $data = $data['rtwpvs'];
        update_post_meta($product_id, '_rtwpvs', $data);
        do_action('rtwpvs_save_product_attributes', $product_id, $data);
        wp_send_json_success();
    }

    public function register_scripts() {

    }

    public function product_swatches_tab($original_tabs) {
        $new_tab['rtwpvs-tab'] = array(
            'label'  => __('Product Swatches', 'woo-product-variation-swatches'),
            'target' => 'rtwpvs_tab_options',
            'class'  => array('show_if_variable'),
        );

        $insert_at_position = 6; // This can be changed
        $tabs = array_slice($original_tabs, 0, $insert_at_position, true); // First part of original tabs
        $tabs = array_merge($tabs, $new_tab); // Add new
        $tabs = array_merge($tabs, array_slice($original_tabs, $insert_at_position, null, true)); // Glue the second part of original

        return $tabs;
    }

    public function product_swatches_tab_content() {

        require_once rtwpvs()->locate_views('product-switches-tab-content');

    }

    public function process_product_switches_meta($post_id) {
        if (isset($_REQUEST['rtwpvs'])) {
            update_post_meta($post_id, '_rtwpvs', $_REQUEST['rtwpvs']);
        }
    }

}