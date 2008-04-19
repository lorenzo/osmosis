<?php
class DepartmentsController extends AppController {

	var $name = 'Departments';
	var $helpers = array('Html', 'Form' );

	var $layouts = array(
		'index' => 'admin'
	);
	
	/**
	 * Lists available departments
	 *
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Department->recursive = 1;
		$this->set('departments', $this->paginate());
	}
	

	function admin_index() {
		$this->Department->recursive = 1;
		$this->set('departments', $this->paginate());
	}

	/**
	 * Shows information about a department and list its associated courses
	 *
	 * @param string $id 
	 * @author José Lorenzo
	 */
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Department',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->Department->recursive = -1;
		$this->set('department', $this->Department->read(null, $id));
		$this->set('courses',$this->paginate($this->Department->Course,array('Course.department_id'=>$id)));
	}

	/**
	 * Adds a department to the database
	 *
	 * @author José Lorenzo
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Department->create();
			if ($this->Department->save($this->data)) {
				$this->Session->setFlash(__('The Department has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Department could not be saved. Please, try again.',true));
			}
		}
	}

	/**
	 * Edits the information of a department
	 *
	 * @param string $id department's id
	 * @author José Lorenzo
	 */
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Department',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Department->save($this->data)) {
				$this->Session->setFlash(__('The Department has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Department could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Department->read(null, $id);
		}
	}

	/**
	 * Deletes a department
	 *
	 * @param string $id department's id
	 * @author José Lorenzo
	 */
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Department',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Department->del($id)) {
			$this->Session->setFlash(sprintf(__('Department %s deleted',true),"# $id"));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
