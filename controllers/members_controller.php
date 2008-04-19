<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $helpers = array('Html', 'Form' );

	/**
	 * Lists available members
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Member->recursive = 0;
		$this->set('members', $this->paginate());
	}

	function admin_index() {
		$this->Member->recursive = 0;
		$conditions = array();
		if (isset($this->params['named']['role'])) {
			$conditions['Role.id'] = $this->params['named']['role'];
		}
		$this->set('members', $this->paginate(null, $conditions));
	}

	/**
	 * Display the details of a member
	 *
	 * @param string $id 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Member.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('member', $this->Member->read(null, $id));
	}

	/**
	 * Creates a new member
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Member->create();
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.',true));
			}
		}
		$roles = $this->Member->Role->find('list');
		$this->set(compact('roles'));
	}

	/**
	 * Edit the details of a member
	 *
	 * @param string $id 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Member',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Member->read(null, $id);
		}
		$roles = $this->Member->Role->find('list');
		$this->set(compact('roles'));
	}

	/**
	 * Deletes a memeber
	 *
	 * @param string $id 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Member',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Member->del($id)) {
			$this->Session->setFlash(__('Member #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	/*
	* Logs an user into the system
	* @return void
	*/
	function login() {
		//Let the auth component manage login action
	}
	
	/**
	 * Logs an user out of the system and redirects him to the logout action set
	 * in AuthComponent
	 * @return void
	 */
	function logout() {
		$action = $this->Auth->logout();
		$this->Session->destroy();
		$this->redirect($action);
	}
	
	function isAuthorized() {
		if ($this->action == 'logout' || $this->action == 'login') {
			return true;
		}
		return parent::isAuthorized();
	}

}
?>
