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
        'title'   => esc_html__( 'Header', 'metro' ),
        'id'      => 'header_section',
        'heading' => '',
        'icon'    => 'el el-flag',
        'fields'  => array(
            array(
                'id'       => 'resmenu_width',
                'type'     => 'slider',
                'title'    => esc_html__( 'Responsive Header Screen Width', 'metro' ),
                'subtitle' => esc_html__( 'Screen width in which mobile menu activated. Recommended value is: 991', 'metro' ),
                'default'  => 991,
                'min'      => 0,
                'step'     => 1,
                'max'      => 2000,
            ),
            array(
                'id'       => 'sticky_menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Show header at the top when scrolling down', 'metro' ),
            ),
            array(
                'id'       => 'top_bar',
                'type'     => 'switch',
                'title'    => esc_html__( 'Top Bar', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => false,
            ),
              array(
                'id'       => 'offcanvas_logo',
                'type'     => 'switch',
                'title'    => esc_html__( 'Offcanvas Logo', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => True,
            ),
             array(
                'id'       => 'offcanvas_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Offcanvas Menu Title', 'metro' ),                
                'default'  => '',               
            ), 
             array(
                'id'       => 'offcanvas_sub_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Offcanvas Sub Title', 'metro' ),                
                'default'  => 'Follow Us',               
            ),

            array(
                'id'       => 'offcanvas_socials',
                'type'     => 'switch',
                'title'    => esc_html__( 'Offcanvas Socials Icon', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
                
            ),
            array(
                'id'       => 'top_bar_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Top Bar Layout', 'metro' ),
                'default'  => '1',
                'options' => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'metro' ) . '</b>',
                        'img' => Helper::get_img( 'top1.png' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'metro' ) . '</b>',
                        'img' => Helper::get_img( 'top2.png' ),
                    ),
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'metro' ) . '</b>',
                        'img' => Helper::get_img( 'top3.png' ),
                    ), 
                    '4' => array(
                        'title' => '<b>'. esc_html__( 'Layout 4', 'metro' ) . '</b>',
                        'img' => Helper::get_img( 'top3.png' ),
                    ),
                ),
                'required' => array( 'top_bar', '=', true )
            ),
            
            array(
                'id'       => 'header_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header Layout', 'metro' ),
                'default'  => '1',
                'options' => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-1.png' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-2.png' ),
                    ),
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-3.png' ),
                    ),
                    '4' => array(
                        'title' => '<b>'. esc_html__( 'Layout 4', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-4.png' ),
                    ),
                    '5' => array(
                        'title' => '<b>'. esc_html__( 'Layout 5', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-5.png' ),
                    ),
                    '6' => array(
                        'title' => '<b>'. esc_html__( 'Layout 6', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-6.png' ),
                    ),
                    '7' => array(
                        'title' => '<b>'. esc_html__( 'Layout 7( Transparent Header )', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-7.png' ),
                    ),
                    '8' => array(
                        'title' => '<b>'. esc_html__( 'Layout 8', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-8.png' ),
                    ),  
                    '9' => array(
                        'title' => '<b>'. esc_html__( 'Layout 9', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-8.png' ),
                    ), 
                    '10' => array(
                        'title' => '<b>'. esc_html__( 'Layout 10', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-8.png' ),
                    ), 
                    '11' => array(
                        'title' => '<b>'. esc_html__( 'Layout 11', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'header-8.png' ),
                    ),
                ),
            ),         

            array(
                'id'       => 'search_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Search Icon', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'account_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Login/Account Icon', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ), 
            array(
                'id'       => 'cart_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cart Icon', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),

            array(
                'id'       => 'carticon',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Cart Icon', 'metro' ),
                'options'  => array(
                    'offscreen'  => esc_html__( 'Offscreen', 'metro' ),
                    'link'    => esc_html__( 'Link', 'metro' ),
                    'hidden'    => esc_html__( 'Hidden', 'metro' ),
                ),
                'default' => 'offscreen',
            ),

            array(
                'id'       => 'wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'banner',
                'type'     => 'switch',
                'title'    => esc_html__( 'Banner', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
                'required' => array( 'banner', 'equals', true )
            ),
            array(
                'id'       => 'banner_search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Banner Search', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
                'required' => array( 'banner', 'equals', true )
            ),
            array(
                'id'       => 'bgtype',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Banner Background Type', 'metro' ),
                'options'  => array(
                    'bgcolor'  => esc_html__( 'Background Color', 'metro' ),
                    'bgimg'    => esc_html__( 'Background Image', 'metro' ),
                ),
                'default' => 'bgcolor',
                'required' => array( 'banner', 'equals', true )
            ),
            array(
                'id'       => 'bgcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Banner Background Color', 'metro'), 
                'validate' => 'color',
                'transparent' => false,
                'default' => '#f2f2f2',
                'required' => array( 'bgtype', 'equals', 'bgcolor' )
            ),
            array(
                'id'       => 'bgimg',
                'type'     => 'media',
                'title'    => esc_html__( 'Banner Background Image', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'banner.jpg' )
                ),
                'required' => array( 'bgtype', 'equals', 'bgimg' )
            ), 
            array(
                'id'       => 'bgopacity',
                'type'     => 'slider',
                'title'    => esc_html__( 'Banner Background Opacity (in %)', 'metro' ),
                'min'      => 0,
                'max'      => 100,
                'step'     => 1,
                'default'  => 0,
                'display_value' => 'label',
                'required' => array( 'bgtype', 'equals', 'bgimg' )
            ), 
        )
    ) 
);