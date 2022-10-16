<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $comment;
$verified    = wc_review_is_from_verified_owner( $comment->comment_ID );
$is_verified = 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ? true : false;
$is_approved =  '0' === $comment->comment_approved ? false : true;
?>
<div class="wc-review-meta">
	<div class="rtin-left">
		<?php wc_get_template( 'single-product/review-rating.php' ); ?>
		<?php if ( $is_approved ): ?>
			<h3 class="wc-review-author"><?php comment_author(); ?></h3>
			<?php if ( $is_verified ): ?>
				<div class="wc-review-verified"><?php esc_html_e( 'Verified Owner', 'metro' );?></div>
			<?php endif; ?>
		<?php else: ?>
			<div class="wc-review-awaiting"><?php esc_html_e( 'Your review is awaiting approval', 'metro' ); ?></div>
		<?php endif; ?>
	</div>
	<div class="rtin-right">
		<time class="wc-review-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></time>
	</div>
</div>