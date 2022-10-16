<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

use \Redux;

$opt_name = Constants::$theme_options;


function rdtheme_redux_post_type_fields( $prefix ){
    return array(
        'layout' => array(
            'id'       => $prefix. '_layout',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Layout', 'metro' ),
            'options'  => array(
                'left-sidebar'  => esc_html__( 'Left Sidebar', 'metro' ),
                'full-width'    => esc_html__( 'Full Width', 'metro' ),
                'right-sidebar' => esc_html__( 'Right Sidebar', 'metro' ),
            ),
            'default'  => 'right-sidebar'
        ),
        'sidebar' => array(
            'id'       => $prefix. '_sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Custom Sidebar', 'metro' ),
            'options'  => Helper::custom_sidebar_fields(),
            'default'  => 'sidebar',
            'required' => array( $prefix. '_layout', '!=', 'full-width' ),
        ),
        'top_bar' => array(
            'id'       => $prefix. '_top_bar',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                'on'      => esc_html__( 'Enabled', 'metro' ),
                'off'     => esc_html__( 'Disabled', 'metro' ),
            ),
            'default'  => 'default',
        ),
        'top_bar_style' => array(
            'id'       => $prefix. '_top_bar_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Layout', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                '1'       => esc_html__( 'Layout 1', 'metro' ),
                '2'       => esc_html__( 'Layout 2', 'metro' ),
                '3'       => esc_html__( 'Layout 3', 'metro' ),
                '4'       => esc_html__( 'Layout 4', 'metro' ),
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_top_bar', '!=', 'off' )
        ),
        'header_style' => array(
            'id'       => $prefix. '_header_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Layout', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                '1'       => esc_html__( 'Layout 1', 'metro' ),
                '2'       => esc_html__( 'Layout 2', 'metro' ),
                '3'       => esc_html__( 'Layout 3', 'metro' ),
                '4'       => esc_html__( 'Layout 4', 'metro' ),
                '5'       => esc_html__( 'Layout 5', 'metro' ),
                '6'       => esc_html__( 'Layout 6', 'metro' ),
            ),
            'default'  => 'default',
        ),
        'banner' => array(
            'id'       => $prefix. '_banner',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                'on'      => esc_html__( 'Enabled', 'metro' ),
                'off'     => esc_html__( 'Disabled', 'metro' ),
            ),
            'default'  => 'default',
        ),
        'breadcrumb' => array(
            'id'       => $prefix. '_breadcrumb',
            'type'     => 'select',
            'title'    => esc_html__( 'Breadcrumb', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                'on'      => esc_html__( 'Enabled', 'metro' ),
                'off'     => esc_html__( 'Disabled', 'metro' ),
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_banner', '!=', 'off' )
        ),
        'bgtype' => array(
            'id'       => $prefix. '_bgtype',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner Background Type', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                'bgcolor'  => esc_html__( 'Background Color', 'metro' ),
                'bgimg'    => esc_html__( 'Background Image', 'metro' ),
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_banner', '!=', 'off' )
        ),
        'bgimg' => array(
            'id'       => $prefix. '_bgimg',
            'type'     => 'media',
            'title'    => esc_html__( 'Banner Background Image', 'metro' ),
            'default'  => '',
            'required' => array( $prefix. '_bgtype', '=', 'bgimg' ),
        ),
        'bgcolor' => array(
            'id'       => $prefix. '_bgcolor',
            'type'     => 'color',
            'title'    => esc_html__( 'Banner Background Color', 'metro'), 
            'validate' => 'color',
            'transparent' => false,
            'default'  => '',
            'required' => array( $prefix. '_bgtype', '=', 'bgcolor' ),
        ),
         'footer_area_style' => array(
            'id'       => $prefix. '_footer_area_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Display Footer Dark', 'metro'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'metro' ),
                'on'      => esc_html__( 'Enabled', 'metro' ),
                'off'     => esc_html__( 'Disabled', 'metro' ),
            ),
            'default'  => 'default',
        ),
    );
}

Redux::setSection( $opt_name,
    array(
        'title' => esc_html__( 'Layout Defaults', 'metro' ),
        'id'    => 'layout_defaults',
        'icon'  => 'el el-th',
    )
);

// Page
$rdtheme_page_fields = rdtheme_redux_post_type_fields( 'page' );
$rdtheme_page_fields['layout']['default'] = 'full-width';
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Page', 'metro' ),
        'id'         => 'pages_section',
        'subsection' => true,
        'fields'     => $rdtheme_page_fields     
    )
);

//Post Archive
$rdtheme_post_archive_fields = rdtheme_redux_post_type_fields( 'blog' );
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Blog / Archive', 'metro' ),
        'id'         => 'blog_section',
        'subsection' => true,
        'fields'     => $rdtheme_post_archive_fields
    )
);

// Single Post
$rdtheme_single_post_fields = rdtheme_redux_post_type_fields( 'single_post' );
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Post Single', 'metro' ),
        'id'         => 'single_post_section',
        'subsection' => true,
        'fields'     => $rdtheme_single_post_fields           
    ) 
);

// Search
$rdtheme_search_fields = rdtheme_redux_post_type_fields( 'search' );
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Search Layout', 'metro' ),
        'id'         => 'search_section',
        'subsection' => true,
        'fields'     => $rdtheme_search_fields            
    )
);

// Error 404 Layout
$rdtheme_error_fields = rdtheme_redux_post_type_fields( 'error' );
unset($rdtheme_error_fields['layout']);
$rdtheme_error_fields['banner']['default'] = 'off';
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Error 404 Layout', 'metro' ),
        'id'         => 'error_section',
        'subsection' => true,
        'fields'     => $rdtheme_error_fields           
    )
);

// Woocommerce
if ( class_exists( 'WooCommerce' ) ) {
    // Woocommerce Shop Archive
    $rdtheme_shop_archive_fields = rdtheme_redux_post_type_fields( 'shop' );
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Shop', 'metro' ),
            'id'         => 'shop_section',
            'subsection' => true,
            'fields'     => $rdtheme_shop_archive_fields
        ) 
    );

    // Woocommerce Product
    $rdtheme_product_fields = rdtheme_redux_post_type_fields( 'product' );
    $rdtheme_product_fields['layout']['default'] = 'full-width';
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Product', 'metro' ),
            'id'         => 'product_section',
            'subsection' => true,
            'fields'     => $rdtheme_product_fields
        ) 
    );
}

// Dokan
if ( function_exists( 'dokan' ) ) {
    // Dokan Store
    $rdtheme_store_fields = rdtheme_redux_post_type_fields( 'store' );
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Store', 'metro' ),
            'id'         => 'store_section',
            'subsection' => true,
            'fields'     => $rdtheme_store_fields
        ) 
    );
}