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
					<div class="offcanvas-menu-wrap">
					      <button type="button" class="offcanvas-menu-btn offcanvas-btn-dark menu-status-open">
					        <span class="menu-btn-icon">
					            <span></span>
					            <span></span>
					            <span></span>
					        </span>
					        <span class="menu-btn-label">
					            <span class="label-status-open">&nbsp;</span>
					            <span class="label-status-close">Close</span>
					        </span>
					    </button>
					</div>
				</div>				
				<div class="col-sm-4 col-8 rtin-right order-sm-3 mobile-right">
					<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				</div>
			</div>
		</div>		
	</div>	
</div>

<!-- Offcanvas Menu Start -->
<div id="offcanvas-body-wrap" class="offcanvas-body-wrap">
    <div class="offcanvas-item-wrap">
        <div class="nav-item">
        <?php if ( RDTheme::$options['offcanvas_title'] ): ?> 
            <h2><?php echo RDTheme::$options['offcanvas_title']; ?> </h2>
        <?php endif; ?>             
        <?php wp_nav_menu( $nav_menu_args );?> 
        </div>
        <?php if ( RDTheme::$options['offcanvas_socials'] && $socials ): ?>
            <div class="social-item">
               <ul class="main-nav">
                    <?php foreach ( $socials as $social ): ?>
                        <li><a target="_blank" href="<?php echo esc_url( $social['url'] );?>"><i class="fa <?php echo esc_attr( $social['icon'] );?>"></i></a></li>
                    <?php endforeach; ?>                    
                </ul>
            </div>
        <?php endif; ?>  
    </div>
</div>
<!-- Offcanvas Menu End -->