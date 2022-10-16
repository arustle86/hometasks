<?php

namespace Rtwpvs\Helpers;


class Functions
{

    static function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

    static function get_all_image_sizes() {
        return apply_filters('rtwpvs_get_all_image_sizes', array_reduce(get_intermediate_image_sizes(), function ($carry, $item) {
            $carry[$item] = ucwords(str_ireplace(array('-', '_'), ' ', $item));

            return $carry;
        }, array()));
    }

    /**
     * @param string $empty
     *
     * @return array
     */
    static function get_wc_attributes($empty = '') {
        $list = array();
        if (rtwpvs()->is_wc_active()) {
            $lists = (array)wp_list_pluck(wc_get_attribute_taxonomies(), 'attribute_label', 'attribute_name');

            foreach ($lists as $name => $label) {
                $list[wc_attribute_taxonomy_name($name)] = $label . " ( {$name} )";
            }

            if ($empty) {
                $list = array('' => $empty) + $list;
            }
        }

        return $list;

    }

    static function get_wc_attribute_taxonomy($taxonomy_name) {

        $transient_name = rtwpvs()->get_transient_name($taxonomy_name, 'attribute-taxonomy');

        if (false === ($attribute_taxonomy = get_transient($transient_name))) {
            global $wpdb;

            $attribute_name = str_replace('pa_', '', wc_sanitize_taxonomy_name($taxonomy_name));
            $attribute_taxonomy = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name='{$attribute_name}'");
            set_transient($transient_name, $attribute_taxonomy, HOUR_IN_SECONDS);
        }

        return apply_filters('rtwpvs_get_wc_attribute_taxonomy', $attribute_taxonomy, $taxonomy_name);
    }

    static function wc_product_has_attribute_type($type, $taxonomy_name) {
        $attribute = self::get_wc_attribute_taxonomy($taxonomy_name);

        return apply_filters('rtwpvs_wc_product_has_attribute_type', (isset($attribute->attribute_type) && ($attribute->attribute_type == $type)), $type, $taxonomy_name, $attribute);
    }

    static function get_valid_product_attribute_type_from_available_types($type) {
        if (!$type) {
            return null;
        }
        $available_types = array_keys(Options::get_available_attributes_types());
        if (($type && in_array($type, $available_types)) || $type == 'custom') {
            return $type;
        }

        return null;
    }

    public static function get_global_attribute_type($taxonomy_name) {
        $available_types = array_keys(Options::get_available_attributes_types());

        foreach ($available_types as $type) {
            if (Functions::wc_product_has_attribute_type($type, $taxonomy_name)) {
                return $type;
            }
        }

        return null;
    }

    /**
     * @param array $args
     *
     * @return bool
     */
    public static function has_product_attribute_at_url($args) {
        if ((bool)rtwpvs()->get_option('enable_variation_url') && !(bool)$args['is_archive'] && isset($_GET['attribute_' . $args['attribute']])) {
            return true;
        }
        return false;
    }

    /**
     * @param      $args
     * @param null $html
     *
     * @return mixed|void
     */
    static function generate_variation_attribute_option_html($args, $html = null) {
        $args = wp_parse_args($args, array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'is_archive'       => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'meta_data'        => array(),
            'show_option_none' => esc_html__('Choose an option', 'woo-product-variation-swatches')
        ));

        $attribute = $args['attribute'];
        $attribute_id = wc_variation_attribute_name($attribute);
        $product = $args['product'];
        $product_id = $product->get_id();

        // Set transient caching
        $transient_id = $args['is_archive'] ? "archive_" . $product_id . "_" . $attribute_id : $product_id . "_" . $attribute_id;
        $transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
        $use_cache = (bool)rtwpvs()->get_option('use_cache');

        $use_cache = self::has_product_attribute_at_url($args) ? false : $use_cache;

        if (isset($_GET['rtwpvs_clear_transient']) || !$use_cache) {
            delete_transient($transient_name);
        }

        if ($use_cache && false !== ($transient_html = get_transient($transient_name))) {
            return $transient_html;
        }

        $meta_data = empty($args['meta_data']) ? get_post_meta($product_id, '_rtwpvs', true) : $args['meta_data'];
        $attribute_type = isset($meta_data[$attribute]['type']) && $meta_data[$attribute]['type'] ? $meta_data[$attribute]['type'] : null;
        $attribute_type = $attribute_type ? Functions::get_valid_product_attribute_type_from_available_types($attribute_type) : null;
        $global_attribute_type = Functions::get_global_attribute_type($attribute);
        $type = $attribute_type ? $attribute_type : $global_attribute_type;
        $args['attribute_type'] = $attribute_type;
        if ($type) {
            $options = $args['options'];
            $term_data = isset($meta_data[$attribute]) ? $meta_data[$attribute] : array();
            $name = $args['name'] ? $args['name'] : wc_variation_attribute_name($attribute);
            $id = $args['id'] ? $args['id'] : sanitize_title($attribute);
            $class = $args['class'];
            $show_option_none = $args['show_option_none'] ? true : false;
            $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : esc_html__('Choose an option', 'woo-product-variation-swatches');

            if (empty($options) && !empty($product) && !empty($attribute)) {
                $attributes = $product->get_variation_attributes();
                $options = $attributes[$attribute];
            }
            $transient_html = '';
            $transient_html .= '<select id="' . esc_attr($id) . '" class="' . esc_attr($class) . ' hide rtwpvs-wc-select rtwpvs-wc-type-' . esc_attr($type) . '" style="display:none" name="' . esc_attr($name) . '" data-attribute_name="' . esc_attr(wc_variation_attribute_name($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';

            if ($args['show_option_none']) {
                $transient_html .= '<option value="">' . esc_html($show_option_none_text) . '</option>';
            }
            if (!empty($options)) {
                if ($product && taxonomy_exists($attribute)) {
                    $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));

                    foreach ($terms as $term) {
                        if (in_array($term->slug, $options)) {
                            $transient_html .= '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name)) . '</option>';
                        }
                    }
                } else {
                    foreach ($options as $option) {
                        // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                        $selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
                        $transient_html .= '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</option>';
                    }
                }
            }

            $transient_html .= '</select>';

            $transient_html = $transient_html . self::get_variable_items_contents($type, $options, $args, $term_data);
            if ($use_cache) {
                set_transient($transient_name, $transient_html, HOUR_IN_SECONDS);
            }
        } else {
            $transient_html = $html;
        }
        return apply_filters('rtwpvs_variation_attribute_options_html', $transient_html, $args);
    }

    static private function get_variable_items_contents($type, $options, $args, $term_data = array()) {

        $product = $args['product'];
        $attribute = $args['attribute'];
        $data = '';
        $is_archive = (isset($args['is_archive']) && $args['is_archive']);
        if (!empty($options) && $product) {
            $name = uniqid(wc_variation_attribute_name($attribute));
            $display_count = 0;
            if (taxonomy_exists($attribute)) {
                $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));

                foreach ($terms as $term) {
                    if (in_array($term->slug, $options)) {
                        if ($is_archive && self::archive_swatches_has_more($display_count)) {
                            $data .= self::archive_swatches_more($product->get_id());
                            break;
                        }
                        $term_type = ($type == 'custom' && isset($term_data['data'][$term->slug]['type']) && !empty($term_data['data'][$term->slug]['type'])) ? $term_data['data'][$term->slug]['type'] : $type;
                        $selected_class = (sanitize_title($args['selected']) == $term->slug) ? 'selected' : '';
                        $tooltip_type = null;
                        $tooltip_data = null;
                        if (isset($term_data['data'][$term->slug]['tooltip']) && $term_data['data'][$term->slug]['tooltip']) {
                            $tooltip_type = $term_data['data'][$term->slug]['tooltip'];
                            $tooltip_data = isset($term_data['data'][$term->slug]['tooltip_' . $tooltip_type]) ? trim($term_data['data'][$term->slug]['tooltip_' . $tooltip_type]) : null;
                        } elseif ($attribute_tooltip_type = get_term_meta($term->term_id, 'rtwpvs_attribute_tooltip', true)) {
                            $tooltip_type = $attribute_tooltip_type;
                            $tooltip_data = get_term_meta($term->term_id, 'rtwpvs_attribute_tooltip_' . $tooltip_type, true);
                        }
                        $text_tooltip = $tooltip_html_attr = $image_tooltip = null;
                        if ($tooltip_type !== 'no') {
                            if ($tooltip_type == 'image' && $attachment_id = absint($tooltip_data)) {
                                $image_size = sanitize_text_field(rtwpvs()->get_option('tooltip_image_size', 'thumbnail'));
                                $image_url = wp_get_attachment_image_url($attachment_id, apply_filters('rtwpvs_tooltip_image_size', $image_size));
                                $image_tooltip = apply_filters('rtwpvs_tooltip_image',
                                    sprintf('<span class="%s"><img alt="%s" src="%s"/></span>', 'image-tooltip-wrapper',
                                        esc_attr($term->name), esc_url($image_url)
                                    ),
                                    $attachment_id, $image_url, $term, $args
                                );
                            }
                            if (!$tooltip_type || $tooltip_type == 'text') {
                                if ($tooltip_data) {
                                    $text_tooltip = trim(apply_filters('rtwpvs_variable_item_text_tooltip_text', $tooltip_data, $term, $args));
                                } else {
                                    $text_tooltip = trim(apply_filters('rtwpvs_variable_item_text_tooltip', $term->name, $term, $args));
                                }
                                $tooltip_html_attr = !empty($text_tooltip) ? sprintf('data-rtwpvs-tooltip="%s"', esc_attr($text_tooltip)) : '';
                            }

                            if (wp_is_mobile()) {
                                $tooltip_html_attr .= !empty($text_tooltip) || !empty($image_tooltip) ? ' tabindex="2"' : '';
                            }
                        }

                        $data .= sprintf('<div %1$s class="rtwpvs-term rtwpvs-%2$s-term %2$s-variable-term-%3$s %4$s" data-term="%3$s">', $tooltip_html_attr, esc_attr($term_type), esc_attr($term->slug), esc_attr($selected_class));

                        switch ($term_type):
                            case 'color':
                                $global_color = sanitize_hex_color(get_term_meta($term->term_id, 'product_attribute_color', true));
                                $global_is_dual = (bool)(get_term_meta($term->term_id, 'is_dual_color', true) === 'yes');
                                $global_secondary_color = sanitize_hex_color(get_term_meta($term->term_id, 'secondary_color', true));

                                $color = ((isset($args['attribute_type']) && $args['attribute_type']) && isset($term_data['data'][$term->slug]['color']) && !empty($term_data['data'][$term->slug]['color'])) ? sanitize_hex_color($term_data['data'][$term->slug]['color']) : $global_color;
                                $is_dual = ((isset($args['attribute_type']) && $args['attribute_type']) && isset($term_data['data'][$term->slug]['is_dual_color']) && isset($term_data['data'][$term->slug]['is_dual_color']) && ($term_data['data'][$term->slug]['is_dual_color']) === 'yes') ? $term_data['data'][$term->slug]['is_dual_color'] : $global_is_dual;
                                $secondary_color = ((isset($args['attribute_type']) && $args['attribute_type']) && isset($term_data['data'][$term->slug]) && !empty($term_data['data'][$term->slug]['secondary_color'])) ? sanitize_hex_color($term_data['data'][$term->slug]['secondary_color']) : $global_secondary_color;
                                if ($is_dual) {
                                    $data .= sprintf('%4$s<span class="rtwpvs-term-span rtwpvs-term-span-%1$s rtwpvs-term-span-dual-color" style="background: linear-gradient(-45deg, %2$s 0%%, %2$s 50%%, %3$s 50%%, %3$s 100%%);"></span>', esc_attr($type), esc_attr($secondary_color), esc_attr($color), $image_tooltip);
                                } else {
                                    $data .= sprintf('%s<span class="rtwpvs-term-span rtwpvs-term-span-%s" style="background-color:%s;"></span>', $image_tooltip, esc_attr($term_type), esc_attr($color));
                                }
                                break;

                            case 'image':
                                $attachment_id = ((isset($args['attribute_type']) && $args['attribute_type']) && isset($term_data['data'][$term->slug]['image']) && !empty($term_data['data'][$term->slug]['image'])) ? absint($term_data['data'][$term->slug]['image']) : absint(get_term_meta($term->term_id, 'product_attribute_image', true));

                                $image_size = sanitize_text_field(rtwpvs()->get_option('attribute_image_size'));
                                $image_url = wp_get_attachment_image_url($attachment_id, apply_filters('rtwpvs_product_attribute_image_size', $image_size));
                                $data .= sprintf('%s<img alt="%s" src="%s" />', $image_tooltip, esc_attr($term->name), esc_url($image_url));
                                break;

                            case 'button':
                                $data .= sprintf('%s<span class="rtwpvs-term-span rtwpvs-term-span-%s">%s</span>', $image_tooltip, esc_attr($term_type), esc_html($term->name));
                                break;

                            case 'radio':
                                $id = uniqid($term->slug);
                                $data .= sprintf('%6$s<input name="%1$s" id="%2$s" class="rtwpvs-radio-button-term" %3$s  type="radio" value="%4$s" data-term="%4$s" /><label for="%2$s">%5$s</label>', $name, $id, checked(sanitize_title($args['selected']), $term->slug, false), esc_attr($term->slug), esc_html($term->name), $image_tooltip);
                                break;

                            default:
                                $data .= apply_filters('rtwpvs_variable_default_item_content', '', $term, $args, $term_data);
                                break;
                        endswitch;
                        $data .= '</div>';
                        $display_count++;
                    }
                }
            } else {
                foreach ($options as $option) {
                    if ($is_archive && self::archive_swatches_has_more($display_count)) {
                        $data .= self::archive_swatches_more($product->get_id());
                        break;
                    }
                    $selected_class = (sanitize_title($args['selected']) == $option) ? 'selected' : '';
                    $term_name = rawurldecode($option);
                    $term_type = $type == 'custom' && isset($term_data['data'][$option]['type']) && !empty($term_data['data'][$option]['type']) ? $term_data['data'][$option]['type'] : $type;

                    $tooltip_type = null;
                    $tooltip_data = null;
                    if (isset($term_data['data'][$option]['tooltip']) && $term_data['data'][$option]['tooltip']) {
                        $tooltip_type = $term_data['data'][$option]['tooltip'];
                        $tooltip_data = isset($term_data['data'][$option]['tooltip_' . $tooltip_type]) ? trim($term_data['data'][$option]['tooltip_' . $tooltip_type]) : null;
                    }
                    $text_tooltip = $tooltip_html_attr = $image_tooltip = null;
                    if ($tooltip_type !== 'no') {
                        if ($tooltip_type == 'image' && $attachment_id = absint($tooltip_data)) {
                            $image_size = rtwpvs()->get_option('tooltip_image_size');
                            $image_url = wp_get_attachment_image_url($attachment_id, apply_filters('rtwpvs_tooltip_image_size', $image_size));
                            $image_tooltip = apply_filters('rtwpvs_variable_item_not_exists_image_tooltip',
                                sprintf('<span class="%s"><img alt="%s" src="%s"/></span>', 'image-tooltip-wrapper',
                                    esc_attr($term_name), esc_url($image_url)
                                ),
                                $attachment_id, $image_url, $args
                            );
                        }
                        if (!$tooltip_type || $tooltip_type == 'text') {
                            if ($tooltip_data) {
                                $text_tooltip = trim(apply_filters('rtwpvs_variable_item_not_exists_text_tooltip_text', $tooltip_data, $args));
                            } else {
                                $text_tooltip = trim(apply_filters('rtwpvs_variable_item_not_exists_text_tooltip', $term_name, $args));
                            }
                            $tooltip_html_attr = !empty($text_tooltip) ? sprintf('data-rtwpvs-tooltip="%s"', esc_attr($text_tooltip)) : '';
                        }
                        if (wp_is_mobile()) {
                            $tooltip_html_attr .= !empty($text_tooltip) || !empty($image_tooltip) ? ' tabindex="2"' : '';
                        }
                    }

                    $data .= sprintf('<div %1$s class="rtwpvs-term rtwpvs-%2$s-term %2$s-variable-term-%3$s %4$s" title="%5$s" data-term="%3$s">', $tooltip_html_attr, esc_attr($term_type), esc_attr($term_name), esc_attr($selected_class), esc_html($term_name));

                    switch ($term_type):
                        case 'color':
                            $color = (isset($term_data['data'][$option]['color']) && !empty($term_data['data'][$option]['color'])) ? sanitize_hex_color($term_data['data'][$option]['color']) : '';
                            $data .= sprintf('<span class="rtwpvs-term-span rtwpvs-term-span-%s" style="background-color:%s;"></span>', esc_attr($term_type), esc_attr($color));
                            break;

                        case 'image':

                            $attachment_id = (isset($term_data['data'][$option]['image']) && !empty($term_data['data'][$option]['image'])) ? absint($term_data['data'][$option]['image']) : 0;
                            $image_size = rtwpvs()->get_option('attribute_image_size');
                            $image_url = wp_get_attachment_image_url($attachment_id, apply_filters('rtwpvs_product_attribute_image_size', $image_size));
                            $data .= sprintf('<img alt="%s" src="%s" />', esc_attr($term_name), esc_url($image_url));
                            break;

                        case 'button':
                            $data .= sprintf('<span class="rtwpvs-term-span rtwpvs-term-span-%s">%s</span>', esc_attr($term_type), esc_html($term_name));
                            break;

                        case 'radio':
                            $id = uniqid($term_name);
                            $data .= sprintf('<input name="%1$s" id="%2$s" class="rtwpvs-radio-button-term" %3$s  type="radio" value="%4$s" data-term="%4$s" /><label for="%2$s">%5$s</label>', $name, $id, checked(sanitize_title($args['selected']), $term_name, false), esc_attr($term_name), esc_html($term_name));
                            break;

                        default:
                            $data .= apply_filters('rtwpvs_variable_not_exist_default_item_content', '', $args, $term_data);
                            break;
                    endswitch;
                    $data .= '</div>';

                    $display_count++;
                }
            }
        }

        $contents = apply_filters('rtwpvs_variable_term', $data, $type, $options, $args, $term_data);

        $attribute = $args['attribute'];

        $css_classes = apply_filters('rtwpvs_variable_terms_wrapper_class', array("{$type}-variable-wrapper"), $type, $args, $term_data);

        $data = sprintf('<div class="rtwpvs-terms-wrapper %s" data-attribute_name="%s">%s</div>', trim(implode(' ', array_unique($css_classes))), esc_attr(wc_variation_attribute_name($attribute)), $contents);

        return apply_filters('rtwpvs_variable_items_wrapper', $data, $contents, $type, $args, $term_data);
    }

    static public function get_product_attributes_array($attributes) {
        if (empty($attributes)) {
            return array();
        }

        $attrs = array();
        foreach ($attributes as $key => $value) {
            $attrs[$key] = wc_attribute_label($key);
        }

        return $attrs;
    }

    public static function check_license() {
        return apply_filters('rtwpvs_check_license', true);
    }

    static function get_product_list_html($products = array()) {
        $html = null;
        if (!empty($products)) {
            $htmlProducts = null;
            foreach ($products as $product) {
                $image_url = isset($product['image_url']) ? $product['image_url'] : null;
                $image_thumb_url = isset($product['image_thumb_url']) ? $product['image_thumb_url'] : null;
                $image_thumb_url = $image_thumb_url ? $image_thumb_url : $image_url;
                $price = isset($product['price']) ? $product['price'] : null;
                $title = isset($product['title']) ? $product['title'] : null;
                $url = isset($product['url']) ? $product['url'] : null;
                $buy_url = isset($product['buy_url']) ? $product['buy_url'] : null;
                $buy_url = $buy_url ? $buy_url : $url;
                $doc_url = isset($product['doc_url']) ? $product['doc_url'] : null;
                $demo_url = isset($product['demo_url']) ? $product['demo_url'] : null;
                $feature_list = null;
                $info_html = sprintf('<div class="rt-product-info">%s%s%s</div>',
                    $title ? sprintf("<h3 class='rt-product-title'><a href='%s' target='_blank'>%s%s</a></h3>", esc_url($url), $title, $price ? " ($" . $price . ")" : null) : null,
                    $feature_list,
                    $buy_url || $demo_url || $doc_url ?
                        sprintf(
                            '<div class="rt-product-action">%s%s%s</div>',
                            $buy_url ? sprintf('<a class="rt-buy button button-primary" href="%s" target="_blank">%s</a>', esc_url($buy_url), esc_html__('Buy', 'woo-product-variation-swatches')) : null,
                            $demo_url ? sprintf('<a class="rt-demo button" href="%s" target="_blank">%s</a>', esc_url($demo_url), esc_html__('Demo', 'woo-product-variation-swatches')) : null,
                            $doc_url ? sprintf('<a class="rt-doc button" href="%s" target="_blank">%s</a>', esc_url($doc_url), esc_html__('Documentation', 'woo-product-variation-swatches')) : null
                        )
                        : null
                );

                $htmlProducts .= sprintf(
                    '<div class="rt-product">%s%s</div>',
                    $image_thumb_url ? sprintf(
                        '<div class="rt-media"><img src="%s" alt="%s" /></div>',
                        esc_url($image_thumb_url),
                        esc_html($title)
                    ) : null,
                    $info_html
                );

            }

            $html = sprintf('<div class="rt-product-list">%s</div>', $htmlProducts);

        }

        return $html;
    }

    static function get_current_url($args = array()) {
        global $wp;

        return esc_url(trailingslashit(home_url(add_query_arg($args, $wp->request))));
    }


    public static function get_current_actual_url() {

        $current_url = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $current_url .= $_SERVER["SERVER_NAME"];
        if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
            $current_url .= ":" . $_SERVER["SERVER_PORT"];
        }
        $current_url .= $_SERVER["REQUEST_URI"];

        return $current_url;

    }

    /**
     * @param $count
     *
     * @return bool
     */
    static function archive_swatches_has_more($count) {
        $limit = absint(rtwpvs()->get_option('archive_swatches_display_limit'));
        $enable_single_attribute = (bool)rtwpvs()->get_option('archive_swatches_enable_single_attribute');

        if ($limit === 0 || !$enable_single_attribute) {
            return false;
        }

        return $limit <= $count;
    }

    static function archive_swatches_more($product_id) {
        if (function_exists('rtwpvs_archive_swatches_more')) {
            return rtwpvs_archive_swatches_more($product_id);
        }
        return sprintf('<div class="rtwpvs-term-more"><a href="%s">%s</a></div>', esc_url(get_permalink($product_id)), esc_html__('More', 'woo-product-variation-swatches'));
    }

}