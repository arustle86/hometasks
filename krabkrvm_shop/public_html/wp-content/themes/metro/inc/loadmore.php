<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

class LoadMore {

	protected static $instance = null;

	private function __construct() {
		add_action('wp_ajax_rdtheme_loadmore',          array( $this, 'loadmore' ) );
		add_action('wp_ajax_nopriv_rdtheme_loadmore',   array( $this, 'loadmore' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init( $type = 'loadmore' ) {
		$this->print_data_html();

		if ( $type == 'loadmore' ) {
			$this->print_btn_html();
		}
		else {
			$this->print_spinner_html();
		}
	}

	public function loadmore() {

		check_ajax_referer( 'metro_loadmore_nonce', 'nonce' );

		$args = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged'] = intval( $_POST['paged'] ) + 1;
		$view = !empty($_POST['view']) && 'list' === $_POST['view'] ? 'list' : 'grid';
		$_REQUEST['ajax_product_loadmore'] = 1;


		// Adding parameters for filter
		$per_page = 9;

		$query_url = esc_url_raw($_POST['filter_query_url']);
		$query_path = parse_url($query_url, PHP_URL_PATH);
		$wc_options = get_option('woocommerce_permalinks');
		$product_category_base = $wc_options['category_base'];

		// Checking if the url contains category
		if(strpos($query_url, $product_category_base) !== FALSE){
			$category_expression = '/([A-Za-z0-9-_]*)\/?\??(?>filter|min|orderby.*)?$/m';
			preg_match_all($category_expression, preg_replace('/(page\/[0-9]*\/)/m' , '', $query_path ), $matches, PREG_SET_ORDER, 0);
			$cat_slug = $matches[0][1];
			$current_category = get_term_by( 'slug', $cat_slug, 'product_cat');

			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms' => $current_category->slug,
			);

		}

		// Retriving Query Parameter from url
		parse_str(parse_url($query_url, PHP_URL_QUERY), $url_query_params);
		if(isset($url_query_params) && !empty($url_query_params)){

			foreach($url_query_params as $key => $value){

				if($key == 'max_price' || $key == 'min_price' || $key == 'orderby') continue;

				$taxonomy = str_replace("filter","pa", $key);

				if( taxonomy_exists( $taxonomy ) ){

					$args['tax_query'][] = array(

						'taxonomy' => str_replace("filter","pa", $key),
						'field' => 'slug',
						'terms' => $value,

					);

				}

			}

		}

		// Price
		if(isset($url_query_params['min_price']) && isset($url_query_params['max_price'])){

			$args['meta_query'][] = wc_get_min_max_price_meta_query(array(
				'min_price' => sanitize_text_field($url_query_params['min_price']),
				'max_price' => sanitize_text_field($url_query_params['max_price']),
			));

		}

		if(isset($url_query_params['orderby'])){

			switch(sanitize_text_field($url_query_params['orderby'])){
				case 'popularity':
					$args['meta_key'] = 'total_sales';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'rating':
					$args['meta_key'] = '_wc_average_rating';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'price':
					$args['meta_key'] = '_price';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'ASC';
					break;
				case 'price-desc':
					$args['meta_key'] = '_price';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'price-desc':
					$args['meta_key'] = 'date';
					$args['orderby'] = 'meta_value_num';
					$args['meta_type'] = 'DATE';
					$args['order'] = 'DESC';
					break;
				default:
					break;
			}

		} else {

			switch($_POST['order']){
				case 'popularity':
					$args['meta_key'] = 'total_sales';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'rating':
					$args['meta_key'] = '_wc_average_rating';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'price':
					$args['meta_key'] = '_price';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'ASC';
					break;
				case 'price-desc':
					$args['meta_key'] = '_price';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				case 'price-desc':
					$args['meta_key'] = 'date';
					$args['orderby'] = 'meta_value_num';
					$args['meta_type'] = 'DATE';
					$args['order'] = 'DESC';
					break;
				default:
					break;
			}

		}

		// For other url passed data.
		if( defined('RT_DEMO_SITE') ):
		if( isset($url_query_params['sidebar']) && $url_query_params['sidebar'] == 'full' ){
			RDTheme::$options['wc_desktops_product_columns'] = '3';
			$args['posts_per_page'] = 8;
			$per_page = 8;
		}
		endif;

		$query = new \WP_Query($args);

		if( $query->have_posts() ) :
			while( $query->have_posts() ): $query->the_post();
				Helper::get_template_part( 'woocommerce/content-product', array( 'isloadmore' => true, 'view' => $view ) );
			endwhile;
		endif;
		wp_reset_postdata();
		wp_die();
	}

	private function print_data_html() {
		global $wp_query;
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$nonce =  wp_create_nonce( 'metro_loadmore_nonce' );
		echo '<div class="rdtheme-loadmore-data" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-paged="'.esc_attr( $paged ).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'"></div>';
	}

	private function print_btn_html() {
		global $wp_query;
		$paged = $wp_query->max_num_pages;
		if($paged > 1){
		?>
			<div class="rdtheme-loadmore-btn-area">
				<button class="rdtheme-loadmore-btn">
					<span class="rdtheme-loadmore-btn-text"><?php esc_html_e( 'Загрузить еще', 'metro' );?></span>
					<span class="rdtheme-loadmore-btn-icon"><i class="fa fa-spinner fa-spin"></i></span>
				</button>
			</div>
		<?php 
		}
	}

	private function print_spinner_html() {
		?>
		<div class="rdtheme-infscroll-icon"><i class="fa fa-spinner fa-spin"></i></div>
		<?php
	}
}

LoadMore::instance();