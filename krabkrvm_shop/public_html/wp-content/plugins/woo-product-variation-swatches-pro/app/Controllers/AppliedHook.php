<?php


namespace Rtwpvs\Controllers;


class AppliedHook
{

    static function init() {

        // Divi builder load Fix
        add_filter('default_rtwpvs_variation_attribute_options_html', function ($default) {
            if (function_exists('et_builder_tb_enabled') && et_builder_tb_enabled()) {
                return true;
            }

            return $default;
        });
    }


}