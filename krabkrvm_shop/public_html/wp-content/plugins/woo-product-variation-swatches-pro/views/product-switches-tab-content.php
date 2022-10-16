<?php

global $post, $woocommerce, $product_object;
use Rtwpvs\Helpers\Functions;
use Rtwpvs\Models\Field;

$product = wc_get_product($post->ID);
$product_type = $product->get_type();
if ($product_type !== 'variable') {
    return;
}
$attributes = $product->get_variation_attributes();
$meta_data = get_post_meta($post->ID, '_rtwpvs', true);
$enable_archive_single_attribute = rtwpvs()->get_option('archive_swatches_enable_single_attribute');
if ($enable_archive_single_attribute) {
    $product_meta_fields = array(
        array(
            'label'   => esc_html__('Catalog mode single attribute', 'woo-product-variation-swatches'),
            'id'      => "rtwpvs-archive-single-attribute",
            'type'    => 'select',
            'value'   => isset($meta_data['archive_single_attribute']) ? esc_attr($meta_data['archive_single_attribute']) : null,
            'name'    => "rtwpvs[archive_single_attribute]",
            'options' => array_merge(array(
                '' => __('Global', 'woo-product-variation-swatches')
            ), Functions::get_product_attributes_array($attributes)),

        )
    );
}
?>

<div id="rtwpvs_tab_options" class="panel wc-metaboxes-wrapper rtwpvs-tab-options hidden">
    <?php if (!empty($product_meta_fields)): ?>
        <div class="toolbar toolbar-top">
            <?php Field::generate_fields($product_meta_fields); ?>
        </div>
    <?php endif; ?>
    <?php if ((!empty($attributes)) && (sizeof($attributes) > 0)) { ?>
        <div class="rtwpvs-product-attributes wc-metaboxes">
            <?php foreach ($attributes as $key => $values) {
                include rtwpvs()->locate_views('product-attribute');

            } ?>
        </div>
    <?php } ?>

    <div class="toolbar">
        <button type="button" class="button-primary rtwpvs-save-attributes">
            <?php esc_html_e("Save product switches", "woo-product-variation-swatches") ?>
        </button>
        <button type="button" class="button rtwpvs-reset-attributes">
            <?php esc_html_e("Reset to default", "woo-product-variation-swatches") ?>
        </button>
    </div>

</div>
