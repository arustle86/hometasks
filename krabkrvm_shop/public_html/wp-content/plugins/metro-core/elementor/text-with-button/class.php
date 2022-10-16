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

class Text_With_Button extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Text With Button', 'metro-core' );
		$this->rt_base = 'rt-text-with-button';
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
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => __( 'Title', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'subtitle',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'default' => 'Lorem Ipsum Dolor Amet',
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => __( 'Button Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'btntext',
				'label'   => __( 'Button Text', 'metro-core' ),
				'default' => 'Lorem Ipsum',
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