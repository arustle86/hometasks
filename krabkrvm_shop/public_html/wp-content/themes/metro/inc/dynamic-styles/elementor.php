<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

/*-------------------------------------
INDEX
=======================================
#. EL: Defaults
#. EL: Section Title
#. EL: Post
#. EL: Product List
#. EL: Product Isotope
#. EL: Text With Icon
#. EL: Text With Button
#. EL: Banner With Link
#. EL: Sale Banner Slider
#. EL: Info Box
#. EL: Button
#. EL: Countdown
-------------------------------------*/

$prefix = Constants::$theme_prefix;
$primary_color    = Helper::get_primary_color(); // #111111
$primary_rgb      = Helper::hex2rgb( $primary_color ); // 17, 17, 17
?>

<?php /* EL: Defaults */ ?>
.rt-sec-title-area-1 .rtin-sec-title:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body .owl-theme .owl-dots .owl-dot span {
	background: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.05);
}
body .owl-theme .owl-dots .owl-dot.active span,
body .owl-theme .owl-dots .owl-dot:hover span {
	background: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Section Title */ ?>
.rt-el-title.rtin-style-2 .rtin-title:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Post */ ?>
.rt-el-post-2 .rtin-sec-title-area .rtin-sec-title:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-post-3 .rtin-item .rtin-content .rtin-date {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-post-5 .rtin-thumb-area .rtin-date {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-post-5 .rtin-thumb-area:hover .rtin-date {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-post-5 .rtin-cats a:hover,
.rt-el-post-5 .rtin-title a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}


.rt-el-post-7 .rtin-thumb-area .rtin-date {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-post-7 .rtin-thumb-area:hover .rtin-date {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-post-7 .rtin-cats a:hover,
.rt-el-post-7 .rtin-title a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}


.rt-el-post-6 .rtin-thumb-area:hover .rtin-date {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-post-6 .rtin-cats a:hover,
.rt-el-post-6 .rtin-title a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Product List */ ?>
.rt-el-product-list .rtin-sec-title:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-product-list .rtin-item .rtin-thumb:after {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.0075);
}

<?php /* EL: Product Isotope */ ?>
.rt-el-product-isotope.rtin-layout-2 .rtin-navs-area .rtin-navs a.current:after {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.785);
}
.rt-el-product-isotope.rtin-layout-3 .rtin-navs-area .rtin-navs a.current {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-product-isotope.rtin-layout-3 .rtin-navs-area .rtin-navs a.current:after {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.785);
}
.rt-el-product-isotope .rtin-viewall-2 a::after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Text With Icon */ ?>
.rt-el-text-with-icon .rtin-item .rtin-icon i {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-text-with-icon .rtin-item .rtin-icon svg {
	fill: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-text-with-icon.rtin-style-2 .rtin-item .rtin-icon i {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-text-with-icon.rtin-style-2 .rtin-item .rtin-icon svg {
	fill: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-text-with-icon.rtin-style-4 .rtin-item .rtin-icon i {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-text-with-icon.rtin-style-4 .rtin-item .rtin-icon svg {
	fill: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-text-with-icon.rtin-style-6 .rtin-item .rtin-icon i,
.rt-el-text-with-icon.rtin-style-6 .rtin-item .rtin-icon svg {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-text-with-icon.rtin-style-6 .rtin-item:hover .rtin-icon i,
.rt-el-text-with-icon.rtin-style-6 .rtin-item:hover .rtin-icon svg {
	color: <?php echo esc_html( $primary_color ); ?>;
	fill: <?php echo esc_html( $primary_color ); ?>;
}

.scheme-custom .rt-el-text-with-icon.rtin-style-1 .rtin-item:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	-webkit-box-shadow: 0px 10px 29px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.75);
	box-shadow: 0px 10px 29px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.75);
}

<?php /* EL: Text With Button */ ?>
.rt-el-text-with-btn .rtin-btn:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Banner With Link */ ?>
.rt-el-banner-with-link .rtin-btn {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-banner-with-link .rtin-btn:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Sale Banner Slider */ ?>
.rt-el-sale-banner-slider .rtin-title span {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-sale-banner-slider a.rtin-btn::after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-sale-banner-slider .owl-numbered-dots-items span.active {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Sale Banner Slider */ ?>
.rt-el-sale-banner-slider-1 .rtin-title span {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-sale-banner-slider-1 a.rtin-btn::after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-sale-banner-slider-1 .owl-numbered-dots-items span.active {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Info Box */ ?>
.rt-el-info-box .rtin-title {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box .rtin-btn {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	-webkit-box-shadow: 0px 1px 1px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.008);
	box-shadow: 0px 1px 1px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.008);
}
.rt-el-info-box.rtin-style-2 .rtin-content:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box.rtin-style-3 .rtin-content:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box.rtin-style-4 .rtin-btn::before {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box.rtin-style-4 .rtin-btn:hover::after {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box.rtin-style-5 .rtin-btn:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	-webkit-box-shadow: 0px 1px 1px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.008);
	box-shadow: 0px 1px 1px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.008);	
}
.rt-el-info-box.rtin-style-6 .rtin-btn:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	-webkit-box-shadow: 0px 1px 1px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.008);
	box-shadow: 0px 1px 1px 0px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.008);	
}
.rt-el-info-box.rtin-style-7 .rtin-btn:before {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box.rtin-style-7 .rtin-btn:hover::after {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-info-box-2 .rtin-btn-area .rtin-btn::after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Button */ ?>
.rt-el-btn.rtin-style-1 a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php /* EL: Countdown */ ?>
.rt-el-countdown-1 .rtin-coutdown .rt-countdown-section .rtin-count {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-countdown-3 .rtin-coutdown .rt-countdown-section {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-product-block-13 .rtin-buttons a:hover{
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-13 .rtin-title a:hover{
	color: <?php echo esc_html( $primary_color ); ?>;
}

body .owl-custom-nav-top .owl-nav button.owl-prev:hover,
 body .owl-custom-nav-top .owl-nav button.owl-next:hover{
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-el-text-with-icon.rtin-style-8 .rtin-item:hover .rtin-icon i,
 .rt-el-text-with-icon.rtin-style-8 .rtin-item:hover .rtin-icon svg{
	color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-el-text-with-icon.rtin-style-8 .rtin-item:hover .rtin-icon i, .rt-el-text-with-icon.rtin-style-8 .rtin-item:hover .rtin-icon svg{
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product p.price,
.woocommerce div.product span.price{
	color: <?php echo esc_html( $primary_color ); ?>;
}
.header-style-10 .additional-menu-area span.side-menu-trigger.side-menu-open:hover>span {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.header-style-10 .additional-menu-area span.side-menu-trigger.side-menu-open:hover>span:after {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}