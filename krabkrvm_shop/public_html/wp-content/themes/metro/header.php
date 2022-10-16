<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'metro' ); ?></a>
		<header id="site-header" class="site-header">
			<?php get_template_part( 'template-parts/header/header-top-desktop' ); ?>
			<?php 

				$meta = get_post_meta( get_queried_object_id(), 'metro_layout_settings', true );
				if( isset($meta['header_style']) && $meta['header_style'] !== 'default'){
			
					RDTheme::$header_style = $meta['header_style'];
				}
			
			?>
			<?php get_template_part( 'template-parts/header/header', RDTheme::$header_style ); ?>
		</header>
		<div id="meanmenu"></div>
		<div id="content" class="site-content">
			<?php get_template_part('template-parts/content', 'banner');?>