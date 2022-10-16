let WooCommerce =  {

	/* Single Product-2 relocate meta */
	meta_reloation : () => {
		$('.product-type-variable .single-product-top-2 .product_meta-area-js, .product-type-variable .single-product-top-3 .product_meta-area-js').insertAfter('form.variations_form table.variations');
	},

	
	sticky_product_thumbnail_prices : () => {
 		var priceselector = '.product p.price';
        var originalprice = $(priceselector).html();
        $( document ).on('show_variation', function() {
          $(priceselector).html($('.single_variation .woocommerce-variation-price').html());
        });
        $( document ).on('hide_variation', function() {
          $(priceselector).html(originalprice);
        });
	},



	/* Sticky product thumbnail */
	sticky_product_thumbnail : () => {
		if (typeof $.fn.stickySidebar == 'function') {

			let screenWidth = $('body').outerWidth();

			if ( screenWidth > 991 ) {
				let top = 20;
				if ( MetroObj.hasStickyMenu == 1 ) {
					top += $('.main-header-sticky-wrapper').outerHeight();
				}
				if ( MetroObj.hasAdminBar == 1 ) {
					top += $('#wpadminbar').outerHeight();
				}

				$('.single-product-top-2 .rtin-left > div').stickySidebar({
					topSpacing: top
				});	
			}
		}
	},	

	/* Quantity change */
	quantity_change : () => {
		$(document).on('click', '.quantity .input-group-btn .quantity-btn',function(){
			var $input = $(this).closest('.quantity').find('.input-text');

			if ( $(this).hasClass('quantity-plus') ) {
				$input.trigger('stepUp').trigger('change');
			}

			if ( $(this).hasClass('quantity-minus') ) {
				$input.trigger('stepDown').trigger('change');
			}
		});
	},

	/* Product slider navigation height */
	slider_nav : () => {
		$('.rt-el-product-slider').each(function() {
			var $target = $(this).find('.owl-custom-nav .owl-nav button.owl-prev, .owl-custom-nav .owl-nav button.owl-next'),
			$img = $(this).find('.rtin-thumb-wrapper').first();

			if ($img.length) {
				var height = $img.outerHeight();
				height = height/2 - 24;
				$target.css('top', height + 'px');
			}
		});
	},

	dokan_my_order_responsive_table : () => {
		$('.shop_table.my_account_orders').wrap( "<div class='table-responsive'></div>" );	
	},

	/* Wishlist icon */
	wishlist_icon : () => {
		$(document).on('click', '.rdtheme-wishlist-icon',function(){
			if ( $(this).hasClass('rdtheme-add-to-wishlist')) {

				var $obj   = $(this),
				productId  = $obj.data('product-id'),
				afterTitle = $obj.data('title-after');

				var data = {
					'action'          : 'metro_add_to_wishlist',
					'context'         : 'frontend',
					'nonce'           : $obj.data('nonce'),
					'add_to_wishlist' : productId,
				};

				$.ajax({
					url : MetroObj.ajaxurl,
					type : 'POST',
					data : data,
					beforeSend : function () {
						$obj.find('.wishlist-icon').hide();
						$obj.find('.ajax-loading').show();
						$obj.addClass('rdtheme-wishlist-ajaxloading');
					},
					success : function( data ){
						if ( data['result'] != 'error' ) {
							$obj.find('.ajax-loading').hide();
							$obj.removeClass('rdtheme-wishlist-ajaxloading');
							$obj.find('.wishlist-icon').removeClass('fa-heart-o').addClass('fa-heart').show();
							$obj.removeClass('rdtheme-add-to-wishlist').addClass('rdtheme-remove-from-wishlist');
							$obj.attr('title', afterTitle);
							$('body').trigger('rt_added_to_wishlist', [productId]);
						}
						else {
							console.log(data['message']);
						}
					}
				});

				return false;
			} else if( $(this).hasClass('rdtheme-remove-from-wishlist') ){

				var $obj = $(this),
					productId = $obj.data('product-id'),
					afterTitle = $obj.data('title-after');
				var data = {
					'action': 'metro_remove_from_wishlist',
					'context': 'frontend',
					'nonce': $obj.data('nonce'),
					'remove_from_wishlist': productId
				};
				$.ajax({
					url: MetroObj.ajaxurl,
					type: 'POST',
					data: data,
					beforeSend: function beforeSend() {
						$obj.find('.wishlist-icon').hide();
						$obj.find('.ajax-loading').show();
						$obj.addClass('rdtheme-wishlist-ajaxloading');
					},
					success: function success(data) {
						if (data['result'] != 'error') {
							$obj.find('.ajax-loading').hide();
							$obj.removeClass('rdtheme-wishlist-ajaxloading');
							$obj.find('.wishlist-icon').removeClass('fa-heart').addClass('fa-heart-o').show();
							$obj.removeClass('rdtheme-remove-from-wishlist').addClass('rdtheme-add-to-wishlist');
							$obj.attr('title', 'Add to wishlist');

							$('body').trigger('rt_removed_from_wishlist', [productId]);
						} else {
							console.log(data['message']);
						}
					}
				});
				return false;
			}
		});
	}
}

export default WooCommerce;