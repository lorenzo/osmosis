<?php
class DepartmentsController extends AppController {

	var $name = 'Departments';
	var $helpers = array('Html', 'Form' );
	/**
	 * Lists available departments
	 *
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Department->recursive = 1;
		$this->set('departments', $this->paginate());
	}

	/**
	 * Shows information about a department and list its associated courses
	 *
	 * @param string $id 
	 * @author José Lorenzo
	 */
	
	function view($id = null) {
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
	
	function add() {
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
	
	function edit($id = null) {
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
	
	function delete($id = null) {
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
