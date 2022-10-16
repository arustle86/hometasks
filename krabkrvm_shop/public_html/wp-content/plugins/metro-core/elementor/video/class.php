<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/video/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Video extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Video', 'metro-core' );
		$this->rt_base = 'rt-video';
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_script( 'jquery-magnific-popup' );
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
				'id'      => 'bgimg',
				'label'   => __( 'Background Image', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-video' => 'background-image: url({{URL}});',
				)
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'bgoverlay',
				'label'   => __( 'Background Overlay', 'metro-core' ),
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1,
						'step' => 0.01,
					),
				),
				'default' => array(
					'size' => .4,
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-video::before' => 'background-color: rgba(0, 0, 0, {{SIZE}});',
				)
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'spacing',
				'mode'    => 'responsive',
				'label'   => __( 'Top/Bottom Spacing', 'metro-core' ),
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 400,
					),
				),
				'default' => array(
					'size' => 70,
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-video' => 'padding: {{SIZE}}{{UNIT}} 0;',
				)
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => __( 'Title', 'metro-core' ),
				'default' => 'Lorem Ipsum dolor sit amet',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'label',
				'label'   => __( 'Video Label', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => __( 'Video Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
				'description' => __( 'Enter any video link from external sources eg. http://www.youtube.com/watch?v=1iIZeIy7TqM', 'metro-core' ),
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