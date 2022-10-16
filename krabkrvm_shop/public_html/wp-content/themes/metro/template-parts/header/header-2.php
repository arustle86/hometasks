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
	<div class="header-firstrow">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-xs-12 rtin-left">
					<ul class="header-contact">
						<?php if ( RDTheme::$options['phone'] ): ?>
							<li>
								<i class="flaticon-phone-call"></i><a href="tel:<?php echo esc_attr( str_replace(' ', '', RDTheme::$options['phone'] ) );?>"><?php echo esc_html( RDTheme::$options['phone'] );?></a>
							</li>
						<?php endif; ?>
						<?php if ( RDTheme::$options['email'] ): ?>
							<li>
								<i class="flaticon-envelope"></i><a href="mailto:<?php echo esc_attr( RDTheme::$options['email'] );?>"><?php echo esc_html( RDTheme::$options['email'] );?></a>
							</li>
						<?php endif; ?>					
					</ul>
				</div>
				<div class="col-sm-4 col-xs-12 rtin-middle">
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img width='117px' height='53px' width='117px' height='53px' src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
				</div>
				<div class="col-sm-4 col-xs-12 rtin-right">
					<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				</div>
			</div>
		</div>		
	</div>
	<div class="main-navigation-area">
		<div class="container">
			<div class="main-navigation"><?php wp_nav_menu( $nav_menu_args );?></div>
		</div>
	</div>
</div>