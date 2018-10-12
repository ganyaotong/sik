<?php

// HTTP
define('HTTP_SERVER', 'http://iido.sik/key/');
define('HTTP_IMAGE',  'http://iido.sik/image/');
define('HTTP_ADMIN',  'http://iido.sik/admin/');
define('HTTP_ROOT',   'http://iido.sik/');

// HTTPS
define('HTTPS_ROOT',   'https://iido.sik/');
define('HTTPS_SERVER', 'https://iido.sik/');
define('HTTPS_IMAGE',  'https://iido.sik/image/');

define('DIR_ROOT', str_replace('\key', '', dirname(__FILE__)));
define('DIR_APPLICATION', 	DIR_ROOT . '/key/');
define('DIR_SYSTEM', 		DIR_ROOT . '/system/');
define('DIR_TEMPLATE', 		DIR_ROOT . '/key/view/template/');
define('DIR_CONFIG', 		DIR_ROOT . '/system/config/');
define('DIR_DATABASE', 		DIR_ROOT . '/system/database/');
define('DIR_LOGS', 			DIR_ROOT . '/system/logs/');
define('DIR_CACHE', 		DIR_ROOT . '/system/cache/');
define('DIR_LANGUAGE',      DIR_ROOT . '/key/language/');
define('DIR_IMAGE',         '/image/');
define('DIR_DOWNLOAD',      DIR_ROOT . '/download/');

define('DB_DRIVER',   'mysqlli');
define('DB_HOSTNAME', '127.0.0.1:3306');
define('DB_USERNAME', 'sik');
define('DB_PASSWORD', 'demo');
define('DB_DATABASE', 'iido_sik');
define('DB_PREFIX',   '');

?>
