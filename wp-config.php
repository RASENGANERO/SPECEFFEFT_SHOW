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
define( 'DB_NAME', "svetaspeceffektshow" );

/** Database username */
define( 'DB_USER', "root" );

/** Database password */
define( 'DB_PASSWORD', "root" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'Vy>vS&k(K^;lns#qu+i:az$ 9GvGJ6YId:q< rlzuSN{i%$.(m)UgR:^,W=N *9O' );
define( 'SECURE_AUTH_KEY',  'N(hqKnuk<`!eB9-ZPe?RLQ9mMzp0*|[``B}aQJR9re>ZTvLoIjg6Gu8ZR_8:KU2f' );
define( 'LOGGED_IN_KEY',    '{aYy&EmJ`/;=e,Qv@k4D!q_*nMFp`$4><ouiwFd5tka=$8> a*FKLKx1$2eEo()m' );
define( 'NONCE_KEY',        'C_RbXhG[^V`f;rv?^;bmoXVbx&AVl@u7lG=%n[b{ngsaRN%o)$HWs5TQ5vMJt.4^' );
define( 'AUTH_SALT',        '#>MYS#&|bvny4$!hhd/V{5b0QiNpB_LM:L~1Y*AQ!u*[c%EZBSH~2.*Mk98Y^_He' );
define( 'SECURE_AUTH_SALT', '`}e0<]^OBnr9 zP0=pOik$|]fR:&TIFi)YUx*4=@`%pVdZr |-A}0kNkry.p</F7' );
define( 'LOGGED_IN_SALT',   'vql#_-fT:e2DSypH9OV7K{P]~pnUyv?4>$[v`!es%(Y-^7<6{YtVA~A_$lW/=(Xn' );
define( 'NONCE_SALT',       '*@{SD tmHt~gU91A5sYAA@1l[2)tpUB}cLG4<g</ms+ n}Y]~,}v]YX[So[%R^S7' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
