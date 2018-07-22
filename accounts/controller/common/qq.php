<?php
/*
*官方主站入口 EM-WEEK
*/
final class ControllerCommonQq extends Controller 
{
	public function index()
	{
	//http转化为https   ac
	if ($_SERVER["HTTPS"] <> "on")
	{
		#header("Location: ". HTTPS_SERVER);
	}
		$openid=$this->request->get['openid'];
		$nn=$this->request->get['nickname'];

		$this->load->model('common/qq');
		$this->model_common_qq->addhl($openid,$nn);;
		header('Location:'.HTTP_ROOT);
	}
	

}

?>