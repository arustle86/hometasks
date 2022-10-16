<?php

if (!class_exists('KcSeoAjaxResponse.php')):

    class KcSeoAjaxResponse
    {

        function __construct() {
            add_action('wp_ajax_get_schema_data_action', array($this, 'get_schema_data_action'));
        }

        static function kcseo_remove_hellip() {
            return '';
        }

        function get_schema_data_action() {
            $schema_id = !empty($_POST['schema_id']) ? $_POST['schema_id'] : null;
            $post_id = !empty($_POST['post_id']) ? absint($_POST['post_id']) : null;
            $data = array();
            if ($schema_id && $post_id) {
                $schemaModel = new KcSeoSchemaModel;
                $allSchema = KcSeoOptions::getSchemaTypes();
                global $KcSeoWPSchema;
                $settings = get_option($KcSeoWPSchema->options['main_settings']);
                $post = get_post($post_id);
                if (!empty($allSchema[$schema_id]['fields'])) {
                    $schema = $allSchema[$schema_id]['fields'];
                    foreach ($schema as $key => $field) {
                        if ($key == 'headline' || $key == 'name') {
                            $data[$key] = $post->post_title;
                        } elseif ($key == 'mainEntityOfPage' || $key == 'url') {
                            $data[$key] = get_permalink($post_id);
                        } elseif ($key == 'author') {
                            $data[$key] = get_the_author_meta('display_name', $post->post_author);
                        } elseif ($key == 'datePublished') {
                            $data[$key] = get_the_date(apply_filters('kcseo_date_time_format', 'Y-m-d\TH:i:s'), $post_id);
                        } elseif ($key == 'dateModified') {
                            $data[$key] = get_the_modified_date(apply_filters('kcseo_date_time_format', 'Y-m-d\TH:i:s'), $post_id);
                        } elseif ($key == 'description') {
                            setup_postdata($post);
                            add_filter('excerpt_more', array(__CLASS__, 'kcseo_remove_hellip'), 999);
                            $data[$key] = KcSeoHelper::filter_content(get_the_excerpt($post_id));
                            remove_filter('excerpt_more', array(__CLASS__, 'kcseo_remove_hellip'), 999);
                        } elseif ($key == 'articleBody') {
                            $data[$key] = KcSeoHelper::filter_content($post->post_content);
                        } elseif ($key == 'publisher' && !empty($settings['publisher']['name'])) {
                            $data[$key] = wp_strip_all_tags($settings['publisher']['name']);
                        } elseif ($key == 'image') {
                            if (has_post_thumbnail($post_id)) {
                                $img_id = get_post_thumbnail_id($post);
                                $img = wp_get_attachment_image_src($img_id, 'full');

                                $data[$key] = array(
                                    'id'        => $img_id,
                                    'url'       => $img[0],
                                    'thumb_url' => wp_get_attachment_image_src($img_id)[0],
                                    'width'     => $img[1],
                                    'height'    => $img[2],
                                );
                            }
                        } elseif ($key == 'publisherImage') {
                            if (!empty($settings['publisher']['logo'])) {
                                $img_id = absint($settings['publisher']['logo']);
                                $img = wp_get_attachment_image_src($img_id, 'full');
                                $data[$key] = array(
                                    'id'        => $img_id,
                                    'url'       => $img[0],
                                    'thumb_url' => wp_get_attachment_image_src($img_id)[0],
                                    'width'     => $img[1],
                                    'height'    => $img[2],
                                );
                            }
                        }
                        if (KcSeoFunctions::isWcActive() && $schema_id == "product" && $_product = wc_get_product($post_id)) {
                            if ($key == 'price') {
                                $data[$key] = $_product->get_price();
                            } elseif ($key == 'sku') {
                                $data[$key] = $_product->get_sku();
                            } elseif ($key == 'priceCurrency') {
                                $data[$key] = get_woocommerce_currency();
                            } elseif ($key == 'reviewCount') {
                                $data[$key] = ($count = $_product->get_review_count()) ? $count : '';
                            } elseif ($key == 'ratingValue') {
                                $data[$key] = ($count = $_product->get_average_rating()) ? $count : '';
                            } elseif ($key == 'availability') {
                                $availability = $_product->get_availability();
                                if (!empty($availability['class'])) {
                                    switch ($availability['class']) {
                                        case 'in-stock':
                                            $data[$key] = 'http://schema.org/InStock';
                                            break;
                                        case 'out-of-stock':
                                            $data[$key] = 'http://schema.org/OutOfStock';
                                            break;
                                        case 'available-on-backorder':
                                            $data[$key] = 'http://schema.org/PreOrder';
                                            break;
                                    }
                                }
                            }
                        }

                    }
                }
                wp_send_json(apply_filters('kcseo_get_schema_data_action', array(
                    'data' => $data,
                    'post' => $post
                ), $schema_id, $post_id));
            }
        }
    }

endif;
