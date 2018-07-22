<?php
/**
*	http://key wallet
*  密码管理器接入口 
*  作者：Arthur
*/
class ControllerCommonKey extends Controller
{
	
	function index(){
		$this->load->model('common/config');
		$userid = $this->user->getId();
		if ($this->user->islogged()) {
			if(!$this->model_common_config->activation($userid)){
				$this->related();
			}
			
			$this->data['username'] = $this->user->getUserMail();
		}else{
			$this->data['username'] = '你';
			header('location: '. $this->url->relink('accounts','common/login') . '&&link='. $this->url->relink('key','common/key'));
		}
		
		
		$this->data['sideLinkKEY'] = $this->url->link('common/key');
		$this->data['sideLinkDevice'] = $this->url->link('common/device');
		
		$this->data['LinkManage'] = $this->url->link('common/home');
		$this->data['LinkBlog'] = "http://blog.tanknet.asia/";
		$this->data['addgroupLink'] = $this->url->relink('key','web/addkeygroup');
		$this->data['addkeyLink'] = $this->url->relink('key','web/key/add');
		$this->data['editkeyLink'] = $this->url->relink('key','web/key/update');
		$this->data['deletekeyLink'] = $this->url->relink('key','web/key/delete');
		$this->data['editgroupLink'] = $this->url->relink('key','web/editgroup');
		$this->data['deletegroupLink'] = $this->url->relink('key','web/deletegroup');
		$this->data['LinkLogout'] = $this->url->reLink('accounts','common/logout');
		$this->data['LinKAccounts'] = $this->url->reLink('accounts','common/home');
		$this->data['LinkPrivacy'] = HTTP_ROOT.$this->url->link("common/privacy");

		$this->load->model('client/keygroup');
		$this->data['groupList'] = $this->model_client_keygroup->getgroup($userid);

		$this->load->model('client/emkey');
		$this->data['keyList'] = $this->model_client_emkey->getkey($userid);

		$this->data['LinkHome'] = HTTP_ROOT;
		$this->data['action'] = $this->url->relink('accounts','common/login') . '&&link='. $this->url->relink('key','common/home');
		$this->template = $this->config->get('config_template') . 'common/key.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
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