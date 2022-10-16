<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/countdown-1/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Countdown_1 extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Countdown 1', 'metro-core' );
		$this->rt_base = 'rt-countdown-1';
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_script( 'jquery-countdown' );
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
				'label'       => __( 'Countdown Style', 'metro-core' ),
				'options'     => array(
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2', 'metro-core' ),				
					'3' => __( 'Style 3', 'metro-core' ),				
				),
				'default' => '1',
			),

			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'image',
				'label'   => __( 'Image', 'metro-core' ),
				'description' => __( 'Upload a transparent image', 'metro-core' ),
				
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => __( 'Title', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'subtitle',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'      => Controls_Manager::COLOR,
				'id'        => 'color',
				'label'     => __( 'Title Color', 'metro-core' ),
				'default'   => '#111111',
				'selectors' => array(
					'{{WRAPPER}} .rt-el-countdown-1 .rtin-title-area' => 'color: {{color}};',
				)
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'regular_price',
				'label'   => __( 'Regular Price', 'metro-core' ),
				'default' => '00',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'sale_price',
				'label'   => __( 'Sale Price', 'metro-core' ),
				'default' => '00',
			),
			array(
				'type'    => Controls_Manager::DATE_TIME,
				'id'      => 'date',
				'label'   => __( 'Date-Time', 'metro-core' ),
				'description' => __( 'Enter a future date-time', 'metro-core' ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();

		if ( $data['style'] == '1' ) {			
			$template = 'view';
		}else {			
			$template = 'view-2';
		}
		return $this->rt_template( $template, $data );
	}
}