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
define('DB_NAME', 'ittf_live');

/** MySQL database username */
define('DB_USER', 'ittf_dba');

/** MySQL database password */
define('DB_PASSWORD', 'iFK&tS1+gMOG');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cW~NR)ng+ff?z7beUSI#!2U#xQv+E*%y$-9oX,(NPz&@j1#XQ4Y,ICL,42O==zTg');
define('SECURE_AUTH_KEY',  '-^,,I >eo|cF+=Kw!Vo}AxvZ1Mbl+>i12IArKeCF=#ZF!W~I+M`l^QJF+$?qJC!O');
define('LOGGED_IN_KEY',    'v<$!pa]mw?f}ay;;.+l q|ij^OGkBUY$okDoj&%LisHZI$}tU5wO^-5Y+A<rP|O~');
define('NONCE_KEY',        'Tnp?lh8McPX!ELJv-qAFh*WEt1c|(4!1m%;{k]80XrzP*2-k5m}-C+Z^08{c|N%X');
define('AUTH_SALT',        '%Vj{<(S5WL0a7[wTt*ewG0G7,($RV^|TZ]*qH%3Mki3<`I5<cJ7~Vq nuQg@3C(>');
define('SECURE_AUTH_SALT', 'u)ZO%2uT<V5OL#K89a?~{.3MAZ8Pmv~4*z6k@*EM6%G^rXpE2:Y:C1OSLdJ/0e`)');
define('LOGGED_IN_SALT',   'xpX/uC]|B=c:&:zM|1e^t<F].[vp3(r+@Ij-N%!B%RhBO`yy7z yrA{Rj(nme/K4');
define('NONCE_SALT',       'i[7@VPb2wE01Sq/cn1L44J5u+C}:4oWa-/AY@+N/K[8*=&d]DXcCxT6cvHqE[y2Q');
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
define('WP_DEBUG', false);
define( 'WP_MEMORY_LIMIT', '512M' ); 


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
