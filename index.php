<?php
// Version
define('VERSION', '1.7.8');

// 载入配置
require_once(dirname(__FILE__).'./config.php');

// 启动框架
require_once(DIR_SYSTEM . 'startup.php');
require_once(DIR_SYSTEM . 'library/user.php');

// Registry
$registry = new Registry();

// 载入对象
$loader = new Loader($registry);
$registry->set('load', $loader);

// 配置对象
$config = new Config();
$registry->set('config', $config);

// 数据库对象 
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

// 注册url对象
$url = new Url($config->get('config_url'), $config->get('config_ssl'));	
$registry->set('url', $url);

// 请求对象
$request = new Request();
$registry->set('request', $request);
 
// 响应对象
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
$registry->set('response', $response); 
		
// 注册缓存对象
/*
$cache = new Cache();
$registry->set('cache', $cache); 
*/
// session对象
$session = new Session();
$registry->set('session', $session); 

// 注册页面文档对象
$document = new Document();
$registry->set('document', $document); 

$registry->set('user' , new User($registry));	
		

// 控制器对象 
$controller = new Front($registry);

// Router
if (isset($request->get['route'])) {
	$action = new Action($request->get['route']);
} else {
	$action = new Action('common/home');
}
//print_r($action);
// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();
?>