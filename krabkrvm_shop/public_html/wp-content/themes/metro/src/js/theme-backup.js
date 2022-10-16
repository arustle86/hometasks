let ThemeHelper = {

    querySelector: (selector, callback) => {
    const el = document.querySelectorAll(selector);

    if (el.length) {
      callback(el);
    }
  },

   run_closeMenuAreaLayout : () => {
       var menuArea = $('.additional-menu-area');
        var trigger = $('.side-menu-trigger', menuArea);
        trigger.removeClass('side-menu-close').addClass('side-menu-open');
        if(menuArea.find('> .rt-cover').length){
            menuArea.find('> .rt-cover').remove();
        }
        $('.sidenav').css('transform', 'translateX(-100%)');
   },

   run_closeSideMenu : () => {
            var wrapper = $('body').find('>#page'),
            $this = $('#side-menu-trigger a.menu-times');
            wrapper.removeClass('open').find('.offcanvas-mask').remove();
            $("#offcanvas-body-wrapper").attr('style', '');
            $this.prev('.menu-bar').removeClass('open');
            $this.addClass('close');
        },

    run_sticky_menu : () => {

        var wrapperHtml  = $('<div class="main-header-sticky-wrapper"></div>');
        var wrapperClass = '.main-header-sticky-wrapper';
        
        $('.main-header').clone().appendTo(wrapperHtml);
        $('#page').append(wrapperHtml);

        var height = $(wrapperClass).outerHeight() + 30;

        $(wrapperClass).css('margin-top', '-' + height + 'px');

        $(window).scroll(function(){
            if ($(this).scrollTop() > 300) {
                $('body').addClass('rdthemeSticky');
            }
            else {
                $('body').removeClass('rdthemeSticky');
            }
        });
    },

    run_sticky_meanmenu : () => {

        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('body').addClass("mean-stick");
            } 
            else {
                $('body').removeClass("mean-stick");
            }
        });
    },

    run_isotope : ($container,filter) => {
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

    add_vertical_menu_class : () => {
        var screenWidth = $('body').outerWidth();

        if ( screenWidth < 992 ) {
            $('.vertical-menu').addClass('vertical-menu-mobile');
        }
        else {
            $('.vertical-menu').removeClass('vertical-menu-mobile');
        }
    },

    owl_change_num_pagination : ($owlParent,index) => {
        $owlParent.find('.owl-numbered-dots-items span').removeClass('active');
        //$owlParent.find('.owl-numbered-dots-items [data-num="'+index+'"]').addClass('active');
    }
}


const theme = {


    abc: ()=>{
        /*-------------------
    CONTENT GRID 
-------------------*/
ThemeHelper.querySelector('.content-grid', function (el) {
  var a = 10
  const sidebar = {
          chat: {
            active: false,
            minWidth: 80,
            maxWidth: 300
          },
          navigation: {
            active: false,
            minWidth: 80,
            maxWidth: 300
          }
        },
        breakpointWidth = 1366;

  const updateGridPosition = function (contentGrid) {
    if (window.innerWidth > breakpointWidth) {
      const chatWidth = sidebar.chat.active ? sidebar.chat.maxWidth : sidebar.chat.minWidth,
            navigationWidth = sidebar.navigation.active ? sidebar.navigation.maxWidth : sidebar.navigation.minWidth,
            availableWidth = document.body.clientWidth - contentGrid.offsetWidth - chatWidth - navigationWidth,
            offsetX = (availableWidth / 2) + navigationWidth;

      contentGrid.style.transform = `translate(${offsetX}px, 0)`;
    } else {
      contentGrid.style.transform = `translate(0, 0)`;
    }
  };

  const updateGridPositions = function () {
    for (const grid of el) {
      updateGridPosition(grid);
    }
  };

  const setGridTransition = function (grid) {
    grid.style.transition = `transform .4s ease-in-out`;
  };

  const setGridTransitions = function () {
    for (const grid of el) {
      setGridTransition(grid);
    }
  };

  updateGridPositions();
  window.addEventListener('resize', updateGridPositions);
  // delay transition setup to avoid loading animation
  window.setTimeout(setGridTransitions, 300);

  /*-------------------
      CHAT WIDGET 
  -------------------*/
  app.querySelector('#chat-widget-messages', function (el) {
    const chatWidget = el[0],
          topOffset = 80,
          closedWidth = 80,
          openWidth = 300,
          chatWidgetMessages = chatWidget.querySelector('.chat-widget-messages'),
          chatWidgetForm = chatWidget.querySelector('.chat-widget-form'),
          chatWidgetButton = chatWidget.querySelector('.chat-widget-button'),
          closedClass = 'closed';
  
    const setChatMessagesDimensions = function () {
      if (chatWidget.classList.contains(closedClass)) {
        chatWidgetMessages.style.height = `${window.innerHeight - chatWidgetButton.offsetHeight - topOffset}px`;
      } else {
        chatWidgetMessages.style.height = `${window.innerHeight - chatWidgetForm.offsetHeight - chatWidgetButton.offsetHeight - topOffset}px`;
      }
    };
  
    const toggleChatWidget = function () {
      chatWidget.classList.toggle(closedClass);
      setChatMessagesDimensions();

      sidebar.chat.active = !chatWidget.classList.contains(closedClass);
      updateGridPositions();
    };
  
    const openChatWidget = function () {
      chatWidget.classList.remove(closedClass);
      setChatMessagesDimensions();

      sidebar.chat.active = true;
      updateGridPositions();
    };
  
    chatWidgetButton.addEventListener('click', toggleChatWidget);
  
    setChatMessagesDimensions();
    window.addEventListener('resize', setChatMessagesDimensions);
  
    app.querySelector('#chat-widget-message', function (el) {
      const chatMessageWidget = el[0],
            chatWidgetMessage = chatWidgetMessages.querySelectorAll('.chat-widget-message'),
            chatMessageWidgetHeader = chatMessageWidget.querySelector('.chat-widget-header'),
            chatMessageWidgetConversation = chatMessageWidget.querySelector('.chat-widget-conversation'),
            chatMessageWidgetCloseButton = chatMessageWidget.querySelector('.chat-widget-close-button'),
            hiddenClass = 'hidden';
  
      const setChatConversationDimensions = function () {
        chatMessageWidgetConversation.style.height = `${window.innerHeight - chatMessageWidgetHeader.offsetHeight - chatWidgetForm.offsetHeight - chatWidgetButton.offsetHeight - topOffset}px`;
      };
      
      const toggleChatMessageWidget = function () {
        chatMessageWidget.classList.toggle(hiddenClass);
      };
  
      const closeChatMessageWidget = function () {
        chatMessageWidget.classList.add(hiddenClass);
      };
  
      for (const widgetMessage of chatWidgetMessage) {
        widgetMessage.addEventListener('click', toggleChatMessageWidget);
        widgetMessage.addEventListener('click', openChatWidget);
      }
  
      chatWidgetButton.addEventListener('click', closeChatMessageWidget);
      chatMessageWidgetCloseButton.addEventListener('click', toggleChatMessageWidget);
  
      setChatConversationDimensions();
      window.addEventListener('resize', setChatConversationDimensions);
    });
  });
  
  /*------------------------
      NAVIGATION WIDGET 
  ------------------------*/
  app.querySelector('.navigation-widget-trigger', function (el) {
    const navigationTrigger = el[0],
          topOffset = 80,
          navigationWidget = document.querySelector('#navigation-widget'),
          navigationWidgetSmall = document.querySelector('#navigation-widget-small'),
          activeClass = 'active',
          hiddenClass = 'hidden',
          delayedClass = 'delayed';
  
    const setNavigationWidgetDimensions = function () {
      navigationWidget.style.height = `${window.innerHeight - topOffset}px`;
    };
  
    const toggleNavigationWidget = function () {
      navigationTrigger.classList.toggle(activeClass);

      navigationWidget.classList.toggle(delayedClass);
      navigationWidget.classList.toggle(hiddenClass);
      navigationWidgetSmall.classList.toggle(delayedClass);
      navigationWidgetSmall.classList.toggle(hiddenClass);

      sidebar.navigation.active = !navigationWidget.classList.contains(hiddenClass);
      updateGridPositions();
    };
  
    navigationTrigger.addEventListener('click', toggleNavigationWidget);
  
    setNavigationWidgetDimensions();
    window.addEventListener('resize', setNavigationWidgetDimensions);
  });

  /*-------------------------------
      NAVIGATION WIDGET MOBILE
  -------------------------------*/
  app.querySelector('.navigation-widget-mobile-trigger', function (el) {
    const navigationMobileTrigger = el[0],
          navigationWidgetMobile = document.querySelector('#navigation-widget-mobile'),
          navigationWidgetMobileCloseButton = navigationWidgetMobile.querySelector('.navigation-widget-close-button'),
          hiddenClass = 'hidden';

    const overlay = document.createElement('div');

    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.zIndex = 99998;
    overlay.style.backgroundColor = 'rgba(21, 21, 31, .96)';
    overlay.style.opacity = 0;
    overlay.style.visibility = 'hidden';
    overlay.style.transition = 'opacity .3s ease-in-out, visibility .3s ease-in-out';

    document.body.appendChild(overlay);

    const showOverlay = function () {
      overlay.style.opacity = 1;
      overlay.style.visibility = 'visible';
    };

    const hideOverlay = function () {
      overlay.style.opacity = 0;
      overlay.style.visibility = 'hidden';
    };
  
    const setNavigationWidgetMobileDimensions = function () {
      navigationWidgetMobile.style.height = `${window.innerHeight}px`;
    };
  
    const toggleNavigationWidgetMobile = function () {
      navigationWidgetMobile.classList.toggle(hiddenClass);

      const toggleOverlay = navigationWidgetMobile.classList.contains(hiddenClass) ? hideOverlay : showOverlay;
      toggleOverlay();
    };
  
    navigationMobileTrigger.addEventListener('click', toggleNavigationWidgetMobile);
    navigationWidgetMobileCloseButton.addEventListener('click', toggleNavigationWidgetMobile);
    overlay.addEventListener('click', toggleNavigationWidgetMobile);
  
    setNavigationWidgetMobileDimensions();
    window.addEventListener('resize', setNavigationWidgetMobileDimensions);
  });
})
    },


   rt_toggle : () => {
       
    $(document).on('mouseover', '.trending-sign',
      function () {
          var self = $(this),
              tips = self.attr('data-tips');
          $tooltip = '<div class="fox-tooltip">' +
              '<div class="fox-tooltip-content">' + tips + '</div>' +
              '<div class="fox-tooltip-bottom"></div>' +
              '</div>';
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
      })
      .on('mouseout', '.trending-sign', function () {
          $('body > .fox-tooltip').remove();
      });
 },

   rt_offcanvas_menu : () => {
        $('#page').on('click', '.offcanvas-menu-btn', function(e) {
            e.preventDefault();
            var $this = $(this),
                wrapper = $(this).parents('body').find('>#page'),
                wrapMask = $('<div />').addClass('offcanvas-mask'),
                offCancas = document.getElementById('offcanvas-body-wrap');

            if ($this.hasClass('menu-status-open')) {
                wrapper.addClass('open').append(wrapMask);
                $this.removeClass('menu-status-open').addClass('menu-status-close');
                offCancas.style.transform = 'translateX(' + (0) + 'px)';
             $('body').css({
                    overflow: 'hidden',
                    //height: '100%',
                    transition: 'all 0.3s ease-out'
                });

            } else {
                wrapper.removeClass('open').find('> .offcanvas-mask').remove();
                $this.removeClass('menu-status-close').addClass('menu-status-open');
                offCancas.style.transform = 'translateX(' + (-100) + '%)';
                  if ( MetroObj.rtl == 'yes' ) {
                    offCancas.style.transform = 'translateX(' + (100) + '%)';
                  }
                  $('body').css({
                    overflow: 'visible',
                   // height: 'auto',
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
        function closeMenuArea(){
            var trigger = $('.side-menu-trigger', menuArea);
            trigger.removeClass('side-menu-close').addClass('side-menu-open');
            if(menuArea.find('> .rt-cover').length){
                menuArea.find('> .rt-cover').remove();
            }
            $('.sidenav').css('transform', 'translateX(100%)');
        }
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



rt_offcanvas_menu_layout : () => {      
        var menuArea = $('.additional-menu-area');
        menuArea.on('click', '.side-menu-trigger', function (e) {
            e.preventDefault();
            var self = $(this);
            if(self.hasClass('side-menu-open')){
                $('.sidenav').css('transform', 'translateX(0%)');
                if(!menuArea.find('> .rt-cover').length){
                    menuArea.append("<div class='rt-cover'></div>");
                }
                self.removeClass('side-menu-open').addClass('side-menu-close');
            }
        });
              
        menuArea.on('click', '.closebtn', function (e) {
            e.preventDefault();
            ThemeHelper.run_closeMenuAreaLayout();
        });
        
        $(document).on('click', '.rt-cover', function(){
            ThemeHelper.run_closeMenuAreaLayout();
        });
        
  },

	/* Scroll to top */
	scroll_to_top : () => {
		$('.scrollToTop').on('click',function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});

		$(window).scroll(function(){
            if ($(window).scrollTop() > 300) {
                $('.scrollToTop').addClass('back-top');
            }
            else {
                $('.scrollToTop').removeClass('back-top');
            }
        });
	},

	preloader : () => {
		$('#preloader').fadeOut('slow', function () {
			$(this).remove();
		});
	},

	/* Sticky Menu */
    sticky_menu : () => {
        if ( MetroObj.hasStickyMenu == 1 ) {
            ThemeHelper.run_sticky_menu();
            ThemeHelper.run_sticky_meanmenu();
        }
    },

    ripple_effect : () => {
        if (typeof $.fn.ripples == 'function') {
            $('.rt-water-ripple').ripples({
                resolution: 712,
                dropRadius: 30,
                perturbance: 0.01,
            }); 
        }
    },

    category_search_dropdown : () => {
        $('.category-search-dropdown-js .dropdown-menu li').on('click',function(e){
            var $parent = $(this).closest('.category-search-dropdown-js'),
            slug        = $(this).data('slug'),
            name        = $(this).text();

            $parent.find('.dropdown-toggle').text($.trim(name));
            $parent.find('input[name="product_cat"]').val(slug);
        });

        if ($.fn.autocomplete) {
            $(".ps-autocomplete-js .product-autocomplete-js").autocomplete({
                    minChars: 2,
                    search: function (event, ui) {
                        if (!$(event.target).parent().find('.product-autocomplete-spinner').length) {
                            $('<i class="product-autoaomplete-spinner fa fa-spinner fa-spin"></i>').insertAfter(event.target);
                        }
                    },
                    source: function (req, response) {
                        req.action = 'metro_product_search_autocomplete';
                        $.ajax({
                            dataType: "json",
                            type: "POST",
                            url: MetroObj.ajaxurl,
                            data: req,
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    response: function (event, ui) {
                        $(event.target).parent().find('.product-autoaomplete-spinner').remove();
                    },
                })
        }

    },

    search_popup : () => {
        $('.search-icon-area a').on("click", function(event) {
            event.preventDefault();
            $("#rdtheme-search-popup").addClass("open");
            $('#rdtheme-search-popup > form > input').focus();
        });

        $("#rdtheme-search-popup, #rdtheme-search-popup button.close").on("click keyup", function(event) {
            if (event.target == this || event.target.className == "close" || event.keyCode == 27){
                $(this).removeClass("open");
            }
        });
    },

    vertical_menu : () => {
        $('.vertical-menu-btn').on('click',function(e){
            e.preventDefault();
            $(this).closest('.vertical-menu-area').toggleClass("opened");
        });
    },

    vertical_menu_mobile : () => {
        ThemeHelper.add_vertical_menu_class();
        $(window).on('resize', function () {
            ThemeHelper.add_vertical_menu_class();
        });
        $('.vertical-menu').on('click', 'li.menu-item-has-children span.has-dropdown', function (e) {
            if ($(this).find('+ ul.sub-menu').length) {
                $(this).closest('li').toggleClass('submenu-opend');
                $(this).find('+ ul.sub-menu').slideToggle();
            }
            return false;
        });        
    },

    mobile_menu : () => {
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

    mobile_menu_max_height : () => {
    	var wHeight = $(window).height();
    	wHeight = wHeight - 50;
    	$('.mean-nav > ul').css('max-height', wHeight + 'px');
    },

    multi_column_menu : () => {
    	$('.main-navigation ul > li.mega-menu').each(function() {
            // total num of columns
            var items = $(this).find(' > ul.sub-menu > li').length;
            // screen width
            var bodyWidth = $('body').outerWidth();
            // main menu link width
            var parentLinkWidth = $(this).find(' > a').outerWidth();
            // main menu position from left
            var parentLinkpos = $(this).find(' > a').offset().left;

            var width = items * 220;
            var left  = (width/2) - (parentLinkWidth/2);

            var linkleftWidth  = parentLinkpos + (parentLinkWidth/2);
            var linkRightWidth = bodyWidth - ( parentLinkpos + parentLinkWidth );

            // exceeds left screen
            if( (width/2)>linkleftWidth ){
            	$(this).find(' > ul.sub-menu').css({
            		width: width + 'px',
            		right: 'inherit',
            		left:  '-' + parentLinkpos + 'px'
            	});        
            }
            // exceeds right screen
            else if ( (width/2)>linkRightWidth ) {
            	$(this).find(' > ul.sub-menu').css({
            		width: width + 'px',
            		left: 'inherit',
            		right:  '-' + linkRightWidth + 'px'
            	}); 
            }
            else{
            	$(this).find(' > ul.sub-menu').css({
            		width: width + 'px',
            		left:  '-' + left + 'px'
            	});            
            }
        });
    },

    isotope : () => {
    	if ( typeof $.fn.isotope == 'function' && typeof $.fn.imagesLoaded == 'function') {

            // Blog Layout 2
            var $blogIsotopeContainer = $('.post-isotope');
            $blogIsotopeContainer.imagesLoaded( function() {
            	$blogIsotopeContainer.isotope();
            });

            // Run 1st time
            var $isotopeContainer = $('.rt-el-isotope-container');
            $isotopeContainer.imagesLoaded( function() {
            	$isotopeContainer.each(function() {
            		var $container = $(this).find('.rt-el-isotope-wrapper'),
            		filter = $(this).find('.rt-el-isotope-tab a.current').data('filter');
            		ThemeHelper.run_isotope($container,filter);
            	});
            });


            // Run on click even
            $('.rt-el-isotope-tab a').on('click',function(){
            	$(this).closest('.rt-el-isotope-tab').find('.current').removeClass('current');
            	$(this).addClass('current');
            	var $container = $(this).closest('.rt-el-isotope-container').find('.rt-el-isotope-wrapper'),
            	filter = $(this).attr('data-filter');
            	ThemeHelper.run_isotope($container,filter);
            	return false;
            });
        }
    },


    slick_carousel : () => {

        if (typeof $.fn.slick == 'function') {
            $(".rt-slick-slider").each(function() {
            $(this).slick({
                rtl: MetroObj.rtl
            });
            });

            // Loadmore
            $(document).on('afterLoadMore afterInfinityScroll',function(){
                $(".product_loaded .rt-slick-slider").each(function() {
                    $(this).slick({
                        rtl: MetroObj.rtl
                    });
                });
                $(".product_loaded").removeClass('product_loaded');
            });

        }
    },

    slick_banner_slider : () => {

        if (typeof $.fn.slick == 'function') {

                var pageinfo = $('.paginginfo');
                var slickelement = $('.slick-slider');

                $(".slick-slider").on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    pageinfo.text(i + '/' + slick.slideCount);
                });

                slickelement.slick({
                    prevArrow: $('#slick-prev'),
                    nextArrow: $('#slick-next')

                });
         }
         
    },

    owl_carousel : () => {
        if (typeof $.fn.owlCarousel == 'function') {
            $(".owl-custom-nav .owl-next").on('click',function(){
                $(this).closest('.owl-wrap').find('.owl-carousel').trigger('next.owl.carousel');
            });
            $(".owl-custom-nav .owl-prev").on('click',function(){
                $(this).closest('.owl-wrap').find('.owl-carousel').trigger('prev.owl.carousel');
            });

            $(".rt-owl-carousel").each(function() {
                var options = $(this).data('carousel-options');
                if ( MetroObj.rtl == 'yes') {
                    options['rtl'] = true; //@rtl
                    options['navText'] = ["<i class='fa fa-angle-right'></i>","<i class='fa fa-angle-left'></i>"];
                }
                $(this).owlCarousel(options);
            });

            $(".owl-numbered-dots .owl-numbered-dots-items span").on('click',function(){
                let index = $(this).data('num');
                let $owlParent = $(this).closest('.owl-wrap').find('.owl-carousel');
                $owlParent.trigger('to.owl.carousel', index);
                $owlParent.find('.owl-numbered-dots-items span').removeClass('active');
                $owlParent.find('.owl-numbered-dots-items [data-num="'+index+'"]').addClass('active');
            });
        }
    },

    countdown : () => {
        if ( typeof $.fn.countdown == 'function') {
            try {
                var day = (MetroObj.day == 'Day') ? 'Day%!D' : MetroObj.day,
                hour    = (MetroObj.hour == 'Hour') ? 'Hour%!D' : MetroObj.hour,
                minute  = (MetroObj.minute == 'Minute') ? 'Minute%!D' : MetroObj.minute,
                second  = (MetroObj.second == 'Second') ? 'Second%!D' : MetroObj.second;

                $('.rtjs-coutdown').each(function() {
                    var $CountdownSelector = $(this).find('.rtjs-date');
                    var eventCountdownTime = $CountdownSelector.data('time');
                    $CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function(event) {
                        $(this).html(event.strftime(''
                            + '<div class="rt-countdown-section"><div class="rtin-count">%D</div><div class="rtin-text">'+day+'</div></div>'
                            + '<div class="rt-countdown-section"><div class="rtin-count">%H</div><div class="rtin-text">'+hour+'</div></div>'
                            + '<div class="rt-countdown-section"><div class="rtin-count">%M</div><div class="rtin-text">'+minute+'</div></div>'
                            + '<div class="rt-countdown-section"><div class="rtin-count">%S</div><div class="rtin-text">'+second+'</div></div>'));
                    }).on('finish.countdown', function(event) {
                        $(this).html(event.strftime(''));
                    });
                });

                $('.rtjs-coutdown-2').each(function() {
                    var $CountdownSelector = $(this).find('.rtjs-date');
                    var eventCountdownTime = $CountdownSelector.data('time');
                    $CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function(event) {
                        $(this).html(event.strftime(''
                            + '<div class="rt-countdown-section-top">'
                            + '<div class="rt-countdown-section"><div class="rt-countdown-section-inner"><div class="rtin-count">%D</div><div class="rtin-text">'+day+'</div></div></div>'
                            + '<div class="rt-countdown-section ml10"><div class="rt-countdown-section-inner"><div class="rtin-count">%H</div><div class="rtin-text">'+hour+'</div></div></div>'
                            + '</div><div class="rt-countdown-section-bottom">'
                            + '<div class="rt-countdown-section"><div class="rt-countdown-section-inner"><div class="rtin-count">%M</div><div class="rtin-text">'+minute+'</div></div></div>'
                            + '<div class="rt-countdown-section ml10"><div class="rt-countdown-section-inner"><div class="rtin-count">%S</div><div class="rtin-text">'+second+'</div></div></div></div>'));
                    }).on('finish.countdown', function(event) {
                        $(this).html(event.strftime(''));
                    });
                });    

            }
            catch(err) {
                console.log('Countdown : '+err.message);
            }      
        }        
    },

    magnific_popup : () => {
        if ( typeof $.fn.magnificPopup == 'function') {
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
}

export default theme;