(function ($) {
  'use strict';

  if ($.fn.wpColorPicker) {
    $('input.rtwpvs-color-picker').wpColorPicker();
  }

  jQuery(document).ajaxComplete(function (event, request, options) {
    if (request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf('action=add-tag')) {
      var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');

      if (!res || res.errors) {
        return;
      }

      if ($.fn.wpColorPicker) {
        $('input.rtwpvs-color-picker').wpColorPicker();
      }

      $('button.rtwpvs-remove-image').trigger('click');
      return;
    }
  });
  $(document).on('click', 'button.rtwpvs-upload-image', function (event) {
    event.stopPropagation();
    var file_frame;
    var self = $(this);

    if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
      if (file_frame) {
        file_frame.open();
        return;
      }

      file_frame = wp.media.frames.select_image = wp.media({
        title: rtwpvs_admin.media_title,
        button: {
          text: rtwpvs_admin.button_title
        },
        multiple: false
      });
      file_frame.on('select', function () {
        var attachment = file_frame.state().get('selection').first().toJSON();

        if ($.trim(attachment.id) !== '') {
          var url = typeof attachment.sizes.thumbnail === 'undefined' ? attachment.sizes.full.url : attachment.sizes.thumbnail.url;
          self.prev().val(attachment.id);
          self.closest('.rtwpvs-image-wrapper').find('img').attr('src', url);
          self.next().show();
        }
      });
      file_frame.on('open', function () {
        var selection = file_frame.state().get('selection');
        var current = self.prev().val();
        var attachment = wp.media.attachment(current);
        attachment.fetch();
        selection.add(attachment ? [attachment] : []);
      });
      file_frame.open();
    }
  });
  $(document).on('click', 'button.rtwpvs-remove-image', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var self = $(this),
        placeholder = self.closest('.rtwpvs-image-wrapper').find('img').data('placeholder');
    self.closest('.rtwpvs-image-wrapper').find('img').attr('src', placeholder);
    self.prev().prev().val('');
    self.hide();
    return false;
  });
  $('#rtwpvs-settings-wrapper').on('click', '.nav-tab', function (event) {
    event.preventDefault();
    var target = $(this).data('target');
    $(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
    $('#' + target).show().siblings().hide();
    $('#_last_active_tab').val(target);

    if (history.pushState) {
      var newurl = setGetParameter('section', target);
      window.history.pushState({
        path: newurl
      }, '', newurl);
    }
  });

  function setGetParameter(paramName, paramValue) {
    var url = window.location.href;
    var hash = location.hash;
    url = url.replace(hash, '');

    if (url.indexOf("?") >= 0) {
      var params = url.substring(url.indexOf("?") + 1).split("&");
      var paramFound = false;
      params.forEach(function (param, index) {
        var p = param.split("=");

        if (p[0] == paramName) {
          params[index] = paramName + "=" + paramValue;
          paramFound = true;
        }
      });
      if (!paramFound) params.push(paramName + "=" + paramValue);
      url = url.substring(0, url.indexOf("?") + 1) + params.join("&");
    } else url += "?" + paramName + "=" + paramValue;

    return url + hash;
  }
  /* pro feature */


  $('.rtwpvs-metaboxes-wrapper').on('click', '.rtwpvs-metabox > h3', function () {
    $(this).parent('.rtwpvs-metabox').toggleClass('closed').toggleClass('open');
  }).on('click', '.rtwpvs-metabox h3', function (event) {
    if ($(event.target).filter(':input, option, .sort').length) {
      return;
    }

    $(this).next('.rtwpvs-metabox-content').stop().slideToggle();
  });
  $('.rtwpvs-metabox.closed').each(function () {
    $(this).find('.rtwpvs-metabox-content').hide();
  });
  $(document.body).on('click', '.rtwpvs-save-attributes', function () {
    $.ajax({
      type: "POST",
      url: rtwpvs_admin.ajaxurl,
      data: {
        post_id: rtwpvs_admin.post_id,
        nonce: rtwpvs_admin.nonce,
        action: 'rtwpvs_save_product_attributes',
        data: $('.rtwpvs-tab-options').find('input, select, textarea').serialize()
      },
      beforeSend: function beforeSend() {
        $('#rtwpvs_tab_options').block({
          message: null,
          overlayCSS: {
            background: '#fff',
            opacity: 0.6
          }
        });
      },
      success: function success(data) {
        $('#rtwpvs_tab_options').unblock();
      },
      error: function error(jqXHR, exception) {
        $('#rtwpvs_tab_options').unblock();
        console.error('Uncaught Error:' + jqXHR.responseText);
      }
    });
  });
  $(document.body).on('click', '.rtwpvs-reset-attributes', function () {
    if (confirm(rtwpvs_admin.reset_notice)) {
      $('#rtwpvs_tab_options').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });
      var data = {
        post_id: rtwpvs_admin.post_id,
        nonce: rtwpvs_admin.nonce,
        action: 'rtwpvs_reset_product_attributes'
      };
      $.ajax({
        type: "POST",
        url: rtwpvs_admin.ajaxurl,
        data: data,
        beforeSend: function beforeSend() {
          $('#rtwpvs_tab_options').block({
            message: null,
            overlayCSS: {
              background: '#fff',
              opacity: 0.6
            }
          });
        },
        success: function success(data) {
          $('#woocommerce-product-data').trigger('woocommerce_variations_loaded');
          $('#rtwpvs_tab_options').unblock();
        },
        error: function error(jqXHR, exception) {
          $('#rtwpvs_tab_options').unblock();
          console.error('Uncaught Error:' + jqXHR.responseText);
        }
      });
    }
  });
  /* Licence */

  $(".rtwpvs-setting-tab #license_key-wrapper").on('click', '.rt-licensing-btn', function (e) {
    e.preventDefault();
    console.log('clicked');
    var self = $(this),
        type = self.hasClass('license_activate') ? 'license_activate' : 'license_deactivate';
    $.ajax({
      type: "POST",
      url: rtwpvs_admin.ajaxurl,
      data: {
        action: 'rtwpvs_manage_licensing',
        type: type
      },
      beforeSend: function beforeSend() {
        self.addClass('loading');
        self.parents('.description').find(".rt-licence-msg").remove();
        $('<span class="rt-icon-spinner animate-spin"></span>').insertAfter(self);
      },
      success: function success(response) {
        self.next('.rt-icon-spinner').remove();
        self.removeClass('loading');

        if (!response.error) {
          self.text(response.value);
          self.removeClass(type);
          self.addClass(response.type);

          if (response.type == 'license_deactivate') {
            self.removeClass('button-primary');
            self.addClass('danger');
          } else if (response.type == 'license_activate') {
            self.removeClass('danger');
            self.addClass('button-primary');
          }
        }

        if (response.msg) {
          $("<span class='rt-licence-msg'>" + response.msg + "</span>").insertAfter(self);
        }

        self.blur();
      },
      error: function error(jqXHR, exception) {
        self.removeClass('loading');
        self.next('.rt-icon-spinner').remove();
      }
    });
  });

  $.fn.rtWpVsProductAttributeTermTooltipType = function () {
    return this.each(function () {
      var that = this;
      var $wrapper = $(this).closest('.rtwpvs-metabox-content-wrap');

      var change_classes = function change_classes() {
        var value = $(that).val();
        var visible_class = 'rtwpvs_visible_if_tooltip_' + value;
        var existing_classes = ['text', 'image'].map(function (type) {
          return 'rtwpvs_visible_if_tooltip_' + type;
        }).join(' ');
        $wrapper.removeClass(existing_classes).addClass(visible_class);
        return value;
      };

      $(this).on('change.attribute', function (e) {
        change_classes();
      });
    });
  };

  $.fn.rtWpVsProductAttributeType = function () {
    return this.each(function () {
      var that = this;
      var $wrapper = $(this).closest('.rtwpvs-attribute-box-wrapper');

      var change_classes = function change_classes() {
        var value = $(that).val();
        var visible_class = 'rtwpvs_visible_if_' + value;
        var existing_classes = Object.keys(rtwpvs_admin.attribute_types).map(function (type) {
          return 'rtwpvs_visible_if_' + type;
        }).join(' ');
        $wrapper.removeClass(existing_classes).addClass(visible_class);
        return value;
      };

      $(this).on('change', function (e) {
        var value = change_classes();
        $wrapper.find('.rtwpvs-attribute-term-type').val(value).trigger('change.term');
      });
      $(this).on('change.attribute', function (e) {
        change_classes();
      });
    });
  };

  $.fn.rtWpVsProductAttributeTermType = function () {
    return this.each(function () {
      var that = this;
      var $wrapper = $(this).closest('.rtwpvs-attribute-term-box-wrapper');
      var $main_wrapper = $(this).closest('.rtwpvs-attribute-box-wrapper');

      var change_classes = function change_classes() {
        var value = $(that).val();
        var visible_class = 'rtwpvs_visible_if_term_' + value;
        var existing_classes = Object.keys(rtwpvs_admin.attribute_types).map(function (type) {
          return 'rtwpvs_visible_if_term_' + type;
        }).join(' ');
        existing_classes += ' rtwpvs_visible_if_custom';
        $wrapper.removeClass(existing_classes).addClass(visible_class);
        return value;
      };

      $(this).on('change', function (e) {
        change_classes();
        var allValues = [];
        $main_wrapper.find('.rtwpvs-attribute-term-type').each(function () {
          allValues.push($(this).val());
        });

        var uniqueValues = _.uniq(allValues);

        var is_all_tax_same = uniqueValues.length === 1;

        if (is_all_tax_same) {
          $main_wrapper.find('.rtwpvs-attribute-type').val(uniqueValues.toString()).trigger('change.attribute');
        } else {
          $main_wrapper.find('.rtwpvs-attribute-type').val('custom').trigger('change.attribute');
        }
      });
      $(this).on('change.term', function (e) {
        change_classes();
      });
    });
  };

  $.fn.rtWpVsProductAttributeTermDualColor = function (options) {
    return this.each(function () {
      var $wrapper = $(this).closest('.rtwpvs-metabox-content-wrap');
      $(this).on('change', function (e) {
        var is_duel_color = $(this).is(':checked');
        var target = $wrapper.find('.rtwpvs-attribute-term-secondary-color');

        if (is_duel_color) {
          target.addClass('rtwpvs_visible_if_dual_color_yes');
        } else {
          target.removeClass('rtwpvs_visible_if_dual_color_yes');
        }
      });
      $(this).trigger('change');
    });
  };

  $('.rtwpvs-attribute-type').rtWpVsProductAttributeType();
  $('.rtwpvs-attribute-term-type').rtWpVsProductAttributeTermType();
  $('.rtwpvs-attribute-term-tooltip select').rtWpVsProductAttributeTermTooltipType();
  $('.rtwpvs-attribute-term-is-dual-color input').rtWpVsProductAttributeTermDualColor();
  rtFieldDependency();
  $('#rtwpvs_attribute_tooltip').on('change', function () {
    rtFieldDependency();
  });

  function rtFieldDependency() {
    var value = $('#rtwpvs_attribute_tooltip').val();

    if (value === 'text') {
      $(".rtwpvs_attribute_tooltip_text").show();
      $(".rtwpvs_attribute_tooltip_image").hide();
    } else if (value === 'image') {
      $(".rtwpvs_attribute_tooltip_text").hide();
      $(".rtwpvs_attribute_tooltip_image").show();
    } else {
      $(".rtwpvs_attribute_tooltip_image").hide();
      $(".rtwpvs_attribute_tooltip_text").hide();
    }
  }

  if ($.fn.RtDependency) {
    $('[data-rt-depends]').RtDependency();
  }
})(jQuery);
