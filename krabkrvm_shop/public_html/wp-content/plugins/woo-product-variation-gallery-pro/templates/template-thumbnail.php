<?php
/**
 * Admin Thumbnail js
 * This template can be overridden by copying it to
 * yourtheme/woo-product-variation-gallery-pro/template-thumbnail.php
 */

defined('ABSPATH') || exit;
?>
<script type="text/html" id="tmpl-rtwpvg-thumbnail-template">
    <# hasVideo = (  data.rtwpvg_video_link ) ? 'rtwpvg-thumbnail-video' : '' #>
    <div class="rtwpvg-thumbnail-image {{hasVideo}}">
        <div>
            <img width="{{data.gallery_thumbnail_src_w}}" height="{{data.gallery_thumbnail_src_h}}"
                 src="{{data.gallery_thumbnail_src}}" alt="{{data.alt}}" title="{{data.title}}"/>
        </div>
    </div>
</script>