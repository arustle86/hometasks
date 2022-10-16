<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

// Can be used only in 'include' function

if ( $type == 'cross-sells' ) {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'400'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 1 ),
		'992'  => array( 'items' => 2 ),
	);
}
elseif ( RDTheme::$layout == 'full-width' ) {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'400'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 3 ),
		'992'  => array( 'items' => 3 ),
		'1200' => array( 'items' => 4 ),
	);
}
else {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'400'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 2 ),
		'992'  => array( 'items' => 3 ),
	);
}

$owl_data = array( 
	'nav'                => true,
	'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
	'dots'               => false,
	'autoplay'           => true,
	'autoplayTimeout'    => '5000',
	'autoplaySpeed'      => '200',
	'autoplayHoverPause' => true,
	'loop'               => false,
	'margin'             => 30,
	'responsive'         => $responsive
);

$owl_data = json_encode( $owl_data );

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_style( 'owl-theme-default' );
wp_enqueue_script( 'owl-carousel' );

$block_data = array( 'v_swatch' => false, 'gallery' => false );
?>
<div class="rdtheme-related-products owl-wrap rt-woo-nav related products no-nav <?php echo esc_attr( $type );?>">
	<h2 class="woo-related-title"><?php echo esc_html( $title );?></h2>
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php
		foreach ( $products as $product ) {
			$post_object = get_post( $product->get_id() );
			setup_postdata( $GLOBALS['post'] =& $post_object );
			wc_get_template( "content-product.php" , compact( 'block_data' ) );
		}
		?>
	</div>
</div>