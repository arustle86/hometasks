<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/countdown-3/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Countdown_3 extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Countdown 3', 'metro-core' );
		$this->rt_base = 'rt-countdown-3';
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
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'image1',
				'label'   => __( 'Product Image', 'metro-core' ),
				'description' => __( 'Upload a transparent image', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'image2',
				'label'   => __( 'Title Image', 'metro-core' ),
				'description' => __( 'Upload a transparent image', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::DATE_TIME,
				'id'      => 'date',
				'label'   => __( 'Date-Time', 'metro-core' ),
				'description' => __( 'Enter a future date-time', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'btntext',
				'label'   => __( 'Button Text', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'btnurl',
				'label' => __( 'Button Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
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
		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}