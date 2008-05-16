<?php
App::import('Core', 'Sanitize');
class AppController extends Controller {
	var $components = array('Acl','Auth','RequestHandler','OsmosisComponents','Placeholder');
	var $helpers = array('Javascript', 'Html', 'Form', 'Dynamicjs', 'Time', 'Placeholder', 'Text');

	/**
	 * Contains the id of the course the member is visiting. False if the member is viewing a page outside a course
	 *
	 * @var mixed
	 */
	
	protected $activeCourse = false;
	
	function beforeFilter() {
		if (isset($this->Auth)) {
			$this->Auth->Acl =& $this->Acl;
			$this->Auth->authorize = 'controller';
			$this->Auth->userModel = 'Member';
			$this->Auth->loginAction = array('controller' => 'members', 'action' => 'login');
			$this->Auth->loginRedirect = array('controller' => 'courses');
			$this->Auth->autoRedirect = true;
			$this->set('user', $this->Session->read('Auth.Member'));
			//TODO: Borrar lo siguiente cuando sea el momento
			if(Configure::read('Auth.disabled') && $this->name == 'InitAcl') {
				$this->Auth->allow();
			}
			Configure::write('ActiveUser', $this->Auth->user());
		}
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHoledAction';
		}
		if (isset($this->Auth) && $this->Session->valid() && $this->Auth->user())
			$this->__updateOnlineUser();
		
		$this->_setActiveCourse();
		Configure::write('ActiveCourse.id', $this->activeCourse);
		$this->__selectLayout();
		$this->__instatiateLogger();
	}
	
	function __instatiateLogger() {
		if (!ClassRegistry::isKeySet('ModelLog')) {
			App::import('Model', 'ModelLog');
			ClassRegistry::addObject('ModelLog', new ModelLog);
		}
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
		if (!$member = ClassRegistry::getObject('Member')) {
			App::import('Model', 'Member');
			$member = new Member;
			ClassRegistry::addObject('Member', $member);
		}
		$member->id = $this->Auth->user('id');
		$member->saveField('last_seen', time());
	}
	
	function isAuthorized() {
		if( $this->name == 'Pages')
			return true;
		$valid = $this->Auth->isAuthorized('crud');
		if($valid || Configure::read('Auth.disabled')) {
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
