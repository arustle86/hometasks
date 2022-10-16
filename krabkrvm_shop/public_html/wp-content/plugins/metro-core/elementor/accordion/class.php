<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
if ( ! defined( 'ABSPATH' ) ) exit;

class Accordion extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Accordion', 'metro-core' );
		$this->rt_base = 'rt-accordion';
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
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'items',
				'label'   => __( 'Add as many items as you want', 'metro-core' ),
				'fields'  => array(
					array(
						'type'  => Controls_Manager::TEXT,
						'name'  => 'title',
						'label' => __( 'Title', 'metro-core' ),
						'default' => 'Lorem Ipsum dolor amet',
					),
					array(
						'type'    => Controls_Manager::WYSIWYG,
						'name'    => 'content',
						'label'   => __( 'Content', 'metro-core' ),
						'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip',
					),
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