<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$nav_menu_args = Helper::nav_menu_args();

$logo = empty( RDTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : RDTheme::$options['logo']['url'];
?>
<div class="main-header">
	<div class="header-wrapper">
		<div class="rtin-left">
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img width='117px' height='53px' src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
		</div>
		<div class="rtin-middle">
			<div class="main-navigation-area">
				<div class="main-navigation"><?php wp_nav_menu( $nav_menu_args );?></div>
			</div>
		</div>
		<div class="rtin-right">
			<?php get_template_part( 'template-parts/header/icon', 'area' );?>
		</div>
	</div>
</div>