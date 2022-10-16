<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

trait Socials_Trait {
	
	public static function socials(){
		$socials = array(
			'social_facebook' => array(
				'icon' => 'fa-facebook',
				'url'  => RDTheme::$options['social_facebook'],
			),
			'social_twitter' => array(
				'icon' => 'fa-tg',
				'url'  => RDTheme::$options['social_twitter'],
			),
			'social_linkedin' => array(
				'icon' => 'fa-linkedin',
				'url'  => RDTheme::$options['social_linkedin'],
			),
			'social_youtube' => array(
				'icon' => 'fa-youtube',
				'url'  => RDTheme::$options['social_youtube'],
			),
			'social_pinterest' => array(
				'icon' => 'fa-pinterest',
				'url'  => RDTheme::$options['social_pinterest'],
			),
			'social_instagram' => array(
				'icon' => 'fa-instagram',
				'url'  => RDTheme::$options['social_instagram'],
			),
			'social_rss' => array(
				'icon' => 'fa-rss',
				'url'  => RDTheme::$options['social_rss'],
			),
		);
		$socials = apply_filters( 'rdtheme_socials', $socials );
		return array_filter( $socials, array( __CLASS__ , 'filter_social' ) );
	}

	public static function user_socials(){
		$socials = array(
			'facebook' => array(
				'label' => esc_html__( 'Facebook Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-facebook',
			),
			'tf' => array(
				'label' => esc_html__( 'Tg Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-tg',
			),
			'linkedin' => array(
				'label' => esc_html__( 'Linkedin Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-linkedin',
			),
			'gplus' => array(
				'label' => esc_html__( 'Google Plus Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-google-plus',
			),
			'github' => array(
				'label' => esc_html__( 'Github Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-github',
			),
			'youtube' => array(
				'label' => esc_html__( 'Youtube Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-youtube-play',
			),
			'pinterest' => array(
				'label' => esc_html__( 'Pinterest Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-pinterest-p',
			),
			'instagram' => array(
				'label' => esc_html__( 'Instagram Link', 'metro' ),
				'type'  => 'text',
				'icon'  => 'fa-instagram',
			),
		);
		return $socials;
	}

	public static function filter_social( $args ){
		return ( $args['url'] != '' );
	}
}