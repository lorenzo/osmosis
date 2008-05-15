<?php
App::import('Core', 'Sanitize');
class AppController extends Controller {
	var $components = array('Acl','Auth','RequestHandler','OsmosisComponents','Placeholder');
	var $helpers = array('Javascript', 'Html', 'Form', 'Dynamicjs', 'Time', 'Placeholder');

	/**
	 * Contains the id of the course the member is visiting. False if the member is viewing a page outside a course
	 *
	 * @var string
	 */
	
	protected $activeCourse = false;
	
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
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHoledAction';
		}
		if (isset($this->Auth) && $this->Session->valid() && $this->Auth->user())
			$this->__updateOnlineUser();
		
		$this->_setActiveCourse();
		$this->__selectLayout();
	}
	
	function _blackHoledAction() {
		$this->Session->setFlash(__('Invalid access', true));
		$this->redirect(array('controller' => 'members', 'action' => 'login', 'plugin' => ''));
	}

	function __selectLayout() {
		if (isset($this->params['admin']) && $this->params['admin']) {
			$this->layout = 'admin';
		} elseif (empty($this->activeCourse))
			$this->layout = 'no_course';
	}
	
	protected function __updateOnlineUser() {
		App::import('Model','OnlineUser');
		$data = array('member_id' => $this->Auth->user('id'), 'viewing' => $this->here);
		$online = new OnlineUser;
		$online->save($data,false,array('member_id','viewing'));
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
		if (isset($this->Placeholder->started) && $this->activeCourse);
			$this->Placeholder->attachToolbar($this->activeCourse);
	}
	
	function _setActiveCourse() {
		if (isset($this->params['named']['course_id'])) {
			$this->activeCourse = $this->params['named']['course_id'];
		}
	}
		
}
?>
