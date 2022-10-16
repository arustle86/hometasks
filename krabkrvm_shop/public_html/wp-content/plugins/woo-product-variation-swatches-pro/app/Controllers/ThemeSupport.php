<?php

namespace Rtwpvs\Controllers;

class ThemeSupport
{
    public function __construct() {
        // Claue Theme
        // add_action('init', array(__CLASS__, 'jas_claue_theme_support'), 20);

        // UnCode Theme
        add_action('init', array(__CLASS__, 'uncode_theme_support'), 20);

        // Woodstock Theme
        add_action('init', array(__CLASS__, 'woodstock_theme_support'), 20);

        //Salient Theme Material Style
        add_action('init', array(__CLASS__, 'salient_theme_support'), 20);

        // Atelier Theme
        add_action('init', array(__CLASS__, 'atelier_theme_support'), 20);

        // WOODMART Theme
        add_action('init', array(__CLASS__, 'woodmart_theme_support'), 20);

        // Ecome Theme
        // add_action( 'init', array(__CLASS__, 'ecome_theme_support'), 20 );

        // ShopIsle Theme
        add_action('wp_enqueue_scripts', array(__CLASS__, 'shopisle_theme_support'), 20);

        // Adiva Theme
        add_action('init', array(__CLASS__, 'adiva_theme_support'));

        // OceanWP Theme
        add_action('init', array(__CLASS__, 'oceanwp_theme_support'));
    }

    static function oceanwp_theme_support() {
        if (class_exists('OCEANWP_Theme_Class')) {

            add_filter('wp_get_attachment_image_attributes', function ($attr) {
                $attr['class'] .= ' wp-post-image';

                return $attr;
            });
        }
    }

    static function adiva_theme_support() {
        if (function_exists('adiva_setup')) {

            add_filter('rtwpvs_archive_add_to_cart_select_options', function () {
                return '<span class="tooltip">' . __('Select options', 'woocommerce') . '</span>';
            });

            add_filter('rtwpvs_archive_add_to_cart_text', function () {
                return '<span class="tooltip">' . __('Add to cart', 'woocommerce') . '</span>';
            });
        }
    }

    static function shopisle_theme_support() {
        wp_dequeue_script('shop-isle-navigation');
    }

    static function ecome_theme_support() {
    }

    static function woodmart_theme_support() {
        if (class_exists('WOODMART_Theme')) {

            add_filter('rtwpvs_archive_add_to_cart_select_options', function () {
                return '<span>' . __('Select options', 'woodmart') . '</span>';
            });

            add_filter('rtwpvs_archive_add_to_cart_text', function () {
                return '<span>' . __('Add to cart', 'woodmart') . '</span>';
            });
        }
    }

    static function atelier_theme_support() {
        if (function_exists('sf_atelier_setup')) {

            add_filter('rtwpvs_archive_add_to_cart_select_options', function () {
                return '<i class="sf-icon-variable-options"></i><span>' . apply_filters('variable_add_to_cart_text', __('Select options', 'swiftframework')) . '</span>';
            });

            add_filter('rtwpvs_archive_add_to_cart_text', function () {
                return apply_filters('add_to_cart_icon', '<i class="sf-icon-add-to-cart"></i>') . '<span>' . apply_filters('add_to_cart_text', __('Add to cart', 'swiftframework')) . '</span>';
            });

        }
    }

    static function salient_theme_support() {
        if (function_exists('get_nectar_theme_options')) {


            $options = get_nectar_theme_options();
            $product_style = (!empty($options['product_style'])) ? $options['product_style'] : 'classic';

            if ('material' == $product_style) {
                add_filter('rtwpvs_archive_add_to_cart_select_options', function () {
                    return '<span>' . __('Select options', 'woodmart') . '</span>';
                });

                add_filter('rtwpvs_archive_add_to_cart_text', function () {
                    return '<span>' . __('Add to cart', 'woodmart') . '</span>';
                });
            }

        }
    }

    static function woodstock_theme_support() {
        if (function_exists('woodstock_setup')) {
            add_filter('rtwpvs_archive_product_wrapper', function () {
                return '.product-item';
            });

            add_filter('rtwpvs_archive_add_to_cart_text', function () {
                return '<span class="button-loader"></span>' . __('Add to cart', 'woocommerce');
            });
        }
    }

    static function uncode_theme_support() {
        if (function_exists('uncode_setup')) {
            add_filter('rtwpvs_archive_add_to_cart_button_selector', array(__CLASS__, 'uncode_theme_archive_image_selector'));
            add_filter('rtwpvs_archive_image_selector', array(__CLASS__, 'uncode_theme_archive_image_selector'));
        }
    }

    static function uncode_theme_archive_image_selector() {
        return '.pushed img';
    }

    static function uncode_theme_archive_add_to_cart_button_selector() {
        return '.add_to_cart_button';
    }

    static function jas_claue_theme_support() {
        if (function_exists('jas_claue_setup')) {
        }
    }
}