<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$post_class = Helper::has_sidebar() ? 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12' : 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12';
?>
<?php get_header(); ?>
<div id="primary" class="content-area site-index">
	<div class="container">
		<div class="row">
			<?php Helper::left_sidebar();?>
			<div class="<?php Helper::the_layout_class();?>">
				<div id="main-content" class="main-content">
					<?php if ( have_posts() ) :?>
							<?php
							if ( ( is_home() || is_archive() ) && RDTheme::$options['blog_style'] == '2' ) {
								echo '<div class="post-isotope row">';
								while ( have_posts() ) : the_post();
									echo '<div class="' . $post_class. '">';
									get_template_part( 'template-parts/content-2' );
									echo '</div>';
								endwhile;
								echo '</div>';
							}
							elseif ( ( is_home() || is_archive() ) && RDTheme::$options['blog_style'] == '3' ) {
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content-3' );
								endwhile;
							}
							else {
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content' );
								endwhile;
							}
							?>
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