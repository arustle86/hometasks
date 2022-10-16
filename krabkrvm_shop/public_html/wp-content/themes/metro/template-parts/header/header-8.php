<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
$nav_menu_args  = Helper::nav_menu_offcanvas_args();
$socials        = Helper::socials();
$logo           = empty( RDTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : RDTheme::$options['logo']['url'];
?>

<div class="main-header offcanvas-header">
	<div class="header-firstrow">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-sm-4 col-xs-12 rtin-middle order-sm-2 mobile-center mobile-margin-bottom-10">
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img width='117px' height='53px' src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
					</a>
				</div>
				<div class="col-sm-4 col-4 rtin-left order-sm-1">
					<?php get_template_part( 'template-parts/header/icon', 'menu' ); ?>
				</div>				
				<div class="col-sm-4 col-8 rtin-right order-sm-3 mobile-right">
					<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				</div>
			</div>
		</div>		
	</div>	
</div>
