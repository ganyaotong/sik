<?php
/**
* 登陆功能类
*/
class ControllerPasswordForget extends Controller
{
	
	function index()
	{
  
      $this->load->model('common/user');
      if ($this->request->server['REQUEST_METHOD'] == 'POST') {




        $postmail = $this->request->post['email'];
        
        if ($this->model_common_user->getUserByEmail($postmail)) {
          # code...
          //用户存在，发送email
          if (isset($this->session->data['sendMail'])) {
           # code...
              if ($this->session->data['sendMail']<3) {
                # code...
                  require_once(DIR_SYSTEM . 'library/Mymail.php');
                  $mail = new Mymail();

                  $active_code = md5(uniqid());

                  $this->model_common_user->reSetPassword($active_code,$postmail);
                  $mail->mail_reSetPassword($this->request->post['email'],$active_code);
                  $this->session->data['sendMail']=$this->session->data['sendMail']+1;
                   echo "1";
              }else{
                //发现恶意注册，封ip一天
                echo "5";
              }

          }else{

              $this->session->data['sendMail']=0;
          }
        }else{
          //用户不存在
          echo "3";
        }

      }else{
        $this->load->model('common/user');
        
          $this->data['fotget'] = $this->url->link('password/forget');
          $this->template = $this->config->get('config_template') . 'password/forget.tpl';
          $this->response->setOutPut($this->render(false));
    
        
      }
    
	}

	private function validate() {
    	if (!$this->user->login($this->request->post['email'], $this->request->post['password'])) {
      		$this->error['warning'] = "登陆错误";
    	}
	
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}  	
  	}
    function verifyCode(){

    }
}
?>