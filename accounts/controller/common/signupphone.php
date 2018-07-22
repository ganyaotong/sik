<?php
/**
* 用户签约
*/
class ControllerCommonSignupphone extends Controller
{
  private $error = array();

  //主帐号
  private $accountSid= 'aaf98f8946274232014629e769b10269';

//主帐号Token
  private $accountToken= '8adfa53756a449458fc58ea72fa1421e';

//应用Id
  private $appId='aaf98fda46274464014629e9cd330249';

//请求地址
  private $serverIP='sandboxapp.cloopen.com';

//请求端口 
  private $serverPort='8883';

//REST版本号
  private $softVersion='2013-12-26';

	function index()
	{
		
    	$this->load->model('common/user');
    	if ($this->request->server['REQUEST_METHOD'] == 'POST') {

   

             require_once(DIR_SYSTEM . 'library/CCPRestSDK.php');
            //$userid=$this->model_common_user->addUser($this->request->post);
            //$code=$this->session->data['activeCode'];
            $phone = $this->request->post['phone'];
            $this->sendTemplateSMS($phone,"内容数据",1);
            //$mail->mail_new($this->request->post['phone'],$code);
            //$this->mail_SendCloud($this->request->post['email']);
            echo $phone;
//            echo "1";
        
    			
    	}
    	
	}

   function sendTemplateSMS($to,$datas,$tempId)
  {
     // 初始化REST SDK
     //global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
     $rest = new REST($this->serverIP,$this->serverPort,$this->softVersion);
     $rest->setAccount($this->accountSid,$this->accountToken);
     $rest->setAppId($this->appId);
    
     // 发送模板短信
     echo "Sending TemplateSMS to $to <br/>";
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
         echo "result error!";
         break;
     }
     if($result->statusCode!=0) {
         echo "error code :" . $result->statusCode . "<br>";
         echo "error msg :" . $result->statusMsg . "<br>";
         //TODO 添加错误处理逻辑
     }else{
         echo "Sendind TemplateSMS success!<br/>";
         // 获取返回信息
         $smsmessage = $result->TemplateSMS;
         echo "dateCreated:".$smsmessage->dateCreated."<br/>";
         echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
         //TODO 添加成功处理逻辑
     }
  }

}
?>