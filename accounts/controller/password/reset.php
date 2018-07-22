<?php
/**
* 登陆功能类
*/
class ControllerPasswordReset extends Controller
{
  private $error = array();
	
	function index()
	{
    if ($this->user->islogged()) {
      # code...
      # echo  $this->user->getId();
      $this->data['username'] = $this->user->getUserMail();
      $this->data['action'] = $this->url->relink('key','common/home');

    }else{
      $this->data['username'] = "you";
      header('location: '. $this->url->relink('accounts','common/login') . '&&link='. $this->url->relink('key','common/home'));

    }

      $this->load->model('common/user');
      if ($this->request->server['REQUEST_METHOD'] == 'POST') {
          $psd = $this->request->post['psd'];
          # code...
          $this->model_common_user->rePassword($psd,$this->data['username']);
          echo "1";
      }else{

          $this->data['setpwsLink'] = $this->url->link('password/reset');
          $this->template = $this->config->get('config_template') . 'password/set.tpl';
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