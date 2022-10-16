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
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-sm-4 col-6">
					<div class="logo-wrp">
						<?php get_template_part( 'template-parts/header/icon', 'menu' ); ?>
						<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img width='117px' height='53px' src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
						</a>
					</div>							
				</div>							
				<div class="col-sm-8 col-6">
					<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				</div>
			</div>
		</div>		
	</div>	
</div>
