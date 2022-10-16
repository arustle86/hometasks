<?php

if (!class_exists('KcSeoLicence')):

    class KcSeoLicence {

        function __construct()
        {
            add_action('admin_menu', array($this, 'addLicenseMenu'));
            add_action('admin_init', array($this, 'kcseo_license_register_option'));
            add_action('admin_init', array($this, 'kcseo_sample_activate_license'));
            add_action('admin_notices', array($this, 'kcseo_admin_notices'));
            add_action('admin_init', array($this, 'kcseo_schema_manage_licence'));
        }

        function kcseo_admin_notices()
        {
            if (isset($_GET['keseol_activation']) && !empty($_GET['message'])) {
                switch ($_GET['keseol_activation']) {
                    case 'false':
                        $message = urldecode($_GET['message']);
                        ?>
                        <div class="error">
                            <p><?php echo $message; ?></p>
                        </div>
                        <?php
                        break;
                    case 'true':
                    default:

                        break;
                }
            }
        }

        function kcseo_sample_activate_license()
        {

            if (isset($_POST['kcseo_license_activate'])) {
                if (!check_admin_referer('kcseo_license_nonce', 'kcseo_license_nonce')) {
                    return;
                }
                $license = trim(get_option('kcseo_license_key'));
                $api_params = array(
                    'edd_action' => 'activate_license',
                    'license'    => $license,
                    'item_id'    => EDD_KCSEO_WP_SCHEMA_ITEM_ID,
                    'url'        => home_url()
                );
                $response = wp_remote_post(EDD_KCSEO_WP_SCHEMA_STORE_URL,
                    array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

                if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
                    $err = $response->get_error_message();
                    $message = (is_wp_error($response) && !empty($err)) ? $err : __('An error occurred, please try again.', "wp-seo-structured-data-schema-pro");
                } else {
                    $license_data = json_decode(wp_remote_retrieve_body($response));
                    if (false === $license_data->success) {
                        switch ($license_data->error) {
                            case 'expired' :
                                $message = sprintf(
                                    __('Your license key expired on %s.', "wp-seo-structured-data-schema-pro"),
                                    date_i18n(get_option('date_format'),
                                        strtotime($license_data->expires, current_time('timestamp')))
                                );
                                break;
                            case 'revoked' :
                                $message = __('Your license key has been disabled.', "wp-seo-structured-data-schema-pro");
                                break;
                            case 'missing' :
                                $message = __('Invalid license.', "wp-seo-structured-data-schema-pro");
                                break;
                            case 'invalid' :
                            case 'site_inactive' :
                                $message = __('Your license is not active for this URL.', "wp-seo-structured-data-schema-pro");
                                break;
                            case 'item_name_mismatch' :
                                $message = sprintf(__('This appears to be an invalid license key for %s.', "wp-seo-structured-data-schema-pro"),
                                    KCSEO_WP_SCHEMA_NAME);
                                break;
                            case 'no_activations_left':
                                $message = __('Your license key has reached its activation limit.', "wp-seo-structured-data-schema-pro");
                                break;
                            default :
                                $message = __('An error occurred, please try again.', "wp-seo-structured-data-schema-pro");
                                break;
                        }
                    }
                }

                if (!empty($message)) {
                    $base_url = admin_url('admin.php?page=wp-seo-schema-license');
                    $redirect = add_query_arg(array(
                        'keseol_activation' => 'false',
                        'message'           => urlencode($message)
                    ),
                        $base_url);
                    wp_redirect($redirect);
                    exit();
                }
                update_option('kcseo_license_status', $license_data->license);
                wp_redirect(admin_url('admin.php?page=wp-seo-schema-license'));
                exit();
            }
            if (!empty($_REQUEST['kcseo_license_deactivate'])) {
                if (!check_admin_referer('kcseo_license_nonce', 'kcseo_license_nonce')) {
                    return;
                }
                $license_key = trim(get_option('kcseo_license_key'));
                $api_params = array(
                    'edd_action' => 'deactivate_license',
                    'license'    => $license_key,
                    'item_id'    => EDD_KCSEO_WP_SCHEMA_ITEM_ID,
                    'url'        => home_url()
                );
                $response = wp_remote_post(EDD_KCSEO_WP_SCHEMA_STORE_URL,
                    array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

                // Make sure there are no errors
                if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
                    $err = $response->get_error_message();
                    $message = (is_wp_error($response) && !empty($err)) ? $err : __('An error occurred, please try again.', 'wp-seo-structured-data-schema-pro');
                } else {
                    delete_option('kcseo_license_status');
                }
                wp_redirect(admin_url('admin.php?page=wp-seo-schema-license'));
                exit();
            }
        }

        function kcseo_license_register_option()
        {
            register_setting('kcseo_license', 'kcseo_license_key', array($this, 'kcseo_sanitize_license'));
        }

        function kcseo_sanitize_license($new)
        {
            $old = get_option('kcseo_license_key');
            if ($old && $old != $new) {
                delete_option('kcseo_license_status');
            }

            return $new;
        }

        function kcseo_schema_manage_licence()
        {
            $license_key = trim(get_option('kcseo_license_key'));
            new EDD_KCSEO_WP_SCHEMA_Plugin_Updater(EDD_KCSEO_WP_SCHEMA_STORE_URL,
                KCSEO_WP_SCHEMA_PLUGIN_ACTIVE_FILE_NAME,
                array(
                    'version' => KCSEO_WP_SCHEMA_VERSION,
                    'license' => $license_key,
                    'item_id' => EDD_KCSEO_WP_SCHEMA_ITEM_ID,
                    'author'  => KCSEO_WP_SCHEMA_AUTHOR,
                    'url'     => home_url(),
                    'beta'    => false
                ));

        }

        function addLicenseMenu()
        {
            add_submenu_page('wp-seo-schema', __('WP SEO Schema License', "wp-seo-structured-data-schema-pro"), __('License', "wp-seo-structured-data-schema-pro"), 'manage_options',
                'wp-seo-schema-license',
                array($this, 'wp_schema_license_page'));
        }


        function wp_schema_license_page()
        {
            $license = get_option('kcseo_license_key');
            $status = get_option('kcseo_license_status');
            ?>
            <div class="wrap">
            <h2><?php _e('Plugin License Options', "wp-seo-structured-data-schema-pro"); ?></h2>
            <form method="post" action="options.php">

                <?php settings_fields('kcseo_license'); ?>

                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('License Key', "wp-seo-structured-data-schema-pro"); ?>
                        </th>
                        <td>
                            <input id="kcseo_license_key" name="kcseo_license_key" type="text"
                                   class="regular-text" value="<?php esc_attr_e($license); ?>"/>
                            <label class="description"
                                   for="kcseo_license_key"><?php _e('Enter your license key', "wp-seo-structured-data-schema-pro"); ?></label>
                        </td>
                    </tr>
                    <?php if (false !== $license) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Activate License', "wp-seo-structured-data-schema-pro"); ?>
                            </th>
                            <td>
                                <form action="">
                                    <?php if ($status !== false && $status == 'valid') { ?>
                                        <span class="button-primary disabled"><?php _e('Active', "wp-seo-structured-data-schema-pro"); ?></span>
                                        <?php wp_nonce_field('kcseo_license_nonce', 'kcseo_license_nonce'); ?>
                                        <input type="submit" class="button-secondary" name="kcseo_license_deactivate"
                                               value="<?php _e('Deactivate License'); ?>"/>
                                    <?php } else {
                                        wp_nonce_field('kcseo_license_nonce', 'kcseo_license_nonce'); ?>
                                        <input type="submit" class="button-primary"
                                               name="kcseo_license_activate"
                                               value="<?php _e('Activate License', "wp-seo-structured-data-schema-pro"); ?>"/>
                                    <?php } ?>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php submit_button(); ?>

            </form>
            <?php
        }
    }

endif;