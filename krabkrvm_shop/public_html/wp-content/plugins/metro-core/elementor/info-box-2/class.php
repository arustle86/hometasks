<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/info-box/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;


if ( ! defined( 'ABSPATH' ) ) exit;

class Info_Box_2 extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Info Box 2', 'metro-core' );
		$this->rt_base = 'rt-info-box-2';
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
				'id'      => 'layout',				
				'label'   => __( 'Layout', 'metro-core' ),
				'options' => array(
					'1'  => __( 'Layout One', 'metro-core' ),
					'2'  => __( 'Layout Two', 'metro-core' ),
					
				),
				'default' => '1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style2',
				'mode' => 'responsive',
				'label'   => __( 'Content Align', 'metro-core' ),
				'options' => array(
					'right-top'  => __( 'Right Top ', 'metro-core' ),
					'right-bottom'  => __( 'Right Bottom', 'metro-core' ),
					'left-bottom'  => __( 'Left Bottom', 'metro-core' ),
					'right-bottom-center'  => __( 'Bottom Center', 'metro-core' ),					
				),
				'condition' => array( 'layout' => array('2') ),
				'default' => '1',
			),

			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => __( 'Content Align', 'metro-core' ),
				'options' => array(
					'1'  => __( 'Bottom Left', 'metro-core' ),
					'2'  => __( 'Top Left', 'metro-core' ),
					'3'  => __( 'Top Right', 'metro-core' ),
					'4'  => __( 'Bottom Right', 'metro-core' ),
					'5'  => __( 'Centrt Right', 'metro-core' ),
				),
				'condition' => array( 'layout' => array('1') ),
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
					'size' => 300,
				),
				'label'   => __( 'Box Height', 'metro-core' ),
				'condition' => array( 'layout' => array('1') ),
				'selectors' => array(
					'{{WRAPPER}} .rtin-item' => 'height: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type' => Controls_Manager::SLIDER,
				'id'   => 'space',
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 80,
				),
				'label'   => __( 'Left Spacing', 'metro-core' ),
				'condition' => array( 'layout' => array('1') ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box-2' => 'padding-left: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type' => Controls_Manager::SLIDER,
				'id'   => 'rspace',
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 80,
				),
				'label'   => __( 'Right Spacing', 'metro-core' ),
				'condition' => array( 'layout' => array('1') ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box-2' => 'padding-right: {{SIZE}}{{UNIT}};',
				)
			),

			array(
				'type'        => Controls_Manager::MEDIA,
				'id'          => 'image',
				'label'       => __( 'Product Image', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rtin-item' => 'background-image: url({{URL}});',
				)
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
				'default' => 'Lorem Ipsum Dolor Amet',
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => __( 'Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'btntext',
				'label'   => __( 'Link Text', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'mode' => 'section_end',
			),

			// Style Tab
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style_color',
				'tab'     => Controls_Manager::TAB_STYLE,
				'label'   => __( 'Color', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => __( 'Title', 'metro-core' ),
				'selectors' => array( '{{WRAPPER}} .rtin-title' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'selectors' => array( '{{WRAPPER}} .rtin-subtitle' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'link_color',
				'label'   => __( 'Link', 'metro-core' ),
				'selectors' => array('{{WRAPPER}} .rtin-btn-area .rtin-btn' => 'color: {{VALUE}}'),
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style_type',
				'tab'     => Controls_Manager::TAB_STYLE,
				'label'   => __( 'Typography', 'metro-core' ),
			),
			array(
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'title_typo',
				'label'    => __( 'Title', 'metro-core' ),
				'selector' => '{{WRAPPER}} .rtin-title',
			),
			array(
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'subtitle_typo',
				'label'    => __( 'Subtitle', 'metro-core' ),
				'selector' => '{{WRAPPER}} .rtin-subtitle',
			),
			array(
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'link_typo',
				'label'    => __( 'Link', 'metro-core' ),
				'selector' => '{{WRAPPER}} .rtin-btn',
				'condition' => array( 'layout' => array('1') ),
			),
			array(
				'mode' => 'section_end',
			),

		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		if ( $data['layout'] == '1' ) {
			$template = 'view';
		}elseif( $data['layout'] == '2'){
			$template = 'view2';
		}else {
			$template = 'view';
		}

		return $this->rt_template( $template, $data );
	}
}