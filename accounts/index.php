<?php
// 载入配置
require_once('config.php');

// 启动框架
require_once(DIR_SYSTEM . 'startup.php');
require_once(DIR_SYSTEM . 'library/user.php');
//require_once(DIR_SYSTEM . 'QQAPI/qqConnectAPI.php');


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
/*
// 日志对象
$log = new Log($config->get('config_error_filename'));
$registry->set('log', $log);

function error_handler($errno, $errstr, $errfile, $errline) {
	global $log, $config;
	
	switch ($errno) {
		case E_NOTICE
		case E_USER_NOTICE:
			$error = 'Notice';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = 'Warning';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = 'Fatal Error';
			break;
		default:
			$error = 'Unknown';
			break;
	}
		
	if ($config->get('config_error_display')) {
		echo '<b>' . $error . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';
	}
	
	if ($config->get('config_error_log')) {
		$log->write('PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	}

	return true;
}
	
// Error Handler
set_error_handler('error_handler');
*/
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
/*
// Language Detection
$languages = array();

$query = $db->query("SELECT * FROM " . DB_PREFIX . "language"); 

foreach ($query->rows as $result) {
	$languages[$result['code']] = $result;
}

$detect = '';

if (isset($request->server['HTTP_ACCEPT_LANGUAGE']) && ($request->server['HTTP_ACCEPT_LANGUAGE'])) { 
	$browser_languages = explode(',', $request->server['HTTP_ACCEPT_LANGUAGE']);
	
	foreach ($browser_languages as $browser_language) {
		foreach ($languages as $key => $value) {
			if ($value['status']) {
				$locale = explode(',', $value['locale']);
				if (in_array($browser_language, $locale)) {
					$detect = $key;
				}
			}
		}
	}
}

if (isset($request->get['language']) && array_key_exists($request->get['language'], $languages) && $languages[$request->get['language']]['status']) {
	$code = $request->get['language'];
} elseif (isset($session->data['language']) && array_key_exists($session->data['language'], $languages)) {
	$code = $session->data['language'];
} elseif (isset($request->cookie['language']) && array_key_exists($request->cookie['language'], $languages)) {
	$code = $request->cookie['language'];
} elseif ($detect) {
	$code = $detect;
} else {
	$code = $config->get('config_language');
}

if (!isset($session->data['language']) || $session->data['language'] != $code) {
	$session->data['language'] = $code;
}

if (!isset($request->cookie['language']) || $request->cookie['language'] != $code) {	  
	setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $request->server['HTTP_HOST']);
}			

$config->set('config_language_id', $languages[$code]['language_id']);
$config->set('config_language', $languages[$code]['code']);

// Language	
$language = new Language($languages[$code]['directory']);
$language->load($languages[$code]['filename']);	
$registry->set('language', $language); 
*/
// 注册页面文档对象
$document = new Document();
$registry->set('document', $document); 		


// 用户
$registry->set('user', new User($registry));

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