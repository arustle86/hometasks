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

if ( ! defined( 'ABSPATH' ) ) exit;

class Sale_Banner_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Sale Banner Slider', 'metro-core' );
		$this->rt_base = 'rt-sale-banner-slider';
		parent::__construct( $data, $args );
	}


	private function rt_repeater_fields() {
		$fields = array(
			array(
				'type'    => Controls_Manager::TEXT,
				'name'    => 'title1',
				'label'   => __( 'Title Text 1', 'metro-core' ),
				'default' => 'Lorem',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'name'    => 'title2',
				'label'   => __( 'Title Text 2', 'metro-core' ),
				'default' => 'Ipsum',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'name'    => 'subtitle',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'default' => 'Lorem Ipsum Dolor Amet',
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
				'label'   => __( 'Background Image', 'metro-core' ),
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
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
				'label'       => __( 'Slider Layout', 'metro-core' ),
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
					'{{WRAPPER}} .rtin-item' => 'height: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'items',
				'label'   => __( 'Add as many items as you want', 'metro-core' ),
				'fields'  => $this->rt_repeater_fields(),
			),


			array(
				'type' => Controls_Manager::SLIDER,
				'mode' => 'responsive',
				'id'   => 'img_height',
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
				'condition'   => array( 'style' => '2' ),
				'label'   => __( 'Image box Height', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rtin-right' => 'height: {{SIZE}}{{UNIT}};',
				)
			),



			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}


	private function rt_load_scripts(){
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
	}

	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();

		if ( $data['style'] == '1' ) {
			$template = 'view';		
		}else {
			$template = 'view-1';
		}	

		return $this->rt_template( $template, $data );
	}
}