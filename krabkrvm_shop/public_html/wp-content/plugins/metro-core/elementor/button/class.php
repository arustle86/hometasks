<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/button/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Button extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Button', 'metro-core' );
		$this->rt_base = 'rt-button';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => __( 'Style', 'metro-core' ),
				'options' => array(
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2', 'metro-core' ),
					'3' => __( 'Style 3', 'metro-core' ),
					'4' => __( 'Style 4', 'metro-core' ),
				),
				'default' => '1',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'btntext',
				'label'   => __( 'Button Text', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => __( 'Button Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::CHOOSE,
				'mode'    => 'responsive',
				'id'      => 'align',
				'label'   => __( 'Alignment', 'metro-core' ),
				'options' => array(
					'left'    => array(
						'title' => __( 'Left', 'metro-core' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'metro-core' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'metro-core' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => 'left',
				'selectors' => array(
					'{{WRAPPER}} .rt-el-btn' => 'text-align: {{VALUE}};',
				),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}