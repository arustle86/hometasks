<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;
?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<?php Helper::left_sidebar();?>
			<div class="<?php Helper::the_layout_class();?>">
				<div class="main-content customize-page-selector">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						get_template_part( 'template-parts/content', 'page' );
						if ( comments_open() || get_comments_number() ){
							comments_template();
						}
						?>
					<?php endwhile; ?>
				</div>
			</div>
			<?php Helper::right_sidebar();?>
		</div>
	</div>
</div>
<?php get_footer(); ?>