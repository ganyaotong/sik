<?php 
class ControllerCommonContact extends Controller {
	private $error = array(); 
	    
  	public function index() {
  
 		$this->load->library('captcha');

    //$vi = new Mycaptcha();
    //$vi -> SetImage(2,7,130,60,120,1);
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
	
		$captcha->showImage();	
    	
  	}
	
  	private function validate() {
    	if ((strlen(utf8_decode($this->request->post['name'])) < 1) || (strlen(utf8_decode($this->request->post['name'])) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}

    	if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ((strlen(utf8_decode($this->request->post['enquiry'])) < 10) || (strlen(utf8_decode($this->request->post['enquiry'])) > 3000)) {
      		$this->error['enquiry'] = $this->language->get('error_enquiry');
    	}

    	if (!isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}
}
?>
