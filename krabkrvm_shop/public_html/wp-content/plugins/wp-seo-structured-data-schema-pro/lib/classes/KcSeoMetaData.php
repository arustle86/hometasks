<?php

if (!class_exists('KcSeoMetaData')):

    class KcSeoMetaData
    {

        function __construct() {
            add_action('admin_head', array($this, 'admin_head'));
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
            add_action('save_post', array($this, 'save_KcSeo_schema_data'), 10, 3);
        }

        function admin_enqueue_scripts() {
            global $pagenow, $typenow, $KcSeoWPSchema;
            // validate page
            $pt = $KcSeoWPSchema->kcSeoPostTypes();
            if (!in_array($pagenow, array('post.php', 'post-new.php'))) {
                return;
            }
            if (!in_array($typenow, $pt)) {
                return;
            }

            // scripts
            wp_enqueue_script(array(
                'jquery',
                'kcseo-select2-js',
                'kcseo-admin-js',
            ));

            // styles
            wp_enqueue_style(array(
                'kcseo-select2-css',
                'kcseo-admin-css',
            ));


            if (wp_style_is('jquery-ui-style', 'registered') && wp_style_is('jquery-ui-style', 'enqueued')) {
                wp_enqueue_style('jquery-ui-style');
            }
        }

        function admin_head() {
            global $KcSeoWPSchema;
            $pt = $KcSeoWPSchema->kcSeoPostTypes();
            foreach ($pt as $postType) {
                add_meta_box(
                    'kcseo-wordpres-seo-structured-data-schema-meta-box',
                    __('WP SEO Structured Data Schema by <a href="https://wpsemplugins.com/">wpsemplugins.com</a>', "wp-seo-structured-data-schema-pro"),
                    array($this, 'meta_box_wp_schema'),
                    $postType,
                    'normal',
                    'high'
                );
            }

        }

        function meta_box_wp_schema($post) {
            global $KcSeoWPSchema;
            wp_nonce_field($KcSeoWPSchema->nonceText(), '_kcseo_nonce');
            $_kcseo_ative_tab = get_post_meta($post->ID, '_kcseo_ative_tab', true);

            $schemas = new KcSeoSchemaModel;
            $html = null;
            $html .= "<div class='schema-tips'>";
            $html .= "<p><span>Tip:</span> " . __("For more detailed information on how to configure this plugin, please visit:", "wp-seo-structured-data-schema-pro") . " <a href='https://wpsemplugins.com/wordpress-seo-structured-data-schema-plugin/'>https://wpsemplugins.com/wordpress-seo-structured-data-schema-plugin/</a></p>";
            $html .= "<p><span>Tip:</span> " . __("Once you save these structured data schema settings, validate this page url here:", "wp-seo-structured-data-schema-pro") . " <a href='https://developers.google.com/structured-data/testing-tool/'>https://developers.google.com/structured-data/testing-tool/</a></p>";
            $html .= "</div>";
            $html .= "<div class='schema-holder'>";
            $html .= '<div id="rt-schema-tab-holder" class="rt-tab-container">';
            $htmlMenu = null;
            $htmlCont = null;
            $htmlMenu .= "<ul class='rt-tab-nav kcseo_schema_meta'>";
            $schemaFields = KcSeoOptions::getSchemaTypes();
            $settings = get_option($KcSeoWPSchema->options['main_settings']);
            $publusher_name = !empty($settings['publisher']['name']) ? esc_attr($settings['publisher']['name']) : null;
            $publusher_logo = !empty($settings['publisher']['logo']) ? esc_attr($settings['publisher']['logo']) : null;
            $i = 0;
            foreach ($schemaFields as $schemaID => $schema) {
                $tabId = $KcSeoWPSchema->KcSeoPrefix . $schemaID;
                $activeClass = ((!$_kcseo_ative_tab && $i === 0) || $tabId === $_kcseo_ative_tab) ? ' active' : null;
                $i++;
                $htmlMenu .= '<li data-id="' . $tabId . '" class="' . $activeClass . '"><a href="#' . $tabId . '">' . $schema['title'] . '</a></li>';
                $htmlCont .= "<div id='{$tabId}' class='rt-tab-content{$activeClass}'>";
                $htmlCont .= "<div class='kc-top-toolbar'><span class='kc-auto-fill button button-primary'>" . __("Auto Fill", "wp-seo-structured-data-schema-pro") . "</span></div>";
                $metaData = get_post_meta($post->ID, $tabId, true);
                $metaData = (is_array($metaData) ? $metaData : array());
                foreach ($schema['fields'] as $fieldId => $data) {
                    $data['fieldId'] = $fieldId;
                    $data['id'] = $tabId . "_" . $fieldId;
                    $data['name'] = $tabId . "[{$fieldId}]";
                    $data['value'] = (!empty($metaData[$fieldId]) ? $metaData[$fieldId] : null);
                    if (in_array($fieldId, array('publisher', 'publisherImage')) && !$data['value']) {

                        switch ($fieldId) {
                            case 'publisher':
                                $data['value'] = $publusher_name;
                                break;
                            case 'publisherImage':
                                $data['value'] = $publusher_logo;
                                break;
                        }
                    }
                    if ($data['type'] === 'group' && !empty($data['fields'])) {
                        $groupMetaData = isset($metaData[$fieldId]) && !empty($metaData[$fieldId]) ? $metaData[$fieldId] : array(array());
                        $html_g = null;
                        $i = 0;
                        foreach ($groupMetaData as $imDataId => $mData) {
                            $html_gItem = null;
                            foreach ($data['fields'] as $gFid => $field) {
                                $field['fieldId'] = $fieldId . '-' . $gFid;
                                $field['id'] = $tabId . "_" . $fieldId . '_' . $gFid;
                                $field['name'] = $tabId . "[$fieldId]" . "[$imDataId][$gFid]";
                                $field['value'] = (!empty($mData[$gFid]) ? $mData[$gFid] : null);
                                $html_gItem .= $schemas->get_field($field);
                            }
                            $html_g .= sprintf('<div class="kcseo-group-item" data-index="%d" id="%s">%s%s%s</div>',
                                $imDataId,
                                $tabId . "_" . $fieldId . "_group_item_" . $imDataId,
                                isset($data['duplicate']) && $imDataId > 0 ? '<div class="kc-top-toolbar"><span class="kcseo-remove-group"><span class="dashicons dashicons-trash"></span>Remove</span></div>' : null,
                                $html_gItem,
                                isset($data['duplicate']) ? '<div class="kc-bottom-toolbar"><span class="button button-primary kcseo-group-duplicate">Duplicate item</span></div>' : null
                            );
                        }
                        $htmlCont .= sprintf('<div class="field-container kcseo-group-wrapper" data-duplicate="%d" data-group-id="%s" id="%s">%s</div>',
                            isset($data['duplicate']) ? true : false,
                            $tabId . "[$fieldId]",
                            $tabId . "_" . $fieldId . "_group_wrapper",
                            $html_g
                        );

                    } else {
                        $htmlCont .= $schemas->get_field($data);
                    }
                }
                $multipleMetaData = get_post_meta($post->ID, $tabId . "_multiple", true);
                $multipleHtml = null;
                if (!empty($multipleMetaData) && is_array($multipleMetaData)) {
                    foreach ($multipleMetaData as $mid => $mMetaDatum) {
                        $multipleHtml .= "<div class='multiple-schema-item'>";
                        $multipleHtml .= "<div class='kc-multiple-schema-tool'><span class='kc-remove-schema'><span class='dashicons dashicons-trash'></span>Remove</span></div>";
                        foreach ($schema['fields'] as $fieldId => $data) {
                            if ($fieldId !== "active") {
                                $data['fieldId'] = $fieldId;
                                $data['id'] = $tabId . "_" . $fieldId . "_" . $mid;
                                $data['name'] = $tabId . "_multiple[{$mid}][{$fieldId}]";
                                $data['value'] = (!empty($mMetaDatum[$fieldId]) ? $mMetaDatum[$fieldId] : null);
                                if (in_array($fieldId, array(
                                        'publisher',
                                        'publisherImage'
                                    )) && !$data['value']) {

                                    switch ($fieldId) {
                                        case 'publisher':
                                            $data['value'] = $publusher_name;
                                            break;
                                        case 'publisherImage':
                                            $data['value'] = $publusher_logo;
                                            break;
                                    }
                                }
                                if ($data['type'] === 'group' && !empty($data['fields'])) {
                                    $mGroupMetaData = isset($mMetaDatum[$fieldId]) && !empty($mMetaDatum[$fieldId]) ? $mMetaDatum[$fieldId] : array(array());
                                    $html_g = null;
                                    foreach ($mGroupMetaData as $imDataId => $mData) {
                                        $html_gItem = null;
                                        foreach ($data['fields'] as $gFid => $field) {
                                            $field['fieldId'] = $fieldId . '-' . $gFid;
                                            $field['id'] = $tabId . "_multiple_" . $mid . "_" . $fieldId . '_' . $gFid;
                                            $field['name'] = $tabId . "_multiple[{$mid}][$fieldId]" . "[$imDataId][$gFid]";
                                            $field['value'] = (!empty($mData[$gFid]) ? $mData[$gFid] : null);
                                            $html_gItem .= $schemas->get_field($field);
                                        }
                                        $html_g .= sprintf('<div class="kcseo-group-item" data-index="%d" id="%s">%s%s%s</div>',
                                            $imDataId,
                                            $tabId . "_multiple_" . $mid . "_" . $fieldId . "_group_item_" . $imDataId,
                                            isset($data['duplicate']) && $imDataId > 0 ? '<div class="kc-top-toolbar"><span class="kcseo-remove-group"><span class="dashicons dashicons-trash"></span>Remove</span></div>' : null,
                                            $html_gItem,
                                            isset($data['duplicate']) ? '<div class="kc-bottom-toolbar"><span class="button button-primary kcseo-group-duplicate">Duplicate Item</span></div>' : null
                                        );
                                    }
                                    $multipleHtml .= sprintf('<div class="field-container kcseo-group-wrapper" data-duplicate="%s" data-group-id="%s" id="%s">%s</div>',
                                        isset($data['duplicate']) ? true : false,
                                        $tabId . "_multiple[{$mid}][$fieldId]",
                                        $tabId . "_multiple_" . $mid . "_" . $fieldId . "_group_wrapper",
                                        $html_g
                                    );
                                } else {
                                    $multipleHtml .= $schemas->get_field($data);
                                }
                            }
                        }
                        $multipleHtml .= "</div>";
                    }
                }
                $htmlCont .= "<div class='rt-multiple-schema-wrapper'>{$multipleHtml}</div>";
                $htmlCont .= "<div class='kc-bottom-toolbar'><span class='kc-new-schema button button-primary'>" . __("Add New", "wp-seo-structured-data-schema-pro") . "</span></div>";
                $htmlCont .= "</div>";
            }
            $htmlMenu .= "</ul>";
            $html .= $htmlMenu . $htmlCont;
            $html .= '<input type="hidden" id="_kcseo_ative_tab" name="_kcseo_ative_tab" value="' . $_kcseo_ative_tab . '" />';
            $html .= "</div>";
            $html .= "</div>";
            echo $html;
        }

        function save_KcSeo_schema_data($post_id, $post, $update) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post_id;
            }
            global $KcSeoWPSchema;
            $nonce = !empty($_REQUEST['_kcseo_nonce']) ? $_REQUEST['_kcseo_nonce'] : null;
            if (!wp_verify_nonce($nonce, $KcSeoWPSchema->nonceText())) {
                return $post_id;
            }

            // Check permissions
            if (!empty($_GET['post_type'])) {
                if (!current_user_can('edit_' . $_GET['post_type'], $post_id)) {
                    return $post_id;
                }
            }
            $pt = $KcSeoWPSchema->kcSeoPostTypes();
            if (!in_array($post->post_type, $pt)) {
                return $post_id;
            }

            $meta = array();
            $schemaModel = new KcSeoSchemaModel;
            $schemaFields = KcSeoOptions::getSchemaTypes();
            foreach ($schemaFields as $schemaID => $schema) {
                $schemaMetaId = $KcSeoWPSchema->KcSeoPrefix . $schemaID;
                $data = array();
                foreach ($schema['fields'] as $fieldId => $fieldData) {
                    $value = (!empty($_REQUEST[$schemaMetaId][$fieldId]) ? $_REQUEST[$schemaMetaId][$fieldId] : null);
                    $value = $KcSeoWPSchema->sanitize($fieldId, $fieldData, $value);
                    $data[$fieldId] = $value;
                }
                $meta[$schemaMetaId] = $data;
                $multiple_data = !empty($_POST[$schemaMetaId . "_multiple"]) ? $_POST[$schemaMetaId . "_multiple"] : null;
                if ($multiple_data && is_array($multiple_data)) {
                    $mDataList = array();
                    foreach ($multiple_data as $multiple_item) {
                        $mData = array();
                        foreach ($schema['fields'] as $fieldId => $fieldData) {
                            if ($fieldId !== "active") {
                                $value = (!empty($multiple_item[$fieldId]) ? $multiple_item[$fieldId] : null);
                                $value = $KcSeoWPSchema->sanitize($fieldId, $fieldData, $value);
                                $mData[$fieldId] = $value;
                            }
                        }
                        if (!empty($mData)) {
                            $mDataList[] = $mData;
                        }
                    }
                    if (!empty($mDataList)) {
                        $meta[$schemaMetaId . "_multiple"] = $mDataList;
                    }
                } else {
                    delete_post_meta($post_id, $schemaMetaId . "_multiple");
                }
            }

            /* _kcseo_ative_tab */
            if (isset($_POST['_kcseo_ative_tab'])) {
                $meta['_kcseo_ative_tab'] = sanitize_text_field($_POST['_kcseo_ative_tab']);
            }
            if (count($meta) > 0) {
                foreach ($meta as $mKey => $mValue) {
                    update_post_meta($post_id, $mKey, $mValue);
                }
            }
        }

    }

endif;