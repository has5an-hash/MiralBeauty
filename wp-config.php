<?php
define('DB_NAME', "miralbeauty");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_HOST', "localhost");
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'DISALLOW_FILE_EDIT', false );
define('FS_METHOD', 'direct');

if ( ! defined('ABSPATH') ) define('ABSPATH', __DIR__ . '/');
define( 'DUPLICATOR_AUTH_KEY', 'XJNeFD.vKLag.}r#sc;Wk^F?osL6^xHw<s;_/e]r5A$PFoLg5`t&,B-kK$2lO*JS' );
define( 'AUTH_KEY', '' );
define( 'SECURE_AUTH_KEY', '' );
define( 'LOGGED_IN_KEY', '' );
define( 'NONCE_KEY', '' );
define( 'AUTH_SALT', '' );
define( 'SECURE_AUTH_SALT', '' );
define( 'LOGGED_IN_SALT', '' );
define( 'NONCE_SALT', '' );
require_once ABSPATH . 'wp-settings.php';
