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
        'title'   => esc_html__( 'Footer', 'metro' ),
        'id'      => 'footer_section',
        'heading' => '',
        'icon'    => 'el el-caret-down',
        'fields'  => array(
          
            array(
                'id'       => 'mail_chimp_layout',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Footer MailChimp Area', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => false,
            ),
            array(
                'id'       => 'mail_chimp_styles',
                'type'     => 'select',
                'title'    => esc_html__( 'MailChimp Layouts', 'metro'), 
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'metro' ),
                    '2' => esc_html__( 'Style 2', 'metro' ),
                    '3' => esc_html__( 'Style 3', 'metro' ),                  
                ),
                'default'  => '1',
                'required' => array( 'mail_chimp_layout', 'equals', true )
            ),
         
           array(
                'id'       => 'mail_chimp_bgcolor',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Primary Color', 'metro' ),
                'default'  => '#ffffff',
                 'required' => array( 'mail_chimp_styles', 'equals', '1' )
            ),

            array(
                'id'       => 'mail_chimp_bgimg',
                'type'     => 'media',
                'title'    => esc_html__( 'Mail Chimp Image', 'metro' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'mail-chimp-banner.jpg' )
                ),
                'required' => array( 'mail_chimp_styles', 'equals', '2' )
            ), 

            array(
                'id'       => 'mail_shortcode',
                'type'     => 'text',
                'title'    => esc_html__('Enter Mail Chimp Shortcode', 'metro'),                
                'default'  => esc_html__('[contact-form-7 id="1141" title="Newsletter 1"]', 'metro'),
                'required' => array( 'mail_chimp_layout', 'equals', true )
            ),

            array(
                'id'       => 'footer_area',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Footer Area', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),  

         
            array(
                'id'       => 'copyright_area',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Copyright Area', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'copyright_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Copyright Text', 'metro' ),
                'default'  => sprintf( '&copy; Copyright Metro %s. Designed and Developed by <a target="_blank" href="%s" rel="nofollow">RadiusTheme</a>' , date('Y'), esc_url( Constants::$theme_author_uri ) ),
                'required' => array( 'copyright_area', 'equals', true )
            ),
            array(
                'id'       => 'social_icons',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Social Icons', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => true,
                'required' => array( 'copyright_area', 'equals', true )
            ),
            array(
                'id'       => 'payment_icons',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Payment Icons', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => false,
                'required' => array( 'copyright_area', 'equals', true )
            ),
            array(
                'id'       => 'payment_img',
                'type'     => 'gallery',
                'title'    => esc_html__( 'Payment Icons Gallery', 'metro' ),
                'required' => array( 'payment_icons', 'equals', true )
            ),
             array(
                'id'       => 'footer_bottom_styles',
                'type'     => 'select',
                'title'    => esc_html__( 'Copyright Layouts', 'metro'), 
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'metro' ),
                    '2' => esc_html__( 'Style 2', 'metro' ),                                   
                ),
                'default'  => '1',
                'required' => array( 'payment_icons', 'equals', true )
            ),

            array(
                'id'       => 'footer_area_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Dark Style', 'metro' ),
                'on'       => esc_html__( 'Enabled', 'metro' ),
                'off'      => esc_html__( 'Disabled', 'metro' ),
                'default'  => false,
            ),
         
        )
    )
);