<?php
/**
* 公共头
*/
class ControllerCommonHeader extends Controller
{
	
	function index()
	{
		# code...
		$this->data['title'] = $this->document->getTitle();
		$this->template = "common/header.tpl";
		$this->render();
	}
}
?>