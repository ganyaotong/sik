<?php
// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/install/');
define('HTTP_IMAGE',  'http://'.$_SERVER['HTTP_HOST'].'/image/');
define('HTTP_ADMIN',  'http://'.$_SERVER['HTTP_HOST'].'/admin/');
define('HTTP_ROOT',   'http://'.$_SERVER['HTTP_HOST'].'/');

// HTTPS
define('HTTPS_ROOT',   'https://'.$_SERVER['HTTP_HOST'].'/');
define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST'].'/');
define('HTTPS_IMAGE',  'https://'.$_SERVER['HTTP_HOST'].'/image/');

// 全局目录配置
define('DIR_ROOT', str_replace('\install', '', dirname(__FILE__)));     
define('DIR_APPLICATION', 	DIR_ROOT . '/install/');
define('DIR_SYSTEM', 		DIR_ROOT . '/system/');
define('DIR_TEMPLATE', 		DIR_ROOT . '/install/view/template/');
define('DIR_CONFIG', 		DIR_ROOT . '/system/config/');
define('DIR_DATABASE', 		DIR_ROOT . '/system/database/');		   
define('DIR_LOGS', 			DIR_ROOT . '/system/logs/');			   
define('DIR_CACHE', 		DIR_ROOT . '/system/cache/');		       
define('DIR_LANGUAGE',      DIR_ROOT . '/install/language/');          
define('DIR_IMAGE',         '/image/');                                
define('DIR_DOWNLOAD',      DIR_ROOT . '/download/');          

