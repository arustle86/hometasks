<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

trait Layout_Trait {
	
	private function bgimg_option( $key, $is_single = true ){
		$layout_key = $this->type.'_'.$key;

		if ( $is_single ) {
			$meta = !empty( $this->meta_value[$key] ) ? $this->meta_value[$key] : '';
		}
		else {
			$meta = '';
		}
		
		$op_layout  = RDTheme::$options[$layout_key];
		$op_global  = RDTheme::$options[$key];

		if ( $meta ) {
			$src = wp_get_attachment_image_src( $meta, 'full', true );
			$img = $src[0];
		}
		elseif ( !empty( $op_layout['url'] ) ) {
			$img = $op_layout['url'];
		}
		elseif ( !empty( $op_global['url'] ) ) {
			$img = $op_global['url'];
		}
		else {
			$img = Helper::get_img( 'banner.jpg' );
		}

		return $img;
	}

	// Single
	private function meta_layout_global_option( $key, $is_bool = false  ) {
		$layout_key = $this->type.'_'.$key;

		$meta       = !empty( $this->meta_value[$key] ) ? $this->meta_value[$key] : 'default';
		$op_layout  = RDTheme::$options[$layout_key] ? RDTheme::$options[$layout_key] : 'default';
		$op_global  = RDTheme::$options[$key];

		if ( $meta != 'default' ) {
			$result = $meta;
		}
		elseif ( $op_layout != 'default' ) {
			$result = $op_layout;
		}
		else {
			$result = $op_global;
		}

		if ( $is_bool ) {
			$result = ( $result == 1 || $result == 'on' ) ? true : false;
		}

		return $result;
	}

	// Single
	private function meta_layout_option( $key  ) {
		$layout_key = $this->type.'_'.$key;

		$meta       = !empty( $this->meta_value[$key] ) ? $this->meta_value[$key] : 'default';
		$op_layout  = RDTheme::$options[$layout_key];

		if ( $meta != 'default' ) {
			$result = $meta;
		}
		else {
			$result = $op_layout;
		}

		return $result;
	}

	// Archive
	private function layout_global_option( $key, $is_bool = false  ) {
		$layout_key = $this->type.'_'.$key;

		$op_layout  = RDTheme::$options[$layout_key] ? RDTheme::$options[$layout_key] : 'default';
		$op_global  = RDTheme::$options[$key];

		if ( $op_layout != 'default' ) {
			$result = $op_layout;
		}
		else {
			$result = $op_global;
		}

		if ( $is_bool ) {
			$result = ( $result == 1 || $result == 'on' ) ? true : false;
		}

		return $result;
	}

	// Archive
	private function layout_option( $key  ) {
		$layout_key = $this->type.'_'.$key;
		$op_layout  = RDTheme::$options[$layout_key];

		return $op_layout;
	}
}