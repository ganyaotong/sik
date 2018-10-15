<?php
/**
* 登陆功能类
*/
class ControllerClientVerifyClient extends Controller
{
  private $error = array();
	/*
	* 功能描述：验证客户端
	* URL地址：client/verifyclient/index
	* 请求方式：POST
	* 请求参数：
	*	字段：emailphone；说明：电子邮件手机号码；类型：string；必须：Y
	*	字段：password；说明：密码；类型：string；必须：Y
	*	字段：device；说明：设备名称；类型：String；必须：Y
	* 返回结果：
	*	字段：islogin；说明：登陆是否成功；类型：bool
	*	字段：clientcode；说明；客户端编码或设备编码；类型：String
	*/
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

}
?>