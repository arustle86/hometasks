<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/post/view-3.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use radiustheme\Metro\Helper;

$thumb_size = array( 350, 315 );
//$thumb_size = 'rdtheme-size5';
$query = $data['query'];
?>
<?php if ( $query->have_posts() ) :?>
	<div class="rt-el-post-8">
		<div class="rtin-sec-title-area">
			<h3 class="rtin-sec-title"><?php echo esc_html( $data['title'] );?></h3>
			<?php if ( $data['subtitle'] ): ?>
				<h4 class="rtin-sec-subtitle"><?php echo esc_html( $data['subtitle'] );?></h4>
			<?php endif; ?>
		</div>
		<div class="row">
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$content = Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['count'] );
				?>
				<div class="col-md-6 col-12">
				 	<div class="blog-box">
                        <div class="media">
							<?php if ( has_post_thumbnail() ){ ?>
								<div class="item-img">
									<a class="rtin-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
								</div>
							<?php } ?>   
                            <div class="media-body">
                                <div class="blog-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
                                <div class="blog-category"><?php the_category( ', ' );?></div>
                                <h3 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
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