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
        'title'   => esc_html__( 'Colors', 'metro' ),
        'id'      => 'color_section',
        'heading' => '',
        'icon'    => 'el el-eye-open',
        'fields'  => array(
            array(
                'id'       => 'section-color-sitewide',
                'type'     => 'section',
                'title'    => esc_html__( 'Sitewide Colors', 'metro' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'color_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Primary Color Scheme', 'metro' ),
                'options'  => array(
                    'black'  => esc_html__( 'Black', 'metro' ),
                    'red'    => esc_html__( 'Red', 'metro' ),
                    'orange' => esc_html__( 'Orange', 'metro' ),
                    'tomato' => esc_html__( 'Tomato', 'metro' ),
                    'custom' => esc_html__( 'Custom', 'metro' ),
                ),
                'default'  => 'black',
            ),
            array(
                'id'       => 'primary_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Primary Color', 'metro' ),
                'default'  => '#e53935',
                'required' => array( 'color_type', '=', 'custom' )
            ),
            array(
                'id'       => 'sitewide_color',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Other Colors', 'metro' ),
                'options'  => array(
                    'primary' => esc_html__( 'Primary Color', 'metro' ),
                    'custom'  => esc_html__( 'Custom', 'metro' ),
                ),
                'default'  => 'primary',
                'subtitle' => esc_html__( 'Selecting Primary Color will hide some color options from the below settings and replace them with Primary Color', 'metro' ),
            ),
            array(
                'id'       => 'section-color-menu',
                'type'     => 'section',
                'title'    => esc_html__( 'Main Menu', 'metro' ),
                'indent'   => true,
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'menu_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Menu Color', 'metro' ),
                'default'  => '#111111',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'section-color-submenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Sub Menu', 'metro' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'submenu_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Submenu Color', 'metro' ),
                'default'  => '#111111',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'submenu_hover_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Submenu Hover Color', 'metro' ),
                'default'  => '#ffffff',
            ), 
            array(
                'id'       => 'submenu_hover_bgcolor',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Submenu Hover Background Color', 'metro' ),
                'default'  => '#111111',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'section-color-banner',
                'type'     => 'section',
                'title'    => esc_html__( 'Banner/Breadcrumb Area', 'metro' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'banner_title_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Banner Title Color', 'metro' ),
                'default'  => '#000',
            ),
            array(
                'id'       => 'breadcrumb_link_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Breadcrumb Link Color', 'metro' ),
                'default'  => '#949494',
            ),
            array(
                'id'       => 'breadcrumb_link_hover_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Breadcrumb Link Hover Color', 'metro' ),
                'default'  => '#111111',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'breadcrumb_active_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Active Breadcrumb Color', 'metro' ),
                'default'  => '#000000',
            ),
            array(
                'id'       => 'breadcrumb_seperator_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Breadcrumb Seperator Color', 'metro' ),
                'default'  => '#686868',
            ),
            array(
                'id'       => 'section-color-footer',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Area', 'metro' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'footer_bgcolor',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Background Color', 'metro' ),
                'default'  => '#111111',
            ), 
            array(
                'id'       => 'footer_title_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Title Text Color', 'metro' ),
                'default'  => '#ffffff',
            ), 
            array(
                'id'       => 'footer_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Body Text Color', 'metro' ),
                'default'  => '#cccccc',
            ), 
            array(
                'id'       => 'footer_link_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Body Link Color', 'metro' ),
                'default'  => '#cccccc',
            ), 
            array(
                'id'       => 'footer_link_hover_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Body Link Hover Color', 'metro' ),
                'default'  => '#ffffff',
            ),
        )
    )
);