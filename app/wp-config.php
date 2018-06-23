<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'university');

/** MySQL database username */
define('DB_USER', 'homestead');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(5@N|NH!R.R&v<aUMhEC%?Qdco3.Al2q1p07Dc2j>S?CAZ:Noyo;l8@x!3x{v/11');
define('SECURE_AUTH_KEY',  'I9M*Z1,w0jAG+~KpHo^)v`M%Y9a:w+f$nhnl2()S-FAXtR1nzA2|K%|/4]O/-ASq');
define('LOGGED_IN_KEY',    ' p2qoe9tp+$?}YnyLnPq_>1uORs}4n*e7riHOnke4Ckx@g#<0;9Cr8DAV!<`7|g~');
define('NONCE_KEY',        'YG3:[a{6xQ:h_FBR,C%)`.!]v5Pc%sgnjBhN(OZT&G~tlzTx6`-([~)e<C|p;CfK');
define('AUTH_SALT',        '$%3/,%s%A}3)ivoAUA,bU0]*lJYSM8$??e><,FP!Bz0A]@IH_x?H|bs$7BvtTdeM');
define('SECURE_AUTH_SALT', '@mjE]#Z[~E__kco/n)98:d[h~+S(R%xdGLL,@1XDhwIx?BaIT<V-N8oEeSj8*]0x');
define('LOGGED_IN_SALT',   '6%_u/uCeL5zL}il,6Xpj~_/P:VhJ69qH+*U]Ah{d5g&4#]6xabRJO6Z$R+Gq:;t@');
define('NONCE_SALT',       'OLW{xi?~+>YE|_4X?R<,xut+?3[1==2(VZQ]/R~o;[EO1>?3a//._wc13t6(Rcdc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
