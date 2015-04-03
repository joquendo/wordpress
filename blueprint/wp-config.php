<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
 
// Define Environments
$environments = array(
    'local'             => 'loc.',
    'develop'			=> 'dev.',
    'production'		=> 'prod.'
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];
foreach($environments AS $key => $env){
	if(strstr($server_name, $env)){
		define('ENVIRONMENT', $key);
		break;
	}
}

// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

switch(ENVIRONMENT){
		
	case 'local':
		define('DB_NAME', 'blueprint-dev');
		define('DB_USER', 'root');
		define('DB_PASSWORD', '123');
		define('DB_HOST', '127.0.0.1');
		define('WP_DEBUG', true);
		define('WP_SITEURL', 'http://loc.blueprint.luskin.ucla.edu/');
		define('WP_HOME', 'http://loc.blueprint.luskin.ucla.edu/');
	break;
	
	case 'develop':
		define('DB_NAME', 'blueprint-dev');
		define('DB_USER', 'blueprint');
		define('DB_PASSWORD', 'blueprint5Q!');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', true);
		define('WP_SITEURL', 'http://dev.blueprint.luskin.ucla.edu/');
		define('WP_HOME', 'http://dev.blueprint.luskin.ucla.edu/');
	break;
	
	case 'production':
		define('DB_NAME', 'blueprint');
		define('DB_USER', 'blueprint');
		define('DB_PASSWORD', 'blueprint5Q!');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', false);
		define('WP_SITEURL', 'http://blueprint.luskin.ucla.edu/');
		define('WP_HOME', 'http://blueprint.luskin.ucla.edu/');
	break;
}










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
define('AUTH_KEY',         '`|*$Mt4{Zsf?9]:(+;a>rRS:3=$+*YL?xd(viZZG$zd4d+v*v1fSBP8XQp|V6D_>');
define('SECURE_AUTH_KEY',  'd@c*+_.U7H3%|wNr]IOGus-zAz,C-rrL%-l-UL2]BA~=yw<$J+R-G(}AFum!eVi`');
define('LOGGED_IN_KEY',    'FR.h]BqQTn2ii>DH9s2/cV%ies}[4vMSgH`6AeEbDiCE0:<(tpA=yL/o~{0cW-G6');
define('NONCE_KEY',        'v_sI<J=Sc{r6AEjosp>2<O0y<%tH:q_?Mob^875{^7~j2M=7F@27r}ml<=aV7Bq~');
define('AUTH_SALT',        '3?N;6}|B38]vwLsw<S}O,_f0WJiq+#P^+=8<K/&|h00ck5 EDQ))RNE@O5y$SDp=');
define('SECURE_AUTH_SALT', 'ZbEb@3-$&4?^zmI|0!y#W_k+Xf3_o/PStU2W4xE}_@m!NpA:l6}A`.$>LZoL360;');
define('LOGGED_IN_SALT',   '=dKn;soy|MyLqi4PS8urxID.}h~_}55T|?6V-G9V5W-[f(qCZtEZ$x:`*@,Q44M]');
define('NONCE_SALT',       'VG*Fq~B7cT.IWCQ#cJz{/j[RCV|(R`Th&4/)>%Arrpe$6%9m7*~|LD-=8}gOCd.a');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'blueprint-dev');

/** MySQL database username */
//define('DB_USER', 'blueprint');

/** MySQL database password */
//define('DB_PASSWORD', 'blueprint5Q!');

/** MySQL hostname */
//define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
//define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
//define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
//define('AUTH_KEY',         '`|*$Mt4{Zsf?9]:(+;a>rRS:3=$+*YL?xd(viZZG$zd4d+v*v1fSBP8XQp|V6D_>');
//define('SECURE_AUTH_KEY',  'd@c*+_.U7H3%|wNr]IOGus-zAz,C-rrL%-l-UL2]BA~=yw<$J+R-G(}AFum!eVi`');
//define('LOGGED_IN_KEY',    'FR.h]BqQTn2ii>DH9s2/cV%ies}[4vMSgH`6AeEbDiCE0:<(tpA=yL/o~{0cW-G6');
//define('NONCE_KEY',        'v_sI<J=Sc{r6AEjosp>2<O0y<%tH:q_?Mob^875{^7~j2M=7F@27r}ml<=aV7Bq~');
//define('AUTH_SALT',        '3?N;6}|B38]vwLsw<S}O,_f0WJiq+#P^+=8<K/&|h00ck5 EDQ))RNE@O5y$SDp=');
//define('SECURE_AUTH_SALT', 'ZbEb@3-$&4?^zmI|0!y#W_k+Xf3_o/PStU2W4xE}_@m!NpA:l6}A`.$>LZoL360;');
//define('LOGGED_IN_SALT',   '=dKn;soy|MyLqi4PS8urxID.}h~_}55T|?6V-G9V5W-[f(qCZtEZ$x:`*@,Q44M]');
//define('NONCE_SALT',       'VG*Fq~B7cT.IWCQ#cJz{/j[RCV|(R`Th&4/)>%Arrpe$6%9m7*~|LD-=8}gOCd.a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
//$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
//define('WP_DEBUG', false);

/* Direct Update */
//define('FS_METHOD','direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
//if ( !defined('ABSPATH') )
//	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
//require_once(ABSPATH . 'wp-settings.php');
