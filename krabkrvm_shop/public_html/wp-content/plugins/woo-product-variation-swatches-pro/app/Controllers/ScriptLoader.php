<?php

namespace Rtwpvs\Controllers;


use Rtwpvs\Helpers\Options;

class ScriptLoader
{

    private $suffix;
    private $version;

    public function __construct() {
        $this->suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $this->version = defined('WP_DEBUG') ? time() : rtwpvs()->version();
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 15);
    }

    public function enqueue_scripts() {

        if (apply_filters('rtwpvs_disable_register_enqueue_scripts', false)) {
            return;
        }
        wp_register_script('rtwpvs', rtwpvs()->get_assets_uri("/js/rtwpvs{$this->suffix}.js"), array(
            'jquery',
            'wp-util'
        ), $this->version, true);
        wp_register_style('rtwpvs', rtwpvs()->get_assets_uri("/css/rtwpvs{$this->suffix}.css"), '', $this->version);
        wp_register_style('rtwpvs-tooltip', rtwpvs()->get_assets_uri("/css/rtwpvs-tooltip{$this->suffix}.css"), '', $this->version);

        wp_localize_script('rtwpvs', 'rtwpvs_params', apply_filters('rtwpvs_js_object', array(
            'is_product_page'                          => is_product(),
            'reselect_clear'                           => rtwpvs()->get_option('clear_on_reselect'),
            'archive_swatches'                         => rtwpvs()->get_option('archive_swatches'),
            'archive_swatches_enable_single_attribute' => rtwpvs()->get_option('archive_swatches_enable_single_attribute'),
            'archive_swatches_single_attribute'        => rtwpvs()->get_option('archive_swatches_single_attribute'),
            'archive_swatches_display_event'           => rtwpvs()->get_option('archive_swatches_display_event', 'click'),
            'archive_image_selector'                   => rtwpvs()->get_option('archive_swatches_image_selector', '.attachment-woocommerce_thumbnail, .wp-post-image'),
            'archive_add_to_cart_text'                 => apply_filters('rtwpvs_archive_add_to_cart_text', ''),
            'archive_add_to_cart_select_options'       => apply_filters('rtwpvs_archive_add_to_cart_select_options', ''),
            'archive_product_wrapper'                  => apply_filters('rtwpvs_archive_product_wrapper', '.rtwpvs-product'),
            'archive_add_to_cart_button_selector'      => apply_filters('rtwpvs_archive_add_to_cart_button_selector', ''),
            'enable_variation_url'                     => (bool)rtwpvs()->get_option('enable_variation_url'),
            'has_wc_bundles'                           => (bool)rtwpvs()->get_option('WC_Bundles'),
        )));

        if (apply_filters('rtwpvs_disable_enqueue_scripts', false)) {
            return;
        }
        if (rtwpvs()->get_option('load_scripts')) {
            if (is_product() || is_shop() || is_product_taxonomy()) {
                $this->load_scripts();
            }
            return;
        }

        $this->load_scripts();

    }

    private function load_scripts() {
        wp_enqueue_script('rtwpvs');
        wp_enqueue_script('wc-add-to-cart');
        wp_enqueue_script('wc-add-to-cart-variation');
        wp_enqueue_style('rtwpvs');
        if (rtwpvs()->get_option('tooltip')) {
            wp_enqueue_style('rtwpvs-tooltip');
        }
        $this->add_inline_style();
    }

    public function admin_enqueue_scripts() {
        global $post;
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
        if ((isset($_GET['post_type']) && $_GET['post_type'] == 'product' && isset($_GET['taxonomy'])) || $screen_id === 'product' || ((isset($_GET['page']) && $_GET['page'] == "wc-settings") && (isset($_GET['tab']) && $_GET['tab'] == "rtwpvs"))) {

            wp_enqueue_style('wp-color-picker');
            if (apply_filters('rtwpvs_disable_alpha_color_picker', false)) {
                wp_enqueue_script('wp-color-picker');
            } else {
                wp_enqueue_script('wp-color-picker-alpha', rtwpvs()->get_assets_uri("/js/wp-color-picker-alpha{$this->suffix}.js"), ['wp-color-picker'], '2.1.4', true);
                $colorpicker_l10n = [
                    'clear'            => __('Clear', 'woo-product-variation-swatches'),
                    'defaultString'    => __('Default', 'woo-product-variation-swatches'),
                    'pick'             => __('Select Color', 'woo-product-variation-swatches'),
                    'clearAriaLabel'   => __("Clear color", 'woo-product-variation-swatches'),
                    'defaultAriaLabel' => __("Select default color", 'woo-product-variation-swatches'),
                    'defaultLabel'     => __("Color value", 'woo-product-variation-swatches'),
                ];
                wp_localize_script('wp-color-picker-alpha', 'wpColorPickerL10n', $colorpicker_l10n);
            }
            wp_enqueue_script('rt-dependency', rtwpvs()->get_assets_uri("/js/rt-dependency{$this->suffix}.js"), array('jquery'), $this->version, true);
            wp_enqueue_script('rtwpvs-admin', rtwpvs()->get_assets_uri("/js/admin{$this->suffix}.js"), array('jquery'), $this->version, true);
            wp_enqueue_style('rtwpvs-admin', rtwpvs()->get_assets_uri("/css/admin{$this->suffix}.css"), '', $this->version);

            wp_localize_script('rtwpvs-admin', 'rtwpvs_admin', array(
                'media_title'     => esc_html__('Choose an Image', 'woo-product-variation-swatches'),
                'button_title'    => esc_html__('Use Image', 'woo-product-variation-swatches'),
                'add_media'       => esc_html__('Add Media', 'woo-product-variation-swatches'),
                'reset_notice'    => esc_html__('Are you sure to reset', 'woo-product-variation-swatches'),
                'ajaxurl'         => esc_url(admin_url('admin-ajax.php', 'relative')),
                'nonce'           => wp_create_nonce('rtwpvs_nonce'),
                'post_id'         => $screen_id === 'product' ? $post->ID : null,
                'attribute_types' => Options::get_available_attributes_types()
            ));

        }
    }

    public function add_inline_style() {
        if (apply_filters('rtwpvs_disable_inline_style', false)) {
            return;
        }
        $width = rtwpvs()->get_option('width');
        $height = rtwpvs()->get_option('height');
        $font_size = rtwpvs()->get_option('single_font_size', 16);
        $archive_width = rtwpvs()->get_option('archive_swatches_width');
        $archive_height = rtwpvs()->get_option('archive_swatches_height');
        $archive_font_size = rtwpvs()->get_option('archive_swatches_font_size');
        $tooltip_background = rtwpvs()->get_option('tooltip_background');

        // Attribute item style
        $border_color = rtwpvs()->get_option('border_color', 'rgba(0, 0, 0, 0.3)');
        $border_size = absint(rtwpvs()->get_option('border_size', 1));
        $text_color = rtwpvs()->get_option('text_color', '#000000');
        $background_color = rtwpvs()->get_option('background_color', '#FFFFFF');

        // Attribute item hover
        $hover_border_color = rtwpvs()->get_option('hover_border_color', '#000000');
        $hover_border_size = absint(rtwpvs()->get_option('hover_border_size', 3));
        $hover_text_color = rtwpvs()->get_option('hover_text_color', '#000000');
        $hover_background_color = rtwpvs()->get_option('hover_background_color', '#FFFFFF');

        // Attribute item selected
        $selected_border_color = rtwpvs()->get_option('selected_border_color', '#000000');
        $selected_border_size = absint(rtwpvs()->get_option('selected_border_size', 2));
        $selected_text_color = rtwpvs()->get_option('selected_text_color', '#000000');
        $selected_background_color = rtwpvs()->get_option('selected_background_color', '#FFFFFF');

        ob_start();
        ?>
        <style type="text/css">
            .rtwpvs-term:not(.rtwpvs-radio-term) {
                width: <?php echo $width ?>px;
                height: <?php echo $height ?>px;
            }

            /* Attribute style */
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term) {
                box-shadow: 0 0 0 <?php echo $border_size?>px <?php echo $border_color?> !important;
            }

            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-button-term span,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-radio-term label,
            .rtwpvs .rtwpvs-terms-wrapper .reset_variations a {
                color: <?php echo $text_color?> !important;
            }

            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.radio-variable-item) {
                background-color: <?php echo $background_color?> !important;
            }

            /*  Attribute selected style  */
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-button-term.selected span,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-radio-term.selected label {
                color: <?php echo $selected_text_color?> !important;
            }

            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term).selected {
                background-color: <?php echo $selected_background_color?> !important;
            }

            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term).selected {
                box-shadow: 0 0 0 <?php echo $selected_border_size?>px <?php echo $selected_border_color?> !important;
            }

            /*  Attribute Hover style  */
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term):hover,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term).selected:hover {
                box-shadow: 0 0 0 <?php echo $hover_border_size?>px <?php echo $hover_border_color?> !important;
            }

            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-button-term:hover span,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-button-term.selected:hover span,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-radio-term:hover label,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-radio-term.selected:hover label {
                color: <?php echo $hover_text_color?> !important;
            }

            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term):hover,
            .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-term:not(.rtwpvs-radio-term).selected:hover {
                background-color: <?php echo $hover_background_color?> !important;
            }


            <?php if($archive_width || $archive_height) : ?>
            .rtwpvs-archive-variation-wrapper .rtwpvs-term:not(.rtwpvs-radio-term) {
            <?php if($archive_width) {?> width: <?php echo $archive_width ?>px;
            <?php }?><?php if($archive_height) {?> height: <?php echo $archive_height ?>px;
            <?php }?>
            }

            <?php endif; ?>

            .rtwpvs-squared .rtwpvs-button-term {
                min-width: <?php echo $width ?>px;
            }

            .rtwpvs-button-term span {
                font-size: <?php echo $font_size ?>px;
            }

            <?php if($archive_font_size): ?>
            .rtwpvs-archive-variation-wrapper .rtwpvs-button-term span {
                font-size: <?php echo $archive_font_size ?>px;
            }

            <?php endif; ?>

            <?php if($tooltip_background): ?>
            .rtwpvs.rtwpvs-tooltip .rtwpvs-terms-wrapper .rtwpvs-term .image-tooltip-wrapper {
                border-color: <?php echo $tooltip_background; ?> !important;
                background-color: <?php echo $tooltip_background; ?> !important;
            }

            .rtwpvs-terms-wrapper .image-tooltip-wrapper:after {
                border-top-color: <?php echo $tooltip_background; ?> !important;
            }

            .rtwpvs.rtwpvs-tooltip .rtwpvs-terms-wrapper .rtwpvs-term[data-rtwpvs-tooltip]:not(.disabled)::before {
                background-color: <?php echo $tooltip_background; ?>;
            }

            .rtwpvs.rtwpvs-tooltip .rtwpvs-terms-wrapper .rtwpvs-term[data-rtwpvs-tooltip]:not(.disabled)::after {
                border-top: 5px solid<?php echo $tooltip_background; ?>;
            }

            <?php endif; ?>
            <?php if($tooltip_text_color = rtwpvs()->get_option( 'tooltip_text_color' )): ?>
            .rtwpvs.rtwpvs-tooltip .rtwpvs-terms-wrapper .rtwpvs-term[data-rtwpvs-tooltip]:not(.disabled)::before {
                color: <?php echo $tooltip_text_color; ?>;
            }

            <?php endif; ?>
            <?php if($tooltip_image_width = rtwpvs()->get_option( 'tooltip_image_width', 150 )): ?>
            .rtwpvs.rtwpvs-tooltip .rtwpvs-terms-wrapper span.image-tooltip-wrapper {
                width: <?php echo $tooltip_image_width; ?>px;
            }

            <?php endif; ?>
            <?php if($cross_color = rtwpvs()->get_option( 'attribute_behaviour_cross_color' )): ?>
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled::before,
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled::after,
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled:hover::before,
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled:hover::after {
                background: <?php echo $cross_color; ?> !important;
            }

            <?php endif; ?>
            <?php if($blur_opacity = rtwpvs()->get_option( 'attribute_behaviour_blur_opacity' )): ?>
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled img,
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled span,
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled:hover img,
            .rtwpvs.rtwpvs-attribute-behavior-blur .rtwpvs-term:not(.rtwpvs-radio-term).disabled:hover span {
                opacity: <?php echo $blur_opacity; ?>;
            }

            <?php endif; ?>
        </style>
        <?php
        $css = ob_get_clean();
        $css = str_ireplace(array('<style type="text/css">', '</style>'), '', $css);

        $css = apply_filters('rtwpvs_inline_style', $css);
        wp_add_inline_style('rtwpvs', $css);
    }

}