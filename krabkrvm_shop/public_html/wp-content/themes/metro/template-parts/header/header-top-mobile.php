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
<li class="mean-append-area">
	<div class="top-header">
		<?php Helper::get_template_part( 'template-parts/header/header-top', compact( 'has_top_info', 'socials' ) );?>
	</div>
</li>