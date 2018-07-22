<?php
/**
* 用户签约
*/
class ControllerCommonSignup extends Controller
{
  private $error = array();
	
	function index()
	{
		
    	$this->load->model('common/user');
    	if ($this->request->server['REQUEST_METHOD'] == 'POST') {

          $this->session->data['captcha']="";
          # code...
          $this->validate();
          if(isset($this->error['email']) || isset($this->error['warning'])){
            echo "3";
          }else{
            
              if (!isset($this->error['userIn'])) {
                $userid=$this->model_common_user->addUser($this->request->post);

              }
               echo "1";
           }      
        
    			
    	}else{
        $this->data['Signupverify'] = $this->url->link('common/signupverify');
        $this->data['action'] = $this->url->link('common/signup');
        $this->data['actionPhone'] = $this->url->link('common/signupphone');
        $this->template = $this->config->get('config_template') . 'common/signup.tpl';
        $this->response->setOutPut($this->render(true));
      }
    	
	}

	//驗證數據
	private function validate() {
    	
    	if ((strlen(utf8_decode($this->request->post['email'])) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = "無效的郵箱地址";
    	}

    	if ($this->model_common_user->getTotalUsersByEmail($this->request->post['email'])) {

          if ($this->model_common_user->getverifyByEmail($this->request->post['email'])) {
            # code...
            $this->error['userIn'] = "fuck you";
          }else{
            $this->error['warning'] = "";
          }
      		
    	}
		
    	//if ((strlen(utf8_decode($this->request->post['password'])) < 6) || (strlen(utf8_decode($this->request->post['password'])) > 20)) {
      //		$this->error['password'] = "密码必须在3到20字符之间";
    	//}

    	/*
    	if ($this->request->post['confirm'] != $this->request->post['password']) {
      		$this->error['confirm'] = $this->language->get('error_confirm');//兩次密碼不一致
    	}
		
  		if (!isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}
    	//條款
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');
			
			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			
			if ($information_info && !isset($this->request->post['agree'])) {
      			$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}
		*/
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}

}
?>