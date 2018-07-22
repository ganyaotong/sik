<?php
/** 
* client 客户端
* activation
*/
class ControllerClientActivation extends Controller
{
	
	function index()
	{
        if ($this->request->server['REQUEST_METHOD'] == 'POST'){
                //phone login
            $this->load->model('client/config');

            if ($this->is_phone($this->request->post['emailphone'])) {
                if ($this->validateForPhone()) {
                	if(!$this->model_client_config->activation($this->user->getId())){
						$this->related();
                    	$clientCode=$this->addDevice();

                        if ($this->model_client_config->isUsed($this->user->getId())) {
                            # code...
                            $array= array("islogin"=>"true","clientcode"=>$clientCode,"isActivation"=>"true","isused" =>"true");
                        }else{
                            $array= array("islogin"=>"true","clientcode"=>$clientCode,"isActivation"=>"true","isused" =>"false");
                        }
                        
					}else{
						$array= array("islogin"=>"false","clientcode"=>"null","isActivation"=>"false");
					}
   
                }else{
                    $array= array("islogin"=>"false","clientcode"=>"null","isActivation"=>"false");
                }

                //email login
            }elseif ($this->is_email($this->request->post['emailphone'])) {
                if ($this->validate()) {
                	if(!$this->model_client_config->activation($this->user->getId())){
						$this->related();
                    	$clientCode=$this->addDevice();

                        if ($this->model_client_config->isUsed($this->user->getId())) {
                            # code...
                            $array= array("islogin"=>"true","clientcode"=>$clientCode,"isActivation"=>"true","isused" =>"true");
                        }else{
                            $array= array("islogin"=>"true","clientcode"=>$clientCode,"isActivation"=>"true","isused" =>"false");
                        }

					}else{
						$array= array("islogin"=>"false","clientcode"=>"null","isActivation"=>"false");
					}
                	
                }else{
                    $array= array("islogin"=>"false","clientcode"=>"null","isActivation"=>"false");
                }
            }else{
                 $array= array("islogin"=>"false","clientcode"=>"null","isActivation"=>"false");
            }
        }
        echo json_encode($array);

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

	private function related() {
		$userInfo = $this->user->getUserInfo();
		$this->load->model('client/config');
		if ($this->model_client_config->addconfig($userInfo)) {
			# code...
			return true;
    	} else {
      		return false;
    	}  	
  	}

}
?>