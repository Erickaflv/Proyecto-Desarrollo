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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'd=vBHBu-xAP)PvB!K|?D?Z-no{:rnfkHAu]r *|HcpHDxh?$?nxr8*onOrcP1o~7' );
define( 'SECURE_AUTH_KEY',   'kTPs&>nVJ!0aAA$)Il}D?CuKhVuN4t#^qj!a<! w]q.N7HbLV}qBqv.MW!lUH}Gp' );
define( 'LOGGED_IN_KEY',     'FQ(Z3E}x>Gd+)1_;M^M>_>j0FfJ#7aNfvP$ON)<-HNYE#8n$kDQXU?%l[J.T[Pa-' );
define( 'NONCE_KEY',         '$z9UD`eo_TLV:`?7my}AA^Sq!K(d9ClK.597=q~XE5geOHcbTD<:~V6qbH[SxD7q' );
define( 'AUTH_SALT',         '>S^#A)a7h<,hU`VHY1Z/-!J,G9]--Oo)D;,7L=;MQjQYA04VB`gZhkab;Y`WB?dq' );
define( 'SECURE_AUTH_SALT',  'jaFwt_m%ZLjIvf`DAY|V8Fvd~@BxS|sBg@AmjG-mqv`g8:eDWxNrjlbX=iu9 ]o1' );
define( 'LOGGED_IN_SALT',    ']jDb!N* d+XBN[H59Nr5{jx1?QL/f<>zXNLa1t7<v H0Q^z2nV,&789!.,DPcGvk' );
define( 'NONCE_SALT',        '?|ITkkg`;Rxu.z;LEu$.gYOkWvXGTOdo4P1m::OwucC>sltkKZx}4S~!dja2AIu+' );
define( 'WP_CACHE_KEY_SALT', 'REZ2Sh<DR{3(5MEag}U{gC%-nk6>CHsjRG2|&N3VCF]3{m>-=t3Jki-$0Yi0-7Yo' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
