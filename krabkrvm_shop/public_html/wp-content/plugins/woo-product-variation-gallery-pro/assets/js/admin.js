(function ($) {
  'use strict';

  if ($.fn.wpColorPicker) {
    $('input.rtwpvg-color-picker').wpColorPicker();
  }

  $('#rtwpvg-settings-wrapper').on('click', '.nav-tab', function (event) {
    event.preventDefault();
    var self = $(this),
        target = self.data('target');
    self.addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
    $('#' + target).show().siblings().hide();
    $('#_last_active_tab').val(target);

    if (history.pushState) {
      var newurl = setGetParameter('section', target);
      window.history.pushState({
        path: newurl
      }, '', newurl);
    }
  });
  /* Licence */

  $(".rtwpvg-setting-tab #license_key-wrapper").on('click', '.rt-licensing-btn', function (e) {
    e.preventDefault();
    console.log('clicked');
    var self = $(this),
        type = self.hasClass('license_activate') ? 'license_activate' : 'license_deactivate';
    $.ajax({
      type: "POST",
      url: rtwpvg_admin.ajaxurl,
      data: {
        action: 'rtwpvg_manage_licensing',
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

  function imageUploader() {
    $(document).off('click', '.rtwpvg-add-image');
    $(document).on('click', '.rtwpvg-add-image', addImage);
    $(document).on('click', '.rtwpvg-remove-image', removeImage);
    $(document).on('click', '.rtwpvg-media-video-popup', addMediaVideo);
    $('.woocommerce_variation').each(function () {
      var optionsWrapper = $(this).find('.options');
      var galleryWrapper = $(this).find('.rtwpvg-gallery-wrapper');
      galleryWrapper.insertBefore(optionsWrapper);
    });
  }

  function addImage(event) {
    event.preventDefault();
    event.stopPropagation();
    var that = this;
    var file_frame = 0;
    var product_variation_id = $(this).data('product_variation_id');
    var loop = $(this).data('product_variation_loop');

    if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
      if (file_frame) {
        file_frame.open();
        return;
      }

      file_frame = wp.media.frames.select_image = wp.media({
        title: rtwpvg_admin.choose_image,
        button: {
          text: rtwpvg_admin.add_image
        },
        library: {
          type: ['image']
        },
        multiple: true
      });
      file_frame.on('select', function () {
        var images = file_frame.state().get('selection').toJSON();
        var html = images.map(function (image) {
          if (image.type === 'image') {
            console.log(image);
            var id = image.id,
                rtwpvg_video_link = image.rtwpvg_video_link,
                image_sizes = image.sizes;
            image_sizes = image_sizes === undefined ? {} : image_sizes;
            var thumbnail = image_sizes.thumbnail,
                full = image_sizes.full;
            var url = thumbnail ? thumbnail.url : full.url;
            var template = wp.template('rtwpvg-image');
            return template({
              id: id,
              url: url,
              product_variation_id: product_variation_id,
              loop: loop,
              rtwpvg_video_link: rtwpvg_video_link
            });
          }
        }).join('');
        $(that).parent().prev().find('.rtwpvg-images').append(html);
        sortable();
        variationChanged(that);
      });
      file_frame.open();
    }
  }

  function addMediaVideo(e) {
    e.preventDefault();
    e.stopPropagation();
    var that = this;
    var video_frame = 0;

    if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
      // If the media frame already exists, reopen it.
      if (video_frame) {
        video_frame.open();
        return;
      } // Create the media frame.


      video_frame = wp.media.frames.select_image = wp.media({
        title: rtwpvg_admin.choose_video,
        button: {
          text: rtwpvg_admin.add_video
        },
        library: {
          type: ['video']
        },
        multiple: false
      }); // When a file is selected, run a callback.

      video_frame.on('select', function () {
        var video = video_frame.state().get('selection').first().toJSON();
        console.log(video);

        if (video.type === 'video') {
          $(that).closest('.compat-attachment-fields').find('.compat-field-rtwpvg_video_link input').val(video.url).change();
        }
      }); // Finally, open the modal.

      video_frame.open();
    }
  }

  function removeImage(event) {
    event.preventDefault();
    event.stopPropagation();
    var that = this;
    variationChanged(this);
    setTimeout(function () {
      $(that).parent().remove();
    }, 1);
  }

  function variationChanged(element) {
    $(element).closest('.woocommerce_variation').addClass('variation-needs-update');
    $('button.cancel-variation-changes, button.save-variation-changes').removeAttr('disabled');
    $('#variable_product_options').trigger('woocommerce_variations_input_changed');
  }

  function sortable() {
    $('.rtwpvg-images').sortable({
      items: 'li.image',
      cursor: 'move',
      scrollSensitivity: 40,
      forcePlaceholderSize: true,
      forceHelperSize: false,
      helper: 'clone',
      opacity: 0.65,
      placeholder: 'rtwpvg-sortable-placeholder',
      start: function start(event, ui) {
        ui.item.css('background-color', '#f6f6f6');
      },
      stop: function stop(event, ui) {
        ui.item.removeAttr('style');
      },
      update: function update() {
        variationChanged(this);
      }
    });
  }

  $('#woocommerce-product-data').on('woocommerce_variations_loaded', function () {
    imageUploader();
    sortable();
  });
  $('#variable_product_options').on('woocommerce_variations_added', function () {
    imageUploader();
    sortable();
  });
})(jQuery);
