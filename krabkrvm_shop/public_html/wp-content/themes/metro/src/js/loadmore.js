function loadmore_n_infinityscroll(){
	
	var loadMoreWrapper   = $('.rdtheme-loadmore-wrapper'),
	infinityScrollWrapper = $('.rdtheme-infscroll-wrapper');

	if (loadMoreWrapper.length) {
		loadMore(loadMoreWrapper);
	}

	if (infinityScrollWrapper.length) {
		infinityScroll(infinityScrollWrapper);
	}


	function loadMore($wrapper) {
		var button = $('.rdtheme-loadmore-btn'),
			shopData = $('.rdtheme-loadmore-data');
		
		button.on('click', button, function() {

			var	maxPage = Number.parseInt( shopData.attr('data-max') ),
				query = shopData.attr('data-query'),
				CurrentPage = Number.parseInt(shopData.attr('data-paged')),
				order_by = $(".woocommerce-ordering .orderby").find(':selected').val();

			var data = {
				'action': 'rdtheme_loadmore',
				'context': 'frontend',
				'nonce': shopData.data('nonce'),
				'query': query,
				'view': $('body').hasClass('product-list-view') ? 'list' : 'grid',
				'paged': CurrentPage,
				'filter_query_url': window.location.href,
				'order':order_by
			};

			$.ajax({
				url: MetroObj.ajaxurl,
				type: 'POST',
				data: data,
				beforeSend: function beforeSend() {
					disableBtn(button);
				},
				success: function success(data) {
					if (data) {
						CurrentPage++;
						shopData.attr('data-paged', CurrentPage);
						$wrapper.append(data);
						WcUpdateResultCount($wrapper);
						
						if ( Number.parseInt( shopData.attr('data-max') ) == Number.parseInt( shopData.attr('data-paged') )  ) {
							removeBtn(button);
						} else {
							button.show();
							enableBtn(button);
						}

						$(document).trigger("afterLoadMore");
					} else {
						removeBtn(button);
					}
				}
			});
		return false;
	});
	}

	function infinityScroll($wrapper) {
		var canBeLoaded   = true,
		shopData          = $('.rdtheme-loadmore-data'),
		icon              = $('.rdtheme-infscroll-icon'),
		query             = shopData.attr('data-query'),
		CurrentPage       = 1;

		$(window).on('scroll load', function () {
			if (!canBeLoaded) {
				return;
			}

			var data = {
				'action'  : 'rdtheme_loadmore',
				'context' : 'frontend',
				'nonce'   : shopData.data('nonce'),
				'query'   : query,
				'paged'   : CurrentPage
			};

			if( isScrollable($wrapper) ){
				$.ajax({
					url  : MetroObj.ajaxurl,
					type : 'POST',
					data : data,
					beforeSend: function(){
						canBeLoaded = false;
						icon.show();
					},
					success:function(data){
						if( data ) {
							CurrentPage++;
							canBeLoaded = true;
							$wrapper.append(data);
							WcUpdateResultCount($wrapper);
							icon.hide();
							$(document).trigger("afterInfinityScroll");
						}
						else {
							icon.remove();
						}
					}
				});
			}
		});
	}

	function isScrollable($wrapper) {
		var ajaxVisible = $wrapper.offset().top + $wrapper.outerHeight(true),
		ajaxScrollTop = $(window).scrollTop() + $(window).height();
		if (ajaxVisible <= (ajaxScrollTop) && (ajaxVisible + $(window).height()) > ajaxScrollTop) {
			return true;
		}
		return false;
	}

	function WcUpdateResultCount($wrapper){
		var count = $($wrapper).find('.product').length;
		$('.wc-last-result-count').text(count);
	}

	function disableBtn(button) {
		button.attr('disabled', 'disabled');
		button.find('.rdtheme-loadmore-btn-text').hide();
		button.find('.rdtheme-loadmore-btn-icon').show();
	}

	function enableBtn(button) {
		button.find('.rdtheme-loadmore-btn-icon').hide();
		button.find('.rdtheme-loadmore-btn-text').show();
		button.removeAttr('disabled');
	}

	function removeBtn(button) {
		button.parent('.rdtheme-loadmore-btn-area').hide();
	}
}

export default loadmore_n_infinityscroll;