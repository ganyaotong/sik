<?php
/*
*官方主站入口 EM-WEEK
*/
final class ControllerCommonInit extends Controller 
{
	private $database;
	private $host;
	private $port;
	private $username;
	private $password;
	private $databasename;

	public function index()
	{
		$this->data['action'] = $this->url->link('common/init');
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
			switch ($this->request->post['database']) {
				case 0:
					$this->database = "mysql";
					break;
				default:
					break;
			}
			$this->host = $this->request->post['host'];
			$this->port = $this->request->post['port'];
			$this->databasename = $this->request->post['databasename'];
			$this->username = $this->request->post['username'];
			$this->password = $this->request->post['password'];
			new DB($this->database, $this->host.":".$this->port, $this->username, $this->password, $this->databasename);
			//TODO: create file
			$this->createInstallConfile();
			$this->createLocalConfile();
			$this->createKeyConfile();
			$this->createAccountsConfile();
			header('Location: '.HTTP_ROOT.'install/index.php?route=common/setup');
			
    	}else{

			$this->template = $this->config->get('config_template') . 'common/init.tpl';
			$this->response->setOutput($this->render(TRUE));

    	}
	
	}

	public function createInstallConfile(){
		$flag = "\r\n"
		."define('DB_DRIVER',   '".$this->database."');\r\n"
		."define('DB_HOSTNAME', '".$this->host.":".$this->port."');\r\n"
		."define('DB_USERNAME', '".$this->username."');\r\n"
		."define('DB_PASSWORD', '".$this->password."');\r\n"
		."define('DB_DATABASE', '".$this->databasename."');\r\n"
		."define('DB_PREFIX',   '');\r\n"
		."\r\n"
		."?>";
		file_put_contents('./config.php', $flag.PHP_EOL , FILE_APPEND | LOCK_EX);
	}


	public function createLocalConfile(){
		$flag = "<?php\r\n"
		."\r\n"
		."// HTTP\r\n"
		."define('HTTP_SERVER', 'http://".$_SERVER['HTTP_HOST']."/key/');\r\n"
		."define('HTTP_IMAGE',  'http://".$_SERVER['HTTP_HOST']."/key/view/image/');\r\n"
		."define('HTTP_ADMIN',  'http://".$_SERVER['HTTP_HOST']."/admin/');\r\n"
		."define('HTTP_ROOT',   'http://".$_SERVER['HTTP_HOST']."/');\r\n"
		."\r\n"
		."// HTTPS\r\n"
		."define('HTTPS_ROOT',   'https://".$_SERVER['HTTP_HOST']."/');\r\n"
		."define('HTTPS_SERVER', 'https://".$_SERVER['HTTP_HOST']."/');\r\n"
		."define('HTTPS_IMAGE',  'https://".$_SERVER['HTTP_HOST']."/image/');\r\n"
		."\r\n"
		."define('DIR_APPLICATION', 	dirname(__FILE__) . '/key/');\r\n"
		."define('DIR_SYSTEM', 		dirname(__FILE__) . '/system/');\r\n"
		."define('DIR_TEMPLATE', 		dirname(__FILE__) . '/key/view/template/');\r\n"
		."define('DIR_CONFIG', 		dirname(__FILE__) . '/system/config/');\r\n"
		."define('DIR_DATABASE', 		dirname(__FILE__) . '/system/database/');\r\n"
		."define('DIR_LOGS', 			dirname(__FILE__) . '/system/logs/');\r\n"
		."define('DIR_CACHE', 		dirname(__FILE__) . '/system/cache/');\r\n"
		."define('DIR_LANGUAGE',      '/key/language/');\r\n"
		."define('DIR_IMAGE',         dirname(__FILE__) . '/key/view/image/');\r\n"
		."define('DIR_DOWNLOAD',      dirname(__FILE__) . '/download/');\r\n"
		."\r\n"
		."define('DB_DRIVER',   '".$this->database."');\r\n"
		."define('DB_HOSTNAME', '".$this->host.":".$this->port."');\r\n"
		."define('DB_USERNAME', '".$this->username."');\r\n"
		."define('DB_PASSWORD', '".$this->password."');\r\n"
		."define('DB_DATABASE', '".$this->databasename."');\r\n"
		."define('DB_PREFIX',   '');\r\n"
		."\r\n"
		."?>";

		file_put_contents('../config.php', $flag.PHP_EOL , FILE_APPEND | LOCK_EX);
	}

	public function createKeyConfile(){
		$flag = "<?php\r\n"
		."\r\n"
		."// HTTP\r\n"
		."define('HTTP_SERVER', 'http://".$_SERVER['HTTP_HOST']."/key/');\r\n"
		."define('HTTP_IMAGE',  'http://".$_SERVER['HTTP_HOST']."/image/');\r\n"
		."define('HTTP_ADMIN',  'http://".$_SERVER['HTTP_HOST']."/admin/');\r\n"
		."define('HTTP_ROOT',   'http://".$_SERVER['HTTP_HOST']."/');\r\n"
		."\r\n"
		."// HTTPS\r\n"
		."define('HTTPS_ROOT',   'https://".$_SERVER['HTTP_HOST']."/');\r\n"
		."define('HTTPS_SERVER', 'https://".$_SERVER['HTTP_HOST']."/');\r\n"
		."define('HTTPS_IMAGE',  'https://".$_SERVER['HTTP_HOST']."/image/');\r\n"
		."\r\n"
		."define('DIR_ROOT', str_replace('\key', '', dirname(__FILE__)));\r\n"
		."define('DIR_APPLICATION', 	DIR_ROOT . '/key/');\r\n"
		."define('DIR_SYSTEM', 		DIR_ROOT . '/system/');\r\n"
		."define('DIR_TEMPLATE', 		DIR_ROOT . '/key/view/template/');\r\n"
		."define('DIR_CONFIG', 		DIR_ROOT . '/system/config/');\r\n"
		."define('DIR_DATABASE', 		DIR_ROOT . '/system/database/');\r\n"
		."define('DIR_LOGS', 			DIR_ROOT . '/system/logs/');\r\n"
		."define('DIR_CACHE', 		DIR_ROOT . '/system/cache/');\r\n"
		."define('DIR_LANGUAGE',      DIR_ROOT . '/key/language/');\r\n"
		."define('DIR_IMAGE',         '/image/');\r\n"
		."define('DIR_DOWNLOAD',      DIR_ROOT . '/download/');\r\n"
		."\r\n"
		."define('DB_DRIVER',   '".$this->database."');\r\n"
		."define('DB_HOSTNAME', '".$this->host.":".$this->port."');\r\n"
		."define('DB_USERNAME', '".$this->username."');\r\n"
		."define('DB_PASSWORD', '".$this->password."');\r\n"
		."define('DB_DATABASE', '".$this->databasename."');\r\n"
		."define('DB_PREFIX',   '');\r\n"
		."\r\n"
		."?>";
		file_put_contents('../key/config.php', $flag.PHP_EOL , FILE_APPEND | LOCK_EX);
	}

	public function createAccountsConfile(){
		$flag = "<?php\r\n"
		."\r\n"
		."// HTTP\r\n"
		."define('HTTP_SERVER', 'http://".$_SERVER['HTTP_HOST']."/accounts/');\r\n"
		."define('HTTP_IMAGE',  'http://".$_SERVER['HTTP_HOST']."/image/');\r\n"
		."define('HTTP_ADMIN',  'http://".$_SERVER['HTTP_HOST']."/admin/');\r\n"
		."define('HTTP_ROOT',   'http://".$_SERVER['HTTP_HOST']."/');\r\n"
		."\r\n"
		."// HTTPS\r\n"
		."define('HTTPS_ROOT',   'https://".$_SERVER['HTTP_HOST']."/');\r\n"
		."define('HTTPS_SERVER', 'https://".$_SERVER['HTTP_HOST']."/');\r\n"
		."define('HTTPS_IMAGE',  'https://".$_SERVER['HTTP_HOST']."/image/');\r\n"
		."\r\n"
		."define('DIR_ROOT', str_replace('\accounts', '', dirname(__FILE__)));\r\n"
		."define('DIR_APPLICATION', 	DIR_ROOT . '/accounts/');\r\n"
		."define('DIR_SYSTEM', 		DIR_ROOT . '/system/');\r\n"
		."define('DIR_TEMPLATE', 		DIR_ROOT . '/accounts/view/template/');\r\n"
		."define('DIR_CONFIG', 		DIR_ROOT . '/system/config/');\r\n"
		."define('DIR_DATABASE', 		DIR_ROOT . '/system/database/');\r\n"
		."define('DIR_LOGS', 			DIR_ROOT . '/system/logs/');\r\n"
		."define('DIR_CACHE', 		DIR_ROOT . '/system/cache/');\r\n"
		."define('DIR_LANGUAGE',      DIR_ROOT . '/accounts/language/');\r\n"
		."define('DIR_IMAGE',         '/image/');\r\n"
		."define('DIR_DOWNLOAD',      DIR_ROOT . '/download/');\r\n"
		."\r\n"
		."define('DB_DRIVER',   '".$this->database."');\r\n"
		."define('DB_HOSTNAME', '".$this->host.":".$this->port."');\r\n"
		."define('DB_USERNAME', '".$this->username."');\r\n"
		."define('DB_PASSWORD', '".$this->password."');\r\n"
		."define('DB_DATABASE', '".$this->databasename."');\r\n"
		."define('DB_PREFIX',   '');\r\n"
		."\r\n"
		."?>";
		file_put_contents('../accounts/config.php', $flag.PHP_EOL , FILE_APPEND | LOCK_EX);
	}

}

?>