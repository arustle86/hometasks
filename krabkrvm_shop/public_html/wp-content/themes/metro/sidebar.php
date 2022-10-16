<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<div class="<?php Helper::the_sidebar_class();?>">
	<aside class="sidebar-widget-area">
		<?php
		do_action( 'metro_before_sidebar' );

		if ( RDTheme::$sidebar ) {
			dynamic_sidebar( RDTheme::$sidebar );
		}
		else {
			dynamic_sidebar( 'sidebar' );
		}

		do_action( 'metro_after_sidebar' );
		?>
	</aside>
</div>