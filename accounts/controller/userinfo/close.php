<?php
/**
* 登陆功能类
*/
class ControllerUserinfoClose extends Controller
{
  private $error = array();
	
	function index()
	{
  
      $this->load->model('common/user');
      $this->load->model('config/config');

      if ($this->user->islogged()) {
     
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {

        $this->sendmail();
              
      }else{

        if ($this->session->data['close_code'] ==$this->request->get['activeCode']) {
              # code...
              $userid = $this->user->getId();

              $this->model_common_user->closeAccount($userid);
              $this->model_config_config->stopUserForKey($userid);
              $this->user->logout();
              echo "Close finish";

        }
      }

	   }
   }

   function sendmail(){
      if (isset($this->session->data['closeMail'])) {

            if ($this->session->data['closeMail']<3) {
              require_once(DIR_SYSTEM . 'library/Mymail.php');
              $mail = new Mymail();

              $this->session->data['close_code'] = md5(uniqid());

              $mail->mail_close($this->user->getUserMail(),$this->session->data['close_code']);

              $this->session->data['closeMail']=$this->session->data['closeMail']+1;
              echo "1";
            }else{
                //发现恶意，封ip一天
                echo "5";
            }
          
        }else {
          # code...
          $this->session->data['closeMail']=0;

        }
   }

}
?>