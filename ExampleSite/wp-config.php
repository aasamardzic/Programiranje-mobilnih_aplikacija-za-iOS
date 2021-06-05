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
define( 'DB_NAME', 'ExempleSite' );

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
define( 'AUTH_KEY',         'qvg< .:a #Bru76eE:brvh0qNA^|j8r}M)0Tqi!$p8v%@E^cZHED.a.ZC1ZG`kJ}' );
define( 'SECURE_AUTH_KEY',  '9J3i.p2ikxoSJzQz/-33/ARGXBHGmH3(.RZ0E:(quqo_8^%Y+7LVK8GQ:>NKNU2s' );
define( 'LOGGED_IN_KEY',    'V]/nU6!Q*1;geYAglq3nFSk)LGZSWMKOK[^:#}_F8Y?zICs{WNQ %s._F=fIPrcq' );
define( 'NONCE_KEY',        '2/iYzgi:Q}a{uMJ=N`%|4^?*lAD^O^i*AS%M8{t#(YS)Ovz4i] eB)ME-~;/*{wv' );
define( 'AUTH_SALT',        '(HT>hp03|)=>25( fn0dM )28)|PjngUj0)2VB)h{+WoWO28v{A[M4~1-ejR` `7' );
define( 'SECURE_AUTH_SALT', 'vu?6QIy#E1~XaZ%_i}FkS/IzC6z0!<642P5zNq&X+#-`T@Ouv+c`~$lSzO&S:Z/a' );
define( 'LOGGED_IN_SALT',   ' AQY9dzFgFu (W6D!Z/VH9*?#4fx7f.f+)hPR]~e-=u1Q*=)SgN1r]z1S>/n]sq{' );
define( 'NONCE_SALT',       'b)Z;=8 k&ci,t sML3fCm<enFn/r|RkviEslTK(nuu9jgCEYr~f-+K]+Zl8o~:A&' );

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
