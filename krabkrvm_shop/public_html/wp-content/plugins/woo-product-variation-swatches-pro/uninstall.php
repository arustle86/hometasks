<?php
/**
 * Uninstall plugin
 */

// If uninstall not called from WordPress, then exit
defined('WP_UNINSTALL_PLUGIN') or die('Keep Silent');

$options = get_option('rtwpvs');
if (!empty($options) && is_array($options) && isset($options['remove_all_data']) && $options['remove_all_data']) {
    global $wpdb;

    // change to select type when uninstall
    $table_name = $wpdb->prefix . 'woocommerce_attribute_taxonomies';
    $wpdb->query("UPDATE `$table_name` SET `attribute_type` = 'select' WHERE `attribute_type` != 'text'");

    delete_option('rtwpvs');
    // Remove Option
    delete_option('rtwpvs_backup_attribute_types');
    delete_option('rtwpvs_pro_activate');

    // Site options in Multisite
    delete_site_option('rtwpvs');
    delete_site_option('rtwpvs_pro_activate');
    delete_site_option('rtwpvs_backup_attribute_types');
}