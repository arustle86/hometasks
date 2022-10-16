<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/contact/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Contact extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Contact', 'metro-core' );
		$this->rt_base = 'rt-contact';
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
				'id'      => 'address',
				'label'   => __( 'Address', 'metro-core' ),
				'default' => 'Lorem Ipsum text of the printing and typesetting industry',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'phone',
				'label'   => __( 'Phone', 'metro-core' ),
				'default' => '+0000000000',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'email',
				'label'   => __( 'Email', 'metro-core' ),
				'default' => 'info@example.com',
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