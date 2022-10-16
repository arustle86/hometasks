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
        'title'   => esc_html__( 'Contact & Socials', 'metro' ),
        'id'      => 'socials_section',
        'heading' => '',
        'icon'    => 'el el-twitter',
        'fields'  => array(
            array(
                'id'       => 'phone',
                'type'     => 'text',
                'title'    => esc_html__( 'Phone', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'email',
                'type'     => 'text',
                'title'    => esc_html__( 'Email', 'metro' ),
                'validate' => 'email',
                'default'  => '',
            ),
            array(
                'id'       => 'social_facebook',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social_twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social_linkedin',
                'type'     => 'text',
                'title'    => esc_html__( 'Linkedin', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social_youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social_pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social_instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'metro' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social_rss',
                'type'     => 'text',
                'title'    => esc_html__( 'RSS', 'metro' ),
                'default'  => '',
            ),
        )
    )
);