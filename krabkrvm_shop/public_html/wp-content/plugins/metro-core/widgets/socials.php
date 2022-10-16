<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use \WP_Widget;
use \RT_Widget_Fields;

class Socials_Widget extends WP_Widget {
	public function __construct() {
		$id = METRO_CORE_THEME_PREFIX . '_socials';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'Metro: Socials', 'metro-core' ), // Name
            array( 'description' => esc_html__( 'Metro: Socials', 'metro-core' )
        ) );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<ul>
			<?php
			if( !empty( $instance['facebook'] ) ){
				?><li><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php
			}
			if( !empty( $instance['twitter'] ) ){
				?><li><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php
			}
			if( !empty( $instance['linkedin'] ) ){
				?><li><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php
			}
			if( !empty( $instance['pinterest'] ) ){
				?><li><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php
			}
			if( !empty( $instance['instagram'] ) ){
				?><li><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php
			}
			if( !empty( $instance['github'] ) ){
				?><li><a href="<?php echo esc_url( $instance['github'] ); ?>" target="_blank"><i class="fa fa-github"></i></a></li><?php
			}
			if( !empty( $instance['wordpress'] ) ){
				?><li><a href="<?php echo esc_url( $instance['wordpress'] ); ?>" target="_blank"><i class="fa fa-wordpress"></i></a></li><?php
			}
			if( !empty( $instance['youtube'] ) ){
				?><li><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li><?php
			}
			if( !empty( $instance['rss'] ) ){
				?><li><a href="<?php echo esc_url( $instance['rss'] ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li><?php
			}
			?>
		</ul>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance              = array();
		$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['facebook']  = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']   = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']  = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['youtube']   = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['rss']       = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['github']    = ( ! empty( $new_instance['github'] ) ) ? sanitize_text_field( $new_instance['github'] ) : '';
		$instance['wordpress'] = ( ! empty( $new_instance['wordpress'] ) ) ? sanitize_text_field( $new_instance['wordpress'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'      => '',
			'facebook'   => '',
			'twitter'    => '',
			'linkedin'   => '',
			'pinterest'  => '',
			'youtube'    => '',
			'github'     => '',
			'wordpress'  => '',
			'rss'        => '', 
			'instagram'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'metro-core' ),
				'type'    => 'text',
			),
			'facebook'    => array(
				'label'   => __( 'Facebook URL', 'metro-core' ),
				'type'    => 'url',
			),
			'twitter'     => array(
				'label'   => __( 'Twitter URL', 'metro-core' ),
				'type'    => 'url',
			),
			'linkedin'    => array(
				'label'   => __( 'Linkedin URL', 'metro-core' ),
				'type'    => 'url',
			),
			'pinterest'   => array(
				'label'   => __( 'Pinterest URL', 'metro-core' ),
				'type'    => 'url',
			),
			'instagram'   => array(
				'label'   => __( 'Instagram URL', 'metro-core' ),
				'type'    => 'url',
			),
			'github'   => array(
				'label'   => __( 'Github URL', 'metro-core' ),
				'type'    => 'url',
			),
			'wordpress'   => array(
				'label'   => __( 'Wordpress URL', 'metro-core' ),
				'type'    => 'url',
			),
			'youtube'     => array(
				'label'   => __( 'YouTube URL', 'metro-core' ),
				'type'    => 'url',
			),
			'rss'         => array(
				'label'   => __( 'Rss Feed URL', 'metro-core' ),
				'type'    => 'url',
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}