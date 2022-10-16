<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$previous = get_previous_post();
$next = get_next_post();
?>
<div class="single-post-pagination">
	<div class="rtin-left rtin-item">
		<?php if ( $previous ): ?>
			<?php if ( has_post_thumbnail( $previous ) ): ?>
				<div class="rtin-thumb"><a href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><?php echo get_the_post_thumbnail( $previous, 'thumbnail' ); ?><div class="rtin-icon"><i class="flaticon-plus-symbol"></i></div></a></div>
			<?php endif; ?>

			<div class="rtin-content">
				<h3 class="rtin-title"><a href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><?php echo get_the_title( $previous ); ?></a></h3>
				<div class="rtin-date"><i class="fa fa-clock-o"></i><?php echo esc_html( get_post_time( get_option( 'date_format' ), false, $previous ) ); ?></div>
				<a class="rtin-link" href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><i class="fa fa-angle-left"></i><?php echo esc_html_e( 'Предыдущая запись', 'metro' );?></a>
			</div>
		<?php endif; ?>
	</div>
	<div class="rtin-right rtin-item">
		<?php if ( $next ): ?>
			<div class="rtin-content">
				<h3 class="rtin-title"><a href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo get_the_title( $next ); ?></a></h3>
				<div class="rtin-date"><i class="fa fa-clock-o"></i><?php echo esc_html( get_post_time( get_option( 'date_format' ), false, $next ) ); ?></div>
				<a class="rtin-link" href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo esc_html_e( 'Следующая запись', 'metro' );?><i class="fa fa-angle-right"></i></a>
			</div>
			<?php if ( has_post_thumbnail( $next ) ): ?>
				<div class="rtin-thumb"><a href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo get_the_post_thumbnail( $next, 'thumbnail' ); ?><div class="rtin-icon"><i class="flaticon-plus-symbol"></i></div></a></div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>