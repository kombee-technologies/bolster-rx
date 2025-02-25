<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bolster-rx' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'K;6IHH=08c2H_)2bSBRP7aRn0@:b8kj0|iys?CE%6uS{g6=6t~r7} 3B2);hA 3-' );
define( 'SECURE_AUTH_KEY',  'ox^&qCk)6k=K,Hk:P{$Jw2=?_OUjMnK.1{,Z!ZY^4=Zro(HH3_,- D5%O|zFR;j^' );
define( 'LOGGED_IN_KEY',    'mfm{V<_0Lk%a$)k)3?^_:a>1MT1wI6BQGv>_OOa;G$h!tlLoE `CC.>#mOE.S)K=' );
define( 'NONCE_KEY',        'e7gav]0?c#8RF<h9wLnqdDCG<qFz#R4t82v.sWNH96~oP+6*-do61-4gh81dMed}' );
define( 'AUTH_SALT',        'F;?UVBw-Znky[j>?qfs4$yHWv<B~0,<P94`W]?-qH5f!CKc/f|o_fdEJtex(}]0=' );
define( 'SECURE_AUTH_SALT', '}dDIDejmF/m~`%yh<[>DsP#vm0/f}19=O8=R+#VX_zkh]bk1pp#v@:>6_{h9Z4T=' );
define( 'LOGGED_IN_SALT',   'T<lWYwzC<BuvLORHhIFaq[FFxR3#(,Yl]LcVZLrFbsn)g TSX%R35)b )hb2r 2y' );
define( 'NONCE_SALT',       'Fn1NV2i&Z?Q,Y!k> f0UGNNkOMA/gB.{FhR`H_:hie62W|W=mCCz060]C.C0r[@e' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'blx_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
