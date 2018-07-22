<?php
/**
* sidebar 类
*/
class ControllerCommonSidebar extends Controller
{
	
	function index()
	{
		# code...
		$this->template = 'common/sidebar.tpl';
		$this->render();
	}
}
?>