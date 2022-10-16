<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use \WP_Widget;
use \RT_Widget_Fields;
use radiustheme\Lib\WP_SVG;

class Product_Categories_Widget extends WP_Widget {
	public function __construct() {
		$id = METRO_CORE_THEME_PREFIX . '_product_cat';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'Metro: Product Categories', 'metro-core' ), // Name
            array( 'description' => esc_html__( 'Metro: Product Categories', 'metro-core' )
        ) );
	}

	private function rt_term_post_count( $term_id ){

		$args = array(
			'nopaging'            => true,
			'fields'              => 'ids',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'suppress_filters'    => false,
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $term_id,
				)
			)
		);

		$posts = get_posts( $args );
		return count( $posts );
	}

	private function rt_get_sub_cat( $cat_id ){

		$results = array();

		$args = array(
			'taxonomy'   => 'product_cat',
			'parent'     => $cat_id,
			'orderby'    => 'count',
			'order'      => 'DESC',
		);

		$terms = get_terms( $args );

		foreach ( $terms as $term ) {
			$count = $this->rt_term_post_count( $term->term_id );
			$results[] = array(
				'name'      => $term->name,
				'count'     => $count,
				'permalink' => get_term_link( $term->term_id, 'product_cat' ),
			);
		}
		return $results;
	}

	private function rt_get_cat( $cats ){
		$result = array();

		if ( !$cats ) {
			$args = array(
				'taxonomy'   => 'product_cat',
				'parent'     => 0,
				'fields'     => 'ids'
			);
			$cats = get_terms( $args );
		}

		foreach ( $cats as $id ) {
			$term = get_term( $id, 'product_cat' );
			$attachment_id = get_term_meta( $id, 'metro_icon', true );
			$icon = WP_SVG::get_attachment_image( $attachment_id, 'full' );
			$result[$id] = array(
				'main' => array(
					'id'   => $id,
					'name' => $term->name,
					'icon' => $icon,
					'permalink' => get_term_link( $term->term_id, 'product_cat' ),
				),
				'sub' => $this->rt_get_sub_cat( $id ),
			);
		}
		return $result;
	}

	public function widget( $args, $instance ) {
		$cats = $this->rt_get_cat( $instance['cats'] );

		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}

		$uniqueid = 'c' . time().rand( 1, 99 ).'-';
		$wrapper  = $uniqueid.'accordion';
		?>

		<div id="<?php echo esc_attr( $wrapper );?>" class="metro-product-cat-widget">
			<?php foreach ( $cats as $cat ): ?>
				<?php
				$class = $uniqueid.$cat['main']['id'];
				if ( count( $cat['sub'] ) ) {
					$link_html = sprintf( '<a class="card-link card-has-sub collapsed" href="%s"%s>%3$s</a>', "#{$class}", ' data-toggle="collapse"', $cat['main']['icon'].$cat['main']['name'] );
				}
				else {
					$link_html = sprintf( '<a class="card-link card-no-sub" href="%s">%s</a>', $cat['main']['permalink'], $cat['main']['icon'].$cat['main']['name'] );
				}
				?>
				<div class="card">
				    <div class="card-header"><?php echo $link_html;?></div>

				    <?php if ( count( $cat['sub'] ) ): ?>
					    <div id="<?php echo esc_attr( $class );?>" class="collapse card-content" data-parent="#<?php echo esc_attr( $wrapper );?>">
					        <div class="card-body">
					            <ul>
					            	<?php foreach ( $cat['sub'] as $sub ): ?>
					            		<li><a href="<?php echo esc_attr( $sub['permalink'] );?>"><?php echo esc_html( $sub['name'] );?><span>(<?php echo esc_html( $sub['count'] );?>)</span></a></li>
					            	<?php endforeach; ?>
					            </ul>
					        </div>
					    </div>
				    <?php endif; ?>

				</div>
			<?php endforeach; ?>
		</div>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance            = array();
		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['cats']    = ( ! empty( $new_instance['cats'] ) ) ? $new_instance['cats'] : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'   => '',
			'cats'    => array(),
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$terms  = get_terms( array( 'taxonomy' => 'product_cat', 'fields' => 'id=>name','parent' => 0, 'hide_empty' => false ) );
		$category_dropdown = array();

		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'metro-core' ),
				'type'    => 'text',
			),
			'cats'       => array(
				'label'   => esc_html__( 'Select Categories', 'metro-core' ),
				'type'    => 'multi_select',
				'options' => $category_dropdown,
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}