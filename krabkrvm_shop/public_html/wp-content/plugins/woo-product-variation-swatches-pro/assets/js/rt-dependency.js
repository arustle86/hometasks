function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

(function ($, document) {
  'use strict';

  $.fn.RtDependency = function (options) {
    var settings = $.extend({
      'attribute': 'rt-depends',
      'rules': {}
    }, options);

    var isEmpty = function isEmpty(value) {
      if (typeof value === 'null' || typeof value === 'undefined') {
        return true;
      }

      if (typeof value == 'string') {
        return $.trim(value) === '';
      }

      if (_typeof(value) === 'object') {
        if ($.isArray(value)) {
          var _tmp = $.map(value, function (val, i) {
            return $.trim(val) === '' ? null : val;
          });

          return $.isEmptyObject(_tmp);
        } else {
          return $.isEmptyObject(value);
        }
      }
    };
    /**
     * Check array exists on array
     * @param needleArray
     * @param haystackArray
     * @param strict
     * @returns {boolean}
     */


    var arrayInArraysHelper = function arrayInArraysHelper(needleArray, haystackArray, strict) {
      if (typeof strict == 'undefined') {
        strict = false;
      }

      if (needleArray == null) {
        needleArray = [];
      }

      if (strict === true) {
        return needleArray.sort().join(',').toLowerCase() === haystackArray.sort().join(',').toLowerCase();
      } else {
        for (var i = 0; i < needleArray.length; i++) {
          if (haystackArray.indexOf(needleArray[i]) >= 0) {
            return true;
          }
        }

        return false;
      }
    };
    /**
     * Check string exist on array value
     * @param needleString
     * @param haystackArray
     * @returns {boolean}
     */


    var stringInArraysHelper = function stringInArraysHelper(needleString, haystackArray) {
      return $.inArray(needleString, haystackArray) >= 0 && $.isArray(haystackArray);
    };

    var equalDependency = function equalDependency(element, depObject, parent, useEvent) {
      if (typeof useEvent == 'undefined') {
        useEvent = false;
      }

      if (typeof $(parent).prop("tagName") == 'undefined') {
        return false;
      }

      var tag = $(parent).prop("tagName").toLowerCase();
      var type = $(parent).prop("type").toLowerCase();
      var name = tag + ':' + type;
      var equalLike = typeof depObject.like != 'undefined';
      var value = $(parent).val(); // show if empty?. default false

      depObject.empty = typeof depObject.empty === 'undefined' ? false : depObject.empty;
      depObject.strict = typeof depObject.strict === 'undefined' ? false : depObject.strict;

      if (equalLike) {
        var eqtag = $(depObject.like).prop("tagName").toLowerCase();
        var eqtype = $(depObject.like).prop("type").toLowerCase();
        var eqname = eqtag + ':' + eqtype;

        if (eqname === 'input:checkbox' || eqname === 'input:radio') {
          depObject.value = $(depObject.like + ':checked').map(function () {
            return this.value;
          }).get();
        } else {
          depObject.value = $(depObject.like).val();

          if (!showOnEmptyValue) {
            depObject.value = $.trim($(depObject.like).val()) === '' ? null : $(depObject.like).val();
          }
        }
      }

      switch (name) {
        case "input:text":
        case "input:password":
        case "input:number":
        case "input:date":
        case "input:email":
        case "input:url":
        case "input:tel":
        case "textarea:textarea":
        case "select:select-one":
          if ($.trim(value) === depObject.value) {
            $(element).show();
          } else if (stringInArraysHelper(value, depObject.value)) {
            $(element).show();
          } else {
            if ($.trim(value) === '' && depObject.empty) {
              $(element).show();
            } else {
              $(element).hide();
            }
          }

          break;

        case "input:checkbox":
        case "input:radio":
          value = $(parent + ':checked').map(function () {
            return this.value;
          }).get();

          if (value === depObject.value) {
            $(element).show();
          } else if (stringInArraysHelper(value, depObject.value)) {
            $(element).show();
          } else if (arrayInArraysHelper(value, depObject.value, depObject.strict)) {
            $(element).show();
          } else {
            if (isEmpty(value) && depObject.empty) {
              $(element).show();
            } else {
              $(element).hide();
            }
          }

          break;

        case "select:select-multiple":
          if (arrayInArraysHelper(value, depObject.value, depObject.strict)) {
            $(element).show();
          } else {
            if (value == null && depObject.empty) {
              $(element).show();
            } else {
              $(element).hide();
            }
          }

          break;
      }

      if (useEvent) {
        $(document.body).on('input change', $(parent), function (e) {
          equalDependency(element, depObject, parent, false);
        });
      }
    };

    var useTypes = function useTypes($el, $data) {
      $.each($data, function (selector, depObject) {
        switch (depObject.type) {
          case "equal":
          case "==":
          case "=":
            equalDependency($el, depObject, selector, true);
            break;
        }
      });
    };

    return this.each(function () {
      var $data = $(this).data(settings.attribute.replace('data-', '').trim());

      if ($data) {
        $(this).addClass('has-rt-dependent');
        $.each($data, function (i, obj) {
          useTypes($(this), obj);
        }.bind(this));
      }
    });
  };
})(jQuery, document);
