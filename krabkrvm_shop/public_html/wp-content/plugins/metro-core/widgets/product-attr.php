<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use \WC_Widget;
use \WP_Widget;
use \RT_Widget_Fields;
use \WC_Query;

class Product_Attr extends WC_Widget {
	public function __construct() {
		$id = METRO_CORE_THEME_PREFIX . '_product_attr';
		WP_Widget::__construct(
            $id, // Base ID
            esc_html__( 'Metro: Variation Swatches Attribute Filter', 'metro-core' ), // Name
            array( 'description' => esc_html__( 'Metro: Variation Swatches Attribute Filter', 'metro-core' )
        ) );
	}

	private function rt_before( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
	}

	private function rt_after( $args, $instance ) {
		echo wp_kses_post( $args['after_widget'] );
	}

	private function rt_get_instance_taxonomy( $instance ) {
		if ( isset( $instance['attribute'] ) ) {
			return wc_attribute_taxonomy_name( $instance['attribute'] );
		}

		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $tax ) {
				if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
					return wc_attribute_taxonomy_name( $tax->attribute_name );
				}
			}
		}

		return '';
	}

	private function rt_view( $instance ) {
		$attributes = wc_get_attribute_taxonomies();
		$attribute_slug = '';
		$term_type = '';

		foreach ( $attributes as $attr ) {
			if ( $attr->attribute_name == $instance['attribute'] ) {
				$term_type = $attr->attribute_type; // type eg.
                $attribute_slug = $attr->attribute_name;
                break;
			}
		}

		if ( !$term_type || !$attribute_slug ) {
			return;
		}

		$data = $tooltip_html_attr = $image_tooltip = '';
		$attribute = wc_attribute_taxonomy_name( $instance['attribute'] ); // taxname eg. pa_color

		$filter_name    = 'filter_' . wc_attribute_taxonomy_slug( $attribute_slug );
		$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array();
		$current_filter = array_map( 'sanitize_title', $current_filter );

		$base_link = $this->get_current_page_url();


		$terms = get_terms( array(
			'taxonomy' => $attribute,
			'hide_empty' => false,
		) );

		foreach ( $terms as $term ) {
			$link = remove_query_arg( $filter_name, $base_link );
			$link = add_query_arg( $filter_name, $term->slug, $link );

			$name  = uniqid( wc_variation_attribute_name( $attribute ) );

			$tooltip_html_attr = sprintf( 'data-rtwpvs-tooltip="%s"', $term->name );
			$selected_class = in_array( $term->slug, $current_filter ) ? 'selected' : '';

			$data .= sprintf( '<div %1$s class="rtwpvs-term rtwpvs-%2$s-term %2$s-variable-term-%3$s %4$s" data-term="%3$s">', $tooltip_html_attr, esc_attr( $term_type ), esc_attr( $term->slug ), esc_attr( $selected_class ) );
			switch ( $term_type ) {
				case 'color':
				$color = sanitize_hex_color( get_term_meta( $term->term_id, 'product_attribute_color', true ) );
				$data .= sprintf( '<a href="%s" rel="nofollow" class="rtwpvs-term-span rtwpvs-term-span-%s" style="background-color:%s;"></a>', $link, esc_attr( $term_type ), esc_attr( $color ) );
				break;

				case 'size':
				$data .= sprintf( '<a href="%s" class="rtwpvs-term-span rtwpvs-term-span-%s">%s</a>', $link, esc_attr( $term_type ), esc_html( $term->name ) );
				break;

				case 'image':
				$attachment_id = absint( get_term_meta( $term->term_id, 'product_attribute_image', true ) );
				$image_size = rtwpvs()->get_option( 'attribute_image_size' );
				$image_url  = wp_get_attachment_image_url( $attachment_id, apply_filters( 'rtwpvs_product_attribute_image_size', $image_size ) );
				$data       .= sprintf( '<a href="%s"><img alt="%s" src="%s" /></a>', $link, esc_attr( $term->name ), esc_url( $image_url ) );
				break;

                case 'button':
                case 'radio':
                    $data .= sprintf('<a href="%s"><span class="rtwpvs-term-span rtwpvs-term-span-%s">%s</span></a>', $link, esc_attr($term_type), esc_html($term->name));
                    break;
			}

			$data .= '</div>';
		}


		$contents = $data;

		return sprintf( '<div class="rtwpvs-terms-wrapper %s" data-attribute_name="%s">%s</div>', "{$term_type}-variable-wrapper", esc_attr( wc_variation_attribute_name( $attribute ) ), $contents );
	}

	public function widget( $args, $instance ){
		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}

		echo $this->rt_view( $instance );

		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                = array();
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['attribute']   = ( ! empty( $new_instance['attribute'] ) ) ? sanitize_text_field( $new_instance['attribute'] ) : '';
		$instance['query_type']  = ( ! empty( $new_instance['query_type'] ) ) ? sanitize_text_field( $new_instance['query_type'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'      => '',
			'attribute'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$attribute_array      = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $tax ) {
				if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
					$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
				}
			}
		}

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'metro-core' ),
				'type'    => 'text',
			),
			'attribute'   => array(
				'label'   => esc_html__( 'Attribute', 'metro-core' ),
				'type'    => 'select',
				'options' => $attribute_array,
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}
