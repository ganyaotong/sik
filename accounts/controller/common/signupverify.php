<?php
/**
* 用户签约
*/
class ControllerCommonSignupverify extends Controller
{
  private $error = array();
	
	function index()
	{
		if ($this->user->isLogged()) {  
      		$this->redirect($this->url->link('common/home','','ssl'));
    	}
      
    	$this->load->model('common/user');
    	if ($this->request->server['REQUEST_METHOD'] == 'POST') {

        $psd = $this->request->post['psd'];
        $code = $this->request->post['code'];
        $userid = $this->session->data['userid'];
        
        if ($code==$this->session->data['code']) {
          # code...
          $this->model_common_user->activeuser($psd,$userid);
          echo "1";
        }else{
          echo "0";
        }

      
    		
    		
    	}
		
	}

	//驗證數據
	private function validate() {
    	
    	if ((strlen(utf8_decode($this->request->post['email'])) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = "無效的郵箱地址";
    	}

    	if ($this->model_common_user->getTotalUsersByEmail($this->request->post['email'])) {
      		$this->error['warning'] = "该邮箱地址已被注册、请换一个电子邮箱";
    	}
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}

function mail_newuser($tomail){
  $this->session->data['code'] = rand(1000000,9999999);
  $body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <p>TankNet 帳戶</p>
            <h1>新賬戶簽約郵箱驗證</h1>
            <p>請使用此驗證碼驗證您 TankNet 帳戶 '.$tomail.'</p>
            <br>
            <p>這是您的驗證碼：'.$this->session->data['code'].'</p>
            <br>
            <p>如果您未需要此安全性驗證碼，則可以放心地忽略此郵件。此情況可能是另一位使用者錯誤地輸入您的電子郵件地址。</p>
            <p>謝謝</p>
            <p>TankNet 賬戶小組</p>
          </td>
        </tr>
      </table>

    <table class="preview_table">
    <tbody>
      <tr>
        <td><img width="150" src="https://eweek.sinaapp.com/image/qrcode_account.png"></td>
        <td valign="middle" style="color:#a0a0a0;font-size:12px;">
          <p style="margin:0;">TankNet賬戶小組</p>
          <p style="margin:0;">坦克网络</p>
          <p style="margin:0;">https://www.tanknet.asia</p>
        </td>
      </tr>
    </tbody>
    </table>

      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>

</table>
<!-- /body -->

<!-- /footer -->

</body>
</html>';
      $mail = new SaeMail();
      $mail->setOpt( array(
             'from' => 'account-new-noreply@tanknet.asia',
             'to' => $tomail,
             'smtp_host' => 'smtp.exmail.qq.com', 
             'smtp_port' => '465',
             'smtp_username' => 'account-new-noreply@tanknet.asia',  
             'smtp_password' => 'cc123456cc',  
             'subject' => 'TankNet 賬戶簽約',  
             'content' => $body, 
             'content_type' => "HTML"
) ); 
$ret = $mail->send();
    }
}
?>