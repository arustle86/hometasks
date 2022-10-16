<?php


namespace Rtwpvs\Models;


class Field
{


    public static function generate_fields($fields) {
        $fields = apply_filters('rtwpvs_meta_fields', $fields);

        if (empty($fields)) {
            return;
        }

        foreach ($fields as $field) {
            $field = wp_parse_args($field, array(
                'id'    => '',
                'class' => '',
                'value' => ''
            ));
            $field = apply_filters('rtwpvs_meta_field', $field);

            $field['id'] = esc_html($field['id']);

            $field['size'] = isset($field['size']) ? $field['size'] : '40';
            $field['required'] = (isset($field['required']) and $field['required'] == true) ? ' aria-required="true"' : '';
            $field['placeholder'] = (isset($field['placeholder'])) ? ' placeholder="' . $field['placeholder'] . '" data-placeholder="' . $field['placeholder'] . '"' : '';
            $field['desc'] = (isset($field['desc'])) ? $field['desc'] : '';
            $field['name'] = (isset($field['name'])) ? $field['name'] : $field['id'];

            $field['dependency'] = (isset($field['dependency'])) ? $field['dependency'] : array();

            self::field_start($field);
            switch ($field['type']) {
                case 'text':
                case 'url':
                    ob_start();
                    ?>
                    <input name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>"
                           type="<?php echo $field['type'] ?>"
                           value="<?php echo $field['value'] ?>"
                           size="<?php echo $field['size'] ?>" <?php echo $field['required'] . $field['placeholder'] ?>>
                    <?php
                    echo ob_get_clean();
                    break;
                case 'checkbox':
                    $label = isset($field['trigger_label']) ? $field['trigger_label'] : $field['label'];
                    ob_start();
                    ?>
                    <label for="<?php echo esc_attr($field['id']) ?>">
                        <input name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>"
                            <?php checked($field['value'], 'yes') ?>
                               type="<?php echo $field['type'] ?>"
                               value="yes" <?php echo $field['required'] . $field['placeholder'] ?>>
                        <?php echo $label ?></label>
                    <?php
                    echo ob_get_clean();
                    break;
                case 'color':
                    ob_start();
                    ?>
                    <input name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>" type="text"
                           class="rtwpvs-color-picker" value="<?php echo $field['value'] ?>"
                           data-default-color="<?php echo $field['value'] ?>"
                           size="<?php echo $field['size'] ?>" <?php echo $field['required'] . $field['placeholder'] ?>>
                    <?php
                    echo ob_get_clean();
                    break;
                case 'textarea':
                    ob_start();
                    ?>
                    <textarea name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>" rows="5"
                              cols="<?php echo $field['size'] ?>" <?php echo $field['required'] . $field['placeholder'] ?>><?php echo $field['value'] ?></textarea>
                    <?php
                    echo ob_get_clean();
                    break;
                case 'editor':
                    $field['settings'] = isset($field['settings'])
                        ? $field['settings']
                        : array(
                            'textarea_rows' => 8,
                            'quicktags'     => false,
                            'media_buttons' => false
                        );
                    ob_start();
                    wp_editor($field['value'], $field['id'], $field['settings']);
                    echo ob_get_clean();
                    break;
                case 'select':
                case 'select2':

                    $field['options'] = isset($field['options']) ? $field['options'] : array();
                    $field['multiple'] = isset($field['multiple']) ? ' multiple="multiple"' : '';
                    $css_class = ($field['type'] == 'select2') ? 'rtwpvs-selectwoo' : '';

                    ob_start();
                    ?>
                    <select name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>"
                            class="<?php echo $css_class ?>" <?php echo $field['multiple'] ?>>
                        <?php
                        foreach ($field['options'] as $key => $option) {
                            echo '<option' . selected($field['value'], $key, false) . ' value="' . $key . '">' . $option . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    echo ob_get_clean();
                    break;
                case 'image':
                    ob_start();
                    ?>
                    <div class="rtwpvs-image-wrapper">
                        <div class="image-preview">
                            <img data-placeholder="<?php echo esc_url(self::placeholder_img_src()); ?>"
                                 src="<?php echo esc_url(self::get_img_src($field['value'])); ?>" width="60px"
                                 height="60px"/>
                        </div>
                        <div class="button-wrapper">
                            <input type="hidden" id="<?php echo $field['id'] ?>" name="<?php echo $field['name'] ?>"
                                   value="<?php echo esc_attr($field['value']) ?>"/>
                            <button type="button"
                                    class="rtwpvs-upload-image button button-primary button-small"><?php esc_html_e('Upload / Add image', 'woo-product-variation-swatches'); ?></button>
                            <button type="button"
                                    style="<?php echo(empty($field['value']) ? 'display:none' : '') ?>"
                                    class="rtwpvs-remove-image button button-danger button-small"><?php esc_html_e('Remove image', 'woo-product-variation-swatches'); ?></button>
                        </div>
                    </div>
                    <?php
                    echo ob_get_clean();
                    break;
                default:
                    do_action('rtwpvs_meta_field', $field);
                    break;

            }
            self::field_end($field);

        }
    }

    private static function field_start($field) {
        $depends = empty($field['dependency']) ? '' : "data-rtwpvs-depends='" . wp_json_encode($field['dependency']) . "'";

        ob_start();
        ?>
        <div <?php echo $depends ?> class="form-field rtwpvs-field-wrapper <?php echo esc_attr($field['class']) ?> <?php echo empty($field['required']) ? '' : 'form-required' ?>">
        <label for="<?php echo esc_attr($field['id']) ?>"><?php echo $field['label'] ?></label>
        <div class="field">
        <?php
        echo ob_get_clean();
    }

    private static function get_img_src($thumbnail_id = false) {
        if (!empty($thumbnail_id)) {
            $image = wp_get_attachment_thumb_url($thumbnail_id);
        } else {
            $image = self::placeholder_img_src();
        }

        return $image;
    }

    private static function placeholder_img_src() {
        return rtwpvs()->get_images_uri('placeholder.png');
    }

    private static function field_end($field) {

        ob_start();
        if (!empty($field['desc'])):
            ?>
            <p><?php echo $field['desc'] ?></p>
        <?php endif; ?>
        </div>
        </div>
        <?php
        echo ob_get_clean();
    }

}