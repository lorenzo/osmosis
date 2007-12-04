<?php
class AppController extends Controller {
	var $components = array('Acl','Auth','RequestHandler');
	var $helpers = array('Javascript', 'Html', 'Form', 'Dynamicjs');

	function beforeFilter() {
		if (isset($this->Auth)) {
			$this->Auth->authorize = 'controller';
			$this->Auth->userModel = 'Member'; 
			$this->Auth->loginAction = '/members/login';
			$this->Auth->loginRedirect = '/courses/';
			$this->Auth->autoRedirect = true;
			$this->set('user', $this->Session->read('Auth.Member'));
			//TODO: Borrar lo siguiente cuando sea el momento
			if(Configure::read('Auth.disabled') && $this->name == 'InitAcl') {
				$this->Auth->allow();
			}
		}
	}

	function isAuthorized() {
		if(Configure::read('Auth.disabled') || $this->name == 'Pages')
			return true;
		if($this->Acl->check($this->Auth->user(),$this->name.'/'.$this->action)) {
			return true;
		}
		return false;
	}
}
?>
