<?php
/**
 *
 * @var            $product_id           WC_Product id
 * @var array      $available_variations variations array
 * @var array      $attributes           attribute array
 * @var WC_Product $product
 */

use Rtwpvs\Helpers\Functions;

$show_clear = rtwpvs()->get_option('show_clear_on_archive', true);
$enable_archive_single_attribute = rtwpvs()->get_option('archive_swatches_enable_single_attribute');
$archive_single_attribute = rtwpvs()->get_option('archive_swatches_single_attribute');
$archive_single_attribute = isset($meta_data['archive_single_attribute']) && $meta_data['archive_single_attribute'] ? $meta_data['archive_single_attribute'] : $archive_single_attribute;
?>
<div class="variations_form rtwpvs-archive-variation-wrapper" data-product_id="<?php echo absint($product_id); ?>"
     data-product_variations="<?php echo htmlspecialchars(wp_json_encode($available_variations)); // WPCS: XSS ok. ?>">
    <div class="variations">
        <?php
        foreach ($attributes as $key => $options) {
            if ($enable_archive_single_attribute && $key != $archive_single_attribute) {
                continue;
            }
            $lowerAttributeKey = strtolower($key);
            $selected = !empty($default_attributes) && isset($default_attributes[$lowerAttributeKey]) && $default_attributes[$lowerAttributeKey] ? $default_attributes[$lowerAttributeKey] : null;
            ?>
            <div class="rtwpvs-variation-terms-wrapper"><?php
                echo Functions::generate_variation_attribute_option_html(apply_filters('rtwpvs_variation_attribute_options_args', array(
                    'options'    => $options,
                    'attribute'  => $key,
                    'product'    => $product,
                    'selected'   => $selected,
                    'is_archive' => true,
                    'meta_data'  => $meta_data
                )));
                ?>
            </div>
            <?php
            if ($enable_archive_single_attribute && $key == $archive_single_attribute) {
                break;
            }

        }
        if ($show_clear && !$enable_archive_single_attribute):
            echo wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<div class="rtwpvs_archive_reset_variations"><a class="reset_variations" href="#">' . esc_html__('Clear', 'woocommerce') . '</a></div>'));
        endif;
        ?>
    </div>

</div>