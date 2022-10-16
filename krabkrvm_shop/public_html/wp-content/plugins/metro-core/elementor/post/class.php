<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/post/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Post extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Post', 'metro-core' );
		$this->rt_base = 'rt-post';
		parent::__construct( $data, $args );
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'roofix-core' ),
				'6'  => esc_html__( '2 Col', 'roofix-core' ),
				'4'  => esc_html__( '3 Col', 'roofix-core' ),
				'3'  => esc_html__( '4 Col', 'roofix-core' ),
				'2'  => esc_html__( '6 Col', 'roofix-core' ),
			),
		);
	}

	private function rt_load_scripts(){
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
	}

	private function rt_query( $data, $qty = 3 ) {
		$args = array(
			'cat'                 => (int) $data['cat'],
			'orderby'             => $data['orderby'],
			'posts_per_page'      => $data['qty'],
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'ignore_sticky_posts' => true,
		);

		switch ( $data['orderby'] ) {
			case 'title':
			case 'menu_order':
			$args['order'] = 'ASC';
			break;
		}

		return new \WP_Query( $args );
	}

	public function rt_fields(){

		$categories = get_categories();
		$category_dropdown = array( '0' => __( 'All Categories', 'metro-core' ) );

		foreach ( $categories as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

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
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2', 'metro-core' ),
					'3' => __( 'Style 3', 'metro-core' ),
					'4' => __( 'Style 4', 'metro-core' ),
					'5' => __( 'Style 5', 'metro-core' ),
					'6' => __( 'Style 6', 'metro-core' ),
					'7' => __( 'Style 7', 'metro-core' ),
					'8' => __( 'Style 8', 'metro-core' ),
					'9' => __( 'Style 9', 'metro-core' ),
				),
				'default' => '1',
			),

			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'qty',
				'label'   => __( 'Post Limit', 'metro-core' ),
				'default' => 3,
				'description' => __( 'Maximum number of Post to display', 'metro-core' ),				
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'bgtype',
				'label'   => __( 'Background Type', 'metro-core' ),
				'options' => array(
					'light' => __( 'Light Background', 'metro-core' ),
					'dark'  => __( 'Dark Background', 'metro-core' ),
				),
				'default' => 'light',
				'condition'   => array( 'style' => array( '1' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => __( 'Title', 'metro-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title_right_link_text',
				'label'   => __( 'Title Right Link Text', 'metro-core' ),
				'default' => 'See More',
				'condition'   => array( 'style' => array( '7' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => __( 'Content Limit', 'metro-core' ),
				'default' => 12,
				'description' => __( 'Maximum number of words to display', 'metro-core' ),
				'condition'   => array( 'style' => array( '3', '4', '8' , '9' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'subtitle',
				'label'   => __( 'Subtitle', 'metro-core' ),
				'default' => 'Lorem Ipsum has been standard daand scrambled. Rimply dummy text of the printing and typesetting industry',
				'condition' => array( 'style' => array( '3', '8', '9' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => __( 'Categories', 'metro-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => __( 'Order By', 'metro-core' ),
				'options' => array(
					'date'        => __( 'Date (Recents comes first)', 'metro-core' ),
					'title'       => __( 'Title', 'metro-core' ),
					'menu_order'  => __( 'Custom Order (Available via Order field inside Page Attributes box)', 'metro-core' ),
				),
				'default' => 'date',
			),
			array(
				'mode' => 'section_end',
			),


			// Responsive Columns
				array(
					'mode'    => 'section_start',
					'id'      => 'sec_responsive',
					'label'   => esc_html__( 'Number of Responsive Columns', 'roofix-core' ),
					'condition'   => array( 'style' => array( '1', '2', '3' ) ),
				),
					array(
						'type'    => Controls_Manager::SELECT2,
						'id'      => 'col_lg',
						'label'   => esc_html__( 'Desktops: > 1199px', 'roofix-core' ),
						'options' => $this->rt_translate['cols'],
						'default' => '4',
					),
					array(
						'type'    => Controls_Manager::SELECT2,
						'id'      => 'col_md',
						'label'   => esc_html__( 'Desktops: > 991px', 'roofix-core' ),
						'options' => $this->rt_translate['cols'],
						'default' => '4',
					),
					array(
						'type'    => Controls_Manager::SELECT2,
						'id'      => 'col_sm',
						'label'   => esc_html__( 'Tablets: > 767px', 'roofix-core' ),
						'options' => $this->rt_translate['cols'],
						'default' => '6',
					),
					array(
						'type'    => Controls_Manager::SELECT2,
						'id'      => 'col_xs',
						'label'   => esc_html__( 'Phones: < 768px', 'roofix-core' ),
						'options' => $this->rt_translate['cols'],
						'default' => '12',
					),
			array(
				'mode' => 'section_end',
			),


		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		if ( $data['style'] == '4' ) {
			$data['query'] = $this->rt_query( $data, 5 );
		}
		else {
			$data['query'] = $this->rt_query( $data );
		}

		switch ( $data['style'] ) {
			case '1':
			$template = 'view-1';
			break;

			case '2':
			$template = 'view-2';
			break;

			case '3':
			$template = 'view-3';
			break;

			case '4':
			$owl_data = array( 
				'nav'                => false,
				'dots'               => false,
				'autoplay'           => true,
				'autoplayTimeout'    => 5000,
				'autoplaySpeed'      => 200,
				'autoplayHoverPause' => true,
				'loop'               => true,
				'margin'             => 30,
				'responsive'         => array(
					'0'    => array( 'items' => 1 ),
					'650'  => array( 'items' => 2 ),
					'992'  => array( 'items' => 3 ),
				)
			);

			$data['owl_data'] = json_encode( $owl_data );
			$this->rt_load_scripts();
			$template = 'view-4';
			break;

			case '5':
			$template = 'view-5';
			break;

			case '6':
			$template = 'view-6';
			break;

			case '7':
			$template = 'view-7';
			break;

			case '8':
			$template = 'view-8';
			break;

			case '9':
			$template = 'view-9';
			break;
			
			default:
			$template = 'view-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}