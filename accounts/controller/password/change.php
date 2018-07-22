<?php
/**
* 登陆功能类
*/
class ControllerPasswordChange extends Controller
{
  private $error = array();
	
	function index()
	{
  
      $this->load->model('common/user');

      if ($this->user->islogged()) {
     
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {


          if (isset($this->session->data['resetMail'])) {

            if ($this->session->data['resetMail']<3) {
              require_once(DIR_SYSTEM . 'library/Mymail.php');
              $mail = new Mymail();

              $userid = $this->user->getId();
              $active_code = md5(uniqid());

              $this->model_common_user->changePassword($active_code,$userid);
              $mail->mail_changePassword($this->user->getUserMail(),$active_code);

              $this->session->data['resetMail']=$this->session->data['resetMail']+1;
              echo "1";
            }else{
                //发现恶意注册，封ip一天
                echo "5";
            }
          
        }else {
          # code...
          $this->session->data['resetMail']=0;

        }

      }

	   }
   }

}
?>