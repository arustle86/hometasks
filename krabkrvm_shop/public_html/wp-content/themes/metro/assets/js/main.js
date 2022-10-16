(function() {
	'use strict';

	var $ = jQuery;

	$.event.special.touchstart = {
		setup: function setup(_, ns, handle) {
			this.addEventListener("touchstart", handle, {
				passive: !ns.includes("noPreventDefault")
			});
		}
	};
	$.event.special.touchmove = {
		setup: function setup(_, ns, handle) {
			this.addEventListener("touchmove", handle, {
				passive: !ns.includes("noPreventDefault")
			});
		}
	};

	var ThemeHelper = {
		querySelector: function querySelector(selector, callback) {
			var el = document.querySelectorAll(selector);

			if (el.length) {
				callback(el);
			}
		},
		run_closeMenuAreaLayout: function run_closeMenuAreaLayout() {
			var menuArea = $('.additional-menu-area');
			var trigger = $('.side-menu-trigger', menuArea);
			trigger.removeClass('side-menu-close').addClass('side-menu-open');

			if (menuArea.find('> .rt-cover').length) {
				menuArea.find('> .rt-cover').remove();
			}

			$('.sidenav').css('transform', 'translateX(-100%)');
		},
		run_closeSideMenu: function run_closeSideMenu() {
			var wrapper = $('body').find('>#page'),
				$this = $('#side-menu-trigger a.menu-times');
			wrapper.removeClass('open').find('.offcanvas-mask').remove();
			$("#offcanvas-body-wrapper").attr('style', '');
			$this.prev('.menu-bar').removeClass('open');
			$this.addClass('close');
		},
		run_sticky_menu: function run_sticky_menu() {
			var wrapperHtml = $('<div class="main-header-sticky-wrapper"></div>');
			var wrapperClass = '.main-header-sticky-wrapper';
			$('.main-header').clone(true, true).appendTo(wrapperHtml);
			$('#page').append(wrapperHtml);
			var height = $(wrapperClass).outerHeight() + 30;
			$(wrapperClass).css('margin-top', '-' + height + 'px');
			$(window).scroll(function() {
				if ($(this).scrollTop() > 300) {
					$('body').addClass('rdthemeSticky');
				} else {
					$('body').removeClass('rdthemeSticky');
				}
			});
		},
		run_sticky_meanmenu: function run_sticky_meanmenu() {
			$(window).scroll(function() {
				if ($(this).scrollTop() > 50) {
					$('body').addClass("mean-stick");
				} else {
					$('body').removeClass("mean-stick");
				}
			});
		},
		run_isotope: function run_isotope($container, filter) {
			$container.isotope({
				filter: filter,
				layoutMode: 'fitRows',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: true
				}
			});
		},
		add_vertical_menu_class: function add_vertical_menu_class() {
			var screenWidth = $('body').outerWidth();

			if (screenWidth < 992) {
				$('.vertical-menu').addClass('vertical-menu-mobile');
			} else {
				$('.vertical-menu').removeClass('vertical-menu-mobile');
			}
		},
		owl_change_num_pagination: function owl_change_num_pagination($owlParent, index) {
			$owlParent.find('.owl-numbered-dots-items span').removeClass('active');
		}
	};
	var theme = {
		rt_toggle: function rt_toggle() {
			$(document).on('mouseover', '.trending-sign', function() {
				var self = $(this),
					tips = self.attr('data-tips');
				$tooltip = '<div class="fox-tooltip">' + '<div class="fox-tooltip-content">' + tips + '</div>' + '<div class="fox-tooltip-bottom"></div>' + '</div>';
				$('body').append($tooltip);
				var $tooltip = $('body > .fox-tooltip');
				var tHeight = $tooltip.outerHeight();
				var tBottomHeight = $tooltip.find('.fox-tooltip-bottom').outerHeight();
				var tWidth = $tooltip.outerWidth();
				var tHolderWidth = self.outerWidth();
				var top = self.offset().top - (tHeight + tBottomHeight);
				var left = self.offset().left;
				$tooltip.css({
					'top': top + 'px',
					'left': left + 'px',
					'opacity': 1
				}).show();

				if (tWidth <= tHolderWidth) {
					var itemLeft = (tHolderWidth - tWidth) / 2;
					left = left + itemLeft;
					$tooltip.css('left', left + 'px');
				} else {
					var itemLeft = (tWidth - tHolderWidth) / 2;
					left = left - itemLeft;

					if (left < 0) {
						left = 0;
					}

					$tooltip.css('left', left + 'px');
				}
			}).on('mouseout', '.trending-sign', function() {
				$('body > .fox-tooltip').remove();
			});
		},
		rt_offcanvas_menu: function rt_offcanvas_menu() {
			$('#page').on('click', '.offcanvas-menu-btn', function(e) {
				e.preventDefault();
				var $this = $(this),
					wrapper = $(this).parents('body').find('>#page'),
					wrapMask = $('<div />').addClass('offcanvas-mask'),
					offCancas = document.getElementById('offcanvas-body-wrap');

				if ($this.hasClass('menu-status-open')) {
					wrapper.addClass('open').append(wrapMask);
					$this.removeClass('menu-status-open').addClass('menu-status-close');
					offCancas.style.transform = 'translateX(' + 0 + 'px)';
					$('body').css({
						overflow: 'hidden',
						transition: 'all 0.3s ease-out'
					});
				} else {
					wrapper.removeClass('open').find('> .offcanvas-mask').remove();
					$this.removeClass('menu-status-close').addClass('menu-status-open');
					offCancas.style.transform = 'translateX(' + -100 + '%)';

					if (MetroObj.rtl == 'yes') {
						offCancas.style.transform = 'translateX(' + 100 + '%)';
					}

					$('body').css({
						overflow: 'visible',
						transition: 'all 0.3s ease-out'
					});
				}

				return false;
			});
			$('#page').on('click', '#side-menu-trigger a.menu-times', function(e) {
				e.preventDefault();
				var $this = $(this);
				$("#offcanvas-body-wrapper").attr('style', '');
				$this.prev('.menu-bar').removeClass('open');
				$this.addClass('close');
				ThemeHelper.run_closeSideMenu();
				return false;
			});

			$(document).on('click', '#page.open .offcanvas-mask', function() {
				ThemeHelper.run_closeSideMenu();
			});
			$(document).on('keyup', function(event) {
				if (event.which === 27) {
					event.preventDefault();
					ThemeHelper.run_closeSideMenu();
				}
			});
		},
		rt_offcanvas_menu_layout: function rt_offcanvas_menu_layout() {
			var menuArea = $('.additional-menu-area');
			menuArea.on('click', '.side-menu-trigger', function(e) {
				e.preventDefault();
				var self = $(this);

				if (self.hasClass('side-menu-open')) {
					$('.sidenav').css('transform', 'translateX(0%)');

					if (!menuArea.find('> .rt-cover').length) {
						menuArea.append("<div class='rt-cover'></div>");
					}

					self.removeClass('side-menu-open').addClass('side-menu-close');
				}
			});
			menuArea.on('click', '.closebtn', function(e) {
				e.preventDefault();
				ThemeHelper.run_closeMenuAreaLayout();
			});
			$(document).on('click', '.rt-cover', function() {
				ThemeHelper.run_closeMenuAreaLayout();
			});
		},
		scroll_to_top: function scroll_to_top() {
			$('.scrollToTop').on('click', function() {
				$('html, body').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
			$(window).scroll(function() {
				if ($(window).scrollTop() > 300) {
					$('.scrollToTop').addClass('back-top');
				} else {
					$('.scrollToTop').removeClass('back-top');
				}
			});
		},
		metro_sal: function metro_sal() {
			sal({
				threshold: 0.4,
				once: true
			});

			if ($(window).outerWidth() < 1025) {
				var scrollAnimations = sal();
				scrollAnimations.disable();
			}
		},
		preloader: function preloader() {
			$('#preloader').fadeOut('slow', function() {
				$(this).remove();
			});
		},
		sticky_menu: function sticky_menu() {
			if (MetroObj.hasStickyMenu == 1) {
				ThemeHelper.run_sticky_menu();
				ThemeHelper.run_sticky_meanmenu();
			}
		},
		ripple_effect: function ripple_effect() {
			if (typeof $.fn.ripples == 'function') {
				$('.rt-water-ripple').ripples({
					resolution: 712,
					dropRadius: 30,
					perturbance: 0.01
				});
			}
		},
		category_search_dropdown: function category_search_dropdown() {
			$('.category-search-dropdown-js .dropdown-menu li').on('click', function(e) {
				var $parent = $(this).closest('.category-search-dropdown-js'),
					slug = $(this).data('slug'),
					name = $(this).text();
				$parent.find('.dropdown-toggle').text($.trim(name));
				$parent.find('input[name="product_cat"]').val(slug);
			});

			if ($.fn.autocomplete) {
				$(".ps-autocomplete-js .product-autocomplete-js").autocomplete({
					minChars: 2,
					search: function search(event, ui) {
						if (!$(event.target).parent().find('.product-autocomplete-spinner').length) {
							$('<i class="product-autoaomplete-spinner fa fa-spinner fa-spin"></i>').insertAfter(event.target);
						}
					},
					source: function source(req, response) {
						req.action = 'metro_product_search_autocomplete';
						$.ajax({
							dataType: "json",
							type: "POST",
							url: MetroObj.ajaxurl,
							data: req,
							success: function success(data) {
								response(data);
							}
						});
					},
					response: function response(event, ui) {
						$(event.target).parent().find('.product-autoaomplete-spinner').remove();
					}
				});
			}
		},
		search_popup: function search_popup() {
			$('.search-icon-area a').on("click", function(event) {
				event.preventDefault();
				$("#rdtheme-search-popup").addClass("open");
				$('#rdtheme-search-popup > form > input').focus();
			});
			$("#rdtheme-search-popup, #rdtheme-search-popup button.close").on("click keyup", function(event) {
				if (event.target == this || event.target.className == "close" || event.keyCode == 27) {
					$(this).removeClass("open");
				}
			});
		},
		vertical_menu: function vertical_menu() {
			$('.vertical-menu-btn').on('click', function(e) {
				e.preventDefault();
				$(this).closest('.vertical-menu-area').toggleClass("opened");
			});
		},
		vertical_menu_mobile: function vertical_menu_mobile() {
			ThemeHelper.add_vertical_menu_class();
			$(window).on('resize', function() {
				ThemeHelper.add_vertical_menu_class();
			});
			$('.vertical-menu').on('click', 'li.menu-item-has-children span.has-dropdown', function(e) {
				if ($(this).find('+ ul.sub-menu').length) {
					$(this).closest('li').toggleClass('submenu-opend');
					$(this).find('+ ul.sub-menu').slideToggle();
				}

				return false;
			});
		},
		mobile_menu: function mobile_menu() {
			$('#site-header .main-navigation nav').meanmenu({
				meanMenuContainer: '#meanmenu',
				meanScreenWidth: MetroObj.meanWidth,
				removeElements: "#site-header, .top-header-desktop",
				siteLogo: MetroObj.siteLogo,
				meanExpand: '<i class="flaticon-plus-symbol"></i>',
				meanContract: '<i class="flaticon-substract"></i>',
				meanMenuClose: '<i class="flaticon-unchecked"></i>',
				appendHtml: MetroObj.appendHtml
			});
		},
		mobile_menu_max_height: function mobile_menu_max_height() {
			var wHeight = $(window).height();
			wHeight = wHeight - 50;
			$('.mean-nav > ul').css('max-height', wHeight + 'px');
		},
		multi_column_menu: function multi_column_menu() {
			$('.main-navigation ul > li.mega-menu').each(function() {
				var items = $(this).find(' > ul.sub-menu > li').length;
				var bodyWidth = $('body').outerWidth();
				var parentLinkWidth = $(this).find(' > a').outerWidth();
				var parentLinkpos = $(this).find(' > a').offset().left;
				var width = items * 250;
				var left = width / 2 - parentLinkWidth / 2;
				var linkleftWidth = parentLinkpos + parentLinkWidth / 2;
				var linkRightWidth = bodyWidth - (parentLinkpos + parentLinkWidth);

				if (width / 2 > linkleftWidth) {
					$(this).find(' > ul.sub-menu').css({
						width: width + 'px',
						right: 'inherit',
						left: '-' + parentLinkpos + 'px'
					});
				} else if (width / 2 > linkRightWidth) {
					$(this).find(' > ul.sub-menu').css({
						width: width + 'px',
						left: 'inherit',
						right: '-' + linkRightWidth + 'px'
					});
				} else {
					$(this).find(' > ul.sub-menu').css({
						width: width + 'px',
						left: '-' + left + 'px'
					});
				}
			});
		},
		isotope: function isotope() {
			if (typeof $.fn.isotope == 'function' && typeof $.fn.imagesLoaded == 'function') {
				var $blogIsotopeContainer = $('.post-isotope');
				$blogIsotopeContainer.imagesLoaded(function() {
					$blogIsotopeContainer.isotope();
				});
				var $isotopeContainer = $('.rt-el-isotope-container');
				$isotopeContainer.imagesLoaded(function() {
					$isotopeContainer.each(function() {
						var $container = $(this).find('.rt-el-isotope-wrapper'),
							filter = $(this).find('.rt-el-isotope-tab a.current').data('filter');
						ThemeHelper.run_isotope($container, filter);
					});
				});
				$('.rt-el-isotope-tab a').on('click', function() {
					$(this).closest('.rt-el-isotope-tab').find('.current').removeClass('current');
					$(this).addClass('current');
					var $container = $(this).closest('.rt-el-isotope-container').find('.rt-el-isotope-wrapper'),
						filter = $(this).attr('data-filter');
					ThemeHelper.run_isotope($container, filter);
					return false;
				});
			}
		},
		slick_carousel: function slick_carousel() {
			if (typeof $.fn.slick == 'function') {
				$(".rt-slick-slider").each(function() {
					$(this).slick({
						rtl: MetroObj.rtl
					});
				});
				$(document).on('afterLoadMore afterInfinityScroll', function() {
					$(".product_loaded .rt-slick-slider").each(function() {
						$(this).slick({
							rtl: MetroObj.rtl
						});
					});
					$(".product_loaded").removeClass('product_loaded');
				});
			}
		},
		slick_banner_slider: function slick_banner_slider() {
			if (typeof $.fn.slick == 'function') {
				var pageinfo = $('.paginginfo');
				var slickelement = $('.slick-slider');
				$(".slick-slider").on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
					var i = (currentSlide ? currentSlide : 0) + 1;
					pageinfo.text(i + '/' + slick.slideCount);
				});
				slickelement.slick({
					prevArrow: $('#slick-prev'),
					nextArrow: $('#slick-next')
				});
			}
		},
		owl_carousel: function owl_carousel() {
			if (typeof $.fn.owlCarousel == 'function') {
				$(".owl-custom-nav .owl-next").on('click', function() {
					$(this).closest('.owl-wrap').find('.owl-carousel').trigger('next.owl.carousel');
				});
				$(".owl-custom-nav .owl-prev").on('click', function() {
					$(this).closest('.owl-wrap').find('.owl-carousel').trigger('prev.owl.carousel');
				});
				$(".rt-owl-carousel").each(function() {
					var options = $(this).data('carousel-options');

					if (MetroObj.rtl == 'yes') {
						options['rtl'] = true;
						options['navText'] = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];
					}

					$(this).owlCarousel(options);
				});
				$(".owl-numbered-dots .owl-numbered-dots-items span").on('click', function() {
					var index = $(this).data('num');
					var $owlParent = $(this).closest('.owl-wrap').find('.owl-carousel');
					$owlParent.trigger('to.owl.carousel', index);
					$owlParent.find('.owl-numbered-dots-items span').removeClass('active');
					$owlParent.find('.owl-numbered-dots-items [data-num="' + index + '"]').addClass('active');
				});
			}
		},
		countdown: function countdown() {
			if (typeof $.fn.countdown == 'function') {
				try {
					var day = MetroObj.day == 'Day' ? 'Day%!D' : MetroObj.day,
						hour = MetroObj.hour == 'Hour' ? 'Hour%!D' : MetroObj.hour,
						minute = MetroObj.minute == 'Minute' ? 'Minute%!D' : MetroObj.minute,
						second = MetroObj.second == 'Second' ? 'Second%!D' : MetroObj.second;
					$('.rtjs-coutdown').each(function() {
						var $CountdownSelector = $(this).find('.rtjs-date');
						var eventCountdownTime = $CountdownSelector.data('time');
						$CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function(event) {
							$(this).html(event.strftime('' + '<div class="rt-countdown-section"><div class="rtin-count">%D</div><div class="rtin-text">' + day + '</div></div>' + '<div class="rt-countdown-section"><div class="rtin-count">%H</div><div class="rtin-text">' + hour + '</div></div>' + '<div class="rt-countdown-section"><div class="rtin-count">%M</div><div class="rtin-text">' + minute + '</div></div>' + '<div class="rt-countdown-section"><div class="rtin-count">%S</div><div class="rtin-text">' + second + '</div></div>'));
						}).on('finish.countdown', function(event) {
							$(this).html(event.strftime(''));
						});
					});
					$('.rtjs-coutdown-2').each(function() {
						var $CountdownSelector = $(this).find('.rtjs-date');
						var eventCountdownTime = $CountdownSelector.data('time');
						$CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function(event) {
							$(this).html(event.strftime('' + '<div class="rt-countdown-section-top">' + '<div class="rt-countdown-section"><div class="rt-countdown-section-inner"><div class="rtin-count">%D</div><div class="rtin-text">' + day + '</div></div></div>' + '<div class="rt-countdown-section ml10"><div class="rt-countdown-section-inner"><div class="rtin-count">%H</div><div class="rtin-text">' + hour + '</div></div></div>' + '</div><div class="rt-countdown-section-bottom">' + '<div class="rt-countdown-section"><div class="rt-countdown-section-inner"><div class="rtin-count">%M</div><div class="rtin-text">' + minute + '</div></div></div>' + '<div class="rt-countdown-section ml10"><div class="rt-countdown-section-inner"><div class="rtin-count">%S</div><div class="rtin-text">' + second + '</div></div></div></div>'));
						}).on('finish.countdown', function(event) {
							$(this).html(event.strftime(''));
						});
					});
				} catch (err) {
					console.log('Countdown : ' + err.message);
				}
			}
		},
		magnific_popup: function magnific_popup() {
			if (typeof $.fn.magnificPopup == 'function') {
				$('.rt-video-popup').magnificPopup({
					disableOn: 700,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});
			}
		}
	};

	var WooCommerce = {
		meta_reloation: function meta_reloation() {
			$('.product-type-variable .single-product-top-2 .product_meta-area-js, .product-type-variable .single-product-top-3 .product_meta-area-js').insertAfter('form.variations_form table.variations');
		},
		sticky_product_thumbnail_prices: function sticky_product_thumbnail_prices() {
			var priceselector = '.product p.price';
			var originalprice = $(priceselector).html();
			$(document).on('show_variation', function() {
				$(priceselector).html($('.single_variation .woocommerce-variation-price').html());
			});
			$(document).on('hide_variation', function() {
				$(priceselector).html(originalprice);
			});
		},
		sticky_product_thumbnail: function sticky_product_thumbnail() {
			if (typeof $.fn.stickySidebar == 'function') {
				var screenWidth = $('body').outerWidth();

				if (screenWidth > 991) {
					var top = 20;

					if (MetroObj.hasStickyMenu == 1) {
						top += $('.main-header-sticky-wrapper').outerHeight();
					}

					if (MetroObj.hasAdminBar == 1) {
						top += $('#wpadminbar').outerHeight();
					}

					$('.single-product-top-2 .rtin-left > div').stickySidebar({
						topSpacing: top
					});
				}
			}
		},
		quantity_change: function quantity_change() {
			$(document).on('click', '.quantity .input-group-btn .quantity-btn', function() {
				var $input = $(this).closest('.quantity').find('.input-text');

				if ($(this).hasClass('quantity-plus')) {
					$input.trigger('stepUp').trigger('change');
				}

				if ($(this).hasClass('quantity-minus')) {
					$input.trigger('stepDown').trigger('change');
				}
			});
		},
		slider_nav: function slider_nav() {
			$('.rt-el-product-slider').each(function() {
				var $target = $(this).find('.owl-custom-nav .owl-nav button.owl-prev, .owl-custom-nav .owl-nav button.owl-next'),
					$img = $(this).find('.rtin-thumb-wrapper').first();

				if ($img.length) {
					var height = $img.outerHeight();
					height = height / 2 - 24;
					$target.css('top', height + 'px');
				}
			});
		},
		dokan_my_order_responsive_table: function dokan_my_order_responsive_table() {
			$('.shop_table.my_account_orders').wrap("<div class='table-responsive'></div>");
		},
		wishlist_icon: function wishlist_icon() {
			$(document).on('click', '.rdtheme-wishlist-icon', function() {
				if ($(this).hasClass('rdtheme-add-to-wishlist')) {
					var $obj = $(this),
						productId = $obj.data('product-id'),
						afterTitle = $obj.data('title-after');
					var data = {
						'action': 'metro_add_to_wishlist',
						'context': 'frontend',
						'nonce': $obj.data('nonce'),
						'add_to_wishlist': productId
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
								$obj.find('.wishlist-icon').removeClass('fa-heart-o').addClass('fa-heart').show();
								$obj.removeClass('rdtheme-add-to-wishlist').addClass('rdtheme-remove-from-wishlist');
								$obj.attr('title', afterTitle);
								$('body').trigger('rt_added_to_wishlist', [productId]);
							} else {
								console.log(data['message']);
							}
						}
					});
					return false;
				} else if ($(this).hasClass('rdtheme-remove-from-wishlist')) {
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
	};

	function loadmore_n_infinityscroll() {
		var loadMoreWrapper = $('.rdtheme-loadmore-wrapper'),
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
				var maxPage = Number.parseInt(shopData.attr('data-max')),
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

							if (Number.parseInt(shopData.attr('data-max')) == Number.parseInt(shopData.attr('data-paged'))) {
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
			var canBeLoaded = true,
				shopData = $('.rdtheme-loadmore-data'),
				icon = $('.rdtheme-infscroll-icon'),
				query = shopData.attr('data-query'),
				CurrentPage = 1;
			$(window).on('scroll load', function() {
				if (!canBeLoaded) {
					return;
				}

				var data = {
					'action': 'rdtheme_loadmore',
					'context': 'frontend',
					'nonce': shopData.data('nonce'),
					'query': query,
					'paged': CurrentPage
				};

				if (isScrollable($wrapper)) {
					$.ajax({
						url: MetroObj.ajaxurl,
						type: 'POST',
						data: data,
						beforeSend: function beforeSend() {
							canBeLoaded = false;
							icon.show();
						},
						success: function success(data) {
							if (data) {
								CurrentPage++;
								canBeLoaded = true;
								$wrapper.append(data);
								WcUpdateResultCount($wrapper);
								icon.hide();
								$(document).trigger("afterInfinityScroll");
							} else {
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

			if (ajaxVisible <= ajaxScrollTop && ajaxVisible + $(window).height() > ajaxScrollTop) {
				return true;
			}

			return false;
		}

		function WcUpdateResultCount($wrapper) {
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

	function widthgen() {
		$(window).on('load resize', elementWidth);

		function elementWidth() {
			$('.elementwidth').each(function() {
				var $container = $(this),
					width = $container.outerWidth(),
					classes = $container.attr("class").split(' ');
				var classes1 = startWith(classes, 'elwidth');
				classes1 = classes1[0].split('-');
				classes1.splice(0, 1);
				var classes2 = startWith(classes, 'elmaxwidth');
				classes2.forEach(function(el) {
					$container.removeClass(el);
				});
				classes1.forEach(function(el) {
					var maxWidth = parseInt(el);

					if (width <= maxWidth) {
						$container.addClass('elmaxwidth-' + maxWidth);
					}
				});
			});
		}

		function startWith(item, stringName) {
			return $.grep(item, function(elem) {
				return elem.indexOf(stringName) == 0;
			});
		}
	}

	function _unsupportedIterableToArray(o, minLen) {
		if (!o) return;
		if (typeof o === "string") return _arrayLikeToArray(o, minLen);
		var n = Object.prototype.toString.call(o).slice(8, -1);
		if (n === "Object" && o.constructor) n = o.constructor.name;
		if (n === "Map" || n === "Set") return Array.from(o);
		if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
	}

	function _arrayLikeToArray(arr, len) {
		if (len == null || len > arr.length) len = arr.length;

		for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];

		return arr2;
	}

	function _createForOfIteratorHelper(o, allowArrayLike) {
		var it;

		if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {
			if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
				if (it) o = it;
				var i = 0;

				var F = function() {};

				return {
					s: F,
					n: function() {
						if (i >= o.length) return {
							done: true
						};
						return {
							done: false,
							value: o[i++]
						};
					},
					e: function(e) {
						throw e;
					},
					f: F
				};
			}

			throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
		}

		var normalCompletion = true,
			didErr = false,
			err;
		return {
			s: function() {
				it = o[Symbol.iterator]();
			},
			n: function() {
				var step = it.next();
				normalCompletion = step.done;
				return step;
			},
			e: function(e) {
				didErr = true;
				err = e;
			},
			f: function() {
				try {
					if (!normalCompletion && it.return != null) it.return();
				} finally {
					if (didErr) throw err;
				}
			}
		};
	}

	(function($) {
		$(document).ready(function() {
			if ($(window).width() < 991.99) {
				$('.woocommerce-top-bar-widget-wrapper').addClass('after-top-bar');
				$(document).on('rt_filter_ajax_load', function() {
					$('.woocommerce-top-bar-widget-wrapper').removeClass('show-drawer');
					$('.drawer-overlay').animate({
						opacity: 0
					}, 500, 'swing', function() {
						$('.drawer-overlay').css({
							'display': 'none'
						});
					});
				});
			} else {
				var parent_store = $('.woocommerce-top-bar-widget-wrapper');
				parent_store.find('.inner-wrapper').prepend("<div class='widget filter-by-text-wrapper'><h3 class=''>" + MetroObj.filter_text + ": </h3></div>");
				var prefix = 'wt-';
				var widgets = $('.woocommerce-top-bar-widget-wrapper .widget');
				widgets.each(function(index) {
					var title = $(this).find('.widgettitle');
					var data_element = title.next();
					var extra_wrapper_classes = $(this).attr('class').replace('widget', '');
					title.attr('target-id', prefix + index);
					title.addClass('click-title');
					data_element.attr('data-id', prefix + index);
					data_element.addClass($.trim(extra_wrapper_classes)).addClass('widget-data');
					data_element.appendTo('.widget-display-data').hide();
				});
				if (!$('.woocommerce-top-bar-widget-wrapper').length) return;
				var notice = $('.woocommerce-notices-wrapper');
				var widget = $('.woocommerce-top-bar-widget-wrapper');
				var shoptop = $('.woo-shop-top');
				var mega_wrapper = $("<div class='mega-wrapper'></div>");
				mega_wrapper.append(widget);
				mega_wrapper.append(shoptop);
				mega_wrapper.insertAfter(notice);
				var second_wrapper = $("<div class='.woocommerce-top-bar-widget-wrapper'></div>");
				$('.top-widget-active-filter-wrapper').appendTo(second_wrapper);
				$('.widget-display-data').appendTo(second_wrapper);
				second_wrapper.insertAfter(mega_wrapper);
				$('.woocommerce-top-bar-widget-wrapper .widget .widgettitle').on('click', function() {
					var id = $(this).attr('target-id');
					var target_element = $('[data-id=' + id + ']');
					var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');

					if (open_element.length > 0) {
						if (parent_store.attr('data-current') == target_element.attr('data-id')) {
							open_element.slideUp();
							parent_store.attr('data-current', false);
						} else {
							open_element.slideUp(function() {
								target_element.slideDown();
								parent_store.attr('data-current', target_element.attr('data-id'));
								parent_store.attr('data-current', false);
							});
						}
					} else {
						target_element.slideDown();
						parent_store.attr('data-current', target_element.attr('data-id'));
					}
				});
				$('.woocommerce-top-bar-widget-wrapper .cat-item a').each(function() {
					var regex = RegExp(MetroObj.product_category_base + ".*\/([A-Za-z0-9-_]*)\/$", "m");
					var matches, category_slug;

					if ((matches = regex.exec($(this).attr('href'))) !== null) {
						category_slug = matches[1];
					}

					$(this).parent().attr('data-slug', category_slug);
				});
			}
		});
		$(document).ready(function() {
			var context = {
				container: ".drawer-container",
				close: ".close",
				overlay: ".drawer-overlay"
			};
			$("".concat(context.container, " ").concat(context.close)).on('click', function(e) {
				rt_close_cart();
			});
			$(context.overlay).on('click', rt_close_cart);

			function rt_close_cart() {
				$(context.container).removeClass('show-sidebar');
				$('.close.filter-drawer').trigger('click');
				$(context.overlay).animate({
					opacity: 0
				}, 500, 'swing', function() {
					$(context.overlay).hide();
				});
			}

			function rt_open_side_cart() {
				$(context.container).addClass('show-sidebar');
				$(context.overlay).show('fast', function() {
					$(context.overlay).animate({
						opacity: 0.5
					}, 500, 'swing');
				});
				rt_get_side_cart_content();
			}

			function rt_get_side_cart_content() {
				$.ajax({
					url: MetroObj.ajaxurl,
					data: {
						action: 'load_template',
						template: 'cart/mini',
						part: 'cart'
					},
					type: "POST",
					success: function success(data) {
						$("#side-content-area-id").html(data);
					},
					error: function error(MLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
					}
				});
			}


			$('.cart-icon-area.offscreen').click(function(e) {
				e.preventDefault();
				rt_open_side_cart();
			});
	
			$(document).on('added_to_cart', function() {
				$('#yith-quick-view-close').trigger("click");
				rt_open_side_cart();
			});
			$(document).on('removed_from_cart', rt_get_side_cart_content);
			$('.mobile-filter-button').on('click', function() {
				$('.woocommerce-top-bar-widget-wrapper').addClass('show-drawer');
				$('.drawer-overlay').css({
					'display': 'block'
				}).animate({
					opacity: 0.5
				}, 500, 'swing');
			});
			$('.close.filter-drawer').on('click', function() {
				$('.woocommerce-top-bar-widget-wrapper').removeClass('show-drawer');
				$('.drawer-overlay').animate({
					opacity: 0
				}, 500, 'swing', function() {
					$('.drawer-overlay').css({
						'display': 'none'
					});
				});
			});
		});
	})(jQuery);

	(function($) {
		$(document).ready(function() {
			function loader() {
				var archive_container = $('.rdtheme-archive-products');
				archive_container.append("<div class='archive-product-overlay'></div><img class='ajax-loader-gif' src='".concat(MetroObj.ajax_loader_url, "'>"));
				var overlay = $('.archive-product-overlay');
				var loader = $('.ajax-loader-gif');
				var parent = overlay.parent();
				parent.css({
					"position": "relative"
				});
				overlay.width(parent.width());
				overlay.height(Math.max(parent.height(), 500));
				loader.css({
					"top": overlay.height() / 2 - loader.height() / 2,
					"left": overlay.width() / 2 - loader.width() / 2
				});
				overlay.show();
				loader.show();
			}

			window.loader = loader;
			if (MetroObj.product_filter != 'ajax') return;
			$('.price_slider_amount .button.button').hide();
			$("\n\t\t.widget .cat-item a, \n\t\t.widget .rtwpvs-term a,\n\t\t.widget-display-data .cat-item a, \n\t\t.widget-display-data .rtwpvs-term a \n\t\t").on('click', function(e) {
				e.preventDefault();
				var query_url = '';
				var active_filter_wrapper = $('.top-widget-active-filter-wrapper');
				var target = $(e.target);

				if ($(e.target).hasClass('rtwpvs-term-span')) {
					if (target.closest('[data-term]').hasClass('rtwpvs-color-term')) {
						$('.rtwpvs-color-term').removeClass('selected');
						var attribute_name = target.closest('[data-attribute_name]').attr('data-attribute_name');
						var term_name = target.closest('[data-term]').addClass('selected').attr('data-term');
						var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + target.closest('[data-id]').attr('data-id') + ']');
						header.addClass('selected');
						var attribute_wrapper = $('.attribute-wrapper.colour').length > 0 ? $('.attribute-wrapper.colour') : $("<div class='attribute-wrapper colour'> <h5> Color </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");
						attribute_wrapper.appendTo(active_filter_wrapper);
						attribute_wrapper.find('.filter-item-container').empty().append(target.parent().clone().css({
							'background-color': target.css('background-color')
						}));
						attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify([attribute_name.replace('attribute_pa', 'filter')])).attr('data-title-id', target.closest('[data-id]').attr('data-id'));
						$(document).trigger('rt_regenerated_filter_tag');
					} else if (target.closest('[data-term]').hasClass('rtwpvs-button-term')) {
						$('.rtwpvs-button-term').removeClass('selected');
						var attribute_name = target.closest('[data-attribute_name]').attr('data-attribute_name');
						var term_name = target.closest('[data-term]').addClass('selected').attr('data-term');
						var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + target.closest('[data-id]').attr('data-id') + ']');
						header.addClass('selected');
						var attribute_wrapper = $('.attribute-wrapper.size').length > 0 ? $('.attribute-wrapper.size') : $("<div class='attribute-wrapper size'> <h5> Size </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");
						attribute_wrapper.appendTo(active_filter_wrapper);
						attribute_wrapper.find('.filter-item-container').empty().append(target.parent().clone());
						attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify([attribute_name.replace('attribute_pa', 'filter')])).attr('data-title-id', target.closest('[data-id]').attr('data-id'));
						$(document).trigger('rt_regenerated_filter_tag');
					}

					attribute_name = attribute_name.replace('attribute_pa', 'filter');
					var full_url = new URL(window.location.href);
					full_url.searchParams.set(attribute_name, term_name);
					query_url = full_url.href;
					var parent_store = $('.woocommerce-top-bar-widget-wrapper');
					var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');
					open_element.slideUp();
					parent_store.attr('data-current', false);
				} else {
					var attribute_name = target.closest('[data-slug]').attr('data-slug');
					var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + target.closest('[data-id]').attr('data-id') + ']');
					header.addClass('selected');
					var attribute_wrapper = $('.attribute-wrapper.category').length > 0 ? $('.attribute-wrapper.category') : $("<div class='attribute-wrapper category'> <h5> Category </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");
					attribute_wrapper.appendTo(active_filter_wrapper);
					attribute_wrapper.find('.filter-item-container').empty().append(target.parent().clone());
					attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify([attribute_name])).attr('data-title-id', target.closest('[data-id]').attr('data-id'));
					$(document).trigger('rt_regenerated_filter_tag');
					var url = new URL(window.location.href);
					url.href = $(e.target).attr('href') + url.search;
					query_url = url.href;
					var parent_store = $('.woocommerce-top-bar-widget-wrapper');
					var open_element = $('[data-id=' + parent_store.attr('data-current') + ']');
					open_element.slideUp();
					parent_store.attr('data-current', false);
				}

				query_url = query_url.replace(new RegExp("/(page\/[0-9]*)\//", "ms"), '');
				window.history.pushState('page-id', 'Ajax Load', query_url);
				loader();
				$.ajax({
					url: MetroObj.ajaxurl,
					data: {
						action: 'load_template',
						template: 'archive',
						part: 'product',
						query_url: query_url
					},
					type: "POST",
					success: function success(data) {
						$(".rdtheme-archive-products").fadeOut('medium', function() {
							$(this).html(data).fadeIn('medium', function() {
								var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
								$('.woocommerce-result-count').replaceWith(updated_statistics_text);
								$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
							});
							$(document).trigger('rt_filter_ajax_load');
						});
					},
					error: function error(MLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
					}
				});
			});
			$(document.body).on('price_slider_create', function() {
				$(document.body).on('price_slider_change', function(event, min, max) {
					var active_filter_wrapper = $('.top-widget-active-filter-wrapper');
					var url = new URL(window.location.href);
					url.searchParams.set('min_price', min);
					url.searchParams.set('max_price', max);
					url.href = url.href.replace(new RegExp("/(page\/[0-9]*)\//", "ms"), '');
					window.history.pushState('page-id', 'Ajax Load', url);
					var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + $('.price_slider_wrapper').closest('[data-id]').attr('data-id') + ']');
					header.addClass('selected');
					var attribute_wrapper = $('.attribute-wrapper.price').length > 0 ? $('.attribute-wrapper.price') : $("<div class='attribute-wrapper price'> <h5> Price </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");
					attribute_wrapper.appendTo(active_filter_wrapper);
					attribute_wrapper.find('.filter-item-container').empty().append("".concat(woocommerce_price_slider_params.currency_format_symbol).concat(min, " - ").concat(woocommerce_price_slider_params.currency_format_symbol).concat(max));
					attribute_wrapper.find('.remove-filter').attr('data-param', JSON.stringify(['max_price', 'min_price'])).attr('data-title-id', $('.price_slider_wrapper').closest('[data-id]').attr('data-id'));
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
							query_url: url.href
						},
						success: function success(data) {
							$(".rdtheme-archive-products").fadeOut('medium', function() {
								$(this).html(data).fadeIn('medium', function() {
									var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
									$('.woocommerce-result-count').replaceWith(updated_statistics_text);
									$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
								});
								$(document).trigger('rt_filter_ajax_load');
							});
						},
						error: function error(MLHttpRequest, textStatus, errorThrown) {
							console.log(errorThrown);
						}
					});
				});
			});
			var known_params = ['filter_color', 'filter_size', 'min_price', 'max_price'];
			$(document).on('rt_regenerated_filter_tag', function() {
				$('.attribute-wrapper .remove-filter').off().on('click', function() {
					if ($(this).attr('data-param')) {
						var params = JSON.parse($(this).attr('data-param'));
						var url = new URL(window.location.href);

						for (I = 0; I < params.length; I++) {
							if (url.searchParams.get(params[I]) === null) {
								url.href = url.href.replace(new RegExp(MetroObj.product_category_base + ".*$", "i"), "") + url.search;
							} else {
								if (known_params.includes(params[I])) url.searchParams["delete"](params[I]);
							}
						}
					} else if ($(this).attr('data-clear')) {
						var url = new URL(window.location.href);
						url.href = url.href.replace(new RegExp(MetroObj.product_category_base + ".*$", "i"), "") + url.search;
						var search = new URLSearchParams(url.search);

						var _iterator = _createForOfIteratorHelper(search.keys()),
							_step;

						try {
							for (_iterator.s(); !(_step = _iterator.n()).done;) {
								var key = _step.value;
								if (known_params.includes(key)) url.searchParams["delete"](key);
							}
						} catch (err) {
							_iterator.e(err);
						} finally {
							_iterator.f();
						}

						$('.woocommerce-top-bar-widget-wrapper .widgettitle, \
						.woocommerce-top-bar-widget-wrapper .rtwpvs-term\
						').removeClass('selected');
						$('.top-widget-active-filter-wrapper .attribute-wrapper').each(function() {
							$(this).remove();
						});
					}

					var header = $('.woocommerce-top-bar-widget-wrapper').find('[target-id=' + $(this).attr('data-title-id') + ']');
					header.removeClass('selected');
					var query_url = url.href;
					query_url = query_url.replace(new RegExp("/(page\/[0-9]*)\//", "ms"), '');
					window.history.pushState('page-id', 'Ajax Load', query_url);
					$(this).closest('.attribute-wrapper').fadeOut('fast', function() {
						$(this).remove();

						if ($('.top-widget-active-filter-wrapper .attribute-wrapper:not(.clear)').length == 0) {
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
							query_url: query_url
						},
						type: "POST",
						success: function success(data) {
							$(".rdtheme-archive-products").fadeOut('medium', function() {
								$(this).html(data).fadeIn('medium', function() {
									var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
									$('.woocommerce-result-count').replaceWith(updated_statistics_text);
									$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
								});
								$(document).trigger('rt_filter_ajax_load');
							});
						},
						error: function error(MLHttpRequest, textStatus, errorThrown) {
							console.log(errorThrown);
						}
					});
				});
			});
			$('.woocommerce-ordering').off().on('change', function(e) {
				var ordering = $(e.target).val();
				var query_url = new URL(window.location.href);
				query_url.searchParams.set('orderby', ordering);
				query_url.href = query_url.href.replace(new RegExp("/(page\/[0-9]*)\//", "ms"), '');
				window.history.pushState('page-id', 'Ajax Load', query_url.href);
				loader();
				$.ajax({
					url: MetroObj.ajaxurl,
					type: "POST",
					data: {
						action: 'load_template',
						template: 'archive',
						part: 'product',
						query_url: query_url.href
					},
					success: function success(data) {
						$(".rdtheme-archive-products").fadeOut('medium', function() {
							$(this).html(data).fadeIn('medium', function() {
								var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
								$('.woocommerce-result-count').replaceWith(updated_statistics_text);
								$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
							});
							$(document).trigger('rt_filter_ajax_load');
						});
					},
					error: function error(MLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
					}
				});
			});
		});
		$(document).on('rt_regenerated_filter_tag', function() {
			var active_filter_wrapper = $('.top-widget-active-filter-wrapper');

			if ($('.attribute-wrapper').length > 0) {
				var attribute_wrapper = $('.attribute-wrapper.clear').length > 0 ? $('.attribute-wrapper.clear') : $("<div class='attribute-wrapper clear'> <h5> Clear all </h5> <div class='filter-item-container'></div> <span class='remove-filter' title='Remove Filter' ><i class='fa fa-remove'></i></span> </div>");
				attribute_wrapper.appendTo(active_filter_wrapper);
				attribute_wrapper.find('.remove-filter').attr('data-clear', true);
			}
		});
	})(jQuery);

	(function($) {
		$(document).ready(function() {
			$('body').on('rt_added_to_wishlist', function(e, product_id) {
				$('.wishlist-icon-num').html(Number.parseInt($('.wishlist-icon-num').html()) + 1);
			});
			$('body').on('rt_removed_from_wishlist', function(e, product_id) {
				$('.wishlist-icon-num').html(Number.parseInt($('.wishlist-icon-num').html()) - 1);
			});
		});
	})(jQuery);

	(function($) {
		$(document).on('ready, rt_filter_ajax_load', function() {
			$('.ajax-pagination-area .page-numbers:not(.current)').off().click(function() {
				var href = new URL($(this).attr('href'));
				var paged = href.searchParams.get('paged');
				var paged_string = 'page/' + paged + '/';
				var url = new URL(window.location.href);

				if (url.pathname.includes('page')) {
					url.href = url.href.replace(new RegExp("/(page\/[0-9]*)\//", "ms"), paged_string);
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
						query_url: url.href
					},
					success: function success(data) {
						$(".rdtheme-archive-products").fadeOut('medium', function() {
							$(this).html(data).fadeIn('medium', function() {
								var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
								$('.woocommerce-result-count').replaceWith(updated_statistics_text);
								$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
							});
							$(document).trigger('rt_filter_ajax_load');
						});
					},
					error: function error(MLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
					}
				});
				return false;
			});
		});
	})(jQuery);

	(function($) {
		$(document).on('ready', function() {
			if (MetroObj.product_filter == 'ajax') {
				if (MetroObj.pagination == 'numbered') {
					$('.pagination-area').hide();
				}

				var query_url = window.location.href;
				$.ajax({
					url: MetroObj.ajaxurl,
					data: {
						action: 'load_template',
						template: 'archive',
						part: 'product',
						query_url: query_url
					},
					type: "POST",
					success: function success(data) {
						$(".rdtheme-archive-products").fadeOut('medium', function() {
							$(this).html(data).fadeIn('medium', function() {
								var updated_statistics_text = $(".rdtheme-archive-products").find('.meta-data-for-ajax');
								$('.woocommerce-result-count').replaceWith(updated_statistics_text);
								$('.meta-data-for-ajax').removeClass('meta-data-for-ajax').addClass('woocommerce-result-count');
							});
							$(document).trigger('rt_filter_ajax_load');
						});
					},
					error: function error(MLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown);
					}
				});
			}
		});
	})(jQuery);

	$(window.mt_search_callback);
	$(document).on('rt_filter_ajax_load', function() {
		var loadMore = $('.rdtheme-loadmore-data');
		var loadMoreMeta = $('.load-more-meta-data');
		var button = $('.rdtheme-loadmore-btn-area');
		loadMore.attr('data-paged', loadMoreMeta.attr('data-paged'));
		loadMore.attr('data-max', loadMoreMeta.attr('data-max'));

		if (Number.parseInt(loadMore.attr('data-max')) == Number.parseInt(loadMore.attr('data-paged'))) {
			button.hide();
		} else {
			button.find('.rdtheme-loadmore-btn-icon').hide();
			button.find('.rdtheme-loadmore-btn-text').show();
			button.find('.rdtheme-loadmore-btn').removeAttr('disabled');
			button.show();
		}
	});
	$(function() {
		$(document).on('rt_filter_ajax_load', function() {
			$('.variations_form').each(function() {
				$(this).wc_variation_form();
			});
		});
		$(document).on('afterLoadMore', function() {
			$('.variations_form').each(function() {
				$(this).wc_variation_form();
			});
		});
	});

	loadmore_n_infinityscroll();
	widthgen();

	function content_ready_scripts() {
		theme.countdown();
		theme.magnific_popup();
		theme.vertical_menu();
		theme.vertical_menu_mobile();
		theme.category_search_dropdown();
		theme.rt_offcanvas_menu();
		theme.rt_toggle();
		theme.rt_offcanvas_menu_layout();
		WooCommerce.dokan_my_order_responsive_table();
		theme.slick_banner_slider();
	}

	function content_load_scripts() {
		theme.isotope();
		theme.owl_carousel();
		theme.slick_carousel();
		theme.slick_banner_slider();
		theme.ripple_effect();
		theme.metro_sal();
	}

	$(document).ready(function() {
		theme.scroll_to_top();
		theme.sticky_menu();
		theme.mobile_menu();
		theme.multi_column_menu();
		theme.search_popup();
		WooCommerce.quantity_change();
		WooCommerce.wishlist_icon();
		WooCommerce.meta_reloation();
		WooCommerce.sticky_product_thumbnail();
		content_ready_scripts();
	});
	$(window).on('load', function() {
		content_load_scripts();
		theme.preloader();
	});
	$(window).on('load resize', function() {
		theme.mobile_menu_max_height();
		WooCommerce.slider_nav();
	});
	$(window).on('elementor/frontend/init', function() {
		if (elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction('frontend/element_ready/widget', function() {
				content_ready_scripts();
				content_load_scripts();
			});
		}
	});
	$(document).on('rt_filter_ajax_load', function() {
		theme.slick_carousel();
	});

}());