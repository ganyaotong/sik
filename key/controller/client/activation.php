<?php
/** 
* client 客户端
* activation
*/
class ControllerClientActivation extends Controller
{
	/*
	* 功能描述：激活账号，激活后会添加配置
	* URL地址：client/activation/index
	* 请求方式：POST
	* 请求参数：
	*	字段：emailphone；说明：电子邮件手机号码；类型：string；必须：Y
	*	字段：password；说明：密码；类型：string；必须：Y
	* 	字段：device；说明：设备名称；类型：string；必须：Y
	* 返回结果：
	*	字段：islogin；说明：用户是否登陆成功；类型：bool；
	*	字段：clientcode：说明：设备编码；类型：string；
	*	字段：isActivation；说明：用户是否已经激活；类型：bool
	*	字段：isused；说明：是否第一次使用；类型：bool
	*/
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
	
	/*
	*	功能描述：添加设备，每一次登陆，调用这个方法添加设备到设备列表，系统维护这个设备列表，这个设备列表作用是对行动设备活动监控。
	* URL地址：client/keylogin/addDevice
	* 请求方式：POST
	* 请求参数：
	*	字段：device
	*	说明：设备名称
	*	类型：String
	*	备注：
	*	必须：Y
	* 返回结果：设备编码
	* 
	*/
	function addDevice(){
        $this->load->model('client/device');
        $client_code = $this->model_client_device->addDevice($this->request->post['device']);
        return $client_code;
    }
	/*
	* 功能描述：检测是否是手机号码
	* URL地址：client/keylogin/is_phone
	* 请求方式：内部调用
	* 请求参数：
	*	字段：phone
	*	说明：手机号码
	*	类型：Int
	*	备注：
	*	必须：Y
	* 返回结果：True/False
	* 
	*/
    function is_phone($phone) {  
        if (strlen ( $phone ) != 11 || ! preg_match ( '/^1[3|4|5|8][0-9]\d{4,8}$/', $phone )) {  
            return false;  
        } else {  
            return true;  
        }  
    }  
	/*
	* 功能描述：检测是否是Email
	* URL地址：client/keylogin/is_email
	* 请求方式：内部调用
	* 请求参数：
	*	字段：email
	*	说明：电子邮件
	*	类型：String
	*	备注：
	*	必须：Y
	* 返回结果：True/False
	*/
    function is_email($email){  
        if (filter_var ($email, FILTER_VALIDATE_EMAIL )) {  
            return true;  
        } else {  
            return false;  
        }  
    }  
	/*
	* 功能描述：登陆验证
	* URL地址：client/keylogin/validate 
	* 请求方式：内部调用
	* 请求参数：
	*	字段：emailphone；说明：电子邮件手机号码；类型：string；必须：Y
	*	字段：password；说明：密码；类型：string；必须：Y
	* 返回结果：True/False
	*	
	*/
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
	/*
	* 功能描述：使用手机号码登陆验证
	* URL地址：client/keylogin/validateForPhone
	* 请求方式：内部调用
	* 请求参数：
	*	字段：emailphone；说明：电子邮件手机号码；类型：string；必须：Y
	*	字段：password；说明：密码；类型：string；必须：Y
	* 返回结果：True/False
	*/
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