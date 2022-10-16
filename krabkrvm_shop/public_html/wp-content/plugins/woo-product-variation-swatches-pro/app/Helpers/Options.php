<?php

namespace Rtwpvs\Helpers;

class Options
{

    static function get_available_attributes_types($type = false) {
        $types = array(
            'color'  => esc_html__('Color', 'woo-product-variation-swatches'),
            'image'  => esc_html__('Image', 'woo-product-variation-swatches'),
            'button' => esc_html__('Button', 'woo-product-variation-swatches'),
            'radio'  => esc_html__('Radio', 'woo-product-variation-swatches')
        );

        $types = apply_filters('rtwpvs_available_attributes_types', $types);

        if ($type) {
            return isset($types[$type]) ? $types[$type] : null;
        }

        return $types;
    }

    public static function get_taxonomy_meta_fields($field_id = false) {

        $fields = array();
        $common_fields = array(
            array(
                'label'   => esc_html__('Show Tooltip', 'woo-product-variation-swatches'),
                'desc'    => esc_html__('Individually show hide tooltip.', 'woo-product-variation-swatches'),
                'id'      => 'rtwpvs_attribute_tooltip',
                'type'    => 'select',
                'options' => array(
                    'text'  => esc_html__("Text", "woo-product-variation-swatches"),
                    'image' => esc_html__("Image", "woo-product-variation-swatches"),
                    'no'    => esc_html__("No", "woo-product-variation-swatches")
                )
            ),
            array(
                'label' => esc_html__('Tooltip Text', 'woo-product-variation-swatches'),
                'desc'  => esc_html__('By default tooltip text will be the term name.', 'woo-product-variation-swatches'),
                'id'    => 'rtwpvs_attribute_tooltip_text',
                'type'  => 'text',
                'class' => 'rtwpvs-hidden',
            ),
            array(
                'label' => esc_html__('Tooltip Image', 'woo-product-variation-swatches'),
                'desc'  => esc_html__('Choose an image for tooltip.', 'woo-product-variation-swatches'),
                'id'    => 'rtwpvs_attribute_tooltip_image',
                'type'  => 'image',
                'class' => 'rtwpvs-hidden'
            )
        );

        $fields['color'] = array_merge(
            array(
                array(
                    'label' => esc_html__('Color', 'woo-product-variation-swatches'),
                    'desc'  => esc_html__('Choose a color', 'woo-product-variation-swatches'),
                    'id'    => 'product_attribute_color',
                    'type'  => 'color'
                ),
                array(
                    'label'         => esc_html__('Dual Color', 'woo-product-variation-swatches'),
                    'trigger_label' => esc_html__('Enable', 'woo-product-variation-swatches'),
                    'id'            => 'is_dual_color',
                    'type'          => 'checkbox'
                ),
                array(
                    'label'      => esc_html__('Secondary Color', 'woo-product-variation-swatches'),
                    'desc'       => esc_html__('Add term secondary color', 'woo-product-variation-swatches'),
                    'id'         => 'secondary_color',
                    'type'       => 'color',
                    'dependency' => array(
                        array('#is_dual_color' => array('type' => 'equal', 'value' => 'yes'))
                    )
                )
            ), $common_fields
        );

        $fields['image'] = array_merge(
            array(
                array(
                    'label' => esc_html__('Image', 'woo-product-variation-swatches'), // <label>
                    'desc'  => esc_html__('Choose an Image', 'woo-product-variation-swatches'), // description
                    'id'    => 'product_attribute_image',
                    'type'  => 'image'
                )
            ), $common_fields
        );
        $fields['button'] = $common_fields;
        $fields['radio'] = $common_fields;

        $fields = apply_filters('rtwpvs_get_product_taxonomy_meta_fields', $fields);

        if ($field_id) {
            return isset($fields[$field_id]) ? $fields[$field_id] : array();
        }

        return $fields;

    }

    public static function get_settings_sections() {
        $fields = array(
            'general'         => array(
                'id'     => 'general',
                'title'  => esc_html__('General', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('Simple change some visual styles', 'woo-product-variation-swatches'),
                'active' => apply_filters('rtwpvs_general_setting_active', true),
                'fields' => apply_filters('rtwpvs_general_setting_fields', array(
                    array(
                        'id'      => 'tooltip',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Enable Tooltip', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Enable / Disable plugin default tooltip on each product attribute.', 'woo-product-variation-swatches'),
                        'default' => true
                    ),
                    array(
                        'id'      => 'style',
                        'type'    => 'radio',
                        'title'   => esc_html__('Shape style', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Attribute Shape Style', 'woo-product-variation-swatches'),
                        'options' => array(
                            'rounded' => esc_html__('Rounded Shape', 'woo-product-variation-swatches'),
                            'squared' => esc_html__('Squared Shape', 'woo-product-variation-swatches')
                        ),
                        'default' => 'rounded'
                    ),
                    array(
                        'id'      => 'attribute_image_size',
                        'type'    => 'select',
                        'title'   => esc_html__('Attribute image size', 'woo-product-variation-swatches'),
                        'desc'    => has_filter('rtwpvs_product_attribute_image_size') ? __('<span style="color: red">Attribute image size changed by <code>rtwpvs_product_attribute_image_size</code> hook. So this option will not apply any effect.</span>', 'woo-product-variation-swatches') : __(sprintf('Choose attribute image size. <a target="_blank" href="%s">Media Settings</a>', esc_url(admin_url('options-media.php'))), 'woo-product-variation-swatches'),
                        'options' => Functions::get_all_image_sizes(),
                        'default' => 'thumbnail'
                    ),
                    array(
                        'id'      => 'width',
                        'type'    => 'number',
                        'title'   => esc_html__('Width', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Variation item width', 'woo-product-variation-swatches'),
                        'default' => 30,
                        'min'     => 10,
                        'max'     => 200,
                        'suffix'  => 'px'
                    ),
                    array(
                        'id'      => 'height',
                        'type'    => 'number',
                        'title'   => esc_html__('Height', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Variation item height', 'woo-product-variation-swatches'),
                        'default' => 30,
                        'min'     => 10,
                        'max'     => 200,
                        'suffix'  => 'px'
                    ),
                    array(
                        'id'      => 'single_font_size',
                        'type'    => 'number',
                        'title'   => esc_html__('Font Size', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Single product variation item font size', 'woo-product-variation-swatches'),
                        'default' => 16,
                        'min'     => 8,
                        'max'     => 24,
                        'suffix'  => 'px'
                    ),
                    array(
                        'id'    => 'tooltip_options_title',
                        'type'  => 'title',
                        'title' => esc_html__('Tooltip Options', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Tooltip settings for single page and catalog mode on shop / archive pages', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'      => 'tooltip_image_size',
                        'type'    => 'select',
                        'title'   => esc_html__('Tooltip image size', 'woo-product-variation-swatches'),
                        'desc'    => has_filter('rtwpvs_tooltip_image_size') ? __('<span style="color: red">Tooltip image size changed by <code>rtwpvs_tooltip_image_size</code> hook. So this option will not apply any effect.</span>', 'woo-product-variation-swatches') : __(sprintf('Choose tooltip image size. <a target="_blank" href="%s">Media Settings</a> Default (Thumbnail)', esc_url(admin_url('options-media.php'))), 'woo-product-variation-swatches'),
                        'options' => Functions::get_all_image_sizes(),
                        'default' => 'thumbnail'
                    ),
                    array(
                        'id'      => 'tooltip_image_width',
                        'type'    => 'number',
                        'title'   => esc_html__('Tooltip Image Width', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Tooltip Image width', 'woo-product-variation-swatches'),
                        'default' => 150,
                        'min'     => 50,
                        'max'     => 800,
                        'suffix'  => 'px'
                    )
                ))
            ),
            'advanced'        => array(
                'id'     => 'advanced',
                'title'  => esc_html__('Advanced', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('Advanced change some visual styles', 'woo-product-variation-swatches'),
                'active' => apply_filters('rtwpvs_advanced_setting_active', false),
                'fields' => apply_filters('rtwpvs_advanced_setting_fields', array(
                    array(
                        'id'      => 'clear_on_reselect',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Clear on Reselect', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Clear selected attribute on select again', 'woo-product-variation-swatches'),
                        'default' => false
                    ),
                    array(
                        'id'      => 'threshold',
                        'type'    => 'number',
                        'title'   => esc_html__('Ajax variation threshold', 'woo-product-variation-swatches'),
                        'desc'    => __('Default value is <code>30</code>, If you want all product variation set it to <code>1</code> then all variation will be load via ajax.<br><span style="color: red">Note: It\'s recommended to keep this number between 30 - 40.</span>', 'woo-product-variation-swatches'),
                        'default' => 30,
                        'min'     => 1,
                        'max'     => 400,
                    ),
                    array(
                        'id'      => 'disable_out_of_stock',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Out of stock for variation', 'woo-product-variation-swatches'),
                        'desc'    => __('Disable out of stock for variation product attribute item<br><span style="color: red">Note: Will not work if you set Ajax variation threshold to 1.</span>', 'woo-product-variation-swatches'),
                        'default' => true
                    ),
                    array(
                        'id'      => 'enable_variation_url',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Variation url', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Generate url based on selected variation attributes.', 'woo-product-variation-swatches'),
                        'default' => false
                    ),
                    array(
                        'id'      => 'attribute_behavior',
                        'type'    => 'radio',
                        'title'   => esc_html__('Attribute behavior', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Disabled attribute will be hide / blur.', 'woo-product-variation-swatches'),
                        'options' => array(
                            'blur'          => esc_html__('Blur with cross', 'woo-product-variation-swatches'),
                            'blur-no-cross' => esc_html__('Blur without cross', 'woo-product-variation-swatches'),
                            'hide'          => esc_html__('Hide', 'woo-product-variation-swatches'),
                        ),
                        'default' => 'blur'
                    )
                ))
            ),
            'style'           => array(
                'id'     => 'style',
                'title'  => esc_html__('Style', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('Advanced change some visual styles', 'woo-product-variation-swatches'),
                'active' => apply_filters('rtwpvs_style_setting_active', false),
                'fields' => apply_filters('rtwpvs_style_setting_fields', array(
                    array(
                        'id'      => 'tooltip_background',
                        'type'    => 'color',
                        'title'   => esc_html__('Tooltip background', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Tooltip background color', 'woo-product-variation-swatches'),
                        'default' => '',
                        'alpha'   => true
                    ),
                    array(
                        'id'      => 'tooltip_text_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Tooltip text color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Tooltip text color', 'woo-product-variation-swatches'),
                        'default' => '',
                    ),
                    array(
                        'id'    => 'title_item_styling',
                        'type'  => 'title',
                        'title' => esc_html__('Attribute item styling', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Change attribute item display style', 'woo-product-variation-swatches'),
                    ),
                    array(
                        'id'      => 'border_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Border color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches item border color. Default is: rgba(0, 0, 0, 0.3)', 'woo-product-variation-swatches'),
                        'default' => 'rgba(0, 0, 0, 0.3)',
                        'alpha'   => true,
                    ),
                    array(
                        'id'      => 'border_size',
                        'type'    => 'number',
                        'title'   => esc_html__('Border size', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item border size. Default is: 1', 'woo-product-variation-swatches'),
                        'default' => 1,
                        'min'     => 1,
                        'max'     => 5,
                        'suffix'  => esc_html__('px', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'      => 'text_color',
                        'type'    => 'color',
                        'title'   => esc_html__('text color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item text color. Default is: #000000', 'woo-product-variation-swatches'),
                        'default' => '#000000',
                        'alpha'   => true
                    ),
                    array(
                        'id'      => 'background_color',
                        'type'    => 'color',
                        'title'   => esc_html__('background color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item background color. Default is: #FFFFFF', 'woo-product-variation-swatches'),
                        'default' => '#FFFFFF',
                        'alpha'   => true
                    ),
                    array(
                        'id'    => 'title_attribute_item_hover_styling',
                        'type'  => 'title',
                        'title' => esc_html__('Attribute item Hover Styling', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Change attribute item hover display style', 'woo-product-variation-swatches'),
                    ),
                    array(
                        'id'      => 'hover_border_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Hover border color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item hover border color. Default is: #000000', 'woo-product-variation-swatches'),
                        'default' => '#000000',
                        'alpha'   => true
                    ),
                    array(
                        'id'      => 'hover_border_size',
                        'type'    => 'number',
                        'title'   => esc_html__('Hover border size', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item hover border size. Default is: 3', 'woo-product-variation-swatches'),
                        'default' => 3,
                        'min'     => 1,
                        'max'     => 5,
                        'suffix'  => esc_html__('px', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'      => 'hover_text_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Hover text color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item hover text color. Default is: #000000', 'woo-product-variation-swatches'),
                        'default' => '#000000',
                        'alpha'   => true
                    ),
                    array(
                        'id'      => 'hover_background_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Hover background color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches attribute item hover background color. Default is: #FFFFFF', 'woo-product-variation-swatches'),
                        'default' => '#FFFFFF',
                        'alpha'   => true
                    ),
                    array(
                        'id'    => 'title_attribute_item_selected_styling',
                        'type'  => 'title',
                        'title' => esc_html__('Attribute item Selected Styling', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Change attribute selected item display style', 'woo-product-variation-swatches'),
                    ),
                    array(
                        'id'      => 'selected_border_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Border color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches selected item border color. Default is: #000000', 'woo-product-variation-swatches'),
                        'default' => '#000000',
                        'alpha'   => true
                    ),
                    array(
                        'id'      => 'selected_border_size',
                        'type'    => 'number',
                        'title'   => esc_html__('Border size', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches selected item border size. Default is: 2', 'woo-product-variation-swatches'),
                        'default' => 2,
                        'min'     => 1,
                        'max'     => 5,
                        'suffix'  => esc_html__('px', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'      => 'selected_text_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Text color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches item selected text color. Default is: #000000', 'woo-product-variation-swatches'),
                        'default' => '#000000',
                        'alpha'   => true
                    ),
                    array(
                        'id'      => 'selected_background_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Background color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches item selected background color. Default is: #FFFFFF', 'woo-product-variation-swatches'),
                        'default' => '#FFFFFF',
                        'alpha'   => true
                    ),
                    array(
                        'id'    => 'title_attribute_behaviour',
                        'type'  => 'title',
                        'title' => esc_html__('Attribute behavior', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('This will work for (blur and blur-no-cross)', 'woo-product-variation-swatches'),
                    ),
                    array(
                        'id'      => 'attribute_behaviour_cross_color',
                        'type'    => 'color',
                        'title'   => esc_html__('Cross background color', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Cross background color for disabled item', 'woo-product-variation-swatches'),
                        'default' => '#ff0000'
                    ),
                    array(
                        'id'      => 'attribute_behaviour_blur_opacity',
                        'type'    => 'number',
                        'title'   => esc_html__('Blur Opacity', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Blur Opacity for disabled item range[.1 to 1]', 'woo-product-variation-swatches'),
                        'default' => .3,
                        'step'    => "0.1",
                        'min'     => .1,
                        'max'     => 1,
                    ),
                ))
            ),
            'archive'         => array(
                'id'     => 'archive',
                'title'  => esc_html__('Archive / Shop', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('Advanced settings on shop / archive pages', 'woo-product-variation-swatches'),
                'fields' => apply_filters('rtwpvs_archive_setting_fields', array(
                    array(
                        'id'      => 'archive_swatches',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Enable Swatches', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Show swatches on archive / shop page.', 'woo-product-variation-swatches'),
                        'default' => true
                    ),
                    array(
                        'id'      => 'archive_swatches_image_selector',
                        'type'    => 'text',
                        'title'   => esc_html__('Image Selector', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Archive product image selector to show variation image. You can also use multiple selectors separated by comma (.attachment-woocommerce_thumbnail, .wp-post-image) ', 'woo-product-variation-swatches'),
                        'default' => '.wp-post-image, .attachment-woocommerce_thumbnail'
                    ),
                    array(
                        'id'      => 'archive_swatches_position',
                        'type'    => 'radio',
                        'title'   => esc_html__('Swatches position', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Show archive swatches position.', 'woo-product-variation-swatches') . "<br/>" . __('<span style="color: red">Some theme remove woocommerce default hook, in that case this may not work with some theme.</span>', 'woo-product-variation-swatches'),
                        'options' => Options::get_archive_swatches_positions(),
                        'default' => 'after_title_and_price'
                    ),
                    array(
                        'id'      => 'archive_swatches_align',
                        'type'    => 'select',
                        'title'   => esc_html__('Swatches align', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Swatches align on archive page.', 'woo-product-variation-swatches'),
                        'options' => Options::get_archive_swatches_aligns(),
                        'default' => 'left'
                    ),
                    array(
                        'id'      => 'archive_swatches_tooltip',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Enable Tooltip', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Show tooltip on archive / shop page', 'woo-product-variation-swatches'),
                        'default' => true
                    ),
                    array(
                        'id'      => 'show_clear_on_archive',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Show clear link', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Show clear link on archive / shop page.', 'woo-product-variation-swatches'),
                        'default' => true
                    ),
                    array(
                        'id'      => 'archive_swatches_width',
                        'type'    => 'number',
                        'title'   => esc_html__('Item Width', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Variation item width on archive / shop page', 'woo-product-variation-swatches'),
                        'default' => 30,
                        'min'     => 10,
                        'max'     => 200,
                        'suffix'  => 'px'
                    ),
                    array(
                        'id'      => 'archive_swatches_height',
                        'type'    => 'number',
                        'title'   => esc_html__('Item Height', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Variation item height on archive / shop page', 'woo-product-variation-swatches'),
                        'default' => 30,
                        'min'     => 10,
                        'max'     => 200,
                        'suffix'  => 'px'
                    ),
                    array(
                        'id'      => 'archive_swatches_font_size',
                        'type'    => 'number',
                        'title'   => esc_html__('Item Font Size', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Variation item font size on archive / shop page', 'woo-product-variation-swatches'),
                        'default' => 16,
                        'min'     => 8,
                        'max'     => 24,
                        'suffix'  => 'px'
                    ),
                    array(
                        'id'    => 'archive_special_attribute_title',
                        'type'  => 'title',
                        'title' => esc_html__('Special Attribute', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Show single attribute as catalog mode on shop / archive pages', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'    => 'archive_swatches_enable_single_attribute',
                        'type'  => 'checkbox',
                        'title' => esc_html__('Show Single Attribute', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Show single attribute taxonomies on archive page.', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'      => 'archive_swatches_single_attribute',
                        'type'    => 'select',
                        'title'   => esc_html__('Chose Attribute', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Choose an attribute to show on catalog mode', 'woo-product-variation-swatches'),
                        'options' => Functions::get_wc_attributes(esc_html__(' - Choose Attribute - ', 'woo-product-variation-swatches'))
                    ),
                    array(
                        'id'      => 'archive_swatches_display_event',
                        'type'    => 'select',
                        'title'   => esc_html__('Catalog Mode Display Event', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Show catalog mode image display event.', 'woo-product-variation-swatches'),
                        'options' => array(
                            'click' => esc_html__("on Click", 'woo-product-variation-swatches'),
                            'hover' => esc_html__("on Hover", 'woo-product-variation-swatches')
                        ),
                        'default' => 'click'
                    ),
                    array(
                        'id'      => 'archive_swatches_display_limit',
                        'type'    => 'number',
                        'size'    => 'tiny',
                        'title'   => esc_html__('Attribute display limit', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Catalog mode attribute display limit. Default is 0. Means no limit.', 'woo-product-variation-swatches'),
                        'default' => 0
                    ),
                ))
            ),
            'tools'           => array(
                'id'     => 'tools',
                'title'  => esc_html__('Tools', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('Tools define some system tasks', 'woo-product-variation-swatches'),
                'active' => apply_filters('rtwpvs_tools_setting_active', false),
                'fields' => apply_filters('rtwpvs_tools_setting_fields', array(
                    array(
                        'id'    => 'remove_all_data',
                        'type'  => 'checkbox',
                        'title' => esc_html__('Enable to delete all data', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__('Enable / Disable Allow to delete all data for WooCommerce Product variation plugin during delete this plugin', 'woo-product-variation-swatches')
                    ),
                    array(
                        'id'    => 'archive_special_attribute_title',
                        'type'  => 'title',
                        'title' => esc_html__('Performance', 'woo-product-variation-swatches'),
                        'desc'  => __('Improve your site performance.', 'woo-product-variation-swatches') . sprintf(__('You can remove all cache from here. <a href="%s">Clear all cache</a>', 'woo-product-variation-swatches'), add_query_arg([
                                '_wpnonce'                   => wp_create_nonce('rtwpvs_clear_all_cache'),
                                'rtwpvs_clear_all_transient' => ''
                            ], Functions::get_current_actual_url()))
                    ),
                    array(
                        'id'      => 'load_scripts',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Load Scripts', 'woo-product-variation-swatches'),
                        'desc'    => __('Only <strong>Single product</strong> and <strong>Product archive</strong> pages. [if unchecked then it will load the scripts to all over the site]', 'woo-product-variation-swatches'),
                        'default' => false
                    ),
                    array(
                        'id'      => 'defer_load_js',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Defer Load JS', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Defer Load JS for PageSpeed Score', 'woo-product-variation-swatches'),
                        'default' => false
                    ),
                    array(
                        'id'      => 'use_cache',
                        'type'    => 'checkbox',
                        'title'   => esc_html__('Use Cache', 'woo-product-variation-swatches'),
                        'desc'    => esc_html__('Use Transient Cache for PageSpeed Score', 'woo-product-variation-swatches'),
                        'default' => false
                    )
                ))
            ),
            'license'         => array(
                'id'     => 'license',
                'title'  => esc_html__('License', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('Add your licence code here', 'woo-product-variation-swatches'),
                'active' => apply_filters('rtwpvs_tools_setting_active', false),
                'fields' => apply_filters('rtwpvs_tools_setting_fields', array(
                    array(
                        'id'    => 'license_key',
                        'type'  => 'text',
                        'title' => esc_html__('Licence key', 'woo-product-variation-swatches'),
                        'desc'  => esc_html__("Enter your licence key here", "woo-product-variation-swatches")
                    )
                ))
            ),
            'premium_plugins' => array(
                'id'     => 'premium_plugins',
                'title'  => esc_html__('Related Plugins', 'woo-product-variation-swatches'),
                'desc'   => esc_html__('You can try our premium plugins', 'woo-product-variation-swatches'),
                'fields' => apply_filters('rtwpvs_premium_plugins_setting_fields', array(
                    array(
                        'id'         => 'premium_feature',
                        'type'       => 'feature',
                        'attributes' => array(
                            'class' => 'rt-feature'
                        ),
                        'html'       => Functions::get_product_list_html(array(
                            'rtwpvg-pro' => array(
                                'price'     => 29,
                                'title'     => "Variation Images Gallery for WooCommerce PRO",
                                'image_url' => rtwpvs()->get_images_uri('rtwpvg-pro.png'),
                                'url'       => 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery/',
                                'demo_url'  => 'https://radiustheme.com/demo/wordpress/woopluginspro/product/woocommerce-variation-images-gallery/',
                                'buy_url'   => 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery/',
                                'doc_url'   => 'https://www.radiustheme.com/how-to-use-woocommerce-variation-images-gallery-pro/'
                            ),
                            'metro'      => array(
                                'title'     => "Metro – Minimal WooCommerce WordPress Theme",
                                'image_url' => rtwpvs()->get_images_uri('metro.jpg'),
                                'url'       => 'https://www.radiustheme.com/downloads/metro-minimal-woocommerce-wordpress-theme/',
                                'demo_url'  => 'https://www.radiustheme.com/demo/wordpress/themes/metro/preview/',
                                'buy_url'   => 'https://www.radiustheme.com/downloads/metro-minimal-woocommerce-wordpress-theme/',
                                'doc_url'   => 'https://www.radiustheme.com/demo/wordpress/themes/metro/docs/'
                            )
                        ))
                    )
                ))
            )
        );

        return apply_filters('rtwpvs_settings_fields', $fields);
    }

    public static function get_archive_swatches_positions() {
        $positions = array(
            'after_title_and_price'      => esc_html__('After item title and price', 'woo-product-variation-swatches'),
            'before_title_and_price'     => esc_html__('Before item title and price', 'woo-product-variation-swatches'),
            'after_select_option_button' => esc_html__('After select options button', 'woo-product-variation-swatches'),

        );

        return apply_filters('rtwpvs_archive_swatches_positions', $positions);
    }

    public static function get_archive_swatches_aligns() {
        $aligns = array(
            'left'   => esc_html__('Left', 'woo-product-variation-swatches'),
            'right'  => esc_html__('Right', 'woo-product-variation-swatches'),
            'center' => esc_html__('Center', 'woo-product-variation-swatches'),

        );

        return apply_filters('get_archive_swatches_aligns', $aligns);
    }

    public static function get_tooltip_options() {
        $options = array(
            'no'  => esc_html__('No', 'woo-product-variation-swatches'),
            'yes' => esc_html__('Yes', 'woo-product-variation-swatches')
        );

        return apply_filters('get_tooltip_options', $options);
    }
}