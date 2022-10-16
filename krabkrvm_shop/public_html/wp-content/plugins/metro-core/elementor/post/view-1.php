<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/post/view-1.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use radiustheme\Metro\Helper;

$thumb_size = 'rdtheme-size3';
$query = $data['query'];

if ( !empty( $data['cat'] ) ) {
	$blog_permalink = get_category_link( $data['cat'] );
}
else {
	$blog_page = get_option( 'page_for_posts' );
	$blog_permalink = $blog_page ? get_permalink( $blog_page ) : home_url( '/' );
}

$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col_xs']}";

?>
<?php if ( $query->have_posts() ) :?>
	<div class="rt-el-post-1 rtin-<?php echo esc_attr( $data['bgtype'] ); ?>">
		<div class="rt-sec-title-area-1">
			<h3 class="rtin-sec-title"><?php echo esc_html( $data['title'] );?></h3>
			<div class="rtin-viewall"><a href="<?php echo esc_url( $blog_permalink ); ?>"><?php esc_html_e( 'См. далее', 'metro-core' );?><i class="fa fa-chevron-right"></i></a></div>
		</div>
		<div class="row">
			<?php while ( $query->have_posts() ) : $query->the_post();?>				
				<div class="<?php echo esc_attr( $col_class );?>">	
					<div class="rtin-item">
						<?php if ( has_post_thumbnail() ): ?>
							<a class="rtin-thumb theme-overlay-2 theme-overlay-hover" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
						<?php else: ?>
							<a class="rtin-thumb theme-overlay-2 theme-overlay-hover" href="<?php the_permalink(); ?>"><img src="<?php echo Helper::get_img( 'nothumb-size3.jpg' );?>"></a>
						<?php endif; ?>
						<div class="rtin-content">
							<div class="rtin-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
							<h3 class="rtin-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>
					</div>
				</div>
			<?php endwhile;?>
		</div>
	</div>
<?php else: ?>
	<div><?php esc_html_e( 'Currently there are no posts', 'metro-core' ); ?></div>
<?php endif;?>
<?php wp_reset_postdata();?>