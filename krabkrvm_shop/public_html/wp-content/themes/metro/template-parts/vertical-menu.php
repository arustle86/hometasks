<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( ! class_exists( '\radiustheme\Metro_Core\Navmenu_Walker' ) ) return;

$locations = get_nav_menu_locations();

if ( !array_key_exists( 'vertical', $locations ) ) return;

$menu_obj = get_term( $locations['vertical'], 'nav_menu' );
$menu_name = $menu_obj->name;

if ( !isset( $icon_display ) ) {
	$icon_display = true;
}
?>
<div class="vertical-menu-area">
	<div class="vertical-menu-btn">
		<img class="rtin-menubar" src="<?php echo Helper::get_img( 'menubar.png' );?>" alt="menu">
		<img class="rtin-crossbar" src="<?php echo Helper::get_img( 'crossbar.png' );?>" alt="menu">
		<h3 class="rtin-title"><?php echo esc_html( $menu_name );?></h3>
	</div>
	<?php
	wp_nav_menu( array( 
		'theme_location'  => 'vertical',
		'container'       => 'nav',
		'container_class' => 'vertical-menu',
		'fallback_cb'     => false,
		'walker'          => new \radiustheme\Metro_Core\Navmenu_Walker( $icon_display )
	) );
	?>
</div>