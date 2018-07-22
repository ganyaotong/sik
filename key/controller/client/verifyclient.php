<?php
/**
* 登陆功能类
*/
class ControllerClientVerifyClient extends Controller
{
  private $error = array();
	
	function index()
	{

        if ($this->request->server['REQUEST_METHOD'] == 'POST'){
                //phone login
            if ($this->is_phone($this->request->post['emailphone'])) {
                if ($this->validateForPhone()) {
                    $clientCode=$this->addDevice();
                    $array= array("islogin"=>"true","clientcode"=>$clientCode);
                }else{
                    $array= array("islogin"=>"false","clientcode"=>"null");
                }

                //email login
            }elseif ($this->is_email($this->request->post['emailphone'])) {
                if ($this->validate()) {
                    $clientCode=$this->addDevice();
                    $array= array("islogin"=>"true","clientcode"=>$clientCode);
                }else{
                    $array= array("islogin"=>"false","clientcode"=>"null");
                }
            }else{
                 $array= array("islogin"=>"false","clientcode"=>"null");
            }
        }
        echo json_encode($array);
        /*
		$this->data['action'] = $this->url->link('client/login');
		$this->template = $this->config->get('config_template') . 'client/login.tpl';
		$this->response->setOutPut($this->render(false));
        */
        
	}

    function addDevice(){
        $this->load->model('client/device');
        $client_code = $this->model_client_device->addDevice($this->request->post['device']);
        return $client_code;
    }
    function is_phone($phone) {  
        if (strlen ( $phone ) != 11 || ! preg_match ( '/^1[3|4|5|8][0-9]\d{4,8}$/', $phone )) {  
            return false;  
        } else {  
            return true;  
        }  
    }  

    function is_email($email){  
        if (filter_var ($email, FILTER_VALIDATE_EMAIL )) {  
            return true;  
        } else {  
            return false;  
        }  
    }  

	private function validate() {
    	if (!$this->user->login($this->request->post['emailphone'], $this->request->post['password'])) {
      		$this->error['warning'] = "登陆错误";
    	}
	
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}  	
  	}
    private function validateForPhone() {
        if (!$this->user->loginForPhone($this->request->post['emailphone'], $this->request->post['password'])) {
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