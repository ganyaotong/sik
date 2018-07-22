<?php
class Url {
	private $url;
	private $ssl;
	private $hook = array();
	
	public function __construct($url, $ssl) {
		$this->url = $url;
		$this->ssl = $ssl;
	}

	//URL调度 配置
	public function link($route, $args = '', $connection = 'NONSSL') {
		if ($connection ==  'NONSSL') {
			$url = $this->url;	
		} else {
			$url = $this->ssl;	
		}
		
		$url .= 'index.php?route=' . $route;
			
		if ($args) {
			$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&')); 
		}
		
		return $this->rewrite($url);
	}

	//参数：---项目名---route---变量---SSL
	public function reLink($Program, $route, $args = '', $connection = 'NONSSL'){
		if ($connection ==  'NONSSL') {
			$url = HTTP_ROOT . $Program . '/';
		} else {
			$url = HTTPS_ROOT . $Program . '/';
		}
		
		$url .= 'index.php?route=' . $route;
			
		if ($args) {
			$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&')); 
		}
		
		return $this->rewrite($url);
	}
	public function addRewrite($hook) {
		$this->hook[] = $hook;
	}

	public function rewrite($url) {
		foreach ($this->hook as $hook) {
			$url = $hook->rewrite($url);
		}
		
		return $url;		
	}
}
?>