<?php
/**
* 登陆功能类
*/
class ControllerCommonLogin extends Controller
{
  private $error = array();
	
	function index()
	{
		  if ($this->user->isLogged()) {  
      		$this->redirect($this->url->link('common/key'));
    	}
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){

        //二次验证
        $userid =$this->session->data['user_id'];
        $this->load->model('common/user');
        if ($this->model_common_user->getAuthenticatorStatus($userid)) {
          # code...
          $this->session->data['tmpUserid'] = $this->session->data['user_id'];
          unset($this->session->data['user_id']);
          $this->redirect($this->url->link('common/authenticator'));
        }
        //二次验证 END
        if($this->session->data['link'] =='clientmobile'){
          $this->redirect($this->url->link('common/clientMobile'));
        }
        if ($this->session->data['link'] == '') {
          # code...
           $this->redirect($this->url->link('common/key'));
        }
          $this->redirect($this->session->data['link']);
   
        
       
    	}
    $this->session->data['link'] = $this->request->get['link'];

    $this->data['LinkKey'] = $this->url->reLink('key','common/key','','ssl');
    $this->data['LinKAccounts'] = $this->url->reLink('accounts','common/key');

    $this->data['sideLinkKEY'] = $this->url->reLink('key','common/key');

    $this->data['signup'] = $this->url->link('common/signup');
    $this->data['fotget'] = $this->url->link('password/forget');
		$this->data['action'] = $this->url->link('common/login');
		$this->template = $this->config->get('config_template') . 'common/login.tpl';
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