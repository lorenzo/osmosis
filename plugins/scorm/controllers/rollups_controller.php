<?php
class RollupsController extends ScormAppController {

	var $name = 'Rollups';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Rollup->recursive = 0;
		$this->set('rollups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Rollup.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('rollup', $this->Rollup->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Rollup->create();
			if ($this->Rollup->save($this->data)) {
				$this->Session->setFlash('The Rollup has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Rollup could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Rollup');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Rollup->save($this->data)) {
				$this->Session->setFlash('The Rollup saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Rollup could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rollup->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Rollup');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Rollup->del($id)) {
			$this->Session->setFlash('Rollup #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
