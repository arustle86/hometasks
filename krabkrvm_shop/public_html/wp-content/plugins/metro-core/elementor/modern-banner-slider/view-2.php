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

$metro_slider_js_options = apply_filters('metro_slider_js_options', array(
    'arrows' => $data['slider_nav'] == 'yes' ? true : false,
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => $data['slider_autoplay'] == 'yes' ? true : false,
    'autoplaySpeed' => $data['slider_autoplay_speed'],    
    'speed' => 500,    
    'vertical' => true,      
     'infinite' => true,
    'asNavFor' => '.slick-slide-img, .slick-price-circle'
   ));

$metro_nav_slider_js_options = apply_filters('metro_thumbnail_slider_js_options', array(
    'arrows' => false,
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => $data['slider_autoplay'] == 'yes' ? true : false,
    'autoplaySpeed' => $data['slider_autoplay_speed'], 
    'speed' => 500,
    'fade' => true,
    'asNavFor' => '.slick-slide-text, .slick-price-circle'
));
$metro_nav_slider_js_options2 = apply_filters('metro_thumbnail_slider_js_options2', array(
    'arrows' => false,
    'slidesToShow' => 1,
    'slidesToScroll' => 1,
    'autoplay' => $data['slider_autoplay'] == 'yes' ? true : false,
    'autoplaySpeed' => $data['slider_autoplay_speed'], 
    'speed' => 500,
    'fade' => true
));

?>
    <!--=====================================-->
    <!--=        Slider Start Here          =-->
    <!--=====================================-->
        <div class="slider-layout2">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="slider-content">
                            <div class="slick-slider slick-slide-text" data-slick='<?php echo htmlspecialchars(wp_json_encode($metro_slider_js_options), ENT_QUOTES, 'UTF-8'); // WPCS: XSS ok. ?>'>
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
                                    <?php if ( $item['subtitle'] ): ?>
                                        <div class="item-subtitle"><?php echo wp_kses_post( $item['subtitle'] );?></div>
                                    <?php endif; ?> 
                                    <?php if ( $item['subtitle'] ): ?>
                                            <h1 class="item-title"><?php echo wp_kses_post( $item['title'] );?></h1>
                                    <?php endif; ?> 
                                    <?php if ( $item['content'] ): ?>
                                         <p><?php echo wp_kses_post( $item['content'] );?></p>
                                    <?php endif; ?> 
                                    <?php if ( $item['linktext'] ): ?>
                                     <div class="item-btn">
                                        <a <?php echo $attr;?>><?php echo esc_html( $item['linktext'] );?>  <i class="fas fa-long-arrow-alt-right"></i></a>
                                     </div>
                                <?php endif; ?>                                     
                                </div>
                            <?php endforeach; ?>  
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="slider-img">
                            <div class="slick-slider slick-slide-img" data-slick='<?php echo htmlspecialchars(wp_json_encode($metro_nav_slider_js_options), ENT_QUOTES, 'UTF-8'); // WPCS: XSS ok. ?>'>
                                                          
                                <?php foreach ( $data['items'] as $item ) : ?>   
                                    <div class="slick-slide" data-sal="slide-left" data-sal-duration="800" data-sal-delay="600">
                                       <?php echo wp_get_attachment_image( $item['bgimg']['id'], 'full' );?>
                                    </div>
                                <?php endforeach; ?>  

                            </div>
                            <ul class="bg-shape">
                                <li data-sal="slide-down" data-sal-duration="800">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape_17.png" alt="shape">
                                </li>
                                <li data-sal="slide-up" data-sal-duration="800" data-sal-delay="200">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape_18.png" alt="shape">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="slider-price">
                        <div class="slick-slider slick-price-circle" data-slick='<?php echo htmlspecialchars(wp_json_encode($metro_nav_slider_js_options2), ENT_QUOTES, 'UTF-8'); // WPCS: XSS ok. ?>'>
                         
                           <?php foreach ( $data['items'] as $item ) : ?>    
                            <div class="slick-slide">
                                <div class="price-box" data-sal="zoom-in" data-sal-duration="1000" data-sal-delay="1000">
                                    <?php if ( $item['price'] ): ?>
                                        
                                        <div class="price-text"><?php echo esc_html( $item['price_label'] );?></div>
                                        <div class="price-number">
                                            <span class="currency-symbol"><?php echo esc_html( $item['symbol'] );?></span> 
                                            <?php echo esc_html( $item['price'] );?>
                                        </div>

                                    <?php endif; ?> 
                                </div>
                            </div>
                         <?php endforeach; ?>   
                            
                        </div>
                    </div>

                     <div class="slick-navigation" data-sal="zoom-in" data-sal-duration="1000">
                        <?php if ( $data['slider_paginginfo'] ): ?>
                            <div class="paginginfo"></div>
                        <?php endif; ?> 
                        <?php if ( $data['slider_nav'] ): ?>
                        <div class="nav-btn">
                            <button id="slick-prev" type="button" class="slick-arrow prev-btn"><i class="fas fa-long-arrow-alt-left"></i></button>
                            <button id="slick-next" type="button" class="slick-arrow next-btn"><i class="fas fa-long-arrow-alt-right"></i></button>
                        </div>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
        </div>
    <!--=====================================-->
    <!--=        Product Start Here         =-->
    <!--=====================================-->