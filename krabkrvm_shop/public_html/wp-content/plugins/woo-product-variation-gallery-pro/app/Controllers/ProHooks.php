<?php

namespace Rtwpvg\Controllers;

use Rtwpvg\Helpers\Functions;

class ProHooks
{
    public function __construct() {
        add_filter('rtwpvg_get_image_props', [$this, 'add_video_props'], 10, 2);
    }

    function add_video_props($props, $attachment_id) {

        $has_video = trim(get_post_meta($attachment_id, 'rtwpvg_video_link', true));
        $type = wp_check_filetype($has_video);
        $video_width = trim(get_post_meta($attachment_id, 'rtwpvg_video_width', true));
        $video_height = trim(get_post_meta($attachment_id, 'rtwpvg_video_height', true));
        $props['rtwpvg_video_link'] = $has_video;

        if (!empty($has_video)) {
            if (!empty($type['type'])) {
                $props['rtwpvg_video_embed_type'] = 'video';
            } else {
                $props['rtwpvg_video_embed_type'] = 'iframe';
                $props['rtwpvg_video_embed_url'] = Functions::get_simple_embed_url($has_video);
            }

            $props['rtwpvg_video_width'] = $video_width ? $video_width : 'auto';
            $props['rtwpvg_video_width'] = $video_height ? $video_height : '100%';
        }

        return $props;

    }

}