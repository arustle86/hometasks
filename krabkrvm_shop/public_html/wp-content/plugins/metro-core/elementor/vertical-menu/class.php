<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/vertical-menu/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Vertical_Menu extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Vertical Menu', 'metro-core' );
		$this->rt_base = 'rt-vertical-menu';
		parent::__construct( $data, $args );
	}

	public function rt_fields() {
		$fields = array(
			
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'icon_display',
				'label'       => __( 'Display Icons', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
			),
			array(
				'mode' => 'section_end',
			),
		
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'tab'     => Controls_Manager::TAB_STYLE,
				'label'   => __( 'Style', 'metro-core' ),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'menu_title_color',
				'label'   => __( 'Menu Text Color', 'metro-core' ),
				'default' => '#111111',
				'selectors' => array( '{{WRAPPER}} .vertical-menu-area .vertical-menu ul.menu li a' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'menu_icon_color',
				'label'   => __( 'Menu Icon Color', 'metro-core' ),
				'default' => '#444444',
				'selectors' => array( '{{WRAPPER}} .vertical-menu-area .vertical-menu ul.menu svg' => 'fill: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'menu_title_color_hover',
				'label'   => __( 'Menu Text Hover Color', 'metro-core' ),
				'default' => '#111111',
				'selectors' => array( '{{WRAPPER}} .vertical-menu-area .vertical-menu ul.menu li a:hover' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'menu_icon_color_hover',
				'label'   => __( 'Menu Icon Hover Color', 'metro-core' ),
				'default' => '#444444',
				'selectors' => array( '{{WRAPPER}} .vertical-menu-area .vertical-menu ul.menu li:hover svg' => 'fill: {{VALUE}}' ),
			),

			
			array(
				'mode' => 'section_end',
			),


		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$data['icon_display'] = $data['icon_display'] ? true: false;

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}