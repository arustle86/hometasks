<?php

use Rtwpvs\Helpers\Options;
use Rtwpvs\Helpers\Functions;
use Rtwpvs\Models\Field;

if (!defined('ABSPATH')) {
    exit;
}

$terms = get_terms($key, array('orderby' => 'name', 'hide_empty' => 0,));
$attribute_type = isset($meta_data[$key]['type']) && $meta_data[$key]['type'] ? $meta_data[$key]['type'] : null;
$attribute_type = Functions::get_valid_product_attribute_type_from_available_types($attribute_type);
$global_attribute_type = Functions::get_global_attribute_type($key);
$type = $attribute_type ? $attribute_type : $global_attribute_type;
?>
<div data-taxonomy="<?php echo esc_attr($key); ?>"
     class="woocommerce_attribute rtwpvs-attribute-box-wrapper rtwpvs_visible_if_<?php echo esc_attr($type); ?> wc-metabox closed">
    <h3>
        <strong class="attribute_name"><?php echo wc_attribute_label($key); ?></strong>
        <div class="rtwpvs-term-handler">
            <?php
            woocommerce_wp_select(array(
                'label'   => esc_html__('Attribute Type', 'woo-product-variation-swatches'), // Text in Label
                'value'   => isset($meta_data[$key]['type']) ? esc_attr($meta_data[$key]['type']) : '',
                'id'      => 'rtwpvs_attribute_type_' . $key,
                'name'    => "rtwpvs[{$key}][type]",
                'class'   => "rtwpvs-attribute-type",
                'options' => array_merge(array(
                    '' => esc_html__('Global', 'woo-product-variation-swatches')
                ), Options::get_available_attributes_types(), array('custom' => esc_html__('Custom', 'woo-product-variation-swatches'))),
            ));
            ?>
        </div>
    </h3>
    <div class="woocommerce_attribute_data wc-metabox-content rtwpvs-metaboxes-wrapper hidden">
        <div class="rtwpvs-attribute-term-panel-group rtwpvs-metaboxes">
            <?php

            if (!empty($values)) {
                foreach ($values as $value) {
                    $termLabel = $value;
                    if (!is_wp_error($terms)) {
                        foreach ($terms as $term) {

                            if ($term->slug != $value) {
                                continue;
                            }
                            {
                                $termLabel = $term->name;
                            }
                        }
                    }
                    if ($type == 'custom' && isset($meta_data[$key]['data'][$value]['type'])) {
                        $term_type = $meta_data[$key]['data'][$value]['type'];
                    } else if (!$type) {
                        $term_type = current(array_keys(Options::get_available_attributes_types()));
                    } else {
                        $term_type = $type;
                    }
                    $tooltip = isset($meta_data[$key]['data'][$value]['tooltip']) ? $meta_data[$key]['data'][$value]['tooltip'] : '';
                    ?>
                    <div class="rtwpvs-attribute-term-panel rtwpvs-attribute-term-box-wrapper rtwpvs_visible_if_term_<?php echo esc_attr($term_type); ?> rtwpvs-metabox closed">
                        <h3>
                            <div class="label"><?php echo rawurldecode($termLabel); ?></div>
                            <div class="rtwpvs-term-handler">
                                <?php
                                woocommerce_wp_select(array(
                                    'label'   => esc_html__('Type', 'woo-product-variation-swatches'),
                                    'value'   => $term_type,
                                    'id'      => 'rtwpvs_term_' . $key . '_' . $value,
                                    'class'   => 'rtwpvs-attribute-term-type',
                                    'name'    => "rtwpvs[{$key}][data][{$value}][type]",
                                    'options' => Options::get_available_attributes_types(),
                                ));
                                ?>
                            </div>
                        </h3>
                        <div class="rtwpvs-term-data rtwpvs-metabox-content hidden">
                            <div class="rtwpvs-metabox-content-wrap rtwpvs_visible_if_tooltip_<?php echo esc_attr($tooltip); ?>">
                                <?php
                                $is_dual_color = isset($meta_data[$key]['data'][$value]['is_dual_color']) && "yes" === $meta_data[$key]['data'][$value]['is_dual_color'] ? "yes" : 'no';
                                $fields = array(
                                    array(
                                        'label' => esc_html__('Image', 'woo-product-variation-swatches'),
                                        'desc'  => esc_html__('Choose an Image', 'woo-product-variation-swatches'),
                                        'id'    => 'rtwpvs_term_' . $key . '_' . $value . "_image",
                                        'value' => isset($meta_data[$key]['data'][$value]['image']) ? $meta_data[$key]['data'][$value]['image'] : '',
                                        'class' => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-image',
                                        'name'  => "rtwpvs[{$key}][data][{$value}][image]",
                                        'type'  => 'image'
                                    ),
                                    array(
                                        'label' => esc_html__('Color', 'woo-product-variation-swatches'),
                                        'id'    => 'rtwpvs_term_' . $key . '_' . $value . "_color",
                                        'value' => isset($meta_data[$key]['data'][$value]['color']) ? $meta_data[$key]['data'][$value]['color'] : '',
                                        'class' => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-color',
                                        'name'  => "rtwpvs[{$key}][data][{$value}][color]",
                                        'type'  => 'color'
                                    ),
                                    array(
                                        'label'         => esc_html__('Dual Color', 'woo-product-variation-swatches'),
                                        'trigger_label' => esc_html__('Enable', 'woo-product-variation-swatches'),
                                        'class'         => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-is-dual-color',
                                        'name'          => "rtwpvs[{$key}][data][{$value}][is_dual_color]",
                                        "value"         => $is_dual_color,
                                        'id'            => 'rtwpvs_term_' . $key . '_' . $value . "_is_dual_color",
                                        'type'          => 'checkbox',
                                    ),
                                    array(
                                        'label' => esc_html__('Secondary Color', 'woo-product-variation-swatches'),
                                        'id'    => 'rtwpvs_term_' . $key . '_' . $value . "_secondary_color",
                                        'value' => isset($meta_data[$key]['data'][$value]['secondary_color']) ? $meta_data[$key]['data'][$value]['secondary_color'] : '',
                                        'class' => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-secondary-color',
                                        'name'  => "rtwpvs[{$key}][data][{$value}][secondary_color]",
                                        'type'  => 'color'
                                    ),
                                    array(
                                        'label'   => esc_html__('Show Tooltip', 'woo-product-variation-swatches'),
                                        'id'      => 'rtwpvs_term_' . $key . '_' . $value . "_tooltip",
                                        'type'    => 'select',
                                        'value'   => $tooltip,
                                        'class'   => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-tooltip',
                                        'name'    => "rtwpvs[{$key}][data][{$value}][tooltip]",
                                        'options' => array(
                                            ''      => esc_html__('Global', 'woo-product-variation-swatches'),
                                            'text'  => esc_html__("Text", "woo-product-variation-swatches"),
                                            'image' => esc_html__("Image", "woo-product-variation-swatches"),
                                            'no'    => esc_html__("No", "woo-product-variation-swatches")
                                        )
                                    ),
                                    array(
                                        'label' => esc_html__('Tooltip Text', 'woo-product-variation-swatches'), // <label>
                                        'desc'  => esc_html__('By default tooltip text will be the term name.', 'woo-product-variation-swatches'), // description
                                        'id'    => 'rtwpvs_term_' . $key . '_' . $value . "_tooltip_text",
                                        'name'  => "rtwpvs[{$key}][data][{$value}][tooltip_text]",
                                        'value' => isset($meta_data[$key]['data'][$value]['tooltip_text']) ? $meta_data[$key]['data'][$value]['tooltip_text'] : '',
                                        'type'  => 'text',
                                        'class' => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-tooltip-text'
                                    ),
                                    array(
                                        'label' => esc_html__('Tooltip Image', 'woo-product-variation-swatches'), // <label>
                                        'desc'  => esc_html__('Choose an image for tooltip.', 'woo-product-variation-swatches'), // description
                                        'id'    => 'rtwpvs_term_' . $key . '_' . $value . "_tooltip_text",
                                        'name'  => "rtwpvs[{$key}][data][{$value}][tooltip_image]",
                                        'value' => isset($meta_data[$key]['data'][$value]['tooltip_image']) ? $meta_data[$key]['data'][$value]['tooltip_image'] : '',
                                        'type'  => 'image',
                                        'class' => 'rtwpvs-attribute-term-field rtwpvs-attribute-term-tooltip-image',
                                    )
                                );
                                Field::generate_fields($fields);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }

            ?>
        </div>
    </div>
</div>
