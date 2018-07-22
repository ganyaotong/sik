<?php
final class Cache { 
	private $expire = 3600; 
	private $KV; 

  	public function __construct() {
		$this->KV = new SaeKV();
		$this->KV->init();
		//var_dump($ret);
		//$ret = $this->KV->pkrget('cache.', 100);

		/*sae cache
		$files = glob(DIR_CACHE . 'cache.*');		
		if ($files) {
			foreach ($files as $file) {
				$time = substr(strrchr($file, '.'), 1);

      			if ($time < time()) {
					if (file_exists($file)) {
						unlink($file);
					}
      			}
    		}
		}*/
  	}

	public function get($key) {
		$cache = $this->KV ->get('cache.'.$_SERVER['HTTP_APPVERSION'] .preg_replace('/[^A-Z0-9\._-]/i', '', $key));
		//PRINT_r( $cache );
		if($cache){
			return unserialize($cache);
		}
		/*
		$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
		if ($files) {
			$cache = file_get_contents($files[0]);
			return unserialize($cache);
		}*/
	}

  	public function set($key, $value) {
		//$kv = new SaeKV();
		//$ret = $kv->init();          
		$ret =$this->KV ->set('cache.'. $_SERVER['HTTP_APPVERSION']. preg_replace('/[^A-Z0-9\._-]/i', '', $key), serialize($value));
		/*sae cache
    	$this->delete($key);		
		$file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $this->expire);    	
		$handle = fopen($file, 'w');
    	fwrite($handle, serialize($value));		
    	fclose($handle);*/
  	}
	
  	public function delete($key) {
		//$kv = new SaeKV();
		//$ret = $kv->init();
		$ret = $this->KV ->delete('cache.'.$_SERVER['HTTP_APPVERSION'] . preg_replace('/[^A-Z0-9\._-]/i', '', $key));
		/*sae cache
		$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');		
		if ($files) {
    		foreach ($files as $file) {
      			if (file_exists($file)) {
					unlink($file);
					clearstatcache();
				}
    		}
		}*/
  	}
}
?>