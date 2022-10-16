<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

class General_Setup {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_setup_theme',   array( $this, 'theme_setup' ) );
		add_action( 'widgets_init',        array( $this, 'register_sidebars' ) );
		add_filter( 'body_class',          array( $this, 'body_classes' ) );
		add_filter( 'excerpt_more',        array( $this, 'excerpt_more' ) );
		add_filter( 'excerpt_length',      array( $this, 'excerpt_length' ) );
		add_action( 'wp_head',             array( $this, 'noscript_hide_preloader' ), 1 );
		add_action( 'wp_head',             array( $this, 'pingback' ) );
		add_action( 'wp_body_open',        array( $this, 'preloader' ) );
		add_action( 'wp_footer',           array( $this, 'scroll_to_top_html' ), 5 );
		add_action( 'wp_footer',           array( $this, 'search_popup' ), 5 );
		add_filter( 'get_search_form',     array( $this, 'search_form' ) );
		add_filter( 'comment_form_fields', array( $this, 'move_textarea_to_bottom' ) );
		add_filter( 'post_class',          array( $this, 'hentry_config' ) );
		add_filter( 'elementor/widgets/wordpress/widget_args', array( $this, 'elementor_widget_args' ) );
		add_filter( 'wpcf7_autop_or_not',  '__return_false' ); // cf7 wptop

		/* User extra fields */
		add_action( 'show_user_profile',         array( $this, 'user_fields_form' ) );
		add_action( 'edit_user_profile',         array( $this, 'user_fields_form' ) );
		add_action( 'personal_options_update',   array( $this, 'user_fields_update' ) );
		add_action( 'edit_user_profile_update',  array( $this, 'user_fields_update' ) );

		add_filter('rest_pre_insert_post', [$this, 'pre_insert_post'], 12, 2);
		add_filter('rest_prepare_post', [$this, 'prepare_post'], 12, 3);
	}


	public function pre_insert_post($post, \WP_REST_Request $request) {
		$body = $request->get_body();
		if ($body) {
		    $body = json_decode($body);
		    if (isset($body->menu_order)) {
		        $post->menu_order = $body->menu_order;
		    }
		}

		return $post;
	}

	public function prepare_post(\WP_REST_Response $response, $post, $request) {
		$response->data['menu_order'] = $post->menu_order;
		return $response;
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function theme_setup() {
		// Theme supports
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_post_type_support( 'post', 'page-attributes' );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'Black', 'metro' ),
				'slug' => 'metro-black',
				'color' => '#111111',
			),
			array(
				'name' => esc_html__( 'Red', 'metro' ),
				'slug' => 'metro-red',
				'color' => '#e53935',
			),
			array(
				'name' => esc_html__( 'Orange', 'metro' ),
				'slug' => 'metro-orange',
				'color' => '#FF9900',
			),
			array(
				'name' => esc_html__( 'Tomato', 'metro' ),
				'slug' => 'metro-tomato',
				'color' => '#f26c4f',
			),
			array(
				'name' => esc_html__( 'White', 'metro' ),
				'slug' => 'metro-white',
				'color' => '#ffffff',
			),
		) );

		// Image sizes
		$sizes = array(
			'rdtheme-size1' => array( 1300, 600, true ), // When Full width
			'rdtheme-size2' => array( 960, 480,  true ), // When sidebar present
			'rdtheme-size3' => array( 465, 290,  true ), // Blog 2,3
			'rdtheme-size5' => array( 520, 680,  true ), // Product Fullscreen-1 520/680
			'rdtheme-size6' => array( 410, 490,  true ), // Product Fullscreen-2
			'rdtheme-size7' => array( 1290, 760,  true ), // Single Product 3
			'rdtheme-size8' => array( 400, 438,  true ), // Single Product 3
		);

		$this->add_image_sizes( $sizes );

		// Register menus
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary', 'metro' ),
			'vertical' => esc_html__( 'Vertical', 'metro' ),
			'offcanvas' => esc_html__( 'Offcanvas', 'metro' ),
		) );
	}

	private function add_image_sizes( $sizes ) {
		$sizes = apply_filters( 'metro_image_sizes', $sizes );

		foreach ( $sizes as $size => $value ) {
			add_image_size( $size, $value[0], $value[1], $value[2] );
		}
	}

	public function register_sidebars() {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'metro' ),
			'id'            => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
		
		
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Page Top Bar', 'metro' ),
			'id'            => 'topbar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );

		$footer_widget_titles = array(
			'1' => esc_html__( 'Footer 1', 'metro' ),
			'2' => esc_html__( 'Footer 2', 'metro' ),
			'3' => esc_html__( 'Footer 3', 'metro' ),
			'4' => esc_html__( 'Footer 4', 'metro' ),
		);

		foreach ( $footer_widget_titles as $id => $name ) {
			register_sidebar( array(
				'name'          => $name,
				'id'            => 'footer-'. $id,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			) );			
		}
	}

	public function body_classes( $classes ) {
    	// Header
		$classes[] = 'non-stick';
		$classes[] = 'header-style-'. RDTheme::$header_style;

		if ( RDTheme::$has_top_bar ){
			$classes[] = 'has-topbar';
		}
		if ( RDTheme::$footer_area_style){
			$classes[] = 'has-footer-dark';
		}
        // Sidebar
		if ( RDTheme::$layout == 'left-sidebar' ) {
			$classes[] = 'has-sidebar left-sidebar';
		}
		elseif ( RDTheme::$layout == 'right-sidebar' ) {
			$classes[] = 'has-sidebar right-sidebar';
		}
		else {
			$classes[] = 'no-sidebar';
		}

		// Color
		if ( RDTheme::$options['color_type'] == 'black' ) {
			$classes[] = 'scheme-black';
		}
		else {
			$classes[] = 'scheme-custom';
		}

		// Bgtype
		if ( RDTheme::$bgtype == 'bgimg' ) {
			$classes[] = 'header-bgimg';
		}

		return $classes;
	}

	public function noscript_hide_preloader(){
		// Hide preloader if js is disabled
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}

	public function pingback() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function preloader(){
		// Preloader
		if ( RDTheme::$options['preloader'] ){
			if ( !empty( RDTheme::$options['preloader_image']['url'] ) ) {
				$preloader_img = RDTheme::$options['preloader_image']['url'];
			}
			else {
				$preloader_img = Helper::get_img( 'preloader.gif' );
			}
			echo '<div id="preloader" style="background-image:url(' . esc_url( $preloader_img ) . ');"></div>';
		}
	}

	public function scroll_to_top_html(){
		// Back-to-top link
		if ( RDTheme::$options['back_to_top'] ){
			echo '<a href="#" class="scrollToTop"><i class="fa fa-angle-double-up"></i></a>';
		}
	}

	public function search_popup(){
		if ( RDTheme::$options['search_icon'] ){
			get_template_part( 'template-parts/header/icon-search-popup' );
		}
	}

	public function search_form(){
		$output =  '
		<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<div class="custom-search-input">
		<div class="input-group">
		<input type="text" class="search-query form-control" placeholder="' . esc_attr__( 'Поиск ...', 'metro' ) . '" value="' . get_search_query() . '" name="s" />
		<span class="input-group-btn">
		<button class="btn" type="submit">
		<span class="flaticon-search"></span>
		</button>
		</span>
		</div>
		</div>
		</form>
		';
		return $output;
	}

	public function move_textarea_to_bottom( $fields ) {
		$temp = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $temp;
		return $fields;
	}

	public function hentry_config( $classes ){
		if ( is_search() || is_page() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}
		return $classes;
	}

	public function excerpt_more() {
		return esc_html__( ' ...', 'metro' );
	}

	public function excerpt_length( $length ) {
		if ( is_home() && (RDTheme::$options['blog_style'] == '2' || RDTheme::$options['blog_style'] == '3') ){
			return 25;
		}
		return $length;
	}

	public function user_fields_form( $user ) {
		$user_meta   = get_the_author_meta( 'metro_user_info', $user->ID );
		$designation = isset( $user_meta['designation'] ) ? $user_meta['designation'] : '';
		$socials = Helper::user_socials();
		?>
		<h2><?php esc_html_e( 'Additional Information', 'metro' ); ?></h2>
		<table class="form-table">
			<tbody>
				<?php
				Helper::user_textfield( esc_html__( 'Designation', 'metro' ), 'metro_user_info[designation]', $designation );
				foreach ( $socials as $key => $value ) {
					$social = isset( $user_meta['socials'][$key] ) ? $user_meta['socials'][$key] : '';
					Helper::user_textfield( $value['label'], "metro_user_info[socials][$key]", $social );
				}
				?>
			</tbody>
		</table>
		<?php
	}

	public function user_fields_update( $user_id=false ) {
		if ( !$user_id ) {
			$user_id = get_current_user_id();
			if ( !$user_id ) return;
		}

		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		if ( !isset( $_POST['metro_user_info'] ) ) return;

		// Sanitize fields
		$meta = $_POST['metro_user_info'];
		if ( isset( $meta['designation'] ) ) {
			sanitize_text_field( $meta['designation'] );
		}
		if ( isset( $meta['socials'] ) ) {
			foreach ( $meta['socials'] as $key => $value ) {
				$meta['socials'][$key] = sanitize_text_field( $value );
			}
		}
		
		update_user_meta( $user_id, 'metro_user_info', $meta );
	}

	public function elementor_widget_args( $args ) {
		$args['before_widget'] = '<div class="widget %2$s">';
		$args['after_widget']  = '</div>';
		$args['before_title']  = '<h3>';
		$args['after_title']   = '</h3>';
		return $args;
	}
}

General_Setup::instance();