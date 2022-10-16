<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

if ( post_password_required() ) {
    return;
}

if ( !have_comments() && !comments_open() ) {
    return;
}

$comments_number = get_comments_number();
$comments_text   = sprintf( _n( '%s Комментарий', '%s Комментариев', $comments_number, 'metro' ), number_format_i18n( $comments_number ) );
$has_avatar      = get_option( 'show_avatars' );
$comment_class   = !$has_avatar ? ' avatar-disabled' : '';
$comment_args    = array(
    'callback'     => 'radiustheme\Metro\Helper::comments_callback',
    'reply_text'   => esc_html__( 'Ответить', 'metro' ),
    'avatar_size'  => 100,
);

$rdtheme_commenter = wp_get_current_commenter();        
$rdtheme_req       = get_option( 'require_name_email' );
$rdtheme_aria_req  = $rdtheme_req ? ' required' : '';

$comment_form_fields =  array(
    'author' =>
    '<div class="row gutters-15"><div class="col-sm-4"><div class="form-group comment-form-author"><input type="text" id="author" name="author" value="' . esc_attr( $rdtheme_commenter['comment_author'] ) . '" placeholder="'.esc_attr__( 'Name', 'metro' ).( $rdtheme_req ? ' *' : '' ).'" class="form-control"' . $rdtheme_aria_req . '></div></div>',

    'email' =>
    '<div class="col-sm-4 comment-form-email"><div class="form-group"><input id="email" name="email" type="email" value="' . esc_attr(  $rdtheme_commenter['comment_author_email'] ) . '" class="form-control" placeholder="'.esc_attr__( 'Email', 'metro' ).( $rdtheme_req ? ' *' : '' ).'"' . $rdtheme_aria_req . '></div></div>',   

    'url' =>
    '<div class="col-sm-4 comment-form-website"><div class="form-group"><input id="website" name="website" type="text" value="' . esc_attr(  $rdtheme_commenter['comment_author_url'] ) . '" class="form-control" placeholder="'.esc_attr__( 'Website', 'metro' ).( $rdtheme_req ? '' : '' ).'"' . $rdtheme_aria_req . '></div></div></div>',
);

$comment_form_args = array(
    'class_submit'  => 'submit btn-send',
    'submit_field'  => '<div class="form-group form-submit">%1$s %2$s</div>',
    'comment_field' =>  '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" required placeholder="'.esc_attr__( 'Ваш комментарий *', 'metro' ).'" class="textarea form-control" rows="10" cols="40"></textarea></div>',
    'fields' => apply_filters( 'comment_form_default_fields', $comment_form_fields ),
);
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ): ?>
        <div class="comment-list-area">
            <h3 class="comment-title"><?php echo esc_html( $comments_text );?></h3>
            <ul class="comment-list<?php echo esc_attr( $comment_class );?>">
                <?php wp_list_comments( $comment_args ); ?>
            </ul>
            <?php the_comments_navigation(); ?>           
        </div>
    <?php endif;?>
    
    <?php if ( comments_open() ) : ?>
        <?php comment_form( $comment_form_args ); ?>
    <?php else: ?>
        <div class="comments-closed"><?php esc_html_e( 'Комментарий оставлен', 'metro' ); ?></div>
    <?php endif;?>
</div>