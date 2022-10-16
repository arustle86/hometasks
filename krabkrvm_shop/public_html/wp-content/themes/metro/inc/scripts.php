<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.1.1
 */

namespace radiustheme\Metro;

use Elementor\Plugin;

class Scripts {

	use Script_Trait;

	public $version;
	protected static $instance = null;

	public function __construct() {
		$this->version = Constants::$theme_version;

		add_action( 'wp_enqueue_scripts',          array( $this, 'register_scripts' ), 12 );
		add_action( 'wp_enqueue_scripts',          array( $this, 'enqueue_scripts' ), 15 );

		add_action( 'admin_enqueue_scripts',       array( $this, 'admin_scripts' ), 15 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_scripts' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function register_scripts(){
		
		/* Dequeing */
		
		wp_dequeue_style( 'font-awesome' );
		wp_dequeue_style( 'layerslider-font-awesome' );
		wp_dequeue_style( 'yith-wcwl-font-awesome' );
		wp_dequeue_script( 'rtwpvg-slider' );

		/* Slick */
		wp_register_style( 'slick',                     Helper::get_vendor_assets( 'slick/slick.css' ), array(), $this->version );
		wp_register_style( 'slick-theme',               Helper::get_vendor_assets( 'slick/slick-theme.css' ), array(), $this->version );
		wp_register_script( 'slick',                    Helper::get_vendor_assets( 'slick/slick.min.js' ), array( 'jquery' ), $this->version, true );
		

		wp_register_style( 'sal',               Helper::get_vendor_assets( 'sal/sal.css' ), array(), $this->version );
		wp_register_script( 'sal',              Helper::get_vendor_assets( 'sal/sal.js' ), array( 'jquery' ), $this->version, true );
		
		/*CSS*/
		// Owl carousel
		wp_register_style( 'owl-carousel',              Helper::get_css( 'owl.carousel.min' ), array(), $this->version );
		wp_register_style( 'owl-theme-default',         Helper::get_css( 'owl.theme.default.min' ), array(), $this->version );
		// Google fonts
		wp_register_style( 'metro-gfonts',              $this->fonts_url(), array(), $this->version );
		// Font-awesome
		wp_register_style( 'font-awesome',              Helper::get_css( 'font-awesome.min' ), array(), $this->version );
		// Bootstrap
		wp_register_style( 'bootstrap',                 Helper::maybe_rtl( 'bootstrap.min' ), array(), $this->version );
		// Magnific popup
		wp_register_style( 'magnific-popup',            Helper::get_css( 'magnific-popup.min' ), array(), $this->version );
		// Main Theme Style
		wp_register_style( 'metro-style',               Helper::maybe_rtl( 'style' ), array(), $this->version );
		// WooCommerce Style
		wp_register_style( 'metro-wc',                  Helper::maybe_rtl( 'woocommerce' ), array(), $this->version );
		// Elementor
		wp_register_style( 'metro-elementor',           Helper::maybe_rtl( 'elementor' ), array(), $this->version );

		/*JS*/
		// Owl Carousel
		wp_register_script( 'owl-carousel',             Helper::get_js( 'owl.carousel.min' ), array( 'jquery' ), $this->version, true );
		// bootstrap js
		wp_register_script( 'bootstrap',                Helper::get_js( 'bootstrap.bundle.min' ), array( 'jquery' ), $this->version, true );
		// Meanmenu js
		wp_register_script( 'jquery-meanmenu',          Helper::get_js( 'jquery.meanmenu.min' ), array( 'jquery' ), $this->version, true );
		// Isotope
		wp_register_script( 'images-loaded',            Helper::get_js( 'imagesloaded.pkgd.min' ), array( 'jquery' ), $this->version, true );
		wp_register_script( 'isotope',                  Helper::get_js( 'isotope.pkgd.min' ), array( 'jquery' ), $this->version, true );
		// Countdown
		wp_register_script( 'jquery-countdown',         Helper::get_js( 'jquery.countdown.min' ), array( 'jquery' ), $this->version, true );
		// Magnific Popup
		wp_register_script( 'jquery-magnific-popup',    Helper::get_js( 'jquery.magnific-popup.min' ), array( 'jquery' ), $this->version, true );
		// Ripples
		wp_register_script( 'jquery-ripples',           Helper::get_js( 'jquery.ripples.min' ), array( 'jquery' ), $this->version, true );
		// Sticky Sidebar
		wp_register_script( 'jquery-sticky-sidebar',    Helper::get_js( 'jquery.sticky-sidebar.min' ), array( 'jquery' ), $this->version, true );
		// Main js
		wp_register_script( 'metro-main',               Helper::get_js( 'main' ), array( 'jquery', 'jquery-effects-core' ), $this->version, true );
	}

	public function enqueue_scripts() {
		/*CSS*/
		wp_enqueue_style( 'metro-gfonts' );
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'sal' );
		wp_enqueue_style(  'slick' );
		wp_enqueue_style(  'slick-theme' );
		$this->elementor_scripts(); // Elementor Scripts in preview mode
		$this->conditional_scripts(); // Conditional Scripts
		wp_enqueue_style( 'metro-style' );
		wp_enqueue_style( 'metro-wc' );
		wp_enqueue_style( 'metro-elementor' );
		$this->dynamic_style();// Dynamic style

		/*JS*/
		wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'sal' );
		wp_enqueue_script( 'jquery-meanmenu' );
		wp_enqueue_script( 'slick' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'metro-main' );
		$this->localized_scripts(); // Localization
	}

	public function elementor_scripts() {
		if ( !did_action( 'elementor/loaded' ) ) {
			return;
		}
		if ( Plugin::$instance->preview->is_preview_mode() ) {
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );
			wp_enqueue_script( 'jquery-sticky' );
			wp_enqueue_script( 'images-loaded' );
			wp_enqueue_script( 'isotope' );
			wp_enqueue_script( 'jquery-countdown' );
			wp_enqueue_script( 'jquery-magnific-popup' );
			wp_enqueue_script( 'jquery-ripples' );
			wp_enqueue_script( 'slick' );
				
		}
	}

	public function admin_scripts(){
		wp_enqueue_style( 'metro-admin',  Helper::get_css( 'admin' ), array(), $this->version );
	}

	public function gutenberg_scripts() {
		wp_enqueue_style( 'metro-gfonts', $this->fonts_url(), array(), $this->version );
		wp_enqueue_style( 'metro-gutenberg', Helper::maybe_rtl( 'gutenberg' ), array(), $this->version );
		ob_start();
		Helper::requires( 'dynamic-styles/common.php' );
		$dynamic_css = ob_get_clean();
		$css  = $this->add_prefix_to_css( $dynamic_css, '.wp-block.editor-block-list__block' );
		$css  = str_replace( 'gtnbg_root' , '', $css );
		$css  = $this->output_css( $css );
		wp_add_inline_style( 'metro-gutenberg', $css );
	}

	private function fonts_url(){
		$fonts_url = '';
		if ( 'off' !== _x( 'on', 'Google fonts - Roboto and Josefin Sans : on or off', 'metro' ) ) {
			$fonts_url = add_query_arg( 'family', urlencode( 'Roboto:400,500,700|Josefin Sans:400,600,700' ), "//fonts.googleapis.com/css" );
		}
		return $fonts_url;
	}

		private function localized_scripts(){
		$logo = empty( RDTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : RDTheme::$options['logo']['url'];
		$appendHtml = Helper::get_template_content( 'template-parts/header/header-top-mobile' );
		
		// WooCommerce Product Category Base
		$wc_options = get_option('woocommerce_permalinks');
		$product_category_base = $wc_options['category_base'];
		
		$localize_data = array(
			'ajaxurl'       => admin_url( 'admin-ajax.php' ),
			'hasAdminBar'   => is_admin_bar_showing() ? 1 : 0,
			'hasStickyMenu' => RDTheme::$options['sticky_menu'] ? 1 : 0,
			'meanWidth'     => RDTheme::$options['resmenu_width'],
			'siteLogo'      => '<div class="mean-logo-area"><a href="' . esc_url( home_url( '/' ) ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '"><img width="65px" height="30px" class="logo-small" src="'. esc_url( $logo ).'" /></a></div>',
			'appendHtml'    => $appendHtml,
			'rtl'           => is_rtl(),
			'day'	        => esc_html__('Day' , 'metro'),
			'hour'	        => esc_html__('Hour' , 'metro'),
			'minute'        => esc_html__('Minute' , 'metro'),
			'second'        => esc_html__('Second' , 'metro'),   
			'rtl'            => is_rtl() ? 'yes' : 'no', //@rtl
			'top_widget' => RDTheme::$options['metro_wc_top_widget'],
			'product_filter' => RDTheme::$options['metro_wc_product_filter_type'],
			'ajax_loader_url' => empty(RDTheme::$options['metro_wc_product_filter_ajax_preloader']['url']) ? esc_html__(get_template_directory_uri() . "/assets/img/metro-ajax-loader.gif") :  RDTheme::$options['metro_wc_product_filter_ajax_preloader']['url'],
			'product_category_base' => $product_category_base,
			'pagination' => RDTheme::$options['wc_pagination'],
			'filter_text' => __('Filter by', 'metro'),
		);

		wp_add_inline_script( 'jquery', "window.MetroObj = " . json_encode($localize_data)  , 'after' );

		// RTL
		if( is_rtl() ) {	
			wp_enqueue_style( 'metro-rtl',  Helper::get_css( 'rtl' ), array(), $this->version );		
		}	
	}

	

	private function conditional_scripts(){
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( ( is_home() || is_archive() ) && RDTheme::$options['blog_style'] == '2' ) {
			wp_enqueue_script( 'images-loaded' );
			wp_enqueue_script( 'isotope' );
		}

		if ( is_singular( 'product' ) && RDTheme::$options['wc_single_product_layout'] == '2' ) {
			wp_enqueue_script( 'jquery-sticky-sidebar' );
		}
	}

	private function template_style(){
		$css = '';

		$logo_height = RDTheme::$options['logo_height'] . 'px';

		$css .= ".main-header a.logo img{max-height:{$logo_height}}";

		if ( RDTheme::$bgtype == 'bgcolor' ) {
			$bgcolor = RDTheme::$bgcolor;
			$banner_style = "background-color:{$bgcolor};";
		}
		else {
			$bgimg = RDTheme::$bgimg;
			$banner_style = "background:url({$bgimg}) no-repeat scroll center center / cover;";
		}

		$css .= ".banner{{$banner_style}}";

		if ( RDTheme::$bgtype == 'bgimg' ) {
			$opacity = RDTheme::$options['bgopacity']/100;
			$css .= ".header-bgimg .banner:before{background-color:rgba(0,0,0,{$opacity});}";			
		}

		if ( RDTheme::$options['wc_shop_Product_img_size'] ) {			
			$css .= ".rt-product-block .rtin-thumb img{width: 100%;}";		
		}

		

		return $css;
	}

	private function dynamic_style(){
		$dynamic_css = $this->template_style();
		ob_start();
		Helper::requires( 'dynamic-styles/frontend.php' );
		Helper::requires( 'dynamic-styles/elementor.php' );
		$dynamic_css .= ob_get_clean();
		$dynamic_css  = $this->output_css( $dynamic_css );
		wp_register_style( 'metro-dynamic', false );
		wp_enqueue_style( 'metro-dynamic' );
		wp_add_inline_style( 'metro-dynamic', $dynamic_css );
	}
}

Scripts::instance();