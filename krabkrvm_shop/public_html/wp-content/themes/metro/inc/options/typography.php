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
        'title'  => esc_html__( 'Typography', 'metro' ),
        'id'     => 'typo_section',
        'icon'   => 'el el-text-width',
        'fields' => array(
            array(
                'id'       => 'typo_body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
                    'font-size'   => '16px',
                    'line-height' => '28px',
                ),
            ),
            array(
                'id'       => 'typo_h1',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h1', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'    => false,
                'subsets'  => false,
                'default'  => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '32px',
                    'line-height' => '38px',
                ),
            ),
            array(
                'id'       => 'typo_h2',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h2', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '28px',
                    'line-height' => '32px',
                ),
            ),
            array(
                'id'       => 'typo_h3',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h3', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets' => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '22px',
                    'line-height' => '28px',
                ),
            ),
            array(
                'id'       => 'typo_h4',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h4', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '20px',
                    'line-height' => '26px',
                ),
            ),
            array(
                'id'       => 'typo_h5',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h5', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '18px',
                    'line-height' => '24px',
                ),
            ),
            array(
                'id'       => 'typo_h6',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h6', 'metro' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '15px',
                    'line-height' => '20px',
                ),
            ),
            array(
                'id'       => 'section-mainmenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Main Menu Items', 'metro' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'menu_typo',
                'type'     => 'typography',
                'title'    => esc_html__( 'Menu Font', 'metro' ),
                'text-align' => false,
                'color'   => false,
                'subsets'  => false,
                'text-transform' => true,
                'default'     => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '400',
                    'font-size'   => '16px',
                    'line-height' => '26px',
                    'text-transform' => 'none',
                ),
            ),
            array(
                'id'       => 'section-submenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Sub Menu Items', 'metro' ),
                'indent'   => true,
            ), 
            array(
                'id'       => 'submenu_typo',
                'type'     => 'typography',
                'title'    => esc_html__( 'Submenu Font', 'metro' ),
                'text-align'   => false,
                'color'   => false,
                'subsets'  => false,
                'text-transform' => true,
                'default'     => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '400',
                    'font-size'   => '14px',
                    'line-height' => '26px',
                    'text-transform' => 'none',
                ),
            ),
            array(
                'id'       => 'section-resmenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Mobile Menu', 'metro' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'resmenu_typo',
                'type'     => 'typography',
                'title'    => esc_html__( 'Mobile Menu Font', 'metro' ),
                'text-align' => false,
                'color'   => false,
                'subsets'  => false,
                'text-transform' => true,
                'default'     => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '400',
                    'font-size'   => '14px',
                    'line-height' => '21px',
                    'text-transform' => 'none',
                ),
            ),
        )
    )
);