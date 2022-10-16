<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/countdown-2/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Countdown_2 extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Countdown 2', 'metro-core' );
		$this->rt_base = 'rt-countdown-2';
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
				'id'      => 'image',
				'label'   => __( 'Image', 'metro-core' ),
				'description' => __( 'Upload a transparent image', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => __( 'Title', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'subtitle',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'default' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit',
			),
			array(
				'type'    => Controls_Manager::CODE,
				'id'      => 'content',
				'label'   => __( 'Extra Content(Supports HTML code)', 'metro-core' ),
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'ripple',
				'label'       => __( 'Water Ripple Effect', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
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

		if ( $data['ripple'] ) {
			wp_enqueue_script( 'jquery-ripples' );
		}

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}