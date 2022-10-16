(function ($) {
    'use strict';

    $(function () {

        //$(".rt-tab-nav:not(.kcseo_schema_meta) li:first-child a").trigger('click');
        // $("#rt-schema-tab-holder .rt-tab-content").each(function () {
        //     var self = $(this),
        //         nav = self.parents("#rt-schema-tab-holder").find('.rt-tab-nav'),
        //         active = self.find("div[id$=_active-container] input");
        //     if (active.is(":checked")) {
        //         var id = self.attr('id');
        //         nav.find('li[data-id=' + id + '] a').trigger('click');
        //         return false;
        //     }
        // });

        wpSeoShowHideType();
        showHideQuestionFieldsOnChangetype();
        if ($.fn.select2) {
            if ($("#kcseo-wordpres-seo-structured-data-schema-meta-box").length) {
                $("select.select2").select2({
                    dropdownAutoWidth: true,
                    width: '100%'
                });
            } else {
                $("select.select2").select2({
                    dropdownAutoWidth: true
                });
            }
        }

        $('.schema-tooltip').each(function () { // Notice the .each() loop, discussed below
            $(this).qtip({
                content: {
                    text: $(this).next('div') // Use the "div" element next to this for the content
                },
                hide: {
                    fixed: true,
                    delay: 300
                }
            });
        });
    });

    $("#site_type, #_schema_aggregate_rating_schema_type").on('change', function () {
        wpSeoShowHideType();
    });

    $(document).on('change', '#_schema_question_type', function () {
        showHideQuestionFieldsOnChangetype();
    });

    $(document).on('click', ".social-remove", function () {
        if (confirm("Are you sure?")) {
            $(this).parent('.sfield').slideUp('slow', function () {
                $(this).remove();
            });
        }
    });

    $("#social-add").on('click', function () {
        var bindElement = $("#social-add");
        var count = $("#social-field-holder .sfield").length;
        var arg = {
            id: count,
            action: 'newSocial'
        };
        AjaxCall(bindElement, arg, function (data) {
            if (data.data) {
                $("#social-field-holder").append(data.data);
            }
        });
    });

    $(".rt-tab-nav li").on('click', 'a', function (e) {
        e.preventDefault();
        var $this = $(this),
            li = $this.parent(),
            container = $this.parents('.rt-tab-container'),
            nav = container.children('.rt-tab-nav'),
            content = container.children(".rt-tab-content"),
            id = li.data('id');
        content.removeClass('active');
        nav.find('li').removeClass('active');
        li.addClass('active');
        container.find('#' + id).addClass('active');
        container.find('#_kcseo_ative_tab').val(id);
    });

    $(document).on("click", 'span.kSeoImgAdd', function (e) {
        var file_frame,
            $this = $(this).parents('.kSeo-image-wrapper');
        if (undefined !== file_frame) {
            file_frame.open();
            return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or Upload Media For your profile gallery',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });
        file_frame.on('select', function () {
            var attachment = file_frame.state().get('selection').first().toJSON(),
                imgId = attachment.id,
                imgUrl = (typeof attachment.sizes.thumbnail === "undefined") ? attachment.url : attachment.sizes.thumbnail.url,
                imgInfo = "<span><strong>URL: </strong>" + attachment.sizes.full.url + "</span>",
                imgInfo = imgInfo + "<span><strong>Width: </strong>" + attachment.sizes.full.width + "px</span>",
                imgInfo = imgInfo + "<span><strong>Height: </strong>" + attachment.sizes.full.height + "px</span>";
            $this.find('input').val(imgId);
            $this.find('.kSeoImgRemove').removeClass('kSeo-hidden');
            $this.find('img').remove();
            $this.find('.kSeo-image-preview').append("<img src='" + imgUrl + "' />");
            $this.parents('.kSeo-image').find('.image-info').html(imgInfo);
        });
        // Now display the actual file_frame
        file_frame.open();
    });

    $(".kSeoImgRemove").on("click", function (e) {
        e.preventDefault();
        if (confirm("Are you sure?")) {
            var $this = $(this).parents('.kSeo-image-wrapper');
            $this.find('input').val('');
            $this.find('.kSeoImgRemove').addClass('kSeo-hidden');
            $this.find('img').remove();
            $this.parents('.kSeo-image').find('.image-info').html('');
        }
    });

    $("#kcseo-settings").on('submit', function (e) {
        e.preventDefault();

        $('#response').hide();
        var arg = $(this).serialize(),
            arg = arg + '&action=kcSeoWpSchemaSettings',
            bindElement = $('#tlpSaveButton');
        AjaxCall(bindElement, arg, function (data) {
            $('#response').addClass('updated');
            if (!data.error) {
                $('#response').removeClass('error');
                $('#response').show('slow').text(data.msg);
            } else {
                $('#response').addClass('error');
                $('#response').show('slow').text(data.msg);
            }
        });

        return false;
    });
    $("#kcseo-main-settings").on('submit', function (e) {
        e.preventDefault();
        $('#response').hide();
        var arg = $(this).serialize(),
            arg = arg + "&action=kcSeoMainSettings_action",
            bindElement = $('#tlpSaveButton');
        AjaxCall(bindElement, arg, function (data) {
            $('#response').addClass('updated');
            if (!data.error) {
                $('#response').removeClass('error');
                $('#response').show('slow').text(data.msg);
            } else {
                $('#response').addClass('error');
                $('#response').show('slow').text(data.msg);
            }
        });
        return false;
    });

    $(".kc-auto-fill").on('click', function () {
        var self = $(this),
            wrapper = self.parents('.rt-tab-content'),
            schema_id = wrapper.attr('id').replace("_schema_", ""),
            post_id = $('#post_ID').val(),
            data = {
                schema_id: schema_id,
                post_id: post_id,
                action: 'get_schema_data_action'
            };

        AjaxCall(self, data, function (data) {
            $.each(data.data, function (key, value) {
                if (value) {
                    if (key === 'image' || key === 'publisherImage') {
                        var wrapper = $("#_schema_" + schema_id + "_" + key + "-content"),
                            imgInfo = "<span><strong>URL: </strong>" + value.url + "</span>",
                            imgInfo = imgInfo + "<span><strong>Width: </strong>" + value.width + "px</span>",
                            imgInfo = imgInfo + "<span><strong>Height: </strong>" + value.height + "px</span>";
                        wrapper.find('input[name="_schema_' + schema_id + '[image]"]').val(value.id);
                        wrapper.find('.kSeo-image-preview').html("<img src='" + value.thumb_url + "' />");
                        wrapper.find('.kSeoImgRemove').removeClass('kSeo-hidden');
                        wrapper.find('.image-info').html(imgInfo);
                    } else {
                        var field = $("#_schema_" + schema_id + "_" + key),
                            type = field['0'].type;
                        if (type === 'select-one') {
                            field.val(value).trigger('change');
                        } else {
                            field.val(value);
                        }
                    }
                }
            });

        });

    });
    $("#kcseo-add-address").on('click', function () {
        var self = $(this),
            wrapper = self.parents('.kcseo-address-wrapper'),
            target = $(".kcseo-address-holder", wrapper),
            html = $("<div class='multiple-address-item' />"),
            count = target.find(".multiple-address-item").length,
            address_label_count = count + 1,
            tool = "<td><span class='kc-remove-address'><span class='dashicons dashicons-trash'></span>Remove</span></td>";
        html.hide();
        var table = $("#kcseo-main-address").clone(),
            ad_lbl = table.find('.kc-address-label th');
        table.removeAttr('id');
        table.find('span.select2.select2-container.select2-container--default').remove();
        table.find('select.select2').removeClass('select2-hidden-accessible').removeAttr('tabindex').removeAttr('aria-hidden');
        ad_lbl.text(ad_lbl.text() + " " + address_label_count);
        table.find('.kc-address-label').append(tool);
        table.find("input, select, textarea").each(function () {
            $(this).attr('name', $(this).attr('name').replace('address', "_multiple_address[" + count + "]"));
        });
        html.append(table);
        target.append(html);
        html.slideDown(500);
        if ($.fn.select2) {
            $("select.select2", html).select2({
                dropdownAutoWidth: true
            });
        }
    });
    $(document).on('click', 'span.kc-remove-address', function () {
        $(this).parents(".multiple-address-item").slideUp(500, function () {
            $(this).remove();
        })
    });
    $(".kc-new-schema").on('click', function () {
        var self = $(this),
            wrapper = self.parents('.rt-tab-content'),
            target = $(".rt-multiple-schema-wrapper", wrapper),
            schema_id_full = wrapper.attr('id'),
            html = $("<div class='multiple-schema-item' />"),
            count = target.find(".multiple-schema-item").length,
            post_fix = "_" + count;
        html.append("<div class='kc-multiple-schema-tool'><span class='kc-remove-schema'><span class='dashicons dashicons-trash'></span>Remove</span></div>");
        html.hide();
        wrapper.find("> .field-container ").each(function () {
            if ($(this).attr("id") !== schema_id_full + "_active-container") {
                var item = $(this).clone(),
                    field = item.find(".field-content").find("input, select, textarea") || '',
                    name = field.attr("name") || '',
                    field_container = item.find(".field-content"),
                    label = item.find("label.field-label"),
                    label_for = label.attr("for") + post_fix;
                console.log(field, name, field_container, label, label_for);
                item.attr("id", item.attr("id") + post_fix);
                label.attr("for", label_for);
                field_container.attr("id", field_container.attr("id") + post_fix);
                if (name) {
                    field.attr("id", label_for);
                    field.attr("name", name.replace(schema_id_full, schema_id_full + "_multiple[" + count + "]"));
                }
                html.append(item);
            }
        });
        target.append(html);
        html.slideDown(500);
    });
    $(document).on('click', '.kcseo-group-duplicate', function () {
        var self = $(this),
            wrapper = self.parents('.kcseo-group-wrapper'),
            target = self.parents(".kcseo-group-item"),
            group_id = wrapper.attr('data-group-id'),
            group_index = target.attr('data-index'),
            count = wrapper.find(".kcseo-group-item").length,
            post_fix = "_" + count,
            html = $("<div class='kcseo-group-item' data-index='" + count + "' />");
        html.append('<div class="kc-top-toolbar"><span class="kcseo-remove-group"><span class="dashicons dashicons-trash"></span>Remove</span></div>');
        html.hide();
        target.find("> .field-container ").each(function () {
            var item = $(this).clone(),
                field = item.find(".field-content").find("input, select, textarea") || '',
                name = field.attr("name") || '',
                field_container = item.find(".field-content"),
                label = item.find("label.field-label"),
                label_for = label.attr("for") + post_fix;
            item.attr("id", item.attr("id") + post_fix);
            label.attr("for", label_for);
            field_container.attr("id", field_container.attr("id") + post_fix);
            if (name) {
                field.attr("id", label_for);
                field.attr("name", name.replace(group_id + "[" + group_index + "]", group_id + "[" + count + "]"));
            }
            html.append(item);
        });
        if(wrapper.data('duplicate') === 1){
            html.append('<div class="kc-bottom-toolbar"><span class="button button-primary kcseo-group-duplicate">Duplicate Item</span></div>');
        }
        wrapper.append(html);
        html.slideDown(500);
    });

    $(document).on('click', 'span.kcseo-remove-group', function () {
        var self = $(this),
            wrapper = self.parents('.kcseo-group-wrapper'),
            target = self.parents(".kcseo-group-item"),
            group_id = wrapper.attr('data-group-id');
        target.slideUp(500, function () {
            $(this).remove();
            wrapper.find("> .kcseo-group-item ").each(function (count, v) {
                var group_index = $(this).attr('data-index'),
                    post_fix = "_" + count;
                $(this).attr('data-index', count);
                $(this).find("> .field-container ").each(function () {
                    var item = $(this),
                        field = item.find(".field-content").find("input, select, textarea") || '',
                        name = field.attr("name") || '',
                        field_container = item.find(".field-content"),
                        label = item.find("label.field-label"),
                        label_for = label.attr("for") + post_fix;
                    item.attr("id", item.attr("id") + post_fix);
                    label.attr("for", label_for);
                    field_container.attr("id", field_container.attr("id") + post_fix);
                    if (name) {
                        field.attr("id", label_for);
                        field.attr("name", name.replace(group_id + "[" + group_index + "]", group_id + "[" + count + "]"));
                    }
                });
            });
        });


    });

    $(document).on('click', 'span.kc-remove-schema', function () {
        $(this).parents(".multiple-schema-item").slideUp(500, function () {
            $(this).remove();
        })
    });

    function wpSeoShowHideType() {
        if ($('#_schema_aggregate_rating_schema_type').length) {
            var id = $("#_schema_aggregate_rating_schema_type option:selected").val();
        }
        if ($('#site_type').length) {
            var id = $("#site_type option:selected").val();
        }

        if (id == "Person") {
            $(".form-table tr.person, .aggregate-person-holder").show();
        } else {
            $(".form-table tr.person, .aggregate-person-holder").hide();
        }
        if (id == "Organization") {
            $(".form-table tr.business-info,.form-table tr.all-type-data, .aggregate-except-organization-holder").hide();
        } else {
            $(".form-table tr.business-info,.form-table tr.all-type-data, .aggregate-except-organization-holder").show();
        }

        if ($.inArray(id, ['FoodEstablishment', 'Bakery', 'BarOrPub', 'Brewery', 'CafeOrCoffeeShop', 'FastFoodRestaurant', 'IceCreamShop', 'Restaurant', 'Winery']) >= 0) {
            $(".form-table tr.restaurant").show();
        } else {
            $(".form-table tr.restaurant").hide();
        }
    }

    function showHideQuestionFieldsOnChangetype() {
        var faqType = $("#_schema_question_type").val();
        if (faqType === "Question") {
            $('.kcseo-faq-question-holder').show();
            $('.kcseo-faq-ask-action-holder').hide();
        } else {
            $('.kcseo-faq-question-holder').hide();
            $('.kcseo-faq-ask-action-holder').show();
            if (faqType === "AskAction") {
                $('.kcseo-faq-ask-action-holder.kcseo-faq-ask-action-answer-holder').hide();
            }
        }
    }

    function AjaxCall(element, data, handle) {

        $.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            beforeSend: function () {
                $("<span class='wseo_loading'></span>").insertAfter(element);
            },
            success: function (data) {
                $(".wseo_loading").remove();
                handle(data);
            }
        });
    }

})(jQuery);
