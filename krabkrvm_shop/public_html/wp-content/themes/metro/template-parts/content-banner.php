<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( !RDTheme::$has_banner ) {
	return;
}

if ( is_search() ) {
	$title = esc_html__( 'Search Results for : ', 'metro' ) . get_search_query();
}
elseif ( is_404() ) {
	$title = esc_html__( 'Page not Found', 'metro' );
}
elseif ( is_home() ) {
	if ( get_option( 'page_for_posts' ) ) {
		$title = get_the_title( get_option( 'page_for_posts' ) );
	}
	else {
		$title = apply_filters( "rdtheme_blog_title", esc_html__( 'All Posts', 'metro' ) );
	}
}
elseif ( is_archive() ) {
	$title = get_the_archive_title();
}
else{
	$title = get_the_title();
}

$title = apply_filters( 'rdtheme_page_title', $title );
?>
<div class="banner">
	<div class="container">
		<div class="banner-content">
			<h1><?php echo wp_kses_post( $title );?></h1>
			<?php if ( RDTheme::$has_breadcrumb ): ?>
				<div class="main-breadcrumb"><?php Helper::the_breadcrumb();?></div>
			<?php endif; ?>
		</div>
	</div>
</div>