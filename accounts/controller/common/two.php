<?php
/**
* 登陆功能类
*/
class ControllerCommonTwo extends Controller
{
  private $error = array();
	
	function index()
	{

    require_once(DIR_SYSTEM . 'library/GoogleAuthenticator.php');

    if ($this->request->server['REQUEST_METHOD'] == 'POST'){

        $ga = new PHPGangsta_GoogleAuthenticator();

        $oneCode =  $this->request->post['code'];
        $checkResult = $ga->verifyCode($this->session->data['authenticatorCode'], $oneCode, 2);


        if ($checkResult) {
          //验证成功，写入数据库
          $this->load->model('common/user');
          $userid =$this->session->data['user_id'];
          $this->model_common_user->setAuthenticator($userid,$this->session->data['authenticatorCode']);
          echo '1';
        } else {
          //验证失败
          echo '0';
        }

       
      }else{
        $ga = new PHPGangsta_GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl('坦克网络', $secret);
        #$oneCode = $ga->getCode($secret);


        $this->session->data['authenticatorCode'] = $secret;


        $this->data['img'] = $qrCodeUrl;
        $this->data['setAuthenticatorLink'] = $this->url->link('common/two');
        $this->template = $this->config->get('config_template') . 'common/two.tpl';
        $this->children = array(
          'common/header',
          'common/footer',
        );
        $this->response->setOutput($this->render(TRUE));
      }
   
	}


}
?>