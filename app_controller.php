<?php
class AppController extends Controller {
	var $components = array('Acl','Auth','RequestHandler', 'Placeholder');
	var $helpers = array('Javascript', 'Html', 'Form', 'Dynamicjs', 'Time', 'Placeholder');

	/**
	 * Contains the id of the course the member is visiting. False if the member is viewing a page outside a course
	 *
	 * @var string
	 */
	
	var $activeCourse = false;
	
	
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
		$this->__selectLayout();
	}

	function __selectLayout() {
		if (isset($this->params['admin']) && $this->params['admin']) {
			$this->layout = 'admin';
		}
	}
	
	function isAuthorized() {
		if( $this->name == 'Pages')
			return true;
		if(@$this->Acl->check($this->Auth->user(),$this->name.'/'.$this->action) || Configure::read('Auth.disabled')) {
			return true;
		}
		return false;
	}
	
	function admin_index() {
		$this->index;
	}
	
	function admin_view($id = null) {
		$this->view($id);
	}
	
	function admin_edit($id = null) {
		$this->edit($id);
	}
	
	function admin_delete($id = null) {
		$this->delete($id);
	}
	
	function beforeRender() {
		$this->activeCourse = 1;
		if (isset($this->Placeholder->started))
			$this->Placeholder->attachToolbar($this->activeCourse);
	}
	
}
?>
