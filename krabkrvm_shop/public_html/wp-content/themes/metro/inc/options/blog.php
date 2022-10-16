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
        'title'   => esc_html__( 'Blog Settings', 'metro' ),
        'id'      => 'blog_settings_section',
        'icon'    => 'el el-tags',
        'heading' => '',
        'fields'  => array(
            array(
                'id'       =>'blog_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog/Archive Layout', 'metro' ),
                'default'  => '1',
                'options'  => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'blog1.jpg' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'blog2.jpg' ),
                    ),
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'metro' ) . '</b>',
                        'img'   => Helper::get_img( 'blog3.png' ),
                    ),
                ),
            ),
            array(
                'id'       => 'blog_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Date', 'metro' ),
                'on'       => esc_html__( 'On', 'metro' ),
                'off'      => esc_html__( 'Off', 'metro' ),
                'default'  => true,
            ), 
            array(
                'id'       => 'blog_author_name',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Author Name', 'metro' ),
                'on'       => esc_html__( 'On', 'metro' ),
                'off'      => esc_html__( 'Off', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_comment_num',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Comment Number', 'metro' ),
                'on'       => esc_html__( 'On', 'metro' ),
                'off'      => esc_html__( 'Off', 'metro' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Categories', 'metro' ),
                'on'       => esc_html__( 'On', 'metro' ),
                'off'      => esc_html__( 'Off', 'metro' ),
                'default'  => true,
            ),
        )
    ) 
);