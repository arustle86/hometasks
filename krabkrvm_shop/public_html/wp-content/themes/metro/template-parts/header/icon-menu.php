<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\Metro;
$nav_menu_args  		= Helper::nav_menu_offcanvas_args();
$socials        		= Helper::socials();
$logo           		= empty( RDTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : RDTheme::$options['logo']['url'];
$offcanvas_addit_info  	= ( RDTheme::$options['phone'] || RDTheme::$options['email'] ) ? true : false;
?>
<div class="additional-menu-area">
	<div class="sidenav">
			<a href="#" class="closebtn"><i class="fa fa-times-circle"></i></a>
		<?php if ( RDTheme::$options['offcanvas_logo'] ): ?> 
			<div class="additional-logo">
				<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img width='117px' height='53px' src="<?php echo esc_url( $logo  );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
			</div>
         <?php endif; ?>			
	        <div class="nav-item">  

	        	<?php if ( RDTheme::$options['offcanvas_title'] ): ?> 
	            <h2><?php echo RDTheme::$options['offcanvas_title']; ?> </h2>
	        <?php endif; ?>  

	        	<?php wp_nav_menu( $nav_menu_args );?> 
	        </div>

			<div class="nav-addit-info"> 

				<?php if ( RDTheme::$options['offcanvas_sub_title'] ): ?> 
				    <h3><?php echo RDTheme::$options['offcanvas_sub_title']; ?> </h3>
				<?php endif; ?>	

		        <?php if ( $offcanvas_addit_info ) { ?>					
				<?php if ( RDTheme::$options['phone'] ) { ?>
					<span><a href="tel:<?php echo esc_attr( RDTheme::$options['phone'] );?>"><?php echo esc_html( RDTheme::$options['phone'] );?></a></span>
				<?php } ?>
				<?php if ( RDTheme::$options['email'] ) { ?>
					<span><a href="mailto:<?php echo esc_attr( RDTheme::$options['email'] );?>"><?php echo esc_html( RDTheme::$options['email'] );?></a></span>
				<?php } ?>
			<?php } ?>

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
	<span class="side-menu-open side-menu-trigger">
		<span></span>
		<span></span>
		<span></span>
	</span>
</div>