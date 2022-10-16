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
        'title'   => esc_html__( 'Error Page Settings', 'metro' ),
        'id'      => 'error_settings_section',
        'heading' => '',
        'icon'    => 'el el-error-alt',
        'fields'  => array( 
            array(
                'id'       => 'error_bgimg',
                'type'     => 'media',
                'title'    => esc_html__( 'Background Image', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( '404bg.jpg' )
                ),
            ),
            array(
                'id'       => 'error_404img',
                'type'     => 'media',
                'title'    => esc_html__( '404 Image', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( '404.png' )
                ),
            ), 
            array(
                'id'       => 'error_text_1',
                'type'     => 'text',
                'title'    => esc_html__( 'Error Text 1', 'metro' ),
                'default'  => esc_html__( "OPS! Under Construction", 'metro' ),
            ),
            array(
                'id'       => 'error_text_2',
                'type'     => 'text',
                'title'    => esc_html__( 'Error Text 2', 'metro' ),
                'default'  => esc_html__( "Try going to Home Page by using the button below.", 'metro' ),
            ), 
            array(
                'id'       => 'error_buttontext',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'metro' ),
                'default'  => esc_html__( 'Go To Home Page', 'metro' ),
            )
        )
    )
);