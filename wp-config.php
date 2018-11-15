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
define('DB_NAME', 'rajasthan_bikes');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

//for cache
define('WP_CACHE', 'false');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '4&LTfgviMZCh/&B7Ezs4-qWk{A2xPA.B]jJSH78m N-cOolJbran]oLj8|z5n+yY');
define('SECURE_AUTH_KEY',  '>47yZb6(2YAMC*+=02}r0@2Z(a~^V3: k|#>LA,)d&/D9`IcdhSv${`=e6kHUNia');
define('LOGGED_IN_KEY',    'd;{Zg|R!mbA65bb^x%MLo[+|A0_.5 CE/ F=_]M=U);j2L,s[)B6@4z|7;*dUgq)');
define('NONCE_KEY',        'tkZe?t@o }h|!~IlFsTC>KIGU]*].DhNqh%rSwGq4Fz&]|aJc!t2Bil{c]|$_+6W');
define('AUTH_SALT',        '(+Y{y5>`e?K/=t+Vj;3)I-D|xap#B&g.Xna,C.v9O^efH/BgPQ5s0N@J7wSr0G/I');
define('SECURE_AUTH_SALT', '-:35bKP3t[:Fo28KtW:meeWgE-24^t2~:?P/;yl{*3= }Ws?%f=+#K$1z{!Yi?b|');
define('LOGGED_IN_SALT',   'Hk.UgWB*xA.kl+kt5&H02a|@ #_Lk1]&i8RX]T-jLA3O$eA?ES/CJHSLei){sGP|');
define('NONCE_SALT',       '++h4$lZ&MNg5f;Y#/rK|_!D68r#M5vu)iU(8Y{-d3+r_B[cbXKrzedi#Q#%C&V|W');

error_reporting(0);

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

define('WP_SITEURL', 'http://localhost/rajasthan_bikes/trunk/');
define('WP_HOME', 'http://localhost/rajasthan_bikes/trunk/');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');



