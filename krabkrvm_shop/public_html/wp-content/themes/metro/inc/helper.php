<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

use radiustheme\Lib\WP_SVG;

class Helper {

	use Socials_Trait;
	use Asset_Loader_Trait;

	public static function has_sidebar() {
		$has_sidebar_widgets = false;
		if ( RDTheme::$sidebar ) {
			if ( is_active_sidebar( RDTheme::$sidebar ) ){
				$has_sidebar_widgets = true;
			}
		}
		else {
			if ( is_active_sidebar( 'sidebar' ) ){
				$has_sidebar_widgets = true;
			}
		}

		if ( $has_sidebar_widgets && RDTheme::$layout != 'full-width' ) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function the_layout_class() {
		$layout_class = self::has_sidebar() ? 'col-lg-9 col-md-8 col-sm-12 col-12' : 'col-sm-12 col-12';
		echo apply_filters( 'metro_layout_class', $layout_class );
	}

	public static function the_sidebar_class() {
		echo apply_filters( 'metro_sidebar_class', 'col-lg-3 col-md-4 ol-sm-12 col-12' );
	}

	public static function left_sidebar() {
		if ( self::has_sidebar() ) {
			if ( RDTheme::$layout == 'left-sidebar' ) {
				get_sidebar();
			}			
		}
	}

	public static function right_sidebar() {
		if ( self::has_sidebar() ) {
			if ( RDTheme::$layout == 'right-sidebar' ) {
				get_sidebar();
			}
		}
	}

	public static function shop_grid_page_url() {
		global $wp;
		$current_url = add_query_arg( $wp->query_string, '&shopview=grid', home_url( $wp->request ) );
		return $current_url;
	}

	public static function shop_list_page_url() {
		global $wp;
		$current_url = add_query_arg( $wp->query_string, '&shopview=list', home_url( $wp->request ) );
		return $current_url;
	}

	public static function the_breadcrumb() {
		if ( function_exists( 'bcn_display') ) {
			bcn_display();
		}
		else {
			Helper::requires( 'breadcrumbs.php' );
			$args = array(
				'show_browse'   => false,
				'post_taxonomy' => array( 'product' =>'product_cat' )
			);
			$breadcrumb = new RDTheme_Breadcrumb( $args );
			return $breadcrumb->trail();
		}
	}
	
	public static function filter_content( $content ){
		// wp filters
		$content = wptexturize( $content );
		$content = convert_smilies( $content );
		$content = convert_chars( $content );
		$content = wpautop( $content );
		$content = shortcode_unautop( $content );

		// remove shortcodes
		$pattern= '/\[(.+?)\]/';
		$content = preg_replace( $pattern,'',$content );

		// remove tags
		$content = strip_tags( $content );

		return $content;
	}

	public static function get_current_post_content( $post = false ) {
		if ( !$post ) {
			$post = get_post();				
		}
		$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
		$content = self::filter_content( $content );
		return $content;
	}

	public static function comments_callback( $comment, $args, $depth ){
		$args2 = get_defined_vars();
		Helper::get_template_part( 'template-parts/comments-callback', $args2 );
	}

	public static function nav_menu_args(){
		$nav_menu_args = array( 'theme_location' => 'primary','container' => 'nav', 'fallback_cb' => false );
		
		return $nav_menu_args;
	}	
	public static function nav_menu_offcanvas_args(){
		$nav_menu_args = array( 'theme_location' => 'offcanvas','container' => 'offcanvas-nav', 'fallback_cb' => false );
		
		return $nav_menu_args;
	}

	public static function user_textfield( $label, $field, $value ){
		?>
		<tr>
			<th>
				<label><?php echo esc_html( $label ); ?></label>
			</th>
			<td>
				<input class="regular-text" type="text" value="<?php echo esc_attr( $value );?>" name="<?php echo esc_attr( $field );?>">
			</td>
		</tr>
		<?php
	}

	public static function is_page( $arg ) {
		if ( function_exists( $arg ) && call_user_func( $arg ) ) {
			return true;
		}
		return false;
	}

	public static function get_primary_color() {
		$colors = array(
			'black'  => '#111111',
			'red'    => '#e53935',
			'orange' => '#FF9900',
			'tomato' => '#f26c4f',
		);

		if ( RDTheme::$options['color_type'] == 'custom' ) {
			$primary_color = RDTheme::$options['primary_color'];
		}
		else {
			$primary_color =$colors[RDTheme::$options['color_type']];
		}

		return apply_filters( 'rdtheme_primary_color', $primary_color );
	}

	public static function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = "$r, $g, $b";
		return $rgb;
	}

	public static function uniqueid() {
		$time = microtime();
		$time = str_replace( array( ' ','.' ), '-' , $time );
		$id = 'u-'. $time;
		return $id;
	}

	public static function custom_sidebar_fields() {
		$prefix = Constants::$theme_prefix;
		$sidebar_fields = array();

		$sidebar_fields['sidebar'] = esc_html__( 'Sidebar', 'metro' );

		$sidebars = get_option( "{$prefix}_custom_sidebars", array() );
		if ( $sidebars ) {
			foreach ( $sidebars as $sidebar ) {
				$sidebar_fields[$sidebar['id']] = $sidebar['name'];
			}
		}

		return $sidebar_fields;
	}

	public static function get_attachment_image( $attachment_id, $size = 'thumbnail', $icon = false, $attr = '' ) {
		if ( !defined( 'METRO_CORE' ) ) {
			return wp_get_attachment_image( $attachment_id, $size, $icon, $attr );
		}
		else {
			$img = WP_SVG::get_attachment_image( $attachment_id, $size, $icon, $attr );
		}
		return $img;
	}
}