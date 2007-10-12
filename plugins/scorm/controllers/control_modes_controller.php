<?php
class ControlModesController extends ScormAppController {

	var $name = 'ControlModes';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->ControlMode->recursive = 0;
		$this->set('controlModes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Control Mode.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('controlMode', $this->ControlMode->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ControlMode->create();
			if ($this->ControlMode->save($this->data)) {
				$this->Session->setFlash('The Control Mode has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Control Mode could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Control Mode');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ControlMode->save($this->data)) {
				$this->Session->setFlash('The Control Mode saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Control Mode could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ControlMode->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Control Mode');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ControlMode->del($id)) {
			$this->Session->setFlash('Control Mode #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
