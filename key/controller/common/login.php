<?php
/**
* 
*/
class ControllerCommonLogin extends Controller
{
	function index(){
	
		$this->template = $this->config->get('config_template') . 'common/login.tpl';
		$this->response->setOutPut($this->render(true));
	}
}


?>