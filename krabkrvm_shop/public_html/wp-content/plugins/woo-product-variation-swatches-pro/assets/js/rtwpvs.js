(function ($) {
  'use strict';

  $.fn.rtWpvsVariationSwatchesForm = function () {
    this._variation_form = $(this);
    this.product_variations = this._variation_form.data('product_variations');
    this._is_ajax = !!this.product_variations;
    this._out_of_stock = {};
    this._is_mobile = $('body').hasClass('rtwpvs-is-mobile');

    this.start = function () {
      var that = this;

      this._variation_form.find('.rtwpvs-terms-wrapper').each(function () {
        var attribute = $(this),
            wc_select = attribute.parent().find('select.rtwpvs-wc-select');
        attribute.on('touchstart click', '.rtwpvs-term:not(.rtwpvs-radio-term)', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var self = $(this),
              is_selected = self.hasClass('selected'),
              term = self.data('term');

          if (is_selected && rtwpvs_params.reselect_clear) {
            term = '';
          }

          wc_select.val(term).trigger('change').trigger('click').trigger('focusin');

          if (that._is_mobile) {
            wc_select.trigger('touchstart');
          }

          self.trigger('focus');

          if (is_selected) {
            self.trigger('rtwpvs-unselected-term', [term, wc_select, this._variation_form]);
          } else {
            self.trigger('rtwpvs-selected-term', [term, wc_select, this._variation_form]);
          }
        }); // Radio attributes trigger

        attribute.on('change', 'input.rtwpvs-radio-button-term:radio', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var radioTerm = $(this),
              term = radioTerm.val(),
              termWrapper = radioTerm.parent('.rtwpvs-term.rtwpvs-radio-term'),
              is_selected = termWrapper.hasClass('selected');

          if (is_selected && rtwpvs_params.reselect_clear) {
            term = '';
          }

          wc_select.val(term).trigger('change').trigger('click').trigger('focusin');

          if (that._is_mobile) {
            wc_select.trigger('touchstart');
          }

          if (rtwpvs_params.reselect_clear) {
            if (is_selected) {
              _.delay(function () {
                radioTerm.prop('checked', false);
                termWrapper.trigger('rtwpvs-unselected-term', [term, wc_select, this._variation_form]);
              }, 1);
            } else {
              termWrapper.trigger('rtwpvs-selected-term', [term, wc_select, this._variation_form]);
            }
          } else {
            if (!rtwpvs_params.reselect_clear) {
              radioTerm.parent('.rtwpvs-term.rtwpvs-radio-term').removeClass('selected disabled').addClass('selected').trigger('rtwpvs-selected-term', [term, wc_select, this._variation_form]);
            }
          }
        });

        if (rtwpvs_params.reselect_clear) {
          // Radio attributes
          attribute.on('touchstart click', 'input.rtwpvs-radio-button-term:radio', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).trigger('change');
          });
        }
      });

      setTimeout(function () {
        that._variation_form.trigger('reload_product_variations');

        that._variation_form.trigger('rtwpvs_loaded', [that]);
      }, 1);
    };

    this.update_trigger = function () {
      this._variation_form.on('rtwpvs_loaded', {
        that: this
      }, this.loaded_triggered); // will trigger


      this._variation_form.on('woocommerce_update_variation_values', this.update_variation_triggered); // Will first run


      this._variation_form.on('reset_data', {
        that: this
      }, this.reset_triggered); // will trigger after woocommerce_update_variation_values


      this._variation_form.on('woocommerce_variation_has_changed', {
        that: this
      }, this.variation_has_changed_triggered); // Will run after reset_data

    };

    this.update_variation_triggered = function (e) {
      $(this).find('.rtwpvs-terms-wrapper').each(function () {
        var attribute = $(this),
            wc_select = attribute.parent().find('select.rtwpvs-wc-select'),
            selected = wc_select.find('option:selected').val() || '',
            current = wc_select.find('option:selected'),
            itemIndex = wc_select.find('option').eq(1),
            wc_terms = [];
        wc_select.find('option').each(function () {
          if ($(this).val() !== '') {
            wc_terms.push($(this).val());
            selected = current ? current.val() : itemIndex.val();
          }
        });
        setTimeout(function () {
          attribute.find('.rtwpvs-term').each(function () {
            var item = $(this),
                term = item.attr('data-term');
            item.removeClass('selected disabled').addClass('disabled');

            if (wc_terms.indexOf(term) !== -1) {
              item.removeClass('disabled').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false);

              if (term === selected) {
                item.addClass('selected').find('input.rtwpvs-radio-button-term:radio').prop('checked', true);
              }
            } else {
              item.find('input.rtwpvs-radio-button-term:radio').prop('disabled', true).prop('checked', false);
            }

            if (term === selected) {
              item.addClass('selected').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false).prop('checked', true);
            }
          });
          attribute.trigger('rtwpvs-terms-updated');
        }, 1);
      });
    };

    this.variation_has_changed_triggered = function (e) {
      var that = e.data.that;

      if (!that._is_ajax) {
        $(this).find('.rtwpvs-terms-wrapper').each(function () {
          var attribute = $(this),
              wc_select = attribute.parent().find('select.rtwpvs-wc-select'),
              selected = wc_select.find('option:selected').val() || '',
              current = wc_select.find('option:selected'),
              itemIndex = wc_select.find('option').eq(1),
              wc_terms = [];
          wc_select.find('option').each(function () {
            if ($(this).val() !== '') {
              wc_terms.push($(this).val());
              selected = current ? current.val() : itemIndex.val();
            }
          });
          setTimeout(function () {
            attribute.find('.rtwpvs-term').each(function () {
              var item = $(this),
                  term = item.attr('data-term');
              item.removeClass('selected disabled');

              if (term === selected) {
                item.addClass('selected').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false).prop('checked', true);
              }
            });
            attribute.trigger('rtwpvs-terms-updated');
          }, 1);
        });
      }
    };

    this.reset_triggered = function (e) {
      if (e.data.that._is_ajax) {
        $(this).find('.rtwpvs-terms-wrapper').each(function () {
          var attribute = $(this);
          attribute.find('.rtwpvs-term').removeClass('selected disabled').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false).prop('checked', false);
        });
      }
    };

    this.loaded_triggered = function (e) {
      var that = e.data.that;

      if (that._is_ajax) {
        var attributes = {};
        that.product_variations.map(function (variation) {
          Object.keys(variation.attributes).map(function (attribute) {
            if (!attributes[attribute]) {
              attributes[attribute] = [];
            }

            if (variation.attributes[attribute] && attributes[attribute].indexOf(variation.attributes[attribute]) === -1) {
              attributes[attribute].push(variation.attributes[attribute]);
            }
          });
        });
        $(e.target).find('.rtwpvs-terms-wrapper').each(function () {
          var attribute_name = $(this).data('attribute_name');
          $(this).find('.rtwpvs-term').each(function () {
            var self = $(this),
                term = self.attr('data-term');

            if (!$.isEmptyObject(attributes) && attributes[attribute_name].indexOf(term) === -1) {
              self.removeClass('selected').addClass('disabled').find('input.rtwpvs-radio-button-term:radio').prop('disabled', true).prop('checked', false);
            }
          });
        });
      }
    };

    this.start();
    this.update_trigger();
    return this;
  };

  $.fn.wc_set_variation_attr = function (attr, value) {
    if (undefined === this.attr('data-o_' + attr)) {
      this.attr('data-o_' + attr, !this.attr(attr) ? '' : this.attr(attr));
    }

    if (false === value) {
      this.removeAttr(attr);
    } else {
      this.attr(attr, value);
    }
  };

  $.fn.wc_reset_variation_attr = function (attr) {
    if (undefined !== this.attr('data-o_' + attr)) {
      this.attr(attr, this.attr('data-o_' + attr));
    }
  };

  $.fn.rtWpvsVariationSwatchesArchiveForm = function () {
    this._variation_form = $(this);
    this.product_variations = this._variation_form.data('product_variations');
    this._attributeTerms = this._variation_form.find('.variations select');
    this._is_ajax = !!this.product_variations;
    this._is_archive = this._variation_form.hasClass('rtwpvs-archive-variation-wrapper');
    this._wrapper = this._variation_form.closest(rtwpvs_params.archive_product_wrapper);
    this._is_mobile = $('body').hasClass('rtwpvs-is-mobile');
    this._image = this._wrapper.find(rtwpvs_params.archive_image_selector);
    this._cart_button = this._wrapper.find('.rtwpvs_add_to_cart');
    this._cart_button_ajax = this._wrapper.find('.rtwpvs_ajax_add_to_cart');
    this._cart_button_html = this._cart_button.clone().html();
    this._price = this._wrapper.find('.price');
    this._price_html = this._price.clone().html();
    this._product_id = this._cart_button.data('product_id');
    this.attributeData = {};
    this.selectedData = {};

    if ($.trim(rtwpvs_params.archive_add_to_cart_button_selector)) {
      this._cart_button = this._wrapper.find(rtwpvs_params.archive_add_to_cart_button_selector);
      this._cart_button_ajax = this._wrapper.find(rtwpvs_params.archive_add_to_cart_button_selector);
    }

    this.setAttributeData = function () {
      var that = this;

      this._attributeTerms.each(function () {
        var taxonomy = $(this).data('attribute_name') || $(this).attr('data-attribute_name');
        var taxonomy_terms = [];
        $(this).find('.rtwpvs-term').each(function () {
          taxonomy_terms.push($(this).data('term') || $(this).attr('data-term'));
        });
        that.attributeData[taxonomy] = taxonomy_terms;
      });
    };

    this.setSelectedData = function () {
      var that = this;

      this._attributeTerms.each(function () {
        var taxonomy = $(this).data('attribute_name') || $(this).attr('name');
        var value = $(this).val() || '';
        that.selectedData[taxonomy] = value;
      });
    };

    this.variation_changed = function (e) {
      var that = e.data.variationForm;
      var matching_variations = that.findMatchingVariations(that.product_variations, that.selectedData),
          variation = matching_variations.shift();

      if (variation) {
        _.delay(function () {
          that._variation_form.trigger('found_variation.rtwpvs-archive-variation', [variation]);

          that._variation_form.trigger('hide_variation');

          that._variation_form.trigger('rtwpvs_archive_found_variation', [that, variation]);
        }, 50);
      } else {
        that._variation_form.trigger('update_variation_values.rtwpvs-archive-variation');

        that._variation_form.trigger('reset_data.rtwpvs-archive-variation');
      }
    };

    this.resetArchiveVariation = function () {
      var $price = this._wrapper.find('.price'),
          $view_cart_button = this._wrapper.find('.added_to_cart'),
          $view_cart_button2 = this._wrapper.find('.added_to_cart_button');

      $price.html(this._price_html);

      this._cart_button.data('variation_id', '');

      this._cart_button.data('variation', ''); //  If not catalog mode


      if (!rtwpvs_params.archive_swatches_enable_single_attribute) {
        //
        if (rtwpvs_params.archive_add_to_cart_select_options) {
          this._cart_button.html(rtwpvs_params.archive_add_to_cart_select_options);
        } else {
          if (wc_add_to_cart_variation_params.i18n_select_options.trim()) {
            this._cart_button.text(wc_add_to_cart_variation_params.i18n_select_options);
          }
        }

        if ('no' === wc_add_to_cart_variation_params.enable_ajax_add_to_cart) {
          this._cart_button.prop('href', this._cart_button.data('product_permalink'));
        }
      } // Resetting Buttons


      this._cart_button.removeClass('added');

      if ($view_cart_button.length > 0) {
        $view_cart_button.remove();
      }

      if ($view_cart_button2.length > 0) {
        $view_cart_button2.remove();
      }
    };

    this.initVariationURL = function () {
      var that = this;
      var url = new URL(window.location.toString());
      var search = url.searchParams.toString();
      var originalUrl = url.origin + url.pathname;

      this._variation_form.on('check_variations.wc-variation-form', function (event) {
        var attributes = void 0;

        if (rtwpvs_params.has_wc_bundles) {
          url = new URL(window.location.toString());
          search = url.searchParams.toString();
          attributes = that.getChosenAttributesBundleSupport();
        } else {
          attributes = that.getChosenAttributes();
        }

        var attributesObject = Object.keys(attributes).reduce(function (attrs, current) {
          if (attributes[current]) {
            attrs[current] = attributes[current];
          }

          return attrs;
        }, {});
        var searchObject = that.urlParamsToObj(search);
        var data = Object.assign({}, searchObject, attributesObject);
        var params = $.param(data);
        window.history.pushState({}, '', that.setUrlParams(originalUrl, params));
      });
    };

    this.init_trigger = function () {
      if (this._is_archive) {
        var that = this;

        this._variation_form.on('found_variation.rtwpvs-archive-variation', {
          variationForm: this._variation_form
        }, function (event, variation) {
          event.stopPropagation();
          that.variationsImageUpdate(variation);

          var template = false,
              $template_html = '',
              $view_cart_button = that._wrapper.find('.added_to_cart'),
              $view_cart_button2 = that._wrapper.find('.added_to_cart_button'),
              $price = that._wrapper.find('.price');

          if (!variation.variation_is_visible) {
            template = wp.template('unavailable-variation-template');
          } else {
            template = wp.template('rtwpvs-variation-template');
          }

          $template_html = template({
            variation: variation,
            price_html: $(variation.price_html).unwrap().html() || that._price_html
          });
          $template_html = $template_html.replace('/*<![CDATA[*/', '');
          $template_html = $template_html.replace('/*]]>*/', '');
          $price.html($template_html);

          that._cart_button.data('variation_id', variation.variation_id);

          that._cart_button.data('variation', that.getChosenAttributes());

          if (!rtwpvs_params.archive_swatches_enable_single_attribute) {
            // Cart Text
            if (rtwpvs_params.archive_add_to_cart_text) {
              that._cart_button.html(rtwpvs_params.archive_add_to_cart_text);
            } else {
              if (wc_add_to_cart_variation_params.i18n_add_to_cart.trim()) {
                that._cart_button.text(wc_add_to_cart_variation_params.i18n_add_to_cart);
              }
            } // Ajax Add to cart


            if ('no' === wc_add_to_cart_variation_params.enable_ajax_add_to_cart) {
              var params = $.param(Object.assign({}, {
                'add-to-cart': that._product_id,
                variation_id: variation.variation_id
              }));

              that._cart_button.prop('href', that.setUrlParams(that._cart_button.data('add_to_cart_url'), params));
            }
          } // Resetting Buttons


          that._cart_button.removeClass('added');

          if ($view_cart_button.length > 0) {
            $view_cart_button.remove();
          }

          if ($view_cart_button2.length > 0) {
            $view_cart_button2.remove();
          }
        });

        this._variation_form.on('reset_image.rtwpvs-archive-variation', {
          variationForm: this._variation_form
        }, function (event) {
          that.variationsImageUpdate(false);
        });

        this._variation_form.on('reset_data.rtwpvs-archive-variation', {
          variationForm: this._variation_form
        }, function (event) {
          that.resetArchiveVariation();
        });
      } else {
        if (rtwpvs_params.enable_variation_url) {
          this.initVariationURL();
        }
      } // Add to cart trigger


      this._cart_button_ajax.off('click.rtwpvs-archive-add-to-cart');

      this._cart_button_ajax.on('click.rtwpvs-archive-add-to-cart', function (event) {
        var $button = $(this);

        if (rtwpvs_params.archive_swatches_enable_single_attribute) {
          return true;
        }

        if (!$button.data('variation_id')) {
          return true;
        }

        event.preventDefault(); // Don't move it

        event.stopPropagation(); // Don't move it

        $button.removeClass('added').addClass('loading');
        var data = {
          action: "rtwpvs_add_variation_to_cart"
        };
        $.each($button.data(), function (key, value) {
          data[key] = value;
        }); // TODO
        // Trigger event.

        $(document.body).trigger('adding_to_cart', [$button, data]); // Ajax action.

        $.post(wc_add_to_cart_variation_params.ajax_url.toString(), data, function (response) {
          if (!response) {
            return;
          }

          if (response.error && response.product_url) {
            window.location = response.product_url;
            return;
          } // Redirect to cart option


          if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
            window.location = wc_add_to_cart_params.cart_url;
            return;
          } // Trigger event so themes can refresh other areas.


          $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
        });
      });
    };

    this.setUrlParams = function (url, query) {
      if (query) {
        query = query.trim().replace(/^(\?|#|&)/, '').replace(/(\?|#|&)$/, '');
        query = query ? '?' + query : query;
        var parts = url.split(/[\?\#]/);
        var start = parts[0];

        if (query && /\:\/\/[^\/]*$/.test(start)) {
          start = start + '/';
        }

        var match = url.match(/(\#.*)$/);
        url = start + query;

        if (match) {
          url = url + match[0];
        }
      }

      return url;
    };

    this.urlParamsToObj = function (search) {
      var keys = Array.from(new URLSearchParams(search).keys());
      var obj = {};

      for (var i = 0; i < keys.length; i++) {
        var key = keys[i];
        obj[key] = new URLSearchParams(search).get(key);
      }

      return obj;
    };

    this.init = function () {
      this.init_trigger();
      var that = this;

      _.delay(function () {
        that.setDefaultImages();

        that._variation_form.trigger('rtwpvs_archive_init', [that, that.product_variations]);

        $(document).trigger('rtwpvs_archive_init_loaded', [that._variation_form, that.product_variations]);
      }, 2);
    };

    this.setDefaultImages = function () {
      var that = this;

      _.delay(function () {
        that._variation_form.find('.rtwpvs-terms-wrapper > .rtwpvs-term:not(.disabled)').each(function (i, el) {
          $(this).off('rtwpvs-selected-item.archive-image-hover');
          $(this).off('rtwpvs-selected-item.archive-image-click');
          $(this).off('mouseenter.archive-image-hover');
          $(this).off('mouseleave.archive-image-hover');

          if (rtwpvs_params.archive_swatches_display_event === 'hover') {
            $(this).on('mouseenter.archive-image-hover', function (event) {
              event.stopPropagation();
              $(this).trigger('click').trigger('focusin');

              if (that._is_mobile) {
                $(this).trigger('touchstart');
              }
            });
          }
        });
      }, 2);
    };

    this.variationsImageUpdate = function (variation) {
      var product_image = this._wrapper.find(rtwpvs_params.archive_image_selector);

      product_image.addClass('rtwpvs-image-load').one('webkitAnimationEnd oanimationend msAnimationEnd animationend webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
        $(this).removeClass('rtwpvs-image-load');
      });

      if (variation && variation.image && variation.image.thumb_src && variation.image.thumb_src.length > 1) {
        product_image.wc_set_variation_attr('src', variation.image.thumb_src);
        product_image.wc_set_variation_attr('height', variation.image.thumb_src_h);
        product_image.wc_set_variation_attr('width', variation.image.thumb_src_w);
        product_image.wc_set_variation_attr('srcset', variation.image.thumb_srcset);
        product_image.wc_set_variation_attr('sizes', variation.image.thumb_sizes);
        product_image.wc_set_variation_attr('title', variation.image.title);
        product_image.wc_set_variation_attr('alt', variation.image.alt);
      } else {
        product_image.wc_reset_variation_attr('src');
        product_image.wc_reset_variation_attr('width');
        product_image.wc_reset_variation_attr('height');
        product_image.wc_reset_variation_attr('srcset');
        product_image.wc_reset_variation_attr('sizes');
        product_image.wc_reset_variation_attr('title');
        product_image.wc_reset_variation_attr('alt');
      }
    };

    this.isMatch = function (variation_attributes, attributes) {
      var match = true;

      for (var attr_name in variation_attributes) {
        if (variation_attributes.hasOwnProperty(attr_name)) {
          var val1 = variation_attributes[attr_name];
          var val2 = attributes[attr_name];

          if (val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2) {
            match = false;
          }
        }
      }

      return match;
    };

    this.findMatchingVariations = function (variations, attributes) {
      var matching = [];

      for (var i = 0; i < variations.length; i++) {
        var variation = variations[i];

        if (this.isMatch(variation.attributes, attributes)) {
          matching.push(variation);
        }
      }

      return matching;
    };

    this.getChosenAttributesBundleSupport = function () {
      var data = {};

      this._attributeTerms.each(function () {
        var attribute_name = $(this).attr('name');
        data[attribute_name] = $(this).val() || '';
      });

      return data;
    };

    this.getChosenAttributes = function () {
      var data = {};

      this._attributeTerms.each(function () {
        var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
        data[attribute_name] = $(this).val() || '';
      });

      return data;
    };

    this.init();
    $(document).trigger('rtwpvs_archive', [this._variation_form]);
  };

  $(document).on('wc_variation_form', '.variations_form', function () {
    $(this).rtWpvsVariationSwatchesForm();
    $(this).rtWpvsVariationSwatchesArchiveForm();
  }); // Support for Jetpack's Infinite Scroll,

  $(document.body).on('post-load', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for Yith Infinite Scroll

  $(document).on('yith_infs_added_elem', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for Yith Ajax Filter

  $(document).on('yith-wcan-ajax-filtered', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for Woodmart theme

  $(document).on('wood-images-loaded', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for berocket ajax filters

  $(document).on('berocket_ajax_products_loaded', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Flatsome Infinite Scroll Support

  $('.shop-container .products').on('append.infiniteScroll', function (event, response, path) {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // FacetWP Load More

  $(document).on('facetwp-loaded', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // WooCommerce Filter Nav

  $('body').on('aln_reloaded', function () {
    _.delay(function () {
      $('.variations_form').each(function () {
        $(this).wc_variation_form();
      });
    }, 100);
  });
})(jQuery);
