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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JDPhqwhO9iEpFGa22NkvfKD6mZ7G8nUki1de8tQvzMo+nAb3tSTy0pBIR2fKphzKU8Fs9IX+2chRXjjbsu6e/Q==');
define('SECURE_AUTH_KEY',  'L2S4MWr/5igZcbndpccnfa7DVD5lVgpTn8bDwInjg35OZqt82AI7O/XEbtywy61R8FpxO36dTDy16F1LD4V5Gg==');
define('LOGGED_IN_KEY',    'Kf0zHVoBw6IDQ4Rt9ITdfK4n4tV2XvZZ7HKngMGfEoNHiPcfcwhjcjYjSkSVGjFnfOjZFgC3mmSFfTgARmJjtg==');
define('NONCE_KEY',        'yaCOxj6pKy94CUC/J6ilApjagJT80G9Z0hIkfjVfEkovdiXZ0/pedr0MarOkuHmvTfewTGAaSfRnUyLtmbGGUA==');
define('AUTH_SALT',        '3kkyV9LKjxLFIHzh9sZHYCg+soNT4aC5KPSERoWfhi9WhUJgQZjz9s1n+FNTfzRX49yASf5qqHx4vurm/NVB4Q==');
define('SECURE_AUTH_SALT', 'fxq24tpZYOZkr77vUi8w6MOQq4JHFdfIs0v0cvs7cpwZiVXlFJ+w5qEvLxe+ra4ZpsCvVpFLuDhbqkE9xdTAyw==');
define('LOGGED_IN_SALT',   'D3dH1MgYb0z2S3er0xkgzTvYFf75vhx2w1XzfRyv0Ye77lzXmRBJ+6pnbmQGZTbO3AnZkdXgjTYhQ8o0taAkKw==');
define('NONCE_SALT',       'plua21ajfpgMdugMCLv7Z2PQy2sGNYM9PZpcibj4no2uL3fCXnyyuYn5IvRcQ0DKw41E0LBLwtsQjwU/vucifw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
