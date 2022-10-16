<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( !RDTheme::$has_top_bar ) {
	return;
}

$has_top_info = RDTheme::$options['phone'] || RDTheme::$options['email'] ? true : false;
$socials = Helper::socials();

if ( !$has_top_info && !$socials ) {
	return;
}
?>
<div class="top-header top-header-desktop rtin-style-<?php echo esc_attr( RDTheme::$top_bar_style );?>">
	<div class="container">
		<?php Helper::get_template_part( 'template-parts/header/header-top', compact( 'has_top_info', 'socials' ) );?>
	</div>
</div>