<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;


Helper::includes( 'dynamic-styles/common.php' );

/*-------------------------------------
INDEX
=======================================
#. Defaults
#. Header
#. Banner/Breadcrumb
#. Footer
#. Contents Area
#. WooCommerce
#. Plugins
-------------------------------------*/

$prefix = Constants::$theme_prefix;
$primary_color    = Helper::get_primary_color(); // #111111
$primary_rgb      = Helper::hex2rgb( $primary_color ); // 17, 17, 17

$menu_typo     = RDTheme::$options['menu_typo'];
$submenu_typo  = RDTheme::$options['submenu_typo'];
$resmenu_typo  = RDTheme::$options['resmenu_typo'];

$menu_color             = RDTheme::$options['sitewide_color'] == 'custom' ? RDTheme::$options['menu_color'] : '#000000';
$submenu_color          = RDTheme::$options['sitewide_color'] == 'custom' ? RDTheme::$options['submenu_color'] : '#111111';
$submenu_hover_color    = RDTheme::$options['submenu_hover_color'];
$submenu_hover_bgcolor  = RDTheme::$options['sitewide_color'] == 'custom' ? RDTheme::$options['submenu_hover_bgcolor'] : $primary_color;

$banner_title_color          = RDTheme::$options['banner_title_color'];
$breadcrumb_link_color       = RDTheme::$options['breadcrumb_link_color'];
$breadcrumb_link_hover_color = RDTheme::$options['sitewide_color'] == 'custom' ? RDTheme::$options['breadcrumb_link_hover_color'] : $primary_color;
$breadcrumb_active_color     = RDTheme::$options['breadcrumb_active_color'];
$breadcrumb_seperator_color  = RDTheme::$options['breadcrumb_seperator_color'];

$footer_bgcolor          	 = RDTheme::$options['footer_bgcolor'];
$footer_title_color      	 = RDTheme::$options['footer_title_color'];
$footer_color            	 = RDTheme::$options['footer_color'];
$footer_link_color        	 = RDTheme::$options['footer_link_color'];
$footer_link_hover_color 	 = RDTheme::$options['footer_link_hover_color'];
$mail_chimp_bgimg 		 	 = RDTheme::$options['mail_chimp_bgimg']['url'];
$mail_chimp_bgcolor 		 = RDTheme::$options['mail_chimp_bgcolor'];
?>

<?php
/*-------------------------------------
#. Defaults
---------------------------------------*/
?>
.primary-color {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.primary-bgcolor {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.metro-shop-link + a:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.metro-shop-link-2 {
	color: <?php echo esc_html( $primary_color ); ?> !important;
}
.metro-shop-link-2 + a:after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.ui-autocomplete li:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Header
---------------------------------------*/
?>
.main-header .main-navigation-area .main-navigation ul li a {
	font-family: <?php echo esc_html( $menu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $menu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $menu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $menu_typo['line-height'] ); ?>;
	text-transform : <?php echo esc_html( $menu_typo['text-transform'] ); ?>;
	font-style: <?php echo empty( $menu_typo['font-style'] ) ? 'normal' : $menu_typo['font-style']; ?>;
}
.main-header .main-navigation-area .main-navigation ul li ul li a {
	font-family: <?php echo esc_html( $submenu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $submenu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $submenu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $submenu_typo['line-height'] ); ?>;
	text-transform : <?php echo esc_html( $submenu_typo['text-transform'] ); ?>;
	font-style: <?php echo empty( $submenu_typo['font-style'] ) ? 'normal' : $submenu_typo['font-style']; ?>;
}
.mean-container .mean-nav ul li.menu-item a {
	font-family: <?php echo esc_html( $resmenu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $resmenu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $resmenu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $resmenu_typo['line-height'] ); ?>;
	text-transform : <?php echo esc_html( $resmenu_typo['text-transform'] ); ?>;
	font-style: <?php echo empty( $resmenu_typo['font-style'] ) ? 'normal' : $resmenu_typo['font-style']; ?>;
}

<?php // Top Bar ?>
.top-header .tophead-info li i {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.top-header .tophead-social li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.top-header.rtin-style-2,
.top-header.rtin-style-3 {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Main Menu ?>
.main-header .main-navigation-area .main-navigation ul.menu > li > a::after,
.main-header .main-navigation-area .main-navigation ul.menu > li.current-menu-item > a::after,
.main-header .main-navigation-area .main-navigation ul.menu > li.current > a::after {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.main-header .main-navigation-area .main-navigation ul li a {
	color: <?php echo esc_html( $menu_color ); ?>;
}

<?php // Sub Menu ?>
.main-header .main-navigation-area .main-navigation ul li ul li a {
	color: <?php echo esc_html( $submenu_color ); ?>;
}
.main-header .main-navigation-area .main-navigation ul li ul li:hover > a {
	color: <?php echo esc_html( $submenu_hover_color ); ?>;
	background-color: <?php echo esc_html( $submenu_hover_bgcolor ); ?>;
}

<?php // Multi Column Menu ?>
.main-header .main-navigation-area .main-navigation ul li.mega-menu > ul.sub-menu > li:hover > a {
	color: <?php echo esc_html( $submenu_color ); ?>;
}
.main-header .main-navigation-area .main-navigation ul li.mega-menu > ul.sub-menu > li > a:hover {
	color: <?php echo esc_html( $submenu_hover_bgcolor ); ?>;
}

<?php // Mean Menu ?>
.mean-container .mean-bar {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.mean-container .mean-bar a.meanmenu-reveal,
.mean-container .mean-nav ul li.menu-item a:hover,
.mean-container .mean-nav>ul>li.current-menu-item>a,
.mean-container .mean-nav ul li.menu-item a.mean-expand {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.mean-container .mean-bar a.meanmenu-reveal span {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Header Misc ?>
.header-contact li i,
.header-contact li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.header-icon-area .cart-icon-area a:hover i,
.header-icon-area .account-icon-area a:hover i,
.header-icon-area .search-icon-area a:hover i {
	color: <?php echo esc_html( $primary_color ); ?>
}
.header-icon-area .cart-icon-area .cart-icon-num {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	-webkit-box-shadow: 0 5px 5px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.3);
	box-shadow: 0 5px 5px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.3);
}
.header-icon-area .cart-icon-area .cart-icon-products {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.cart-icon-products .widget_shopping_cart .mini_cart_item a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.cart-icon-products .widget_shopping_cart .woocommerce-mini-cart__buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.header-style-3 .header-firstrow {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.header-style-3 .header-icon-area .cart-icon-area .cart-icon-num {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.vertical-menu-area .vertical-menu-btn,
.product-search .input-group .btn-group .rtin-btn-search,
.product-search .input-group .dropdown-menu ul li:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Banner/Breadcrumb
---------------------------------------*/
?>
.banner .banner-content h1 {
	color: <?php echo esc_html( $banner_title_color ); ?>;
}
.main-breadcrumb {
	color: <?php echo esc_html( $breadcrumb_seperator_color ); ?>;
}
.main-breadcrumb a span {
	color: <?php echo esc_html( $breadcrumb_link_color ); ?>;
}
.main-breadcrumb span {
	color: <?php echo esc_html( $breadcrumb_active_color ); ?>;
}
.main-breadcrumb a span:hover {
	color: <?php echo esc_html( $breadcrumb_link_hover_color ); ?>;
}

<?php
/*-------------------------------------
#. Footer
---------------------------------------*/
?>
.site-footer {
	background-color: <?php echo esc_html( $footer_bgcolor ); ?>;
}
.footer-top-area .widget > h3 {
	color: <?php echo esc_html( $footer_title_color ); ?>;
}
.footer-top-area .widget {
	color: <?php echo esc_html( $footer_color ); ?>;
}
.footer-top-area a:link,
.footer-top-area a:visited {
	color: <?php echo esc_html( $footer_link_color ); ?>;
}
.footer-top-area .widget a:hover,
.footer-top-area .widget a:active {
	color: <?php echo esc_html( $footer_link_hover_color ); ?>;
}
.footer-bottom-area .footer-bottom-inner .copyright-text {
	color: <?php echo esc_html( $footer_color ); ?>;
}
.footer-bottom-area .footer-bottom-inner .copyright-text a {
	color: <?php echo esc_html( $footer_link_hover_color ); ?>;
}

.footer-top-mail-chimp.footer-top-layout2{	
	background-image: url(<?php echo esc_html( $mail_chimp_bgimg ); ?>);
}
.footer-top-mail-chimp.footer-top-layout1{	
	background-color: <?php echo esc_html( $mail_chimp_bgcolor ); ?>;
}

<?php
/*-------------------------------------
#. Contents Area
---------------------------------------*/
?>

<?php // Defaults ?>

button,
input[type="button"],
input[type="reset"],
input[type="submit"] {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

button:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover,
button:active,
input[type="button"]:active,
input[type="reset"]:active,
input[type="submit"]:active {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.8);
}
body a.scrollToTop {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	-webkit-box-shadow: 0 1px 6px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.275);
	box-shadow: 0 1px 6px rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.275);
}

.rdtheme-button-1,
.rdtheme-button-2 {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Widgets ?>
.widget.widget_tag_cloud a:hover,
.widget.widget_product_tag_cloud a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.sidebar-widget-area .widget a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.sidebar-widget-area .widget.widget_tag_cloud a:hover,
.sidebar-widget-area .widget.widget_product_tag_cloud a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.widget_metro_post .rtin-item .rtin-content .rtin-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.sidebar-widget-area .widget_metro_socials ul li a,
.widget_metro_socials  ul li a {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.sidebar-widget-area .widget_metro_socials ul li a:hover,
.widget_metro_socials  ul li a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.metro-product-cat-widget .card .card-header svg {
    fill: <?php echo esc_html( $primary_color ); ?>;
}
.metro-product-cat-widget .card .card-body ul li a span {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Contents ?>
.pagination-area ul li:not(.pagi) a:hover,
.pagination-area ul li:not(.pagi) span,
.dokan-product-listing-area .pagination-wrap ul li:not(.pagi) a:hover,
.dokan-product-listing-area .pagination-wrap ul li:not(.pagi) span {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.post-each .post-thumbnail .post-date-round {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.post-each .post-thumbnail .post-date-box {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.post-each .post-top-cats a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.post-each .post-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.post-each .post-meta li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.post-each .read-more-btn:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.post-content-area .post-tags a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.post-social .post-social-sharing a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.post-author-block .rtin-right .author-social a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.single-post-pagination .rtin-item .rtin-content .rtin-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.single-post-pagination .rtin-item .rtin-content a.rtin-link:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.comments-area .main-comments .reply-area a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

#respond form .btn-send {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.custom-nav-1 .custom-nav-1-inner .owl-prev:hover,
.custom-nav-1 .custom-nav-1-inner .owl-next:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body .owl-custom-nav .owl-nav button.owl-prev:hover,
body .owl-custom-nav .owl-nav button.owl-next:hover {
	background: <?php echo esc_html( $primary_color ); ?>;
}
.rt-slick-slider .slick-prev:hover,
.rt-slick-slider .slick-next:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. WooCommerce
---------------------------------------*/
?>
.woocommerce span.onsale {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

p.demo_store {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce-message:before,
.woocommerce-info:before {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce a.button,
.woocommerce input.button,
.woocommerce button.button,
.woocommerce a.button.alt,
.woocommerce input.button.alt,
.woocommerce button.button.alt {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce a.button:hover,
.woocommerce input.button:hover,
.woocommerce button.button:hover,
.woocommerce a.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce button.button.alt:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce button.button:disabled:hover,
.woocommerce button.button:disabled[disabled]:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-woo-nav .owl-carousel .owl-nav .owl-prev:hover,
.rt-woo-nav .owl-carousel .owl-nav .owl-next:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.sidebar-widget-area .widget.widget_products .product_list_widget .product-title:hover,
.sidebar-widget-area .widget.widget_recent_reviews .product_list_widget .product-title:hover,
.sidebar-widget-area .widget.widget_top_rated_products .product_list_widget .product-title:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}


.woocommerce div.product .single-add-to-cart-wrapper button.button.single_add_to_cart_button,
.woocommerce div.product .single-add-to-cart-wrapper button.button.single_add_to_cart_button.disabled {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-add-to-cart-wrapper .product-single-meta-btns a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rdtheme-wc-reviews #respond input#submit {
    background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rdtheme-wc-reviews #respond input#submit:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.single-product-top-1 .product_meta-area .product-meta-content a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.single-product-top-1 .product_meta-area .product-social .product-social-items li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-bottom-1 .woocommerce-tabs ul.tabs li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-bottom-1 .woocommerce-tabs ul.tabs li.active a {
	color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-2 .rtin-avaibility .rtin-stock {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-2 .product_meta-area .product-meta-content a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-2 .product_meta-area .product-social .product-social-items li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-2 .woocommerce-tabs ul.tabs li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.woocommerce div.product .single-product-top-2 .woocommerce-tabs ul.tabs li.active a {
	color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-3 .product_meta-area .product-social .product-social-items li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-3 .woocommerce-tabs ul.tabs li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-top-3 .woocommerce-tabs ul.tabs li.active a {
	color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li.active a {
	color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.woocommerce table.shop_table tbody tr td.product-remove a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?> !important;
	border-color: <?php echo esc_html( $primary_color ); ?> !important;
}
.woocommerce-checkout .woocommerce .checkout #payment .place-order button#place_order:hover,
.woocommerce form .woocommerce-address-fields #payment .place-order button#place_order:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a,
.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:hover,
.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation ul li a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block ?>
.rt-product-block span.onsale {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 1 ?>
.rt-product-block-1 .rtin-buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-1 .rtin-buttons a:hover {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.785);
}

<?php // Product Block 2 ?>
.rt-product-block-2 .rtin-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-2 .rtin-buttons a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-product-block-2 .rtin-buttons a.action-cart,
.rt-product-block-2 .rtin-buttons a.added_to_cart {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 3 ?>
.rt-product-block-3 .rtin-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-3 .rtin-buttons a.action-cart,
.rt-product-block-3 .rtin-buttons a.added_to_cart {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-3 .rtin-buttons a.yith-wcqv-button:hover,
.rt-product-block-3 .rtin-buttons a.compare:hover,
.rt-product-block-3 .rtin-buttons a.rdtheme-wishlist-icon:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 4 ?>
.rt-product-block-4 .rtin-buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-product-block-4 .rtin-buttons a:hover {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.785);
}

<?php // Product Block 5 ?>
.rt-product-block-5 a.rdtheme-wishlist-icon {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-5 .rtin-buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-product-block-5 .rtin-buttons a:hover {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.785);
}
.rt-product-block-5 .rtin-buttons a.yith-wcqv-button {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-5 .rtin-buttons a.yith-wcqv-button:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 6 ?>
.rt-product-block-6 .rtin-actions > a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-6 .rtin-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-product-block-6 .rtin-buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 7 ?>
.rt-product-block-7 .rtin-thumb-wrapper .rtin-buttons a {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-7 .rtin-thumb-wrapper .rtin-buttons a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 8 ?>
.rt-product-block-8 .rtin-buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-8 .rtin-buttons a:hover {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.785);
}

<?php // Product Block 9 ?>
.rt-product-block-9 .rdtheme-wishlist-icon.rdtheme-remove-from-wishlist {
	color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product Block 10 ?>
.rt-product-block-10 .rtin-buttons{
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-10 .rtin-buttons a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-10 .rtin-buttons a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Product List 1 ?>
.rt-product-list-1 .rtin-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-list-1 .rtin-buttons a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-list-1 .rtin-buttons a.action-cart,
.rt-product-list-1 .rtin-buttons a.added_to_cart {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-11 .rtin-thumb-wrapper .rtin-buttons a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Plugins
---------------------------------------*/
?>

<?php // Layer Slider ?>
.ls-theme1 .ls-nav-prev,
.ls-theme1 .ls-nav-next,
.ls-theme2 .ls-nav-prev,
.ls-theme2 .ls-nav-next {
	color: <?php echo esc_html( $primary_color ); ?> !important;
}
.ls-theme1 .ls-nav-prev:hover,
.ls-theme1 .ls-nav-next:hover,
.ls-theme2 .ls-nav-prev:hover,
.ls-theme2 .ls-nav-next:hover {
	background-color: <?php echo esc_html( $primary_color ); ?> !important;
}

<?php // Newsletter ?>
.newsletter-form-1 input[type="submit"] {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.newsletter-form-2 .newsletter-submit input[type="submit"] {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.newsletter-form-4 .newsletter-submit input[type="submit"] {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.newsletter-form-3 .newsletter-submit input[type="submit"] {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Dokan ?>
input[type="submit"].dokan-btn,
a.dokan-btn,
.dokan-btn {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.dokan-product-listing .dokan-product-listing-area .product-listing-top ul.dokan-listing-filter li.active a, .dokan-product-listing .dokan-product-listing-area .product-listing-top ul.dokan-listing-filter li a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}

input[type="submit"].dokan-btn:hover,
a.dokan-btn:hover,
.dokan-btn:hover,
input[type="submit"].dokan-btn:active,
a.dokan-btn:active,
.dokan-btn:active,
input[type="submit"].dokan-btn:focus,
a.dokan-btn:focus,
.dokan-btn:focus {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // CF7 ?>
.metro-contact-form .wpcf7-submit {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.metro-contact-form .wpcf7-submit:hover {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.8);
}

<?php // Variation Swatches ?>
.rtwpvs .rtwpvs-terms-wrapper .rtwpvs-size-term:hover .rtwpvs-term-span-size, .rtwpvs .rtwpvs-terms-wrapper .rtwpvs-size-term.selected .rtwpvs-term-span-size {
    background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Variation Gallery ?>
.rtwpvg-wrapper .rtwpvg-slider-wrapper .rtwpvg-trigger .dashicons-search:hover::before {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php // Instagram Feed ?>
#sb_instagram #sbi_load .sbi_follow_btn a {
	color: <?php echo esc_html( $primary_color ); ?>;
}
#sb_instagram #sbi_load .sbi_follow_btn a:focus,
#sb_instagram #sbi_load .sbi_follow_btn a:hover {
	background: <?php echo esc_html( $primary_color ); ?>;
}
#sb_instagram #sbi_images .sbi_photo_wrap a:after {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.8);
}

.rt-product-block-14 .rtin-thumb-wrapper .action-btn li a{
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-product-block-14 .rtin-thumb-wrapper .action-btn li a:hover{
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.has-footer-dark .footer-bottom-area .footer-bottom-inner .footer-social li a:hover{
	color: <?php echo esc_html( $primary_color ); ?>;
}

.newsletter-form-3.newsletter-form-5 .newsletter-submit input[type="submit"]:hover{
	background-color: <?php echo esc_html( $primary_color ); ?>;
}


.rt-el-text-with-icon.rtin-style-8 .rtin-item:hover .rtin-icon i,
.rt-el-text-with-icon.rtin-style-8 .rtin-item:hover .rtin-icon svg{
	color: <?php echo esc_html( $primary_color ); ?>;
}