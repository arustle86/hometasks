<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="page-thumbnail"><?php the_post_thumbnail( 'rdtheme-size1' );?></div>
	<?php endif; ?>
	<?php the_content();?>
	<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after'  => '</div>', 'link_before' => '<span class="page-number">', 'link_after'  => '</span>' ) );?>
</div>