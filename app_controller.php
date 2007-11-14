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
			//TODO: Borrar lo siguiente cuando sea el momento
			if(Configure::read('Auth.disabled')) {
				$this->Auth->allow();
				if (!$this->Session->check('Member.id')) {
					$this->Session->write('Member.id', '1');
					$this->Session->write('Member.name', 'Mr. Admin');
				}
				$this->set('user', $this->Session->read('Member'));
			}
		}
	}

	function isAuthorized() {
		if($this->Acl->check($this->Auth->user(),$this->name.'/'.$this->action)) {
			return true;
		}
		return false;
	}
}
?>
