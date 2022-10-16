<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

use \Redux;

$opt_name = Constants::$theme_options;

Redux::setSection( $opt_name,
    array(
        'title' => esc_html__( 'WooCommerce Settings', 'metro' ),
        'id'    => 'wc_secttings',
        'icon'  => 'el el-shopping-cart',
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Shop Page', 'metro' ),
        'id'      => 'wc_sec_shop',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'wc_product_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Product Block Style', 'metro'),
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'metro' ),
                    '2' => esc_html__( 'Style 2', 'metro' ),
                    '3' => esc_html__( 'Style 3', 'metro' ),
                    '4' => esc_html__( 'Style 4', 'metro' ),
                    '5' => esc_html__( 'Style 5', 'metro' ),
                    '6' => esc_html__( 'Style 6', 'metro' ),
                    '7' => esc_html__( 'Style 7', 'metro' ),
                    '8' => esc_html__( 'Style 8', 'metro' ),
                    '9' => esc_html__( 'Style 9', 'metro' ),
                    '10' => esc_html__( 'Style 10', 'metro' ),
                    '12' => esc_html__( 'Style 12', 'metro' ),
                ),
                'default'  => '1',
            ),

            array(
                'id'       => 'wc_product_columns_update',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Columns Update', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),

            array(
                'id'       => 'wc_desktops_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Desktops Product Columns', 'metro'),
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'metro' ),
                    '6'  => esc_html__( '2 Col', 'metro' ),
                    '4'  => esc_html__( '3 Col', 'metro' ),
                    '3'  => esc_html__( '4 Col', 'metro' ),
                    '2'  => esc_html__( '6 Col', 'metro' ),
                ),
                'required' => array( 'wc_product_columns_update', 'equals', true ),
                'default'  => '4',
            ),


            array(
                'id'       => 'wc_tab_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Tab Product Columns', 'metro'),
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'metro' ),
                    '6'  => esc_html__( '2 Col', 'metro' ),
                    '4'  => esc_html__( '3 Col', 'metro' ),
                    '3'  => esc_html__( '4 Col', 'metro' ),
                    '2'  => esc_html__( '6 Col', 'metro' ),
                ),
                'default'  => '6',
            ),
            array(
                'id'       => 'wc_mobile_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Mobile Product Columns', 'metro'),
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'metro' ),
                    '6'  => esc_html__( '2 Col', 'metro' ),
                    '4'  => esc_html__( '3 Col', 'metro' ),
                    '3'  => esc_html__( '4 Col', 'metro' ),
                    '2'  => esc_html__( '6 Col', 'metro' ),
                ),
                'default'  => '12',
            ),


             array(
                'id'       => 'wc_shop_Product_img_size',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Columns Images 100% ', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),


            array(
                'id'       => 'wc_num_product',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Products Per Page', 'metro' ),
                'default'  => '9',
            ),
            array(
                'id'       => 'wc_pagination',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Pagination Type', 'metro' ),
                'options'  => array(
                    'numbered'        => esc_html__( 'Numbered', 'metro' ),
                    'load-more'       => esc_html__( 'Load More', 'metro' ),
                    'infinity-scroll' => esc_html__( 'Infinity Scroll', 'metro' ),
                ),
                'default'  => 'numbered'
            ),
            array(
                'id'       => 'wc_sale_label',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sale Product Label', 'metro' ),
                'options'  => array(
                    'percentage' => esc_html__( 'Percentage', 'metro' ),
                    'text'       => esc_html__( 'Text', 'metro' ),
                ),
                'default'  => 'percentage'
            ),
            array(
                'id'       => 'wc_shop_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Category', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_shop_review',
                'type'     => 'switch',
                'title'    => esc_html__( 'Review Star', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_shop_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Wishlist" must be enabled to use this feature', 'metro' ),
            ),
            array(
                'id'       => 'wc_shop_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quickview Icon', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Quick View" must be enabled to use this feature', 'metro' ),
            ),
            array(
                'id'       => 'wc_shop_compare_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Compare Icon', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Compare" must be enabled to use this feature', 'metro' ),
            ),

            array(
                'id' => 'metro_search_auto_suggest_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search', 'metro'),

                'default' => true,
                'on' => esc_html__('Enable', 'metro'),
                'off' => esc_html__('Disable', 'metro'),
            ),
            array(
                'id' => 'metro_search_img_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search With Image', 'metro'),
                'default' => true,
                'on' => esc_html__('Enable', 'metro'),
                'off' => esc_html__('Disable', 'metro'),
            ),
            array(
                'id' => 'metro_search_auto_suggest_limit',
                'type' => 'text',
                'title' => esc_html__('Autosuggest Limit', 'metro'),

                'default' => '10'
            ),
            array(
                'id'       => 'metro_wc_product_archive_slide_or_alternate',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Product Archive Style', 'metro' ),
                'options'  => array(
                    'slide' => esc_html__( 'Gallery Slide', 'metro' ),
                    'alternate' => esc_html__( 'Gallery Alternate', 'metro' ),
                ),
                'default'  => 'slide',
            ),
            array(
                'id'       => 'metro_wc_product_filter_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Product Filter Type', 'metro' ),
                'options'  => array(
                    'ajax' => esc_html__( 'Ajax', 'metro' ),
                    'regular' => esc_html__( 'Regular', 'metro' ),
                ),
                'default'  => 'regular',
            ),
            array(
                'id'       => 'metro_wc_product_filter_ajax_preloader',
                'type'     => 'media',
                'title'    => esc_html__( 'Ajax Preloader', 'metro' ),
                'default'  => array(
                    'url' => Helper::get_img('metro-ajax-loader.gif')
                ),
            ),
            array(
                'id' => 'metro_wc_top_widget',
                'type' => 'switch',
                'title' => esc_html__('Enable top widget on shop page for filters.', 'metro'),
                'default' => false,
                'on' => esc_html__('Enable', 'metro'),
                'off' => esc_html__('Disable', 'metro'),
            ),

        )
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Product Page', 'metro' ),
        'id'      => 'wc_sec_product',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'wc_single_product_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Layout', 'metro'),
                'options'  => array(
                    '1' => esc_html__( 'Default', 'metro' ),
                    '2' => esc_html__( 'Layout 2', 'metro' ),
                    '3' => esc_html__( 'Layout 3', 'metro' ),
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'wc_show_excerpt',
                'type'     => 'switch',
                'title'    => esc_html__( "Show excerpt when short description doesn't exist", 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Social Sharing', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'      => 'wc_share',
                'type'    => 'checkbox',
                'class'   => 'redux-custom-inline',
                'title'   => esc_html__( 'Social Sharing Icons', 'metro'),
                'options' => array(
                    'facebook'  => 'Facebook',
                    'twitter'   => 'Twitter',
                    'linkedin'  => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'tumblr'    => 'Tumblr',
                    'reddit'    => 'Reddit',
                    'vk'        => 'Vk',
                ),
                'default' => array(
                    'facebook'  => '1',
                    'twitter'   => '1',
                    'linkedin'  => '1',
                    'pinterest' => '1',
                    'tumblr'    => '0',
                    'reddit'    => '1',
                    'vk'        => '0',
                ),
                'required' => array( 'wc_social', '=', true )
            ),
            array(
                'id'       => 'wc_product_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quickview Icon', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Quick View" must be enabled to use this feature', 'metro' ),
            ),
            array(
                'id'       => 'wc_product_compare_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Compare Icon', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Compare" must be enabled to use this feature', 'metro' ),
            ),
            array(
                'id'       => 'wc_product_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Wishlist" must be enabled to use this feature', 'metro' ),
            ),
            array(
                'id'       => 'wc_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Сопутствующие товары', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Description Tab', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_reviews',
                'type'     => 'switch',
                'title'    => esc_html__( 'Reviews Tab', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_additional_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Additional Information Tab', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'in_stock_avaibility',
                'type'     => 'switch',
                'title'    => esc_html__( 'In stock Availability', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
        )
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Cart Page', 'metro' ),
        'id'      => 'wc_sec_cart',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'wc_cross_sell',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross Sell Products', 'metro' ),
                'on'       => esc_html__( 'Show', 'metro' ),
                'off'      => esc_html__( 'Hide', 'metro' ),
                'default'  => true,
            ),
        )
    )
);

do_action('rt_after_redux_options_loaded','metro');