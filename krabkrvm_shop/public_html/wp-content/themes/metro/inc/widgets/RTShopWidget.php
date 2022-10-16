<?php 

namespace radiustheme\Metro;
use radiustheme\Metro\RDTheme;
// Security check
defined('ABSPATH') || die();

if( !class_exists('RTShopWidget') ){

    class RTShopWidget{

        function __construct(){

            add_action('woocommerce_before_shop_loop', array(&$this, 'add_top_widget'));

        }

        function add_top_widget(){
        
            if(is_active_sidebar('topbar') && RDTheme::$options['metro_wc_top_widget']){
                echo "<div class='woocommerce-top-bar-widget-wrapper no-sudo'>";
                echo "<span class='close filter-drawer'>
                    <i class='fa fa-1x fa-angle-left'></i>
                </span>";
                echo "<div class='inner-wrapper'>"; 
                dynamic_sidebar('topbar');
                echo "<div class='top-widget-active-filter-wrapper'></div>";
                echo "<div class='widget-display-data'></div>";
                echo "</div>";
                echo "</div>";
            }

        }

    }

    new RTShopWidget();

}

?>