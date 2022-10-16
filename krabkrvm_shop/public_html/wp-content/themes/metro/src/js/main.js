import passive_event from './passive_event';
import theme from './theme';
import wc from './woocommerce';
import loadmore from './loadmore';
import widthgen from './widthgen';
import additional from './additional';

loadmore();
widthgen();

function content_ready_scripts(){
	theme.countdown(); /* Countdown */
	theme.magnific_popup(); /* Magnific Popup */
	theme.vertical_menu();
	theme.vertical_menu_mobile();
	theme.category_search_dropdown();
	theme.rt_offcanvas_menu();
	theme.rt_toggle();
	theme.rt_offcanvas_menu_layout();
	wc.dokan_my_order_responsive_table();
	theme.slick_banner_slider(); /* Slick Carousel */
}

function content_load_scripts(){
	theme.isotope(); /* Isotope */
	theme.owl_carousel(); /* Owl Carousel */
	theme.slick_carousel(); /* Slick Carousel */
	theme.slick_banner_slider(); /* Slick Carousel */
	theme.ripple_effect(); /* Water Ripple */
	theme.metro_sal(); /* Scroll to top */
}

$(document).ready(function(){
	//theme.abc(); /* Scroll to top */
	theme.scroll_to_top(); /* Scroll to top */
	theme.sticky_menu(); /* Sticky Menu */
	theme.mobile_menu(); /* MeanMenu - Mobile Menu */
	theme.multi_column_menu(); /* Mega Menu */
	theme.search_popup(); /* Header Search */
	
	wc.quantity_change(); /* Quantity change */
	wc.wishlist_icon(); /* Wishlist icon */
	wc.meta_reloation();
	wc.sticky_product_thumbnail();
	//wc.sticky_product_thumbnail_prices();
	content_ready_scripts();
});


$(window).on('load', function () {
	content_load_scripts();
	theme.preloader(); /* Preloader */
});

$(window).on('load resize', function () {
	theme.mobile_menu_max_height(); /* Define the maximum height for mobile menu */
	wc.slider_nav(); /* Product slider navigation height */
});

$(window).on('elementor/frontend/init', function() {
	if (elementorFrontend.isEditMode()) {
		elementorFrontend.hooks.addAction('frontend/element_ready/widget', function(){
			content_ready_scripts()
			content_load_scripts();
		});
	}
});

$(document).on('rt_filter_ajax_load', function(){
	theme.slick_carousel();
});