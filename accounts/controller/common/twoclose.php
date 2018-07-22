<?php
/**
* 登陆功能类
*/
class ControllerCommonTwoclose extends Controller
{
  private $error = array();
	
	function index()
	{

    if ($this->request->server['REQUEST_METHOD'] == 'POST'){

        $this->load->model('common/user');
        $userid =$this->session->data['user_id'];
        $this->model_common_user->closeAuthenticator($userid);
        echo "1";
      }
	}


}
?>