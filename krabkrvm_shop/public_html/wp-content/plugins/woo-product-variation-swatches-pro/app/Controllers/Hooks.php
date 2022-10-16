<?php

namespace Rtwpvs\Controllers;

use Rtwpvs\Helpers\Functions;
use Rtwpvs\Helpers\Options;

class Hooks
{

    static function init() {
        add_filter('product_attributes_type_selector', [__CLASS__, 'product_attributes_types']);
        add_action('admin_init', [__CLASS__, 'add_product_taxonomy_meta']);
        add_action('woocommerce_product_option_terms', [__CLASS__, 'product_option_terms'], 20, 2);
        add_action('dokan_product_option_terms', [__CLASS__, 'product_option_terms'], 20, 2);
        add_filter('woocommerce_dropdown_variation_attribute_options_html', [__CLASS__, 'variation_attribute_options_html'], 200, 2);

        if (!is_admin()) {
            add_filter('woocommerce_ajax_variation_threshold', [__CLASS__, 'ajax_variation_threshold'], 8);
        }
        add_action('admin_init', [__CLASS__, 'after_plugin_active']);

        add_filter('wp_get_attachment_image_attributes', [__CLASS__, 'add_wp_class_attachment_image_attributes'], 9);

        add_filter('woocommerce_available_variation', [__CLASS__, 'available_variation'], 100, 3);
        add_filter('post_class', [__CLASS__, 'product_loop_post_class'], 25, 3);
        add_filter('woocommerce_loop_add_to_cart_args', [__CLASS__, 'loop_add_to_cart_args'], 20, 2);
        add_filter('woocommerce_product_add_to_cart_url', [__CLASS__, 'simple_product_cart_url'], 10, 2);
        add_filter('woocommerce_get_script_data', [__CLASS__, 'wc_get_script_data'], 10, 2);

        add_action('wp_ajax_nopriv_rtwpvs_add_variation_to_cart', [__CLASS__, 'add_to_cart']);
        add_action('wp_ajax_rtwpvs_add_variation_to_cart', [__CLASS__, 'add_to_cart']);
        add_filter('script_loader_tag', [__CLASS__, 'script_loader_add_defer_tag'], 10, 3);
        add_action('rtwpvs_save_product_attributes', [__CLASS__, 'delete_transient_at_rtwpvs_save_or_reset_product_attributes']);
        add_action('rtwpvs_reset_product_attributes', [__CLASS__, 'delete_transient_at_rtwpvs_save_or_reset_product_attributes']);
        add_action('woocommerce_save_product_variation', [__CLASS__, 'delete_transient_at_save_or_update_product_variation']);
        add_action('woocommerce_update_product_variation', [__CLASS__, 'delete_transient_at_save_or_update_product_variation']);
        add_action('woocommerce_delete_product_transients', [__CLASS__, 'delete_transient_at_delete_product_transients']);
        add_action('woocommerce_attribute_updated', [__CLASS__, 'delete_transient_at_attribute_updated'], 20, 3);
        add_action('woocommerce_attribute_deleted', [__CLASS__, 'delete_transient_at_attribute_deleted'], 20, 3);
        add_action('woocommerce_attribute_added', [__CLASS__, 'delete_transient_at_attribute_added'], 20, 2);

        add_filter('pre_update_option_rtwpvs', [__CLASS__, 'delete_transient_at_update_option'], 10, 2);
        add_action('init', [__CLASS__, 'delete_transient_at_force']);
    }

    static function delete_transient_at_force() {
        if (isset($_GET['rtwpvs_clear_all_transient']) && isset($_REQUEST['_wpnonce']) && is_admin() && wp_verify_nonce($_REQUEST['_wpnonce'], 'rtwpvs_clear_all_cache')) {
            $archive_transient_name = "_transient_" . rtwpvs()->get_transient_name("archive_%", 'attribute-html');
            $product_transient_name = "_transient_" . rtwpvs()->get_transient_name("%", 'attribute-html');
            global $wpdb;
            $wpdb->query($wpdb->prepare("DELETE FROM $wpdb->options WHERE `option_name` LIKE (%s) OR `option_name` LIKE (%s) ", $archive_transient_name, $product_transient_name));
            do_action('rtwpvs_clear_all_transient');
        }
    }

    static function delete_transient_at_update_option($new_value, $old_value) {
        $new_single_attribute = isset($new_value['archive_swatches_single_attribute']) ? $new_value['archive_swatches_single_attribute'] : '';
        $old_single_attribute = isset($old_value['archive_swatches_single_attribute']) ? $old_value['archive_swatches_single_attribute'] : '';
        $new_display_limit = isset($new_value['archive_swatches_display_limit']) ? absint($new_value['archive_swatches_display_limit']) : '';
        $old_display_limit = isset($old_value['archive_swatches_display_limit']) ? absint($old_value['archive_swatches_display_limit']) : '';

        if (($new_single_attribute !== $old_single_attribute) || ($new_display_limit !== $old_display_limit)) {
            $archive_transient_name = "_transient_" . rtwpvs()->get_transient_name("archive_%", 'attribute-html');
            $product_transient_name = "_transient_" . rtwpvs()->get_transient_name("%", 'attribute-html');
            global $wpdb;
            $wpdb->query($wpdb->prepare("DELETE FROM $wpdb->options WHERE `option_name` LIKE (%s) OR `option_name` LIKE (%s) ", $archive_transient_name, $product_transient_name));
            do_action('rtwpvs_clear_all_transient_at_update_option');
        }
        return $new_value;
    }

    static function delete_transient_at_attribute_added($attribute_id, $attribute) {
        $transient_name = rtwpvs()->get_transient_name(wc_attribute_taxonomy_name($attribute['attribute_name']), 'attribute-taxonomy');
        delete_transient($transient_name);
    }

    static function delete_transient_at_attribute_deleted($attribute_id, $attribute_name, $taxonomy) {
        $transient_name = rtwpvs()->get_transient_name($taxonomy, 'attribute-taxonomy');
        delete_transient($transient_name);
    }

    static function delete_transient_at_attribute_updated($attribute_id, $attribute, $old_attribute_name) {
        $transient_name = rtwpvs()->get_transient_name(wc_attribute_taxonomy_name($attribute['attribute_name']), 'attribute-taxonomy');
        $old_transient = sprintf('rtwpvs_get_wc_attribute_taxonomy_%s', wc_attribute_taxonomy_name($old_attribute_name));
        delete_transient($transient_name);
        delete_transient($old_transient);
    }

    static function delete_transient_at_delete_product_transients($product_id) {
        $product = wc_get_product($product_id);

        if ($product && $product->is_type('variable')) {
            $attribute_keys = array_keys($product->get_variation_attributes());

            foreach ($attribute_keys as $attribute_id) {
                $transient_id = $product_id . "_" . wc_variation_attribute_name($attribute_id);
                $archive_transient_name = rtwpvs()->get_transient_name("archive_" . $transient_id, 'attribute-html');
                $product_transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
                delete_transient($archive_transient_name);
                delete_transient($product_transient_name);
            }
        }
    }

    static function delete_transient_at_save_or_update_product_variation($variation_id) {
        $product = wc_get_product($variation_id);
        $product_id = $product->get_parent_id();
        $attribute_keys = array_keys($product->get_variation_attributes());
        foreach ($attribute_keys as $attribute_id) {
            $transient_id = $product_id . "_" . wc_variation_attribute_name($attribute_id);
            $archive_transient_name = rtwpvs()->get_transient_name("archive_" . $transient_id, 'attribute-html');
            $product_transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
            delete_transient($archive_transient_name);
            delete_transient($product_transient_name);
        }
    }

    static function delete_transient_at_rtwpvs_save_or_reset_product_attributes($product_id) {
        $product = wc_get_product($product_id);
        $attribute_keys = array_keys($product->get_variation_attributes());
        foreach ($attribute_keys as $attribute_id) {
            $transient_id = $product_id . "_" . wc_variation_attribute_name($attribute_id);
            $archive_transient_name = rtwpvs()->get_transient_name("archive_" . $transient_id, 'attribute-html');
            $product_transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
            delete_transient($archive_transient_name);
            delete_transient($product_transient_name);
        }
    }

    static function script_loader_add_defer_tag($tag, $handle, $src) {

        $defer_load_js = (bool)rtwpvs()->get_option('defer_load_js');

        if ($defer_load_js) {
            $handles = array('rtwpvs');

            if (!wp_is_mobile() && in_array($handle, $handles) && (strpos($tag, 'plugins' . DIRECTORY_SEPARATOR . 'woo-product-variation-swatches') !== false)) {
                return str_ireplace(' src=', ' defer src=', $tag);
            }
        }

        return $tag;

    }

    static function add_to_cart() {

        ob_start();

        $data = wp_parse_args($_POST, array(
            'product_id'   => 0,
            'quantity'     => 0,
            'variation_id' => 0,
            'variation'    => array(),
        ));

        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($data['product_id']));
        $product = wc_get_product($product_id);
        $quantity = empty($data['quantity']) ? 1 : wc_stock_amount($data['quantity']);
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
        $product_status = get_post_status($product_id);
        $variation_id = absint($data['variation_id']);
        $variation = $data['variation'];

        // If Not a variation
        if (
            ('variable' != $product->get_type() || empty($variation_id)) ||
            !$passed_validation ||
            false === WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation) ||
            'publish' !== $product_status
        ) {
            // If there was an error adding to the cart, redirect to the product page to show any errors
            $response = array(
                'error'       => true,
                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),
            );

            wp_send_json($response);
        }

        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        // Return fragments
        \WC_AJAX::get_refreshed_fragments();

    }

    static function simple_product_cart_url($url, $product) {

        if ('simple' === $product->get_type()) {
            $url = $product->is_purchasable() && $product->is_in_stock() ? remove_query_arg('added-to-cart', add_query_arg('add-to-cart', $product->get_id(), Functions::get_current_url())) : get_permalink($product->get_id());
        }

        return $url;
    }

    static function loop_add_to_cart_args($args, $product) {

        if ($product->is_type('variable')) {

            if (!rtwpvs()->get_option('archive_swatches')) {
                return $args;
            }

            $get_variations = count($product->get_children()) <= apply_filters('woocommerce_ajax_variation_threshold', 30, $product);

            $enable_archive_single_attribute = (bool)rtwpvs()->get_option('archive_swatches_enable_single_attribute');

            if (!$enable_archive_single_attribute) {
                $args['class'] .= ' rtwpvs_add_to_cart';
            }

            // Based On WooCommerce Settings
            if ('yes' === get_option('woocommerce_enable_ajax_add_to_cart') && !$enable_archive_single_attribute) {
                $args['class'] .= ' rtwpvs_ajax_add_to_cart';
            } else {
                $args['attributes']['data-product_permalink'] = $product->add_to_cart_url();
                $args['attributes']['data-add_to_cart_url'] = $product->is_purchasable() && $product->is_in_stock() ? Functions::get_current_url() : get_permalink($product->get_id());
            }

            // variation_id
            $args['attributes']['data-variation_id'] = "";
            $args['attributes']['data-variation'] = "";

            $args['variations'] = array(
                'available_variations' => $get_variations ? array_values($product->get_available_variations()) : false,
                'attributes'           => $product->get_variation_attributes(),
                'selected_attributes'  => $product->get_default_attributes(),
            );
        }

        return $args;
    }

    public static function product_loop_post_class($classes, $class, $product_id) {

        if ('product' === get_post_type($product_id)) {
            $product = wc_get_product($product_id);
            if ($product->is_type('variable')) {
                $classes[] = 'rtwpvs-product';
            }
        }

        return $classes;
    }

    /**
     * @param $variation
     * @param $product      \WC_Product
     * @param $variationObj \WC_Product_Variable
     *
     * @return bool
     */
    static function available_variation($variation, $product, $variationObj) {
        if (isset($variation['image']['thumb_src']) && !empty($variation['image']['thumb_src'])) {
            $attachment_id = $variationObj->get_image_id();
            $thumbnail_size = apply_filters('woocommerce_thumbnail_size', 'woocommerce_thumbnail');
            $thumb_srcset = function_exists('wp_get_attachment_image_srcset') ? wp_get_attachment_image_srcset($attachment_id, $thumbnail_size) : false;
            $thumb_sizes = function_exists('wp_get_attachment_image_sizes') ? wp_get_attachment_image_sizes($attachment_id, $thumbnail_size) : false;
            $variation['image']['thumb_srcset'] = apply_filters('rtwpvs_thumb_srcset', $thumb_srcset, $variation, $product, $variationObj);
            $variation['image']['thumb_sizes'] = apply_filters('rtwpvs_thumb_sizes', $thumb_sizes, $variation, $product, $variationObj);
        }

        if (rtwpvs()->get_option('disable_out_of_stock')) {
            return $variationObj->is_in_stock() ? $variation : false;
        }

        return $variation;
    }


    static function add_wp_class_attachment_image_attributes($attr) {

        $classes = (array)explode(' ', $attr['class']);

        array_push($classes, 'wp-post-image');

        $attr['class'] = implode(' ', array_unique($classes));

        return $attr;
    }

    static function ajax_variation_threshold($threshold) {
        return absint(rtwpvs()->get_option('threshold', $threshold));
    }


    /**
     * Not used
     */
    static function get_available_product_variations() {
        if (is_ajax() && isset($_GET['product_id'])) {
            $product_id = absint($_GET['product_id']);
            $product = wc_get_product($product_id);
            $available_variations = array_values($product->get_available_variations());

            wp_send_json_success(wp_json_encode($available_variations));
        } else {
            wp_send_json_error();
        }
    }

    static function product_attributes_types($selector) {
        $types = Options::get_available_attributes_types();
        if (!empty($types)) {
            foreach ($types as $key => $type) {
                $selector[$key] = $type;
            }
        }

        return $selector;
    }


    static function add_product_taxonomy_meta() {

        $fields = Options::get_taxonomy_meta_fields();
        $meta_added_for = apply_filters('rtwpvs_product_taxonomy_meta_for', array_keys($fields));

        if (function_exists('wc_get_attribute_taxonomies')):

            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if ($attribute_taxonomies) :
                foreach ($attribute_taxonomies as $tax) :
                    $product_attr = wc_attribute_taxonomy_name($tax->attribute_name);
                    $product_attr_type = $tax->attribute_type;
                    if (in_array($product_attr_type, $meta_added_for)) :
                        new TermMeta($product_attr, $fields[$product_attr_type]);
                        do_action('rtwpvs_wc_attribute_taxonomy_meta_added', $product_attr, $product_attr_type);
                    endif;
                endforeach;
            endif;
        endif;

    }

    static function product_option_terms($attribute_taxonomy, $i) {
        global $thepostid;
        if (in_array($attribute_taxonomy->attribute_type, array_keys(Options::get_available_attributes_types()))) {

            $taxonomy = wc_attribute_taxonomy_name($attribute_taxonomy->attribute_name);

            $product_id = $thepostid;

            if (is_null($thepostid) && isset($_POST['post_id'])) {
                $product_id = absint($_POST['post_id']);
            }

            $args = array(
                'orderby'    => 'name',
                'hide_empty' => 0,
            );
            ?>
            <select multiple="multiple"
                    data-placeholder="<?php esc_attr_e('Select terms', 'woo-product-variation-swatches'); ?>"
                    class="multiselect attribute_values wc-enhanced-select"
                    name="attribute_values[<?php echo $i; ?>][]">
                <?php
                $all_terms = get_terms($taxonomy, apply_filters('woocommerce_product_attribute_terms', $args));
                if ($all_terms) :
                    foreach ($all_terms as $term) :
                        echo '<option value="' . esc_attr($term->term_id) . '" ' . selected(has_term(absint($term->term_id), $taxonomy, $product_id), true, false) . '>' . esc_attr(apply_filters('woocommerce_product_attribute_term_name', $term->name, $term)) . '</option>';
                    endforeach;
                endif;
                ?>
            </select>
            <?php do_action('before_rtwpvs_product_option_terms_button', $attribute_taxonomy, $taxonomy); ?>
            <button class="button plus select_all_attributes"><?php esc_html_e('Select all', 'woo-product-variation-swatches'); ?></button>
            <button class="button minus select_no_attributes"><?php esc_html_e('Select none', 'woo-product-variation-swatches'); ?></button>

            <?php
            $fields = Options::get_available_attributes_types($attribute_taxonomy->attribute_type);

            if (!empty($fields)): ?>
                <button class="button fr plus rtwpvs_add_new_attribute"
                        data-dialog_title="<?php printf(esc_html__('Add new %s', 'woo-product-variation-swatches'), esc_attr($attribute_taxonomy->attribute_label)) ?>"><?php esc_html_e('Add new', 'woo-product-variation-swatches'); ?></button>
            <?php else: ?>
                <button class="button fr plus add_new_attribute"><?php esc_html_e('Add new', 'woo-product-variation-swatches'); ?></button>
            <?php endif; ?>
            <?php
            do_action('after_rtwpvs_product_option_terms_button', $attribute_taxonomy, $taxonomy, $product_id);
        }
    }

    static function variation_attribute_options_html($html, $args) {

        if (apply_filters('default_rtwpvs_variation_attribute_options_html', false, $args, $html)) {
            return $html;
        }

        // WooCommerce Product Bundle Fixing
        if (isset($_POST['action']) && $_POST['action'] === 'woocommerce_configure_bundle_order_item') {
            return $html;
        }


        return Functions::generate_variation_attribute_option_html(apply_filters('rtwpvs_variation_attribute_options_args', $args), $html);
    }

    static function after_plugin_active() {
        if (get_option('rtwpvs_pro_activate') === 'yes') {
            delete_option('rtwpvs_pro_activate');
            wp_safe_redirect(add_query_arg(array(
                'page'    => 'wc-settings',
                'tab'     => 'rtwpvs',
                'section' => 'general',
            ), admin_url('admin.php')));
        }
    }

    static function wc_get_script_data($params, $handle) {
        if ('wc-add-to-cart-variation' == $handle) {
            $params = array_merge($params, array(
                'ajax_url'                => WC()->ajax_url(),
                'i18n_view_cart'          => apply_filters('rtwpvs_view_cart_text', esc_attr__('View cart', 'woocommerce')),
                'i18n_add_to_cart'        => apply_filters('rtwpvs_add_to_cart_text', esc_attr__('Add to cart', 'woocommerce')),
                'i18n_select_options'     => apply_filters('rtwpvs_select_options_text', esc_attr__('Select options', 'woocommerce')),
                'cart_url'                => apply_filters('woocommerce_add_to_cart_redirect', wc_get_cart_url(), null),
                'is_cart'                 => is_cart(),
                'cart_redirect_after_add' => get_option('woocommerce_cart_redirect_after_add'),
                'enable_ajax_add_to_cart' => get_option('woocommerce_enable_ajax_add_to_cart')
            ));

            wc_get_template('rtwpvs-variation-template.php', array(), '', trailingslashit(rtwpvs()->get_template_path()));
        }

        return $params;
    }
}