<?php
/**
*	http://key
*  密码管理器接入口 
*  作者：Arthur
*/
class ControllerCommonHome extends Controller
{
	
	function index(){
		$this->load->model('common/config');
		if ($this->user->islogged()) {
			# code...
			# echo  $this->user->getId();
			//判断是否激活
			if(!$this->model_common_config->activation($this->user->getId())){
				$this->related();
			}
			
			$this->data['username'] = $this->user->getUserMail();
		}else{
			$this->data['username'] = '你';
			header('location: '. $this->url->relink('accounts','common/login') . '&&link='. $this->url->relink('key','common/home'));
		}

		$this->data['sideLinkWallet'] = $this->url->link('common/wallet') ;
		$this->data['sideLinkKEY'] = $this->url->link('common/key');
		$this->data['sideLinkDevice'] = $this->url->link('common/device');
		$this->data['LinkManage'] = $this->url->link('common/manage');
		$this->data['LinkLogout'] = $this->url->reLink('accounts','common/logout');
		$this->data['LinKAccounts'] = $this->url->reLink('accounts','common/home');


		$this->data['LinkHome'] = HTTP_ROOT;
		//$this->data['LinkLogin'] = $this->url->relink('accounts','common/login','','ssl') . '&&link='. $this->url->relink('key','common/home','','ssl');
		$this->template = $this->config->get('config_template') . 'common/home.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
			'common/sidebar',
			);
		$this->response->setOutPut($this->render(true));
	}

	private function related() {
		$userInfo = $this->user->getUserInfo();
		$this->load->model('common/config');
		if ($this->model_common_config->addconfig($userInfo)) {
			# code...
			return true;
    	} else {
      		return false;
    	}  	
  	}
}
?>