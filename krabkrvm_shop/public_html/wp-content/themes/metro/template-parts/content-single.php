<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$thumb_size      = Helper::has_sidebar() ? 'rdtheme-size2' : 'rdtheme-size1';
$has_entry_meta  = RDTheme::$options['blog_date'] || ( RDTheme::$options['blog_cats'] && has_category() ) || RDTheme::$options['blog_author_name'] || RDTheme::$options['blog_comment_num'] ? true : false;

$comments_number = get_comments_number();
$comments_text   = sprintf( _n( '%s Комментарий', '%s Комментариев', $comments_number, 'metro' ), number_format_i18n( $comments_number ) );
$author_id       = get_the_author_meta( 'ID' );
$author_name     = get_the_author_meta( 'display_name' );
$author_bio      = get_the_author_meta( 'description' );
$author_info     = get_the_author_meta( 'metro_user_info' );
$author_designation = !empty( $author_info['designation'] ) ? $author_info['designation'] : '';
$author_socials  = array();

if ( !empty( $author_info['socials'] ) ) {
	$socials = Helper::user_socials();
	foreach ( $author_info['socials'] as $key => $value ) {
		if ( $value ) {
			$author_socials[$key] = array(
				'icon' => $socials[$key]['icon'],
				'link' => $value
			);
		}
	}	
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-each post-each-single' ); ?>>

	<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumbnail"><?php the_post_thumbnail( $thumb_size );?></div>
	<?php endif; ?>

	<span class="entry-title d-none"><?php the_title();?></span>

	<div class="post-content-area">
		<?php if ( $has_entry_meta ): ?>
			<ul class="post-meta">
				<?php if ( RDTheme::$options['blog_date'] ): ?>
					<li><i class="fa fa-calendar" aria-hidden="true"></i><span class="updated published"><?php the_time( get_option( 'date_format' ) );?></span></li>
				<?php endif; ?>
				<?php if ( RDTheme::$options['blog_author_name'] ): ?>
					<li><i class="fa fa-user" aria-hidden="true"></i><span class="vcard author"><a href="<?php echo get_author_posts_url( $author_id ); ?>" class="fn"><?php the_author(); ?></a></span></li>
				<?php endif; ?>
				<?php if ( RDTheme::$options['blog_comment_num'] ): ?>
					<li><i class="fa fa-comments" aria-hidden="true"></i><span><?php echo esc_html( $comments_text );?></span></li>
				<?php endif; ?>
				<?php if ( RDTheme::$options['blog_cats'] && has_category() ): ?>
					<li><i class="fa fa-tags" aria-hidden="true"></i><?php the_category( ', ' );?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
		<div class="post-content entry-content clearfix"><?php the_content();?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after'  => '</div>' ) );?>

		<div class="single-post-footer">
			<?php if ( RDTheme::$options['post_tags'] && has_tag() ): ?>
				<div class="post-tags">
					<h3 class="rtin-title"><?php esc_html_e( 'Тэги:', 'metro' );?></h3>
					<div class="rtin-content"><?php echo get_the_term_list( $post->ID, 'post_tag' ); ?></div>
				</div>
			<?php endif; ?>
			<?php
			if ( RDTheme::$options['post_social'] ) {
				do_action( 'rdtheme_social_share', RDTheme::$options['post_share'] );
			}
			?>		
		</div>

		<?php if ( RDTheme::$options['post_about_author'] && $author_bio ): ?>
			<div class="post-author-block">
				<div class="rtin-left">
					<a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo get_avatar( $author_id, 120 ); ?></a>
				</div>
				<div class="rtin-right">
					<h3 class="author-name"><?php echo esc_html( $author_name );?></h3>

					<?php if ( $author_designation ): ?>
						<div class="author-designation"><?php echo esc_html( $author_designation );?></div>
					<?php endif ?>

					<?php if ( $author_socials ): ?>
						<div class="author-social">
							<?php foreach ( $author_socials as $author_social ): ?>
								<a href="<?php echo esc_url( $author_social['link'] );?>" target="_blank"><i class="fa <?php echo esc_attr( $author_social['icon'] );?>"></i></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					
					<div class="author-bio"><?php echo wp_kses_post( $author_bio );?></div>
				</div>
			</div>
		<?php endif; ?>

		<?php
		if ( RDTheme::$options['post_pagination'] ) {
			get_template_part( 'template-parts/content-single-pagination' );
		}
		?>

	</div>

</div>