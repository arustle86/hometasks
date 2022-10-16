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

$thumb_size = 'rdtheme-size3';
//$thumb_size = 'rdtheme-size5';
$query = $data['query'];
$count = 1;
		$i = 1;

?>
<?php if ( $query->have_posts() ) :?>
	<div class="rt-el-post-9 blog-grid-2">
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
				<?php if ( $i == 1 || $i == 2   ) { ?>					
				
				<div class="col-lg-4 col-md-6 col-12">
					 <div class="blog-box">
                        <div class="item-img">
                           <a class="rtin-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
                            <div class="item-date">
                            		<?php 
										$date 		= strtotime( get_the_date() );
										$day  		= date( 'j', $date );
										$month  	= date( 'M', $date );?>
									<span class="days"><?php echo esc_attr($day) ?></span>
									<span class="month"><?php echo esc_attr($month) ?></span>
								</div>
                        </div>
                        <div class="item-content">
                            <div class="item-category"><?php the_category( ', ' );?></div>
                            <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                    </div>
				</div>
				<?php } ?>

			<?php if ( $i == 2 ) { ?>
			<div class="col-lg-4 col-md-12 col-12">	
				<div class="blog-box">		
					<?php } ?>	
						<?php if ( $i == 3 || $i == 4   ) { ?>			
			                <div class="blog-no-thumb">
			                    <div class="item-date"><?php 
										$date 		= strtotime( get_the_date() );
										$day  		= date( 'j', $date );
										$month  	= date( 'M', $date );?>
									<span class="days"><?php echo esc_attr($day) ?></span>
									<span class="month"><?php echo esc_attr($month) ?></span></div>
			                    <div class="item-content">
			                        <div class="item-category"><?php the_category( ', ' );?></div>
			                        <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			                    </div>
			                </div>       
						<?php } ?>
					<?php if ( $i == 4 ) { ?>							
				</div>
			</div>	
			<?php } ?>
			<?php if ( $query->post_count == $i ) { ?>							
			<?php } ?>
			<?php $i++;  ?>				

			<?php endwhile;?>
		</div>
	</div>
<?php else: ?>
	<div><?php esc_html_e( 'Currently there are no posts', 'metro-core' ); ?></div>
<?php endif;?>
<?php wp_reset_postdata();?>