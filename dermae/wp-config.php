<?php
define( 'WP_HOME', 'http://dermae.e-motors.mobi' );
define( 'WP_SITEURL', 'http://dermae.e-motors.mobi' );

$uh_wpconfig_dir = preg_replace('/\\\\/', '/', dirname(__FILE__));
$uh_wp_path = preg_replace('/(E:\/home\/[^\/]+\/[^\/]+\/|\/var\/www\/html\/[^\/]+\/)web(.*)/', '$2', $uh_wpconfig_dir);
if (!empty($_SERVER['HTTP_HOST'])) {
    $uh_site_url = 'http://' . $_SERVER['HTTP_HOST'] . $uh_wp_path;
    define('WP_SITEURL', $uh_site_url);
    define('WP_HOME', $uh_site_url);
}
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
define('DB_NAME', "emotors_dermae");

/** MySQL database username */
define('DB_USER', "emotors_admin");

/** MySQL database password */
define('DB_PASSWORD', "Emotors12345");

/** MySQL hostname */
define('DB_HOST', "localhost");

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'ljyAbwwsa(D)dwiDLSXTgYg7(T(xbaeA&m3AIS1LH#U91xAV0EzCnLvqb(X2Zp@L');
define('SECURE_AUTH_KEY',  'wC7cbuJEz@cfQ4666mT4SjSsMdpFDJyFx6gpYqcxzm9j9%NVvGT%J!bMotKXM(Kk');
define('LOGGED_IN_KEY',    'uLi*qG9uizHvWIb3B%rHXen%sF(Q3yUk!Opn0ZJqi4onGI**Yyhch!sYDAv@Lz!^');
define('NONCE_KEY',        '8#RU#Nui**QUKk#qWXjMQQWzz&3#xvBXfKJ03BnH%WZkYPK5@EFvIvd2^TGuKbYj');
define('AUTH_SALT',        '@E65H4%58v3taW3l(YMLQxSs^NWw)VBr!vGU#OsVxeP!KwFpi!ng%Q#G)dA&Peug');
define('SECURE_AUTH_SALT', 'Z1#V%0Y^4n*(CtXYhm#PHMw#7hz&wN1z3x*r3#0zkaGQt(zA%U&bx*dcR9moxSn2');
define('LOGGED_IN_SALT',   'Je7W91SZly7ASzqM3^l^UCi*dbvKXrM5NRn2dSmH3r&OVI3xYffpHvKka&0*k0vR');
define('NONCE_SALT',       'Wa50PK(GCqY^TqMMuGj29T@&jxueS&%G%*@&4oQ1kvZsSzWNXqN#o^0BD&MThhJ7');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
define( 'WP_HOME', 'http://dermae.e-motors.mobi' );
define( 'WP_SITEURL', 'http://dermae.e-motors.mobi' );
$table_prefix  = 'apswp_';

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

define ('FS_METHOD', 'direct');
?>