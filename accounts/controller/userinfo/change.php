<?php
/**
* 登陆功能类
*/
class ControllerUserinfoChange extends Controller
{
  private $error = array();
	
	function index()
	{
  
      $this->load->model('common/user');

      if ($this->user->islogged()) {
     
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {


              $userid = $this->user->getId();

              $un = $this->request->post['un'];
              $email = $this->request->post['email'];
              $phone = $this->request->post['phone'];

              $this->model_common_user->changeInfo($un,$phone,$userid);

              echo "1";
            
      

      }

	   }
   }

}
?>