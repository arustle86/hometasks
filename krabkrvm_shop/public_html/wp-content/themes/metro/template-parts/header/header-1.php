<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$nav_menu_args = Helper::nav_menu_args();

$logo       = empty( RDTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : RDTheme::$options['logo']['url'];
$logo_width = (int) RDTheme::$options['logo_width'];
$menu_width = 12 - $logo_width;
$logo_class = "col-lg-{$logo_width} col-sm-12 col-12";
$menu_class = "col-lg-{$menu_width} col-sm-12 col-12";
?>
<div class="main-header">
	<div class="container">
		<div class="row align-items-center">
			<div class="<?php echo esc_attr( $logo_class );?>">
			<div class="site-branding">
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>">
						<img width='117px' height='53px' src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
					</a>
				</div>
			</div>
			<div class="<?php echo esc_attr( $menu_class );?>">
				<div class="main-navigation-area">
					<div class="main-navigation"><?php wp_nav_menu( $nav_menu_args );?></div>
					<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				</div>
			</div>
		</div>
	</div>
</div>