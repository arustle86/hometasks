<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'krabkrvm_wp_1' );

/** Database username */
define( 'DB_USER', 'krabkrvm_wp_1' );

/** Database password */
define( 'DB_PASSWORD', '%Ef8i4J^&' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',lOEG?jte(+pibOs5~yH}GZ;,.;T/K)l>+)zxx<Ypv0GBfF@2jV4U3Tjvq#-?<?j' );
define( 'SECURE_AUTH_KEY',  '!^lB&>f1c@^z:Vj2#}zplh6a3Q2dDM@=T4=0qRn;E`=y@0<]rdMY&yWh?;8Ln/(E' );
define( 'LOGGED_IN_KEY',    'R*O<kXm;tgR]oROaU+He/cD5cfAHO4PGQZzn>((/2Z#<|l$JH[T:p{Zk)wfG`^H=' );
define( 'NONCE_KEY',        'qp/,Qg,ys7/.[m@gM)jcn>nB=Ef9(0qGLe/QEbso-m;Y42K&O0:#Yb%qXH3&#+k/' );
define( 'AUTH_SALT',        '7IUk9;svA?]m(y64iMFb:0v[huXJ66g~23&ot<7Heq;}*pq{@,ejxn/>6F2}1OM:' );
define( 'SECURE_AUTH_SALT', 'OZu61fQx3$1^<Y(gtjRWYRlx?:hxh8T)dy-l/)^!fo|@UBBbtwBOi?eGex|P0?xc' );
define( 'LOGGED_IN_SALT',   'CJNb>oME9,_al]T4z[daXBYN& AM4ZwhNFa^3216_gonR4mb5/3l./#H]gZuQU<y' );
define( 'NONCE_SALT',       'Pp#njN,7+$%&>eO7:&qdc:8=Nxf(Taq/Fu]1*R}Z!/*0-v)(04BkZ-kscAHa!iFB' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
