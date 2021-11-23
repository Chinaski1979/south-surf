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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'southsurf_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         's_)RM;ok)COl{d6BVJ)/%~ank*TB&%)|kqh_&$NI,z]2}ph#r]zD_INtj Ud&kNH' );
define( 'SECURE_AUTH_KEY',  '38{D(QmGy]eISs&Bd|MN>qo&aPO6Qn/Ra;d5jLXbq.1a?6{.pO|>p:u0H3}Fqyv!' );
define( 'LOGGED_IN_KEY',    ' +rb=}L5^!?N1LExm`>:K8Kf!(-uY~}{AHXL*x&(1$X$pur&PAr[>%qL!nAq)<rV' );
define( 'NONCE_KEY',        ':@6pZH$-&w4lv!EPjY4-u1>!..u(mP1UkloSwMt 5$]ychDF%Jwf>O,~})[!^+^}' );
define( 'AUTH_SALT',        'Nz@C3XUJ!u>}6Pdp#;x|@!6XF>RJpOt999oR>xqKnr:m ,AA,|;z^z.@0_ZPp_Fk' );
define( 'SECURE_AUTH_SALT', '4W$`NTe=lii*}vyS{[l)m+LfG|,uo.;V1.r}4O5|U0/RFS%Sj]I0g+8>%zbl(#^<' );
define( 'LOGGED_IN_SALT',   'v?FG@9IVN}ne=n/fg+Jjr]6l`xBA)^CD=mv&II#0&f:&rT(<O[[AA,bV#*{X=V!q' );
define( 'NONCE_SALT',       'mdKy,@N]uLYINNZ)J1=}P3wY>YUzz?*Mn=L]&kHs,hG%=![-lT!8y+MF}+/f,_9%' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
