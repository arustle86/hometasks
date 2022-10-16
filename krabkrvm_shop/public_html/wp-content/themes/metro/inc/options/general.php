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
        'title'   => esc_html__( 'General', 'metro' ),
        'id'      => 'general_section',
        'heading' => '',
        'icon'    => 'el el-network',
        'fields'  => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Main Logo', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-dark.png' )
                ),
            ),
            array(
                'id'       => 'logo_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Light Logo', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-light.png' )
                ),
                'subtitle' => esc_html__( 'Used when Transparent Header is enabled', 'metro' ),
            ),
            array(
                'id'       => 'logo_width',
                'type'     => 'select',
                'title'    => esc_html__( 'Logo Area Width', 'metro'), 
                'subtitle' => esc_html__( 'Width is defined by the number of bootstrap columns. Please note, navigation menu width will be decreased with the increase of logo width', 'metro' ),
                'options'  => array(
                    '1' => esc_html__( '1 Column', 'metro' ),
                    '2' => esc_html__( '2 Column', 'metro' ),
                    '3' => esc_html__( '3 Column', 'metro' ),
                    '4' => esc_html__( '4 Column', 'metro' ),
                ),
                'default'  => '3',
            ),
            array(
                'id'       => 'logo_height',
                'type'     => 'slider',
                'title'    => esc_html__( 'Logo Height', 'metro' ),
                'subtitle' => esc_html__( 'Maximum height of logo. Recommended value is: 53', 'metro' ),
                'default'  => 53,
                'min'      => 0,
                'step'     => 1,
                'max'      => 700,
            ),
            array(
                'id'       => 'breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Preloader Image', 'metro' ),
                'subtitle' => esc_html__( 'Please upload your choice of preloader image. Transparent GIF format is recommended', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'preloader.gif' )
                ),
                'required' => array( 'preloader', 'equals', true )
            ),
            array(
                'id'       => 'back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back to Top Arrow', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
        )            
    ) 
);