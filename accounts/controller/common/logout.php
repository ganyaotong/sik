<?php
/**
* 登陆功能类
*/
class ControllerCommonLogout extends Controller
{
  private $error = array();
	
	function index()
	{
		  $this->user->logout();
		  //$this->response->setOutPut($this->render(false));
      header("Location: ". HTTP_ROOT);
	}

	
}
?>