<?php
/**
* 登陆功能类
*/
class ControllerPasswordSet extends Controller
{
  private $error = array();
	
	function index()
	{
    /*
    if (!isset($this->session->data['install'])) {
      exit();
    }
    */  
      $this->load->model('common/user');
      if ($this->request->server['REQUEST_METHOD'] == 'POST') {

        $psd = $this->request->post['psd'];
        
        if (isset($this->session->data['activeCode'])) {
          # code...
          $this->model_common_user->activeuser($psd);
          echo "1";
        }else{
          echo "0";
        }

      }else{
        $this->load->model('common/user');
        if (isset($this->session->data['activeCode'])) {
          # code...
          $this->data['setpwsLink'] = $this->url->link('password/set');
          $this->template = $this->config->get('config_template') . 'password/set.tpl';
          $this->response->setOutPut($this->render(false));
        }
        
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