<?php
global $KcSeoWPSchema;
$settings = get_option($KcSeoWPSchema->options['main_settings']);
$pt = !empty($settings['post-type']) ? $settings['post-type'] : array('post', 'page');
?>
<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
    <h2><?php esc_html_e('Schema Settings', "wp-seo-structured-data-schema-pro"); ?></h2>
    <form id="kcseo-main-settings">

        <table width="40%" cellpadding="10" class="form-table">
            <tr>
                <th><?php esc_html_e("Business / Org Schema", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php $dd = !empty($settings['site_schema']) ? $settings['site_schema'] : 'home_page'; ?>
                    <input type="radio" <?php echo($dd == 'home_page' ? 'checked' : null); ?> name="site_schema"
                           value="home_page" id="site_schema_home"><label for="site_schema_home"><?php esc_html_e("Home page
                        only", "wp-seo-structured-data-schema-pro") ?></label><br>
                    <input type="radio" <?php echo($dd == 'all' ? 'checked' : null); ?> name="site_schema" value="all"
                           id="site_schema_all"><label for="site_schema_all"><?php esc_html_e("Sitewide (Apply General Settings schema
                        sitewide)", "wp-seo-structured-data-schema-pro") ?></label><br>
                    <input type="radio" <?php echo($dd == 'off' ? 'checked' : null); ?> name="site_schema" value="off"
                           id="site_schema_off"><label
                            for="site_schema_off"><?php esc_html_e("Turn off (Turn off global schema)", "wp-seo-structured-data-schema-pro") ?></label>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e("Post Type", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php
                    $postTypes = $KcSeoWPSchema->get_post_type_list();
                    foreach ($postTypes as $key => $value) {
                        $checked = (in_array($key, $pt) ? "checked" : null);
                        echo "<label for='pt-{$key}'><input id='pt-{$key}' {$checked} type='checkbox' name='post-type[]' value='{$key}' /> {$value}</label><br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="2"><h3><?php esc_html_e("Site Navigation Element Schema", "wp-seo-structured-data-schema-pro") ?></h3></th>
            </tr>
            <tr>
                <th><?php esc_html_e("Publisher Name", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <select name="site_nav">
                        <option value=""><?php esc_html_e("Select one menu", "wp-seo-structure-data-schema-pro") ?></option>
                        <?php
                        $menus = get_terms('nav_menu');
                        if (!empty($menus)) {
                            foreach ($menus as $menu) {
                                $slt = (!empty($settings['site_nav']) && $settings['site_nav'] == $menu->term_id) ? " selected" : null;
                                echo "<option value='{$menu->term_id}'{$slt}>{$menu->name}</option>";
                            }
                        }
                        ?>
                    </select>
                    <p class="description"><?php esc_html_e("Please deselect the navigation menu if you want to deactivate site navigation
                        schema.", "wp-seo-structured-data-schema-pro") ?></p>
                </td>
            </tr>
            <tr>
                <th colspan="2"><h3><?php esc_html_e("Publisher Information", "wp-seo-structured-data-schema-pro") ?></h3></th>
            </tr>
            <tr>
                <th><?php esc_html_e("Publisher Name", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="publisher[name]"
                           value="<?php echo(!empty($settings['publisher']['name']) ? esc_attr($settings['publisher']['name']) : null); ?>"/>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e("Publisher Logo", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php
                    $schemas = new KcSeoSchemaModel();
                    $data = array(
                        'id'    => 'publisher-logo',
                        'name'  => 'publisher[logo]',
                        'type'  => 'image',
                        'value' => (!empty($settings['publisher']['logo']) ? absint($settings['publisher']['logo']) : null),
                        'desc'  => __("Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>", "wp-seo-structured-data-schema-pro")
                    );
                    echo $schemas->get_field($data);
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="2"><h3><?php esc_html_e("Third party plugin Settings", "wp-seo-structured-data-schema-pro") ?></h3></th>
            </tr>
            <tr>
                <th><?php esc_html_e("YOAST SEO Default Schema JSON-LD", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php $dd = !empty($settings['yoast_wpseo_json_ld']) ? "checked" : null; ?>
                    <input type="checkbox" <?php echo $dd; ?> name="yoast_wpseo_json_ld" value="1"
                           id="yoast-wpseo-json-ld"><label
                            for="yoast-wpseo-json-ld"><?php esc_html_e("Disable", "wp-seo-structured-data-schema-pro") ?></label>
                    <p class="description"><?php esc_html_e("This will remove all default schema generated by Yoast SEO plugin.", "wp-seo-structured-data-schema-pro") ?></p>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e("YOAST SEO sitelinks searchbox", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php $dd = !empty($settings['yoast_wpseo_json_ld_search']) ? "checked" : null; ?>
                    <input type="checkbox" <?php echo $dd; ?> name="yoast_wpseo_json_ld_search" value="1"
                           id="yoast-wpseo-json-ld-search"><label
                            for="yoast-wpseo-json-ld-search"><?php esc_html_e("Disable", "wp-seo-structured-data-schema-pro") ?></label>
                    <p class="description"><?php esc_html_e("This will remove sitelinks searchbox generated by Yoast SEO plugin.", "wp-seo-structured-data-schema-pro") ?></p>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e("Woocommerce default schema", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php $dd = !empty($settings['wc_schema_disable']) ? "checked" : null; ?>
                    <input type="checkbox" <?php echo $dd; ?> name="wc_schema_disable" value="1"
                           id="wc-schema-disable"><label
                            for="wc-schema-disable"><?php esc_html_e("Disable", "wp-seo-structured-data-schema-pro") ?></label>
                    <p class="description"><?php esc_html_e("This will remove Woocommerce plugin generated schema.", "wp-seo-structured-data-schema-pro") ?></p>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e("Easy Digital Download default schema", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php $dd = !empty($settings['edd_schema_microdata']) ? "checked" : null; ?>
                    <input type="checkbox" <?php echo $dd; ?> name="edd_schema_microdata" value="1"
                           id="edd-schema-microdata"><label
                            for="edd-schema-microdata"><?php esc_html_e("Disable", "wp-seo-structured-data-schema-pro") ?></label>
                    <p class="description"><?php esc_html_e("This will remove Easy Digital Download plugin generated schema.", "wp-seo-structured-data-schema-pro") ?></p>
                </td>
            </tr>
            <tr>
                <th colspan="2"><h3><?php esc_html_e("System Settings", "wp-seo-structured-data-schema-pro") ?></h3></th>
            </tr>
            <tr>
                <th><?php esc_html_e("Delete all data", "wp-seo-structured-data-schema-pro") ?></th>
                <td align="left" scope="row">
                    <?php $dd = !empty($settings['delete-data']) ? "checked" : null; ?>
                    <input type="checkbox" <?php echo $dd; ?> name="delete-data" value="1" id="delete-data"><label
                            for="delete-data"><?php esc_html_e("Enable", "wp-seo-structured-data-schema-pro") ?></label>
                    <p class="description"><?php esc_html_e("This will delete all schema created and applied by this plugin when plugin is
                        deleted.", "wp-seo-structured-data-schema-pro") ?></p>
                </td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary"
                                 value="<?php esc_html_e('Save Changes', "wp-seo-structured-data-schema-pro"); ?>"></p>

        <?php wp_nonce_field($KcSeoWPSchema->nonceText(), '_kcseo_nonce'); ?>
    </form>
    <div id="response"></div>
</div>