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
define('DB_NAME', 'ittf_store');

/** MySQL database username */
define('DB_USER', 'ittf_dba');

/** MySQL database password */
define('DB_PASSWORD', 'iFK&tS1+gMOG');

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
define('AUTH_KEY',         '0D=AlP5BHF+4Oe04|6;_Qlrck?%7MKA74p-.N,gc)d|#JICma8C`,aC%LHb72y`l');
define('SECURE_AUTH_KEY',  'K2|_oFG_1;/ltMTZx>6oV}3zr*4Xh8_;0_>@z<}O~d& geC,U|u+y LWdMlmRc#|');
define('LOGGED_IN_KEY',    '?7KZ|l7&%Ok +B.FK/w3OHbP8`6b %wMawu;4/!]<{B4jk:gy]kAESdVwMy&$Rr)');
define('NONCE_KEY',        'nso <S>H]<60~Ey[;cmL|2aPifYV0BUzGwZyAesRt0B=u|MV[QSz,Km<FvQhQqZv');
define('AUTH_SALT',        'FDgy7~8r5H`9$r9P+ q+G$dF(7WR.J`{<uUHK<BCkS8??P;NCfP}6lAYJ4/`#W]=');
define('SECURE_AUTH_SALT', 'FgOG@XVy-$ }F4Vs41a 1TWw*?_J? ~&%iMO _<2{Ky;d$SXXa& =? D6DUpZOJf');
define('LOGGED_IN_SALT',   '-GUAG4+7[ pxRS)hrq/dCfU*x5RG4~gc!Tzf,;fO4DWuRU,y0{szKB72|N]51F~D');
define('NONCE_SALT',       'D7{`0WwY<Syb1hH2!mhce>Al%V`VOX,6vn]tXJu|[bAZoare0ixs,p>vb=a,d:gZ');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
