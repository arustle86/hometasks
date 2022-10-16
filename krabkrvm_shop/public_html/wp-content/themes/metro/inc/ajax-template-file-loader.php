<?php
/**
 * 
 * @author RadiusTheme
 * @since 1.6
 * @version 1.0.1
 * 
 */

// Security check
defined('ABSPATH') || die();

final class RtAjaxTemplateFileLoader{

    public function __construct(){

        // Hook Initialization
        add_action('wp_ajax_nopriv_load_template', array(&$this, 'load_template'));
        add_action('wp_ajax_load_template', array(&$this, 'load_template'));

        // Asset Initialization

    }

    public function load_template(){

        wc_get_template_part(
            'ajax/' . sanitize_text_field($_POST['template']), 
            sanitize_text_field($_POST['part'])
        );

        wp_die();

    }

}

new RtAjaxTemplateFileLoader();