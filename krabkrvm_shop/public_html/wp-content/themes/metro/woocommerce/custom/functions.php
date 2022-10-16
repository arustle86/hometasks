<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

class WC_Functions {

	protected static $instance = null;

	public function __construct() {
		/* Theme supports for WooCommerce */
		add_action( 'after_setup_theme',                               array( $this, 'theme_support' ) );

		/* Body class */
		add_filter( 'body_class',                                      array( $this, 'body_classes' ) );

		/* Disable default styles */
		// add_filter( 'woocommerce_enqueue_styles',                      array( $this, 'disable_styles' ) );

		/* Title */
		add_filter( 'rdtheme_page_title',                              array( $this, 'page_title' ) );

		add_action( 'wp_ajax_metro_product_search_autocomplete',        array( $this, 'product_search_autocomplete') );
		add_action( 'wp_ajax_nopriv_metro_product_search_autocomplete', array( $this, 'product_search_autocomplete') );

		/* Header cart count number */
		add_filter( 'woocommerce_add_to_cart_fragments',               array( $this, 'header_cart_count' ) );

		/* Breadcrumb */
		remove_action( 'woocommerce_before_main_content',              'woocommerce_breadcrumb', 20, 0 );

		/* Replace default placeholder image */
		add_filter( 'woocommerce_placeholder_img_src',                 array( $this, 'placeholder_img_src' ) );

		/* Modify responsive smallscreen size */
		add_filter( 'woocommerce_style_smallscreen_breakpoint',        array( $this, 'smallscreen_breakpoint' ) );

		/* Shop hide default page title */
		add_filter( 'woocommerce_show_page_title',                     '__return_false' );

		/* Star rating html */
		add_filter( 'woocommerce_product_get_rating_html',             array( $this, 'star_rating_html' ), 10, 3 );

		/* Shop/Archive Wrapper */
		remove_action( 'woocommerce_before_main_content',              'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_sidebar',                          'woocommerce_get_sidebar', 10 );
		remove_action( 'woocommerce_after_main_content',               'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content',                 array( $this, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content',                  array( $this, 'wrapper_end' ), 10 );

		/* Shop top tab */
		remove_action( 'woocommerce_before_shop_loop',                 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop',                 'woocommerce_catalog_ordering', 30 );
		add_action( 'woocommerce_before_shop_loop',                    array( $this, 'shop_topbar' ), 20 );


		/* Shop loop */
		add_filter( 'loop_shop_per_page',                              array( $this, 'loop_shop_per_page' ) );
		add_filter( 'loop_shop_columns',                               array( $this, 'loop_shop_columns' ) );
		add_filter( 'woocommerce_sale_flash',                          array( $this, 'sale_flash' ), 10, 3 );

		remove_action( 'woocommerce_before_shop_loop_item',            'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title',      'woocommerce_template_loop_product_thumbnail', 10 );
		remove_action( 'woocommerce_shop_loop_item_title',             'woocommerce_template_loop_product_title', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title',       'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title',       'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop',                  'woocommerce_pagination', 10 );
		remove_action( 'woocommerce_after_shop_loop_item',             'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_after_shop_loop_item',             'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'woocommerce_after_shop_loop',                     array( $this, 'pagination' ), 10 );

		/* Single Product */
		
		// Add to cart button
		add_action( 'woocommerce_before_add_to_cart_button',           array( $this, 'add_to_cart_button_wrapper_start' ), 3 );
		add_action( 'woocommerce_after_add_to_cart_button',            array( $this, 'single_add_to_cart_button' ) );
		add_action( 'woocommerce_after_add_to_cart_button',            array( $this, 'add_to_cart_button_wrapper_end' ), 90 );

		// Sharing
		remove_action( 'woocommerce_single_product_summary',           'woocommerce_template_single_sharing', 50 );

		// Review
		remove_action( 'woocommerce_review_before_comment_meta',       'woocommerce_review_display_rating', 10 );

		// Related Products
		add_action( 'init',                                            array( $this, 'show_or_hide_related_products' ) );

		// Hide product data tabs
		add_filter( 'woocommerce_product_tabs',                        array( $this, 'hide_product_data_tab' ) );
		add_filter( 'woocommerce_product_review_comment_form_args',    array( $this, 'product_review_form' ) );

		// Hide some tab headings
		add_filter( 'woocommerce_product_description_heading',            '__return_false' );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

		// Review avatar size
		add_filter( 'woocommerce_review_gravatar_size',                 array( $this, 'review_gravatar_size' ) );

		// Single Product Layout
		add_action( 'init',                                             array( $this, 'single_product_layout_hooks' ) );



		/* Cart */
		remove_action( 'woocommerce_cart_collaterals',                 'woocommerce_cross_sell_display' );
		remove_action( 'woocommerce_cart_collaterals',                 'woocommerce_cart_totals', 10 );
		add_action( 'woocommerce_cart_collaterals',                    'woocommerce_cart_totals' );

		add_action( 'init',                                            array( $this, 'show_or_hide_cross_sells' ) );

		/* Checkout */
		remove_action( 'woocommerce_checkout_order_review',            'woocommerce_checkout_payment', 20 );
		add_action( 'woocommerce_checkout_after_order_review',         'woocommerce_checkout_payment' );

		/* Yith Quickview */
		if ( function_exists( 'YITH_WCQV_Frontend' ) ) {
			remove_action( 'woocommerce_after_shop_loop_item',         array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
			remove_action( 'yith_wcwl_table_after_product_name',       array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
			remove_action( 'yith_wcqv_product_summary',                'woocommerce_template_single_meta', 30 );
			add_action( 'yith_wcqv_product_summary',                   'woocommerce_template_single_meta', 15 );
			add_action( 'yith_wcqv_show_quick_view_button',            array( &$this, 'hide_yith_quick_view'),10,2 );
		}

		/* Yith Compare */
		if ( class_exists( 'YITH_Woocompare' ) ) {
			global $yith_woocompare;
			remove_action( 'woocommerce_after_shop_loop_item',          array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
			remove_action( 'woocommerce_single_product_summary',        array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
			add_filter( 'yith_woocompare_compare_added_label',          '__return_empty_string' );
		}

		/* Yith Wishlist */
		if ( function_exists( 'YITH_WCWL_Frontend' ) && class_exists( 'YITH_WCWL_Ajax_Handler' )  ) {
			
			$wishlist_init = YITH_WCWL_Frontend();

			remove_action( 'wp_head',                                   array( $wishlist_init, 'add_button' ) );
			add_action( 'wp_ajax_metro_add_to_wishlist',                array( $this, 'add_to_wishlist' ) );
			add_action( 'wp_ajax_nopriv_metro_add_to_wishlist',         array( $this, 'add_to_wishlist' ) );

			add_action( 'wp_ajax_metro_remove_from_wishlist',                array( $this, 'remove_from_wishlist' ) );
			add_action( 'wp_ajax_nopriv_metro_remove_from_wishlist',         array( $this, 'remove_from_wishlist' ) );

			add_filter( 'yith_wcwl_show_add_to_wishlist', '__return_false');
		}

		/* Variation Swatch and Gallery */

		// Variation gallery single image size
		add_action( 'woocommerce_gallery_image_size',                    array( $this, 'single_gallery_img_size' ) );

		// Remove variation swatch auto calling from archive
		remove_action( 'init',                                          array( 'Rtwpvs\Controllers\ShopPage', 'shop_page_init' ) );

		// Disable license notice
		add_filter( 'rtwpvs_check_license',                             '__return_false' );
		add_filter( 'rtwpvg_check_license',                             '__return_false' );

		// Disable promotional tabs
		add_action( 'rtwpvs_settings_fields',                           array( $this, 'rtwpv_disable_promotion' ) );
		add_action( 'rtwpvg_settings_fields',                           array( $this, 'rtwpv_disable_promotion' ) );


        add_action( "woocommerce_shortcode_before_products_loop", array( $this, 'rt_product_woo_shortcode_before_loop_add_class_loop'), 10, 1 );
       
		//add_action( "woocommerce_shortcode_before_product_categories_loop", array( $this, 'rt_product_cats_woo_shortcode_before_loop_add_class_loop'), 20, 1 );
		
		add_action('wp_head', array(&$this, 'custom_cart_functionality'));

		add_filter('rtwpvs_archive_product_wrapper', function (){
				return '.rt-product-block';
			});

    }

    public function rt_product_woo_shortcode_before_loop_add_class_loop( $atts ) {
        global $metro_shortcode_called;
        $metro_shortcode_called = 'products';
    }

    public function rt_product_cats_woo_shortcode_before_loop_add_class_loop( $atts ) {
        global $metro_shortcode_cats;
        $metro_shortcode_cat = 'product_categories';
    }


	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function theme_support() {
		add_theme_support( 'woocommerce', array(
			'gallery_thumbnail_image_width' => 150
		) );

		add_theme_support( 'wc-product-gallery-lightbox' );
		add_post_type_support( 'product', 'page-attributes' );
	}

	public function body_classes( $classes ) {
		if( isset( $_GET["shopview"] ) && $_GET["shopview"] == 'list' ) {
			$classes[] = 'product-list-view';
		}
		else {
			$classes[] = 'product-grid-view';
		}

		if ( is_singular( 'product' ) ) {
			$classes[] = 'single-product-layout-' . RDTheme::$options['wc_single_product_layout'];
			if ( function_exists( 'rtwpvg' ) ) {
				$classes[] = 'thumb-pos-' . rtwpvg()->get_option('thumbnail_position');
			}
		}

		return $classes;
	}

	public function product_search_autocomplete() {
		if ( isset( $_REQUEST['term'] ) ) {
			global $wpdb;
			$result = array();
			$term = trim( $_REQUEST['term'] );
			$term = sanitize_text_field( $term );

			$query = "SELECT post_title FROM $wpdb->posts WHERE post_type='product' AND post_title like '%{$term}%' ORDER BY post_title ASC LIMIT 10";
			$query = apply_filters( 'metro_product_search_query', $query, $_REQUEST );
			$titles = $wpdb->get_results( $query, ARRAY_A );

			foreach ( $titles as $title ) {
				$result[] = $title['post_title'];
			}

			$result = apply_filters( 'metro_product_search_query_result', $result, $_REQUEST );
			wp_send_json( $result );
		}
	}	

	public function disable_styles( $enqueue_styles ) {
		if ( !is_cart() && !is_checkout() ) {
			unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
		}
		unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		return $enqueue_styles;
	}

	public function page_title( $title ) {
		if ( is_woocommerce() ) {
			$title = woocommerce_page_title( false );
		}
		
		return $title;
	}

	public function header_cart_count( $fragments ) {
		$number = '<span class="cart-icon-num">' . WC()->cart->get_cart_contents_count() . '</span>';
		$total  = '<div class="cart-icon-total">' . WC()->cart->get_cart_total() . '</div>';
		$fragments['span.cart-icon-num']   = $number;
		$fragments['div.cart-icon-total']  = $total;
		return $fragments;
	}

	public function placeholder_img_src( $src ) {
		$default = WC()->plugin_url() . '/assets/images/placeholder.png';

		if ( $src == $default ) {
			$src = Helper::get_img( 'wc-placeholder.jpg' );
		}

		return $src;
	}

	public function pagination() {
		if ( RDTheme::$options['wc_pagination'] == 'load-more' ) {
			LoadMore::instance()->init( 'loadmore' );
		}
		else if ( RDTheme::$options['wc_pagination'] == 'infinity-scroll' ) {
			LoadMore::instance()->init( 'infiscroll' );
		}
		else {
			get_template_part( 'template-parts/pagination' );
		}
	}

	public function smallscreen_breakpoint(){
		return '767px';
	}

	public function star_rating_html( $html, $rating, $count ){
		$html = 0 < $rating ?'<div class="rdtheme-star-rating"><span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"></span></div>' : '';
		return $html;
	}

	public function wrapper_start() {
		self::get_custom_template_part( 'shop-header' );
	}

	public function wrapper_end() {
		self::get_custom_template_part( 'shop-footer' );
	}

	public function shop_topbar() {
		self::get_custom_template_part( 'shop-top' );
	}

	public function loop_shop_per_page(){
		return RDTheme::$options['wc_num_product'];
	}

	public function loop_shop_columns(){
		if ( RDTheme::$layout == 'full-width' ) {
			return 4;
		}
		return 3;
	}



/*
 *	Single product: Get sale percentage
 */
public function sale_flash( $args, $post, $product  ) {


	if ( RDTheme::$options['wc_sale_label'] == 'percentage' ) {
			

	    if ( $product->get_type() === 'variable' ) {
	        // Get product variation prices
	        $product_variation_prices = $product->get_variation_prices();

	        $highest_sale_percent = 0;

	        foreach( $product_variation_prices['regular_price'] as $key => $regular_price ) {
	            // Get sale price
	            $sale_price = $product_variation_prices['sale_price'][$key];

	            // Is product variation on sale?
	            if ( $sale_price < $regular_price ) {
	                $sale_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

	                // Is current sale percent highest?
	                if ( $sale_percent > $highest_sale_percent ) {
	                    $highest_sale_percent = $sale_percent;
	                }
	            }
	        }

	        // Return variation sale percent      
	       return sprintf('<span class="onsale">-%s%%</span>', $highest_sale_percent );	

	    } else {
	        $regular_price = $product->get_regular_price();
	        $sale_percent = 0;

	        // Make sure calculated
	        if ( intval( $regular_price ) > 0 ) {
	            $sale_percent = round( ( ( $regular_price - $product->get_sale_price() ) / $regular_price ) * 100 );
	        }
			return sprintf('<span class="onsale">-%s%%</span>', $sale_percent );	
	        
	    }

	}else{
			$price = $product->get_regular_price();
			$sale  = $product->get_sale_price();

			// Fix NAN in grouped product
			if ( !$price ) {
				return $args;
			}

			$discount = ( ( $price - $sale ) / $price ) * 100;
			$discount = round( $discount );

			return sprintf('<span class="onsale">-%s%%</span>', $discount );			
		}
	}



	public function sale_flash_old( $args, $post, $product ) {
		if ( RDTheme::$options['wc_sale_label'] == 'percentage' ) {
			$price = $product->get_regular_price();
			$sale  = $product->get_sale_price();

			// Fix NAN in grouped product
			if ( !$price ) {
				return $args;
			}

			$discount = ( ( $price - $sale ) / $price ) * 100;
			$discount = round( $discount );

			return sprintf('<span class="onsale">-%s%%</span>', $discount );			
		}
		return $args;
	}
	
	public function add_to_cart_button_wrapper_start(){
		echo '<div class="single-add-to-cart-wrapper">';
	}

	public function add_to_cart_button_wrapper_end(){
		echo '</div>';
	}

	public function single_add_to_cart_button(){
		echo '<div class="product-single-meta-btns">';
		self::print_add_to_wishlist_icon();
		self::print_quickview_icon();
		self::print_compare_icon();
		echo '</div>';
	}

	public function single_product_layout_hooks() {
		switch ( RDTheme::$options['wc_single_product_layout'] ) {
			case '2':
			remove_action( 'woocommerce_single_product_summary',       'woocommerce_template_single_price', 10 );
			add_action( 'woocommerce_single_product_summary',          array( $this, 'single_2_price_and_stock' ), 12 );
			remove_action( 'woocommerce_single_product_summary',       'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_single_product_summary',       'woocommerce_template_single_meta', 40 );
			add_action( 'woocommerce_single_product_summary',          'woocommerce_template_single_meta', 30 );
			add_action( 'woocommerce_single_product_summary',          'woocommerce_template_single_add_to_cart', 40 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			add_action( 'woocommerce_single_product_summary',          'woocommerce_output_product_data_tabs', 70 );
			break;
			case '3':
			add_action( 'woocommerce_single_product_summary',          array( $this, 'single_3_stock' ), 3 );
			remove_action( 'woocommerce_single_product_summary',       'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_single_product_summary',       'woocommerce_template_single_meta', 40 );
			add_action( 'woocommerce_single_product_summary',          'woocommerce_template_single_meta', 30 );
			add_action( 'woocommerce_single_product_summary',          'woocommerce_template_single_add_to_cart', 40 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			break;			
			default:
			remove_action( 'woocommerce_single_product_summary',       'woocommerce_template_single_meta', 40 );
			add_action( 'woocommerce_single_product_summary',          'woocommerce_template_single_meta', 15 );
			break;
		}
	}


	

	public function single_gallery_img_size( $args ) {
		if ( class_exists( 'WooProductVariationGalleryPro' ) && is_product() ) {
			if ( RDTheme::$options['wc_single_product_layout'] == '3' ) {
				return 'rdtheme-size7';
			}
		}
		return $args;
	}

	public static function single_3_get_gallery_image_html( $attachment_id, $main_image = false ) {
		// ref: function wc_get_gallery_image_html()
		if ( $attachment_id ) {
			$custom_size       = 'rdtheme-size7';
			$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
			$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
			$image_size        = $custom_size;
			$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
			$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
			$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
			$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
			$image             = wp_get_attachment_image(
				$attachment_id,
				$image_size,
				false,
				apply_filters(
					'woocommerce_gallery_image_html_attachment_image_params',
					array(
						'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
						'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
						'data-src'                => esc_url( $full_src[0] ),
						'data-large_image'        => esc_url( $full_src[0] ),
						'data-large_image_width'  => esc_attr( $full_src[1] ),
						'data-large_image_height' => esc_attr( $full_src[2] ),
						'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
					),
					$attachment_id,
					$image_size,
					$main_image
				)
			);

			$html = '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
		}

		return $html;
	}

	public function show_or_hide_related_products(){
		// Show or hide related products
		if ( empty( RDTheme::$options['wc_related'] ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}

	public function single_3_stock() {
		?>
		<div class="single_3-avaibility">
			<span class="rtin-title"><?php esc_html_e( 'Availability', 'metro' ); ?>:</span>
			<span class="rtin-stock"><?php echo esc_html( self::get_stock_status() ); ?></span>
		</div>
		<?php
	}

	public function single_2_price_and_stock() {
		?>
		<div class="rtin-price-area">
			<?php woocommerce_template_single_price();?>
			<div class="rtin-avaibility">
				<span class="rtin-title"><?php esc_html_e( 'Availability', 'metro' ); ?>:</span>
				<span class="rtin-stock"><?php echo esc_html( self::get_stock_status() ); ?></span>
			</div>
		</div>
		<?php
	}

	public function hide_product_data_tab( $tabs ){
		if ( empty( RDTheme::$options['wc_description'] ) ) {
			unset( $tabs['description'] );
		}
		if ( empty( RDTheme::$options['wc_reviews'] ) ) {
			unset( $tabs['reviews'] );
		}
		if ( empty( RDTheme::$options['wc_additional_info'] ) ) {
			unset( $tabs['additional_information'] );
		}
		return $tabs;
	}
	
	public function review_gravatar_size(){
		return '85';
	}
	
	public function product_review_form( $comment_form ){
		$commenter = wp_get_current_commenter();

		$comment_form['fields'] = array(
			'author' => '<div class="row"><div class="col-sm-6"><div class="comment-form-author form-group"><input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_html__( 'Имя *', 'metro' ) . '" required /></div></div>',
			'email'  => '<div class="comment-form-email col-sm-6"><div class="form-group"><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_html__( 'Email *', 'metro' ) . '" required /></div></div></div>',
		);

		$comment_form['comment_field'] = '';

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Ваша оценка', 'metro' ) .'</label>
			<select name="rating" id="rating" required>
			<option value="">' . esc_html__( 'Rate&hellip;', 'metro' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'metro' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'metro' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'metro' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'metro' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'metro' ) . '</option>
			</select></p>';
		}

		$comment_form['comment_field'] .= '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" class="form-control" placeholder="' . esc_html__( 'Ваш отзыв *', 'metro' ) . '" cols="45" rows="8" required></textarea></div>';

		return $comment_form;
	}

	public function show_or_hide_cross_sells(){
		// Show or hide related cross sells
		if ( !empty( RDTheme::$options['wc_cross_sell'] ) ) {
			add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
		}
	}

	public static function get_template_part( $template, $args = array() ){
		extract( $args );

		$template = '/' . $template . '.php';

		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		}
		else {
			$file = get_template_directory() . $template;
		}

		require $file;
	}

	public static function get_custom_template_part( $template, $args = array() ){
		$template = 'woocommerce/custom/template-parts/' . $template;
		self::get_template_part( $template, $args );
	}

	public static function product_slider( $products, $title, $type='' ) {
		$filename = '/woocommerce/custom/template-parts/product-slider.php';

		$child_file  = get_stylesheet_directory() . $filename;
		$parent_file = get_template_directory() . $filename;

		if ( file_exists( $child_file ) ) {
			$file = $child_file;
		}
		else {
			$file = $parent_file;
		}

		include $file;
	}


	public static function print_add_to_cart_icon( $icon = true, $text = true ){
		global $product;
		$quantity = 1;
		$class = implode( ' ', array_filter( array(
			'action-cart button product_type_variable rtwpvs_add_to_cart rtwpvs_ajax_add_to_cart ',
			'product_type_' . $product->get_type(),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
		) ) );

		$html = '';

		if ( $icon ) {
			$html .= '<i class="flaticon-shopping-cart"></i>';
		}

		if ( $text ) {
			$html .= '<span>' . $product->add_to_cart_text() . '</span>';
		}
		echo sprintf( '<a rel="nofollow" title="%s" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">' . $html . '</a>',			
			esc_attr( $product->add_to_cart_text() ),
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : 'action-cart' )
		);
	}

	public static function print_quickview_icon( $icon = true, $text = false ){
		if ( !function_exists( 'YITH_WCQV_Frontend' ) ) {
			return false;
		}

		if ( is_shop() && !RDTheme::$options['wc_shop_quickview_icon'] ) {
			return false;
		}

		if ( is_product() && !RDTheme::$options['wc_product_quickview_icon'] ) {
			return false;
		}

		global $product;

		$html = '';

		if ( $icon ) {
			$html .= '<i class="flaticon-search"></i>';
		}

		if ( $text ) {
			$html .= '<span>' . esc_html__( 'QuickView', 'metro' ) . '</span>';
		}

		?>
		<a href="#" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() );?>" title="<?php esc_attr_e( 'QuickView', 'metro' ); ?>"><?php echo wp_kses_post( $html ); ?></a>
		<?php
	}
	
	public static function print_compare_icon( $icon = true, $text = false ){
		if ( !class_exists( 'YITH_Woocompare' ) ) {
			return false;
		}

		if ( is_shop() && !RDTheme::$options['wc_shop_compare_icon'] ) {
			return false;
		}

		if ( is_product() && !RDTheme::$options['wc_product_compare_icon'] ) {
			return false;
		}

		global $product;
		global $yith_woocompare;
		$id  = $product->get_id();
		$url = method_exists( $yith_woocompare->obj, 'add_product_url' ) ? $yith_woocompare->obj->add_product_url( $id ) : '';

		$html = '';

		if ( $icon ) {
			$html .= '<i class="fa fa-exchange" aria-hidden="true"></i>';
		}

		if ( $text ) {
			$html .= '<span>' . esc_html__( 'Compare', 'metro' ) . '</span>';
		}

		?>

		<a href="<?php echo esc_url( $url );?>" class="compare" data-product_id="<?php echo esc_attr( $id );?>" title="<?php esc_attr_e( 'Add To Compare', 'metro' ); ?>"><?php echo wp_kses_post( $html ); ?></a>
		<?php
	}

	public static function print_add_to_wishlist_icon( $icon = true, $text = false ){
		if ( !defined( 'YITH_WCWL' ) ) {
			return false;
		}

		if ( is_shop() && !RDTheme::$options['wc_shop_wishlist_icon'] ) {
			return false;
		}

		if ( is_product() && !RDTheme::$options['wc_product_wishlist_icon'] ) {
			return false;
		}

		self::get_custom_template_part( 'wishlist-icon', compact( 'icon', 'text' ) );
	}

	public static function social_sharing() {
		$url   = urlencode( get_permalink() );
		$title = urlencode( get_the_title() );

		$sharer = array(
			'facebook' => array(
				'url'  => "http://www.facebook.com/sharer.php?u=$url",
				'icon' => 'fa-facebook',
			),
			'twitter'  => array(
				'url'  => "https://twitter.com/intent/tweet?source=$url&text=$title:$url",
				'icon' => 'fa-twitter'
			),
			'linkedin' => array(
				'url'  => "http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title",
				'icon' => 'fa-linkedin'
			),
			'pinterest'=> array(
				'url'  => "http://pinterest.com/pin/create/button/?url=$url&description=$title",
				'icon' => 'fa-pinterest'
			),
			'tumblr'   => array(
				'url'  => "http://www.tumblr.com/share?v=3&u=$url &quote=$title",
				'icon' => 'fa-tumblr'
			),
			'reddit'   => array(
				'url'  => "http://www.reddit.com/submit?url=$url&title=$title",
				'icon' => 'fa-reddit'
			),
			'vk'       => array(
				'url'  => "http://vkontakte.ru/share.php?url=$url",
				'icon' => 'fa-vk'
			),
		);

		foreach ( RDTheme::$options['wc_share'] as $key => $value ) {
			if ( !$value ) {
				unset( $sharer[$key] );
			}
		}

		return $sharer;
	}

	public function add_to_wishlist() {
		check_ajax_referer( 'metro_wishlist_nonce', 'nonce' );
		\YITH_WCWL_Ajax_Handler::add_to_wishlist();
		wp_die();
	}

	public function remove_from_wishlist() {
		check_ajax_referer( 'metro_wishlist_nonce', 'nonce' );
		\YITH_WCWL_Ajax_Handler::remove_from_wishlist();
		wp_die();
	}

	public function rtwpv_disable_promotion( $options ) {
		if ( isset( $options['license'] ) ) {
			unset( $options['license'] );
		}

		if ( isset( $options['premium_plugins'] ) ) {
			unset( $options['premium_plugins'] );
		}

		return $options;
	}

	public static function get_top_category_name(){
		global $product;

		$terms = wc_get_product_terms( $product->get_id(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );

		if ( empty( $terms ) ) {
			return '';
		}

		if ( $terms[0]->parent == 0 ) {
			$cat = $terms[0];
		}
		else {
			$ancestors = get_ancestors( $terms[0]->term_id, 'product_cat', 'taxonomy' );
			$cat_id    = end( $ancestors );
			$cat       = get_term( $cat_id, 'product_cat' );
		}

		return $cat->name;
	}

	public static function get_product_thumbnail( $product, $thumb_size = 'woocommerce_thumbnail' ) {
		$thumbnail   = $product->get_image( $thumb_size, array(), false );
		if ( !$thumbnail ) {
			$thumbnail = wc_placeholder_img( $thumb_size );
		}
		return $thumbnail;
	}

	public static function get_product_thumbnail_link( $product, $thumb_size = 'woocommerce_thumbnail' ) {
		return '<a href="'.esc_attr( $product->get_permalink() ).'">'.self::get_product_thumbnail( $product, $thumb_size ).'</a>';
	}

	public static function get_product_thumbnail_gallery($product, $thumb_size = 'woocommerce_thumbnail'){

		$attachment_ids = $product->get_gallery_image_ids();

		if ( empty( $attachment_ids ) ) {
			return self::get_product_thumbnail_link( $product, $thumb_size );
		}

		$thumb = $product->get_image_id();
		if ( $thumb ) {
			array_unshift( $attachment_ids, $thumb );
		}

		if (
			isset(RDTheme::$options['metro_wc_product_archive_slide_or_alternate'])
			&& 	RDTheme::$options['metro_wc_product_archive_slide_or_alternate'] == 'alternate'
		){

			?>
			<div class="rt-on-hover-change-wrapper">
				<a class="rt-hover-img-0" href="<?php  echo esc_attr( $product->get_permalink() ); ?>">
					<?php echo wp_get_attachment_image($attachment_ids[0], $thumb_size); ?>
				</a>
				<a class="rt-hover-img-1" href="<?php  echo esc_attr( $product->get_permalink() ); ?>">
					<?php echo wp_get_attachment_image($attachment_ids[1], $thumb_size); ?>
				</a>
			</div>
			<?php
		
		} else {

			$data = array( 
				'slidesToShow' => 1,
				'prevArrow'    => '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
				'nextArrow'    => '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
				'dots'         => false,
				'rtl'     		=> is_rtl() ? true : false,
			);
			$data = json_encode( $data );
			?>
			<div class="rt-slick-slider" data-slick="<?php echo esc_attr( $data );?>">
				<?php foreach ( $attachment_ids as $attachment_id ): ?>
					<a href="<?php echo esc_attr( $product->get_permalink() );?>"><?php echo wp_get_attachment_image( $attachment_id, $thumb_size )?></a>
				<?php endforeach; ?>
			</div>
			<?php

		}

	}

	public static function get_stock_status() {
		global $product;
		return $product->is_in_stock() ? esc_html__( 'In Stock', 'metro' ) : esc_html__( 'Out of Stock', 'metro' );
	}

	public static function is_product_archive() {
		return is_shop() || is_product_taxonomy() ? true : false;
	}

	public static function run_variation_swatch() {
		if ( class_exists( '\Rtwpvs\Controllers\ShopPage' ) ) {
			\Rtwpvs\Controllers\ShopPage::archive_variation_swatches();
		}
	}

	public static function kses_img( $img ) {
		
		$allowed_tags = wp_kses_allowed_html( 'post' );

		$attributes = array( 'srcset', 'sizes' );

		foreach ( $attributes as $attribute ) {
			$allowed_tags['img'][$attribute] = true;
		}

		return wp_kses( $img, $allowed_tags );
	}


	/**
	 * Format the stock amount ready for display based on settings.
	 *
	 * @since  3.0.0
	 * @param  WC_Product $product Product object for which the stock you need to format.
	 * @return string
	 */

	public static function metro_wc_format_stock_for_display( $product ) {		
		
		$display      = __( 'In stock', 'woocommerce' );
		$stock_amount = $product->get_stock_quantity();

		switch ( get_option( 'woocommerce_stock_format' ) ) {
			case 'low_amount':
				if ( $stock_amount <= get_option( 'woocommerce_notify_low_stock_amount' ) ) {
					/* translators: %s: stock amount */
					$display = sprintf( __( 'Only %s left in stock', 'woocommerce' ), wc_format_stock_quantity_for_display( $stock_amount, $product ) );
				}
				break;
			case '':
				/* translators: %s: stock amount */
				$display = sprintf( __( '%s in stock', 'woocommerce' ), wc_format_stock_quantity_for_display( $stock_amount, $product ) );
				break;
		}

		if ( $product->backorders_allowed() && $product->backorders_require_notification() ) {
			$display .= ' ' . __( '(can be backordered)', 'woocommerce' );
		}
		$display_html   = '<span class="product-meta-title">'. esc_html_e( "Наличие", "metro" ) . ' : </span><span class="product-meta-content sku">' . $display .'<span>';	

		return $display_html;
	}


	public function custom_cart_functionality(){
		add_filter( 'woocommerce_widget_cart_is_hidden', '__return_true' );
		// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30 );
	?>

		<div class="drawer-container">
			
			<span class="close">
				<i class="fa fa-1x fa-angle-right"></i>
			</span>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div id="side-content-area-id"></div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="drawer-overlay">
		</div>
	<?php 
	}

	public function hide_yith_quick_view($var_one, $var_two){
		return '';
	}

}

WC_Functions::instance();