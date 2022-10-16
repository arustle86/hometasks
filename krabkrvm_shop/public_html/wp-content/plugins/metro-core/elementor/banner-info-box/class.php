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

if ( ! defined( 'ABSPATH' ) ) exit;

class Banner_Info_Box extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Banner Info Box', 'metro-core' );
		$this->rt_base = 'rt-banner-info-box';
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
				'id'      => 'style',
				'label'   => __( 'Style', 'metro-core' ),
				'options' => array(
					'1'  => __( 'Style 1', 'metro-core' ),
					'2'  => __( 'Style 2', 'metro-core' ),				
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
					'size' => 200,
				),
				'label'   => __( 'Box Height', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rtin-item' => 'height: {{SIZE}}{{UNIT}};',
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
				'default' => 'Collections',
				'condition' => array( 'style' => array('1') ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'content_pos',
				'label'   => __( 'Content Position', 'metro-core' ),
				'options' => array(
					'left-bottom'  => __( 'Left Bottom', 'metro-core' ),
					'left-top'     => __( 'Left Top', 'metro-core' ),
					'right-top'    => __( 'Right Top', 'metro-core' ),
					'right-bottom' => __( 'Right Bottom', 'metro-core' ),
				),
				'default' => 'left-bottom',
				'condition' => array( 'style' => array('1') ),
			),
			array(
				'type' => Controls_Manager::SLIDER,
				'id'   => 'radius',
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'label'   => __( 'Border Radius', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box' => 'border-radius: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'mode' => 'section_end',
			),

			// Background
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_bg',
				'label'   => __( 'Background', 'metro-core' ),
			),
			array(
				'type'    => \Elementor\Group_Control_Background::get_type(),
				'mode'    => 'group',
				'types'   => array( 'classic', 'gradient' ),
				'id'      => 'background',
				'label'   => __( 'Background', 'classima-core' ),
				'selector' => '{{WRAPPER}} .rt-el-info-box',
			),
			array(
				'mode' => 'section_end',
			),

			array(
				'mode'    => 'section_start',
				'id'      => 'sec_img',
				'label'   => __( 'Product Image', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::MEDIA,
				'id'          => 'image',
				'label'       => __( 'Image', 'metro-core' ),
				'description' => __( 'Use a transparent image', 'metro-core' ),
			),
			array(
				'type' => Controls_Manager::SLIDER,
				'mode' => 'responsive',
				'id'      => 'image_size',
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default' => array(
					'unit' => 'px',
				),
				'label'   => __( 'Image Size', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box .rtin-item .rtin-img img' => 'width: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'    => Controls_Manager::CHOOSE,
				'id'      => 'pos_x_type',
				'label'   => __( 'Horizontal Position', 'metro-core' ),				
				'options' => [
					'left' => [
						'title' => __( 'Left', 'metro-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'metro-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode'    => 'responsive',
				'id'      => 'pos_x',
				'label'   => __( 'Offset', 'metro-core' ),
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => -500,
						'max' => 500,
					),
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box .rtin-item .rtin-img.rtin-pos-left'  => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-info-box .rtin-item .rtin-img.rtin-pos-right' => 'right: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'    => Controls_Manager::CHOOSE,
				'id'      => 'pos_y_type',
				'label'   => __( 'Vertical Position', 'metro-core' ),				
				'options' => [
					'top' => [
						'title' => __( 'Top', 'metro-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'metro-core' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default' => 'bottom',
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode'    => 'responsive',
				'id'      => 'pos_y',
				'label'   => __( 'Offset', 'metro-core' ),
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => -500,
						'max' => 500,
					),
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box .rtin-item .rtin-img.rtin-pos-top'    => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-info-box .rtin-item .rtin-img.rtin-pos-bottom' => 'bottom: {{SIZE}}{{UNIT}};',
				)
			),

			array(
				'mode' => 'section_end',
			),

			// Button
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_linking',
				'label'   => __( 'Link and Button', 'metro-core' ),
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
				'label'   => __( 'Button Text', 'metro-core' ),
				'default' => 'Lorem Ipsum',
				'condition' => array( 'style' => array('1') ),
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
				'selectors' => array( '{{WRAPPER}} .rtin-title' => 'color: {{VALUE}}', '{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}' ),
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
				'label'   => __( 'Button/Link', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-info-box .rtin-item .rtin-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-info-box.rtin-style-8 .rtin-item .rtin-btn::after, {{WRAPPER}} .rt-el-info-box.rtin-style-9 .rtin-item .rtin-btn::after' => 'background-color: {{VALUE}}',
				),
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
				'label'    => __( 'Button/Link', 'metro-core' ),
				'selector' => '{{WRAPPER}} .rt-el-info-box-1 .rtin-item .rtin-btn',
			),
			array(
				'mode' => 'section_end',
			),

		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';		
		$data['hasbtn'] = $data['btntext'] && in_array( $data['style'] , array('1') ) ? true : false;
		return $this->rt_template( $template, $data );
	}
}