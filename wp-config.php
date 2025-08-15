<?php
// Suppress deprecation warnings for Elementor/PHP 8.4 compatibility
use function ElementorDeps\DI\env;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

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
define( 'DB_NAME', 'ena_wordpress');

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '|z5aGr2(jQVRivnn-saAOR~Ert5A5|^Am%Ro@x~y2K`<EX tC4fz}6-;f62N|OX=');
define('SECURE_AUTH_KEY',  '*![%E-g%!1Hw=Ah: ZqG9bo3If)#)I2HtXyj/s=i{N|PdkZt=$VF4,>UDS+d)zqh');
define('LOGGED_IN_KEY',    'J& ~C_-x};6ClTt)[T4U9y#V9|7`Z&_h04H/TJ;d~Yuy,.g?z|}N!+5U=ii6C^-x');
define('NONCE_KEY',        'Xd=>T5HlSZi]6z~}+>Sz,ixC~o)jLX|=$?UipYeLd~[tr$qnCToZKY0)$97ENIds');
define('AUTH_SALT',        'oI*n;zGel2e6;JhJ)E+v05P+iC+V5*)0SQ+`}VEI&W x)/f+i$7h].3!ky^+-{4o');
define('SECURE_AUTH_SALT', 'GsFvN:,cf9uS}>q-t6SV-NbIW`d*6:<ggbpwR>QutYkfsn|d>J^j7oiw_<45o:@|');
define('LOGGED_IN_SALT',   'LH4bRlL@Pvmr&<OJ@LanR(e<G;{Z6PUrY_QU(U8%){S%?oQB2lHn*+9Oo7Ak3(i-');
define('NONCE_SALT',       '+/dZx{QRO>X7Lxm7m-- -zo`,;QutQ[PZEG|6#((5)u+^UZ@N!Yuk>ZbWj9:OA,V');

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */
define('WP_MEMORY_LIMIT', '256M');
@ini_set( 'upload_max_size' , '500M' );
@ini_set( 'post_max_size', '500M');
@ini_set('max_execution_time', 600);
@ini_set('max_input_vars', '4000');
@ini_set('max_multipart_body_parts', '2000');



define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'SCRIPT_DEBUG', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
