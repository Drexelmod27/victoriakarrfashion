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
define( 'DB_NAME', 'victoriakarr');

/** MySQL database username */
define( 'DB_USER', 'root');

/** MySQL database password */
define( 'DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'z`wxSUo$ce69=6!</.Wq|i8$)ImR|R%<Q@C1nH3X8|0KRE;n@grBM-eSF&:513}s' );
define( 'SECURE_AUTH_KEY',  '}A<&% vA^TOL` m:bDz]KW(:~Qfqc{~c6]Vn8te.J>fZTR^tPfIe <jTW+Y##ZU-' );
define( 'LOGGED_IN_KEY',    '+5HPeT2iO0>.ZS-K }u~$W;xus<`#ZKNxQwCNp0`4Jga+a1sj!pYGVi|F>$d$e^T' );
define( 'NONCE_KEY',        '5mx}!44T,|HA6(w:(g&>A:xzFx?$z_=5oe`tZLhuyh0ngQu](Bd*^8FEYY([!5Ct' );
define( 'AUTH_SALT',        ';hY59U~JpSq*:%!>@|mdOw^J&rl~*f1(59ufh%70:UV,D*@1A~<H@n{#.G%-5Zuu' );
define( 'SECURE_AUTH_SALT', 'YS9E@[2Zi/c]<nt:?r$v+9D`X}xqpDd;735R}<k6rOZb` U$S[`/:lT&QB9g2fo~' );
define( 'LOGGED_IN_SALT',   'zimjVuPopq}Y+HC+BB}z5[w$>R1.#!F*S^Cmb;:m_dA<2M$ 5sW#u/wQdS*F&z9&' );
define( 'NONCE_SALT',       'U@yJ!zm`_tKOB(5*|[42FFG;74XtJQ#asYFc,^h2J{|:bDIcUJx3R2+Nm>Ze8RLu' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
define( 'WP_HOME', 'http://localhost/victoriakarr/' );
define( 'WP_SITEURL', 'http://localhost/victoriakarr/' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
