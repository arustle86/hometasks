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

class Banner_With_Link extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Banner With Link', 'metro-core' );
		$this->rt_base = 'rt-banner-with-link';
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
				'type'    => \Elementor\Group_Control_Background::get_type(),
				'mode'    => 'group',
				'types'   => array( 'classic' ),
				'id'      => 'background',
				'label'   => __( 'Background', 'classima-core' ),
				'selector' => '{{WRAPPER}} .rt-el-banner-with-link .rtin-item',
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
					'size' => 235,
				),
				'label'   => __( 'Height', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-banner-with-link .rtin-item' => 'height: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => __( 'Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',
				'condition' => array( 'style' => array('1') ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'linktext',
				'label'   => __( 'Link Text', 'metro-core' ),
				'default' => '@loremipsum',
				'condition' => array( 'style' => array('1') ),
			),
			array(
				'mode' => 'section_end',
			),
	


			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general_content',
				'label'   => __( 'Content', 'metro-core' ),
				'condition' => array( 'style' => array('2') ),
			),

			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title_before',
				'label'   => __( 'Title Before', 'metro-core' ),
				'default' => 'New Trending',
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_before_color',
				'label'   => __( 'Title Before Color', 'metro-core' ),
				'default' => '#fff',
				'selectors' => array( '{{WRAPPER}} .rt-el-banner-with-link .rtin-item-content .rtin-sub-title' => 'color: {{VALUE}}' ),
			),
			array(
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'title_before_typo',
				'label'    => __( 'Title Before Typography', 'metro-core' ),
				'selector' => '{{WRAPPER}} .rt-el-banner-with-link .rtin-item-content .rtin-sub-title',
			),
	
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => __( 'Title Text', 'metro-core' ),
				'default' => 'Casual Shoes',
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => __( 'Title Color', 'metro-core' ),
				'default' => '#fff',
				'selectors' => array( '{{WRAPPER}} .rt-el-banner-with-link .rtin-item-content .rtin-title' => 'color: {{VALUE}}' ),
			),
			array(
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Typography::get_type(),
				'id'       => 'title_typo',
				'label'    => __( 'Title Typography', 'metro-core' ),
				'selector' => '{{WRAPPER}} .rt-el-banner-with-link .rtin-item-content .rtin-title',
			),


			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'curl',
				'label' => __( 'Link', 'metro-core' ),
				'placeholder' => 'https://your-link.com',				
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
				'type' => Controls_Manager::SLIDER,
				'mode' => 'responsive',
				'id'   => 'left_right',
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 235,
				),
				'label'   => __( 'Left - Right', 'metro-core' ),
				'selectors' => array(					

					'{{WRAPPER}} .rt-el-banner-with-link.rtin-pos-left .rtin-item-content'  => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-banner-with-link.rtin-pos-right .rtin-item-content' => 'right: {{SIZE}}{{UNIT}};',

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
				'type' => Controls_Manager::SLIDER,
				'mode' => 'responsive',
				'id'   => 'top_buttom',
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 235,
				),
				'label'   => __( 'Top - Bottom', 'metro-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-el-banner-with-link.rtin-pos-top .rtin-item-content' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-banner-with-link.rtin-pos-bottom .rtin-item-content' => 'bottom: {{SIZE}}{{UNIT}};',
					
				)
			),

			array(
				'mode' => 'section_end',
			),




		);

		return $fields;

	}


	protected function render() {
		$data = $this->get_settings();

		if ( $data['style'] == '1' ) {
			$template = 'view';
		}
		else {
			$template = 'view-2';
		}
		
		return $this->rt_template( $template, $data );
	}
}