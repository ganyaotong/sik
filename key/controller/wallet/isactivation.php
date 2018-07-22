<?php
/**
* 公共footer
*/
class ControllerWalletIsactivation extends Controller
{
	
	function index()
	{	
		# code...
		$this->load->model('wallet/wallet');
		$userid = $this->user->getId();
		if ($this->model_wallet_wallet->isActivation($userid)) {
			# code...
			$this->data['giftcardActivation'] = $this->url->relink('cardgift','client/activation');
			$this->template = 'wallet/activation.tpl';
			$this->loadwalletdata();
		}else{
			$this->data['walletactivation'] = $this->url->relink('key','wallet/activation');
			$this->template = 'wallet/noactivation.tpl';
		}

		$this->render();
	}

	function loadwalletdata(){
		$this->load->model('wallet/wallet');
		$this->data['score'] = $this->model_wallet_wallet->getScore($this->user->getId());
	}
}
?>