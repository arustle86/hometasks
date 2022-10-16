<?php 

// Security check
defined('ABSPATH') || die();

if( !class_exists('RTVerticalMenu') ){

    class RTVerticalMenu extends WP_Widget{

        function __construct(){

            parent::__construct(

                'RTverticalMenu',
                
                __('Metro: Vertical Menu', 'metro'),
                
                array(

                    'description' => __('Vertical menu for regular widget display', 'metro')

                )

            );

        }

        // Creating widget front-end
        public function widget( $args, $instance ) {

            $icon_display = $instance[ 'icon_display' ] ? true : false;

            ?>

            <div class="rt-el-vertical-menu">
                <?php radiustheme\Metro\Helper::get_template_part( 'template-parts/vertical-menu', array( 'icon_display' => $icon_display/*$data['icon_display']*/ ) );?>
            </div>

            <?php

        }
                
        // Creating widget Backend 
        public function form( $instance ) {
            
            if ( isset( $instance[ 'icon_display' ] ) ) {
                $icon_display = $instance[ 'icon_display' ];
            } else {
                $icon_display = false;
            }
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'icon_display' ); ?>"><?php _e( 'Icon Display:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'icon_display' ); ?>" name="<?php echo $this->get_field_name( 'icon_display' ); ?>" type="checkbox" <?php checked( $instance[ 'icon_display' ], 'on' ); ?> />
            </p>
            <?php

        }
            
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            
            $instance = $old_instance;
            $instance['icon_display'] = $new_instance['icon_display'];

            return $instance;

        }

    }

    function wpb_load_widget() {

        register_widget( 'RTVerticalMenu' );
    
    }
    
    add_action( 'widgets_init', 'wpb_load_widget' );

}



?>