<?php
/**
* class
* 移动终端登录入口
*/
class ControllerCommonClientmobile extends Controller
{
	
	function index()
	{
		# code...
		if ($this->user->isLogged()) {
			# code...
			echo $this->user->getUsername();
		}
	}
}
?>