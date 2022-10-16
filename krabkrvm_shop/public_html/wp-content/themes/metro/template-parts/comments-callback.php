<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$date = get_comment_date( '', $comment );
$time = get_comment_time();
?>
<?php $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';?>
<<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent main-comments' : 'main-comments', $comment ); ?>>

<div id="respond-<?php comment_ID(); ?>" class="each-comment">

	<?php if ( get_option( 'show_avatars' ) ): ?>
		<div class="imgholder">
			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], "", false, array( 'class'=>'media-object' ) ); ?>
		</div>				
	<?php endif; ?>

	<div class="comments-body">
		<div class="comment-meta">
			<h3 class="comment-author"><?php echo get_comment_author_link( $comment );?></h3>
			<span>,</span>
			<div class="comment-time"><?php printf( esc_html__( '%s @ %3s', 'metro'), $date, $time );?></div>
		</div>
		<div class="comment-text">
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Ваш комментарий на модерации', 'metro' ); ?></p>
			<?php endif; ?>
			<?php comment_text(); ?>							
		</div>
	</div>

	<?php
	comment_reply_link( 
		array_merge( $args, array(
			'add_below' => 'respond',
			'depth'     => $depth,
			'max_depth' => $args['max_depth'],
			'before'    => '<div class="reply-area">',
			'after'     => '</div>'
		) ) 
	);
	?>

</div>