<?php

// HTTP
define('HTTP_SERVER', 'http://iido.sik/key/');
define('HTTP_IMAGE',  'http://iido.sik/key/view/image/');
define('HTTP_ADMIN',  'http://iido.sik/admin/');
define('HTTP_ROOT',   'http://iido.sik/');

// HTTPS
define('HTTPS_ROOT',   'https://iido.sik/');
define('HTTPS_SERVER', 'https://iido.sik/');
define('HTTPS_IMAGE',  'https://iido.sik/image/');

define('DIR_APPLICATION', 	dirname(__FILE__) . '/key/');
define('DIR_SYSTEM', 		dirname(__FILE__) . '/system/');
define('DIR_TEMPLATE', 		dirname(__FILE__) . '/key/view/template/');
define('DIR_CONFIG', 		dirname(__FILE__) . '/system/config/');
define('DIR_DATABASE', 		dirname(__FILE__) . '/system/database/');
define('DIR_LOGS', 			dirname(__FILE__) . '/system/logs/');
define('DIR_CACHE', 		dirname(__FILE__) . '/system/cache/');
define('DIR_LANGUAGE',      '/key/language/');
define('DIR_IMAGE',         dirname(__FILE__) . '/key/view/image/');
define('DIR_DOWNLOAD',      dirname(__FILE__) . '/download/');

define('DB_DRIVER',   'mysqlli');
define('DB_HOSTNAME', '127.0.0.1:3306');
define('DB_USERNAME', 'sik');
define('DB_PASSWORD', 'demo');
define('DB_DATABASE', 'iido_sik');
define('DB_PREFIX',   '');

?>
