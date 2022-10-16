<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/text-with-button/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Modern_Banner_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Modern Banner Slider', 'metro-core' );
		$this->rt_base = 'rt-modern-banner-slider';
		parent::__construct( $data, $args );
	}


	private function rt_repeater_fields() {
		
		$fields = array(
			array(
				'type'    => Controls_Manager::TEXT,
				'name'    => 'title',
				'label'   => __( 'Title Text', 'metro-core' ),
				'default' => 'WoMen’s',
			),
			
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'name'    => 'subtitle',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'default' => 'Collection 2020',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'name'    => 'content',
				'label'   => __( 'Content', 'metro-core' ),
				'default' => 'Stylist modern Wireless Keyboard With Stunning Desig Ultra Slim Stunning Design & Ultra Slim Design.',
			),

			array(
				'type'    => Controls_Manager::TEXT,
				'name'    => 'price_label',
				'label'   => __( 'Price Label', 'metro-core' ),
				'default' => 'Only',
				'condition'   => array( 'style' => array( '2' ) ),
			),
			
			array(
				'type'    => Controls_Manager::TEXT,
				'name'    => 'symbol',
				'label'   => __( 'Price symbol', 'metro-core' ),
				'default' => '$',
				
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'name'    => 'price',
				'label'   => __( 'Price', 'metro-core' ),
				'default' => '$299',
				
			),

			array(
				'type'    => Controls_Manager::URL,
				'name'    => 'url',
				'label'   => __( 'Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'name'    => 'linktext',
				'label'   => __( 'Link Text', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'name'    => 'bgimg',
				'label'   => __( 'Slider Image', 'metro-core' ),
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'name'    => 'slidernav',
				'label'   => __( 'Slider Nav Image', 'metro-core' ),
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			),
		);
		return $fields;
	}


	private function rt_repeater_share_fields() {		
		$fields = array(			
			array(
				'type'    => Controls_Manager::URL,
				'name'    => 'share_url',
				'label'   => __( 'Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
			),		

			array(
				'type'    => Controls_Manager::ICONS,
				'name'      => 'share_icon',
				'label'   => __( 'Icon', 'metro-core' ),
				'default' => 'fa fa-dollar',				
			),

		);
		return $fields;
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'style',
				'label'       => __( 'Product Style', 'metro-core' ),
				'options'     => array(
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2', 'metro-core' ),				
				),
				'default' => '1',
			),
			array(
				'type' => Controls_Manager::SLIDER,
				'mode' => 'responsive',
				'id'   => 'height',
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 500,
				),
				'label'   => __( 'Height', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .slider-layout2' => 'height: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'items',
				'label'   => __( 'Add as many items as you want', 'metro-core' ),
				'fields'  => $this->rt_repeater_fields(),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'    => 'share_title',
				'label'   => __( 'Share Title', 'metro-core' ),
				'default' => 'SHARE',
				'condition'   => array( 'style' => array( '1' ) ),
			),

			
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'shares',
				'label'   => __( 'Add as many Icons as you want', 'metro-core' ),
				'condition'   => array( 'style' => array( '1' ) ),
				'fields'  => array(
					array(
						'type'  => Controls_Manager::ICONS,
						'name'  => 'share_icon',
						'label' => __( 'Image', 'metro-core' ),
					),
					array(
						'type'  => Controls_Manager::TEXT,
						'name'  => 'url',
						'label' => __( 'URL(optional)', 'metro-core' ),
					),
				),
			),	
			array(
				'mode' => 'section_end',
			),

			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general_option',
				'label'   => __( 'Slider Option', 'metro-core' ),
			),
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'slider_nav',
					'label'       => __( 'Navigation Arrow', 'metro-core' ),
					'label_on'    => __( 'On', 'metro-core' ),
					'label_off'   => __( 'Off', 'metro-core' ),
					'default'     => 'yes',
					'description' => __( 'Enable or disable navigation arrow. Default: On', 'metro-core' ),
				),
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'slider_paginginfo',
					'label'       => __( 'Paginginfo Navigation', 'metro-core' ),
					'label_on'    => __( 'On', 'metro-core' ),
					'label_off'   => __( 'Off', 'metro-core' ),
					'default'     => '',
					'description' => __( 'Enable or disable navigation paginginfo. Default: Off', 'metro-core' ),
				),
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'slider_autoplay',
					'label'       => __( 'Autoplay', 'metro-core' ),
					'label_on'    => __( 'On', 'metro-core' ),
					'label_off'   => __( 'Off', 'metro-core' ),
					'default'     => 'yes',
					'description' => __( 'Enable or disable autoplay. Default: On', 'metro-core' ),
				),
				array(
					'type'    => Controls_Manager::NUMBER,
					'id'      => 'slider_autoplay_speed',
					'label'   => __( 'Autoplay Slide Speed', 'metro-core' ),
					'default' => 3000,
					'description' => __( 'Slide speed in milliseconds. Default: 200', 'metro-core' ),
					'condition'   => array( 'slider_autoplay' => 'yes' ),
				),
			array(
				'mode' => 'section_end',
			),

		);
		return $fields;
	}

	private function rt_load_scripts(){
		wp_enqueue_style(  'slick' );
		wp_enqueue_style(  'slick-theme' );
		wp_enqueue_script( 'slick' );			
		
	}
	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();
		if ( $data['style'] == '1' ) {
			$template = 'view-1';		
		}else {
			$template = 'view-2';
		}		

		return $this->rt_template( $template, $data );
	}
}