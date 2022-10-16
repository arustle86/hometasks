<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<?php get_header(); ?>
<div id="primary" class="content-area site-search">
	<div class="container">
		<div class="row">
			<?php Helper::left_sidebar();?>
			<div class="<?php Helper::the_layout_class();?>">
				<div class="main-content">
					<?php if ( have_posts() ) :?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'search' ); ?>
						<?php endwhile; ?>
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
				</div>
				<?php get_template_part( 'template-parts/pagination' );?>
			</div>
			<?php Helper::right_sidebar();?>
		</div>
	</div>
</div>
<?php get_footer(); ?>