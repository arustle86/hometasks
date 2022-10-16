<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/sale-banner/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;
use Elementor\Icons_Manager;
?>
<div class="slider-layout1">
    <div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-xl-5 col-lg-4 col-6">
            <div class="slider-large-img">
                <div class="slick-slider slick-large" data-slick='{"arrows": false, "dots": false, "fade": true, "slidesToShow": 1, "autoplay": true, "autoplaySpeed": 3000, "speed": 500, "slidesToScroll": 1, "asNavFor": ".slick-slide-text,.slick-small"}'>
          		 <?php foreach ( $data['items'] as $item ) : ?>
 					<div class="slick-slide">
                      	<?php echo wp_get_attachment_image( $item['bgimg']['id'], 'full' );?>
                    </div>
				<?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-6">
            <div class="slider-text-content">
                <div class="slick-slider slick-slide-text" data-slick='{"arrows": false, "dots": false, "slidesToShow": 1, "slidesToScroll": 1, "autoplay": true, "autoplaySpeed": 3000, "speed": 500, "vertical": true}'>
               <?php foreach ( $data['items'] as $item ) : ?>
				<?php
					$attr = '';
					if ( !empty( $item['url']['url'] ) ) {
						$attr  = 'href="' . $item['url']['url'] . '"';
						$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
						$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
					}							
				?>
 				 <div class="slick-slide">			 		
			 		<?php if (  $item['title'] ): ?>
                    <h1 class="item-title"><?php echo wp_kses_post( $item['title'] );?></h1>
                    <?php endif; ?>	
					<?php if ( $item['subtitle'] ): ?>
					    <div class="item-subtitle"><?php echo wp_kses_post( $item['subtitle'] );?></div>
					<?php endif; ?>	
					<?php if ( $item['content'] ): ?>
                    	<p><?php echo wp_kses_post( $item['content'] );?></p>
					<?php endif; ?>	
                	<?php if ( $item['linktext'] ): ?>
	                    <div class="item-btn">
							<a <?php echo $attr;?> class="fas fa-long-arrow-alt-right"><?php echo esc_html( $item['linktext'] );?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					<?php endif; ?>	                        	
                    </div>
                    <?php endforeach; ?>                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4">
            <div class="slider-small-img">
                <div class="slick-slider slick-small" data-slick='{"arrows": false, "dots": true, "autoplay": true, "autoplaySpeed": 3000, "speed": 500, "slidesToShow": 1, "slidesToScroll": 1, "asNavFor": ".slick-slide-text,.slick-large"}'>                   
 				<?php foreach ( $data['items'] as $item ) : ?>
 					<div class="slick-slide">
			 		<?php if (  $item['slidernav']['id'] ){
                      	echo wp_get_attachment_image( $item['slidernav']['id'], 'full' );
				 		 }else{
                      	echo wp_get_attachment_image( $item['bgimg']['id'], 'full' );
				 		} 
			 		?>
                    </div>
				<?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>    
    <?php 
    if ( $data['shares'] ) { ?>        
        <div class="share-btn-wrap">
             <a href="#" class="item-btn"><?php echo wp_kses_post( $data['share_title'] );?> <span>+</span></a>
                <ul class="share-icon">                  
                    <?php                       
                    foreach ( $data['shares'] as $share ) :
                    $icon = '<i class="'.$share['share_icon']['value'].'" aria-hidden="true"></i>';
                     ?><li><a href="<?php echo esc_url( $share['url'] );?>">   <?php echo  $icon; ?></a></li>                   
                    <?php endforeach; ?>
                </ul>
         </div>
     <?php } ?>
    </div>
</div>