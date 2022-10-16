<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<section class="no-results not-found">
	<h2 class="page-title"><?php esc_html_e( 'Ничего не найдено', 'metro' ); ?></h2>
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>', 'metro' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'metro' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'metro' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>