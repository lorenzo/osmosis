<?php
class RollupConsiderationsController extends ScormAppController {

	var $name = 'RollupConsiderations';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->RollupConsideration->recursive = 0;
		$this->set('rollupConsiderations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Rollup Consideration.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('rollupConsideration', $this->RollupConsideration->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->RollupConsideration->create();
			if ($this->RollupConsideration->save($this->data)) {
				$this->Session->setFlash('The Rollup Consideration has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Rollup Consideration could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Rollup Consideration');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->RollupConsideration->save($this->data)) {
				$this->Session->setFlash('The Rollup Consideration saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Rollup Consideration could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RollupConsideration->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Rollup Consideration');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->RollupConsideration->del($id)) {
			$this->Session->setFlash('Rollup Consideration #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
