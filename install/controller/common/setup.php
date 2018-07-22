<?php
/*
*官方主站入口 EM-WEEK
*/
final class ControllerCommonSetup extends Controller 
{
	public function index()
	{
		$this->data['action'] = $this->url->link('common/init');
		$a=explode(";",$this->sql); 
		$this->load->model('common/init');
		$this->model_common_init->sql($a);
		$this->session->data['install']="install";
		//Todo: create config file
		header('Location: '.HTTP_ROOT.'accounts/index.php?route=common/signup');

	}

}

?>