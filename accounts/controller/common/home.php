<?php
/*
*账户主页入口 EM-WEEK
*/
final class ControllerCommonHome extends Controller 
{
	public function index()
	{
	//http转化为https   ac
	//if ($_SERVER["HTTPS"] <> "on")
	//{
		#header("Location: ". HTTPS_SERVER);
	//}

		if ($this->user->islogged()) {
			# code...
			# echo  $this->user->getId();
			$this->data['username'] = $this->user->getUserMail();
			$this->data['action'] = $this->url->relink('key','common/home');

		}else{
			$this->data['username'] = "you";
			header('location: '. $this->url->relink('accounts','common/login') . '&&link='. $this->url->relink('key','common/home'));

		}

		$this->document->setTitle('sik key');
		
		//tab edit
		$this->data['un'] = $this->user->getUsername();
		$this->data['phone'] = $this->user->getPhone();
		$this->data['email'] = $this->user->getUserMail();
		$this->data['ug'] = $this->user->getUsergroup();
		$this->data['status'] = $this->user->getStatus();
		$this->data['add_date'] = $this->user->getAddDate();
		//tab edit end

		//二次验证
        $userid =$this->session->data['user_id'];
        $this->load->model('common/user');
        if ($this->model_common_user->getAuthenticatorStatus($userid)) {
          # code...
          $this->data['two'] = 1;
        }else{
        	$this->data['two'] = 0;
        }
        //二次验证 END

		$this->data['LinkHome'] = HTTP_ROOT;
		$this->data['LinkKey'] = $this->url->reLink('key','common/home','','ssl');
		$this->data['LinkPricing'] = $this->url->link('common/pricing');
		$this->data['LinkHelp'] = $this->url->link('common/help');
		$this->data['LinkPrivacy'] = HTTP_ROOT.$this->url->link("common/privacy");
		$this->data['LinkManage'] = $this->url->reLink('key','common/home');
		$this->data['LinkLogout'] = $this->url->reLink('accounts','common/logout');
		$this->data['LinKAccounts'] = $this->url->reLink('accounts','common/home');
		$this->data['LinkTwo'] = $this->url->link('common/two');
		$this->data['twocloseLink'] = $this->url->link('common/twoclose');
		$this->data['sideLinkKEY'] = $this->url->reLink('key','common/key');
		$this->data['changepwdLink'] = $this->url->link('password/reset');
		$this->data['changeinfoLink'] = $this->url->link('userinfo/change');
		$this->data['closeAccountLink'] = $this->url->link('userinfo/close');
		
		$this->data['imgSecurity'] = HTTP_IMAGE.'security.png';
		$this->data['imgWind'] = HTTP_IMAGE.'wind.png';
		$this->data['imgSimplicity'] = HTTP_IMAGE.'simplicity.png';

		$this->template = $this->config->get('config_template') . 'common/home.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
			);
		$this->response->setOutput($this->render(TRUE));
	}
	

}

?>