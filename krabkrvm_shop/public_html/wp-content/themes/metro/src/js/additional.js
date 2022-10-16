// Mini Cart
(function($){

	// Media Query Matches
	$(document).ready(function(){
		
		if($(window).width() < 991.99){
		
			$('.woocommerce-top-bar-widget-wrapper').addClass('after-top-bar');  // filter side slide view.
			
			$(document).on('rt_filter_ajax_load', function(){

				$('.woocommerce-top-bar-widget-wrapper').removeClass('show-drawer');
				$('.drawer-overlay').animate({
					opacity: 0
				}, 500, 'swing', function() {
					$('.drawer-overlay').css({
					'display': 'none'
					})
				});

			})

		} else {

		
			var parent_store = $('.woocommerce-top-bar-widget-wrapper');

			parent_store.find('.inner-wrapper').prepend("<div class='widget filter-by-text-wrapper'><h3 class=''>" + MetroObj.filter_text + ": </h3></div>");

			var prefix = 'wt-';
			var widgets = $('.woocommerce-top-bar-widget-wrapper .widget');
			widgets.each(function(index) {
				var title = $(this).find('.widgettitle');
				var data_element = title.next();

				var extra_wrapper_classes = $(this).attr('class').replace('widget', '');

				// adding data attributes
				title.attr('target-id', prefix + index);
				title.addClass('click-title')
				data_element.attr('data-id', prefix + index);
				data_element.addClass($.trim(extra_wrapper_classes)).addClass('widget-data');
				data_element.appendTo('.widget-display-data').hide();
				
			});

			if ( ! $('.woocommerce-top-bar-widget-wrapper').length  ) return;

			// Restructuring
			var notice = $('.woocommerce-notices-wrapper');
			var widget = $('.woocommerce-top-bar-widget-wrapper');
			var shoptop = $('.woo-shop-top');
			var mega_wrapper = $("<div class='mega-wrapper'></div>");
			mega_wrapper.append(widget);
			mega_wrapper.append(shoptop);
			mega_wrapper.insertAfter(notice);
			
			var second_wrapper = $("<div class='.woocommerce-top-bar-widget-wrapper'></div>")
			$('.top-widget-active-filter-wrapper').appendTo(second_wrapper);
			$('.widget-display-data').appendTo(second_wrapper);
			
			second_wrapper.insertAfter(mega_wrapper);

			$('.woocommerce-top-bar-widget-wrapper .widget .widgettitle').on('click', function() {

				var id = $(this).attr('target-id');
				var target_element = $('[data-id=' + id + ']');
					
				var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');
				
				if(open_element.length > 0){
					
					if(parent_store.attr('data-current') == target_element.attr('data-id')){
					
						open_element.slideUp();

						parent_store.attr('data-current', false);
				
					} else{

						open_element.slideUp(function(){
							
							target_element.slideDown()
							parent_store.attr('data-current', target_element.attr('data-id'));
							parent_store.attr('data-current', false);
						
						});

					}
				
				} else{

					target_element.slideDown()
					parent_store.attr('data-current', target_element.attr('data-id'));
				
				}
				
			});

			$('.woocommerce-top-bar-widget-wrapper .cat-item a').each(function(){
			
				// Retriving Category slug
				var regex = RegExp(MetroObj.product_category_base + ".*\/([A-Za-z0-9-_]*)\/$", "m");

				var matches, category_slug;

				if ((matches = regex.exec(	$(this).attr('href') )) !== null) {
					
					category_slug = matches[1];
				
				}

				$(this).parent().attr('data-slug', category_slug);

			});

		}
		
	});


	$(document).ready(function(){
		
		var context = {
		container: ".drawer-container",
		close: ".close",
		overlay: ".drawer-overlay"
		};
		
		$(`${context.container} ${context.close}`).on('click', function(e){
			rt_close_cart();
		});

		$(context.overlay).on('click', rt_close_cart);

		function rt_close_cart(){
			$(context.container).removeClass('show-sidebar')
			
			$('.close.filter-drawer').trigger('click');

			$(context.overlay).animate({
				opacity: 0
			}, 500, 'swing', function(){
				$(context.overlay).hide();
			});
		}

		function rt_open_side_cart(){
			$(context.container).addClass('show-sidebar')

			$(context.overlay).show('fast', function(){

			$(context.overlay).animate({
				opacity: 0.5,
			}, 500, 'swing');

			});

			rt_get_side_cart_content();
		}

		function rt_get_side_cart_content(){
			// Requesting for data ajaxurl
			$.ajax({
				url: MetroObj.ajaxurl,
				data: {
					action: 'load_template',
					template: 'cart/mini',
					part: 'cart',
				},
				type: "POST",
				success: function(data) {
					$("#side-content-area-id").html(data);
				},

				error: function(MLHttpRequest, textStatus, errorThrown){
					console.log(errorThrown);
				}
			});
		}

		// Open on click
		$('.cart-icon-area').ready(function(){
			$('.cart-icon-area').click(function(e){
				e.preventDefault();
				rt_open_side_cart();
			});
		});

		// Open on product added trigger
		$(document).on('added_to_cart', function(){
			$('#yith-quick-view-close').trigger("click");
			rt_open_side_cart();
		});

		// Removed From cart
		$(document).on('removed_from_cart', rt_get_side_cart_content);

		$('.mobile-filter-button').on('click', function(){
			$('.woocommerce-top-bar-widget-wrapper').addClass('show-drawer');
			
			$('.drawer-overlay').css({'display': 'block'}).animate({
				opacity: 0.5
			}, 500, 'swing');

		});

		$('.close.filter-drawer').on('click', function(){

			$('.woocommerce-top-bar-widget-wrapper').removeClass('show-drawer');
			$('.drawer-overlay').animate({
				opacity: 0
			}, 500, 'swing', function(){$('.drawer-overlay').css({'display': 'none'})});
		});
	});

})(jQuery);

// Ajax Filter
(function($){

	$(document).ready(function(){
		
		function loader(){
			var archive_container = $('.rdtheme-archive-products');
			archive_container.append(`<div class='archive-product-overlay'></div><img class='ajax-loader-gif' src='${MetroObj.ajax_loader_url}'>`);
			var overlay = $('.archive-product-overlay');
			var loader = $('.ajax-loader-gif');
			var parent = overlay.parent();
			parent.css({"position": "relative"});
			overlay.width(parent.width());
			overlay.height(Math.max(parent.height(), 500));
			loader.css( {
				"top": (overlay.height() / 2) - (loader.height() / 2), 
				"left": (overlay.width() / 2) - (loader.width() / 2), 
			});

			overlay.show();
			loader.show();
		
		}

		window.loader = loader;

		if (MetroObj.product_filter != 'ajax' ) return;

		$('.price_slider_amount .button.button').hide();

		$(`
		.widget .cat-item a, 
		.widget .rtwpvs-term a,
		.widget-display-data .cat-item a, 
		.widget-display-data .rtwpvs-term a 
		`).on('click', function(e){
			
			e.preventDefault();
			
			var query_url = '';

			var active_filter_wrapper = $('.top-widget-active-filter-wrapper');
			
			var target = $(e.target);

			// Property Filter Link Click
			if($(e.target).hasClass('rtwpvs-term-span')){

				if(target.closest('[data-term]').hasClass('rtwpvs-color-term')){
					$('.rtwpvs-color-term').removeClass('selected');
					var attribute_name = target.closest('[data-attribute_name]').attr('data-attribute_name');

					var term_name = target.closest('[data-term]').addClass('selected').attr('data-term');
					
					var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + target.closest('[data-id]').attr('data-id') + ']');
					header.addClass('selected');

					var attribute_wrapper = $('.attribute-wrapper.colour').length > 0 
						? $('.attribute-wrapper.colour') 
						: $("<div class='attribute-wrapper colour'> <h5> Color </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");

					attribute_wrapper.appendTo(active_filter_wrapper);
					attribute_wrapper.find('.filter-item-container').empty().append(target.parent().clone().css({'background-color': target.css('background-color')}));
					attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify([attribute_name.replace('attribute_pa', 'filter')])).attr('data-title-id', target.closest('[data-id]').attr('data-id'));

					$(document).trigger('rt_regenerated_filter_tag');

				} else if(target.closest('[data-term]').hasClass('rtwpvs-button-term')){

					$('.rtwpvs-button-term').removeClass('selected');
					var attribute_name = target.closest('[data-attribute_name]').attr('data-attribute_name');
					var term_name = target.closest('[data-term]').addClass('selected').attr('data-term');

					var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + target.closest('[data-id]').attr('data-id') + ']');
					header.addClass('selected');

					var attribute_wrapper = $('.attribute-wrapper.size').length > 0 
						? $('.attribute-wrapper.size') 
						: $("<div class='attribute-wrapper size'> <h5> Size </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");

					attribute_wrapper.appendTo(active_filter_wrapper);
					attribute_wrapper.find('.filter-item-container').empty().append(target.parent().clone());
					attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify([attribute_name.replace('attribute_pa', 'filter')])).attr('data-title-id', target.closest('[data-id]').attr('data-id'));

					$(document).trigger('rt_regenerated_filter_tag');

				}
				
				attribute_name = attribute_name.replace('attribute_pa', 'filter')
				
				// Full Request URL
				var full_url = new URL(window.location.href);
				full_url.searchParams.set(attribute_name, term_name);

				query_url = full_url.href;

				// Closing
				var parent_store = $('.woocommerce-top-bar-widget-wrapper');
				var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');
				open_element.slideUp();
				parent_store.attr('data-current', false);
				
			} else {
				
				var attribute_name = target.closest('[data-slug]').attr('data-slug');
			
				// Category Link Clicked				
				var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + target.closest('[data-id]').attr('data-id') + ']');
				header.addClass('selected');
				
				var attribute_wrapper = $('.attribute-wrapper.category').length > 0 
						? $('.attribute-wrapper.category') 
						: $("<div class='attribute-wrapper category'> <h5> Category </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");
				
				attribute_wrapper.appendTo(active_filter_wrapper);
				attribute_wrapper.find('.filter-item-container').empty().append(target.parent().clone());
				attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify([attribute_name])).attr('data-title-id', target.closest('[data-id]').attr('data-id'));
				
				$(document).trigger('rt_regenerated_filter_tag');

				var url = new URL(window.location.href);
				url.href = $(e.target).attr('href') + url.search;

				query_url = url.href;

				// Closing
				var parent_store = $('.woocommerce-top-bar-widget-wrapper');
				var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');
				open_element.slideUp();
				parent_store.attr('data-current', false);

			}

			query_url = query_url.replace( new RegExp("/(page\/[0-9]*)\//", "ms") , '');

			window.history.pushState('page-id', 'Ajax Load', query_url);

			loader();

			$.ajax({
				url: MetroObj.ajaxurl,
				data: {
					action: 'load_template',
					template: 'archive',
					part: 'product',
					query_url: query_url,
				},
				type: "POST",
				success: function(data) {

					$(".rdtheme-archive-products").fadeOut('medium', function(){
						$(this).html(data).fadeIn('medium', function(){

							var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
							$('.woocommerce-result-count').replaceWith(updated_statistics_text);
							$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');

						});

						$(document).trigger('rt_filter_ajax_load');
					});

				},

				error: function(MLHttpRequest, textStatus, errorThrown){
					console.log(errorThrown);
				}
			});

		});

		// Price Filter
		$(document.body).on('price_slider_create', function(){

			$(document.body).on('price_slider_change', function(event, min, max){
				
				var active_filter_wrapper = $('.top-widget-active-filter-wrapper');

				var url = new URL(window.location.href);

				url.searchParams.set('min_price', min);
				url.searchParams.set('max_price', max);
				url.href = url.href.replace( new RegExp("/(page\/[0-9]*)\//", "ms") , '');
				window.history.pushState('page-id', 'Ajax Load', url);

				var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + $('.price_slider_wrapper').closest('[data-id]').attr('data-id') + ']');
				header.addClass('selected');

				// Adding Active Filter for price range
				var attribute_wrapper = $('.attribute-wrapper.price').length > 0 
						? $('.attribute-wrapper.price') 
						: $("<div class='attribute-wrapper price'> <h5> Price </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");

				attribute_wrapper.appendTo(active_filter_wrapper);
				attribute_wrapper.find('.filter-item-container').empty().append(`${woocommerce_price_slider_params.currency_format_symbol}${min} - ${woocommerce_price_slider_params.currency_format_symbol}${max}`);
				attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify(['max_price', 'min_price'])).attr('data-title-id', $('.price_slider_wrapper').closest('[data-id]').attr('data-id'));;

				// Closing
				var parent_store = $('.woocommerce-top-bar-widget-wrapper');
				var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');
				open_element.slideUp();
				parent_store.attr('data-current', false);

				$(document).trigger('rt_regenerated_filter_tag');
				
				loader();

				$.ajax({
					url: MetroObj.ajaxurl,
					type: "POST",
					data: {
						action: 'load_template',
						template: 'archive',
						part: 'product',
						query_url: url.href,
					},
					success: function(data) {

						$(".rdtheme-archive-products").fadeOut('medium', function(){
							$(this).html(data).fadeIn('medium', function(){
	
								var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
								$('.woocommerce-result-count').replaceWith(updated_statistics_text);
								$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
	
							});
	
							$(document).trigger('rt_filter_ajax_load');
						});

					},

					error: function(MLHttpRequest, textStatus, errorThrown){
						console.log(errorThrown);
					}
				});

			});


		});


		// Known Params
		var known_params = [ 'filter_color', 'filter_size', 'min_price', 'max_price' ];

		// Filter Remove 
		$(document).on('rt_regenerated_filter_tag', function(){

			$('.attribute-wrapper .remove-filter').off().on('click', function(){

				if( $(this).attr('data-param') ){

					// Clear individual filter
					var params = JSON.parse($(this).attr('data-param'));

					var url = new URL(window.location.href);
				
					for(I = 0; I < params.length; I++){
						
						if(url.searchParams.get(params[I]) === null){

							// Category
							url.href = url.href.replace(new RegExp(MetroObj.product_category_base + ".*$", "i"), "") + url.search;

						} else{

							if( known_params.includes( params[I] ) ) url.searchParams.delete(params[I]);

						}
					}

				} else if( $(this).attr('data-clear') ){

					// Clear all filter
					var url = new URL(window.location.href);
					url.href = url.href.replace(new RegExp(MetroObj.product_category_base + ".*$", "i"), "") + url.search;
					
					// Removing Filter From URL
					var search = new URLSearchParams(url.search);

					for(var key of search.keys())
						if(known_params.includes(key))
							url.searchParams.delete(key);

					$('.woocommerce-top-bar-widget-wrapper .widgettitle, \
						.woocommerce-top-bar-widget-wrapper .rtwpvs-term\
						').removeClass('selected');

					// Removing all filter
					$('.top-widget-active-filter-wrapper .attribute-wrapper').each(function(){
						
						// Removing All Filter
						$(this).remove();

						
					});

				}


				var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + $(this).attr('data-title-id') + ']');
				header.removeClass('selected');

				var query_url = url.href;

				query_url = query_url.replace( new RegExp("/(page\/[0-9]*)\//", "ms"), '');
				window.history.pushState('page-id', 'Ajax Load', query_url);

				$(this).closest('.attribute-wrapper').fadeOut('fast', function(){
				
					$(this).remove()
					
					// Clearing clear all if there are no more filter left.
					if( $('.top-widget-active-filter-wrapper .attribute-wrapper:not(.clear)').length == 0 ){
						$('.top-widget-active-filter-wrapper .attribute-wrapper.clear').remove();
					}

				});

				loader();

				$.ajax({
					url: MetroObj.ajaxurl,
					data: {
						action: 'load_template',
						template: 'archive',
						part: 'product',
						query_url: query_url,
					},
					type: "POST",
					success: function(data) {

						$(".rdtheme-archive-products").fadeOut('medium', function(){
						$(this).html(data).fadeIn('medium', function(){

							var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
							$('.woocommerce-result-count').replaceWith(updated_statistics_text);
							$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');

						});

						$(document).trigger('rt_filter_ajax_load');
					});

					},

					error: function(MLHttpRequest, textStatus, errorThrown){
						console.log(errorThrown);
					}
				});

			});

		});
		
		// Order by filter
		$('.woocommerce-ordering').off().on('change', function(e){
			var ordering = $(e.target).val();
			var query_url = new URL(window.location.href);
			query_url.searchParams.set('orderby', ordering);
			query_url.href = query_url.href.replace( new RegExp("/(page\/[0-9]*)\//", "ms") , '');
			window.history.pushState('page-id', 'Ajax Load', query_url.href);
			loader();
			$.ajax({
				url: MetroObj.ajaxurl,
				type: "POST",
				data: {
					action: 'load_template',
					template: 'archive',
					part: 'product',
					query_url: query_url.href,
				},
				success: function(data) {

					$(".rdtheme-archive-products").fadeOut('medium', function(){
						$(this).html(data).fadeIn('medium', function(){

							var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
							$('.woocommerce-result-count').replaceWith(updated_statistics_text);
							$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');

						});



						$(document).trigger('rt_filter_ajax_load');
					});

				},

				error: function(MLHttpRequest, textStatus, errorThrown){
					console.log(errorThrown);
				}
			});
	
		})

	});

	$(document).on('rt_regenerated_filter_tag', function(){

		var active_filter_wrapper = $('.top-widget-active-filter-wrapper');

		if( $('.attribute-wrapper').length > 0){

			var attribute_wrapper = $('.attribute-wrapper.clear').length > 0 
				? $('.attribute-wrapper.clear') 
				: $("<div class='attribute-wrapper clear'> <h5> Clear all </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");

			attribute_wrapper.appendTo(active_filter_wrapper);
			attribute_wrapper.find('.remove-filter').attr('data-clear', true);
		}

	});
})(jQuery);

// Wish List
(function($){$(document).ready(function(){

	// Added to wish list
	$('body').on('rt_added_to_wishlist', function(e, product_id){

		$('.wishlist-icon-num').html( Number.parseInt($('.wishlist-icon-num').html()) + 1 );
		
	});

	// Removed from wish list
	$('body').on('rt_removed_from_wishlist', function(e, product_id){

		$('.wishlist-icon-num').html( Number.parseInt($('.wishlist-icon-num').html()) - 1 );

	});

})})(jQuery);

// Pagination
(function($){$(document).on('ready, rt_filter_ajax_load', function(){
  
	$('.ajax-pagination-area .page-numbers:not(.current)').off().click(function(){
	  
		var href = new URL($(this).attr('href'));
		var paged = href.searchParams.get('paged');
		var paged_string = 'page/' + paged + '/';
		
		var url = new URL(window.location.href);
		
		if(url.pathname.includes('page')){
			
			url.href = url.href.replace( new RegExp("/(page\/[0-9]*)\//", "ms") , paged_string);
			
		} else {
			
			url.href = url.origin + url.pathname + paged_string + url.search; 
		
		}
		
		window.history.pushState('Paged', 'Ajax Load', url.href);
		
		loader();

		$.ajax({
			url: MetroObj.ajaxurl,
			type: "POST",
			data: {
				action: 'load_template',
				template: 'archive',
				part: 'product',
				query_url: url.href,
			},
			success: function(data) {

				$(".rdtheme-archive-products").fadeOut('medium', function(){
					$(this).html(data).fadeIn('medium', function(){

						var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
						
						$('.woocommerce-result-count').replaceWith(updated_statistics_text);
						$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');

					});

					$(document).trigger('rt_filter_ajax_load');
				});

			},

			error: function(MLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown);
			}
		});

	  return false;
	});
	
 })})(jQuery);


// Init Pagination Loader
(function($){$(document).on('ready', function(){

	if(MetroObj.product_filter == 'ajax'){

		if( MetroObj.pagination == 'numbered' ){

			$('.pagination-area').hide();

		}

		var query_url = window.location.href;


			$.ajax({
			url: MetroObj.ajaxurl,
			data: {
				action: 'load_template',
				template: 'archive',
				part: 'product',
				query_url: query_url,
			},
			type: "POST",
			success: function(data) {

				$(".rdtheme-archive-products").fadeOut('medium', function(){
					$(this).html(data).fadeIn('medium', function(){

						var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
						$('.woocommerce-result-count').replaceWith(updated_statistics_text);
						$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');

					});
					$(document).trigger('rt_filter_ajax_load');
				});

			},

			error: function(MLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown);
			}
		});

	}

})})(jQuery)

$(window.mt_search_callback);

// After filter ajax load
$(document).on('rt_filter_ajax_load', function(){
	
	// Load More
	var loadMore = $('.rdtheme-loadmore-data');
	var loadMoreMeta = $('.load-more-meta-data');
	var button = $('.rdtheme-loadmore-btn-area');
	loadMore.attr('data-paged', loadMoreMeta.attr('data-paged') );
	loadMore.attr('data-max', loadMoreMeta.attr('data-max') );

	if( Number.parseInt( loadMore.attr('data-max') ) == Number.parseInt( loadMore.attr('data-paged') )  ){
		
		button.hide();			

	} else {

		button.find('.rdtheme-loadmore-btn-icon').hide();
		button.find('.rdtheme-loadmore-btn-text').show();
		button.find('.rdtheme-loadmore-btn').removeAttr('disabled');
		button.show();
	
	}

});

$(function(){
	$(document).on('rt_filter_ajax_load', function(){
		$('.variations_form').each(function () {
            $(this).wc_variation_form();
        });
	});
    $(document).on('afterLoadMore', function(){
	    $('.variations_form').each(function () {
            $(this).wc_variation_form();
        });
    });
})