<?php
/**
* 登陆功能类
*/
class ControllerCommonAuthenticator extends Controller
{
  private $error = array();
	
	function index()
	{
 
    	if ($this->request->server['REQUEST_METHOD'] == 'POST'){

        require_once(DIR_SYSTEM . 'library/GoogleAuthenticator.php');
        $ga = new PHPGangsta_GoogleAuthenticator();

        $oneCode =  $this->request->post['code'];
        $checkResult = $ga->verifyCode($this->session->data['authenticatorCode'], $oneCode, 2);
        if ($checkResult) {
          
          $this->session->data['user_id']=$this->session->data['tmpUserid'];

          if ($this->session->data['link'] == '') {
          # code...
           $this->redirect($this->url->link('common/home'));
        }
          $this->redirect($this->session->data['link']);
        } else {
        
        }
    	}
		$this->data['action'] = $this->url->link('common/authenticator');
		$this->template = $this->config->get('config_template') . 'common/authenticator.tpl';
		$this->response->setOutPut($this->render(false));
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
}
?>