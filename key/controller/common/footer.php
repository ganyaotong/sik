<?php
/**
* 公共footer
*/
class ControllerCommonfooter extends Controller
{
	
	function index()
	{	
		# code...
		$this->template = 'common/footer.tpl';
		$this->render();
	}
}
?>