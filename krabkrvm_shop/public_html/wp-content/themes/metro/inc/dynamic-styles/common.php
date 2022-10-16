<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$prefix        = Constants::$theme_prefix;
$primary_color = Helper::get_primary_color(); // #111111
$primary_rgb   = Helper::hex2rgb( $primary_color ); // 26, 167, 142

$typo_body     = RDTheme::$options['typo_body'];
$typo_h1       = RDTheme::$options['typo_h1'];
$typo_h2       = RDTheme::$options['typo_h2'];
$typo_h3       = RDTheme::$options['typo_h3'];
$typo_h4       = RDTheme::$options['typo_h4'];
$typo_h5       = RDTheme::$options['typo_h5'];
$typo_h6       = RDTheme::$options['typo_h6'];
?>
body,
gtnbg_root,
ul li,
input,
gtnbg_root p {
	font-family: <?php echo esc_html( $typo_body['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_body['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_body['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_body['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_body['font-style'] ) ? 'normal' : $typo_body['font-style']; ?>;
}
h1 {
	font-family: <?php echo esc_html( $typo_h1['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_h1['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_h1['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_h1['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_h1['font-style'] ) ? 'normal' : $typo_h1['font-style']; ?>;
}
h2 {
	font-family: <?php echo esc_html( $typo_h2['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_h2['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_h2['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_h2['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_h2['font-style'] ) ? 'normal' : $typo_h2['font-style']; ?>;
}
h3 {
	font-family: <?php echo esc_html( $typo_h3['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_h3['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_h3['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_h3['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_h3['font-style'] ) ? 'normal' : $typo_h3['font-style']; ?>;
}
h4 {
	font-family: <?php echo esc_html( $typo_h4['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_h4['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_h4['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_h4['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_h4['font-style'] ) ? 'normal' : $typo_h4['font-style']; ?>;
}
h5 {
	font-family: <?php echo esc_html( $typo_h5['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_h5['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_h5['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_h5['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_h5['font-style'] ) ? 'normal' : $typo_h5['font-style']; ?>;
}
h6 {
	font-family: <?php echo esc_html( $typo_h6['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $typo_h6['font-size'] ); ?>;
	line-height: <?php echo esc_html( $typo_h6['line-height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_h6['font-weight'] ); ?>;
	font-style: <?php echo empty( $typo_h6['font-style'] ) ? 'normal' : $typo_h6['font-style']; ?>;
}

a:link,
a:visited {
	color: <?php echo esc_html( $primary_color ); ?>;
}

blockquote::before,
.wp-block-quote::before {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.wp-block-pullquote {
    border-color: <?php echo esc_html( $primary_color ); ?>;
}