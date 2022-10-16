<?php
/**
 * Admin Thumbnail js template
 *
 * This template can be overridden by copying it to
 * yourtheme/woo-product-variation-gallery-pro/template-admin-thumbnail.php
 *
 */

defined('ABSPATH') || exit;
?>
<script type="text/html" id="tmpl-rtwpvg-image">
    <# hasVideo = (  data.rtwpvg_video_link == '' ) ? '' : 'video' #>
    <li class="image {{hasVideo}}">
        <input type="hidden" name="rtwpvg[{{data.product_variation_id}}][]" value="{{data.id}}">
        <img src="{{data.url}}">
        <a href="#" class="delete rtwpvg-remove-image"><span class="dashicons dashicons-dismiss"></span></a>
    </li>
</script>