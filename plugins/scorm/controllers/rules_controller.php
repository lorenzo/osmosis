<?php
class RulesController extends ScormAppController {

	var $name = 'Rules';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Rule->recursive = 0;
		$this->set('rules', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Rule.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('rule', $this->Rule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Rule->create();
			if ($this->Rule->save($this->data)) {
				$this->Session->setFlash('The Rule has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Rule could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Rule');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Rule->save($this->data)) {
				$this->Session->setFlash('The Rule saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Rule could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rule->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Rule');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Rule->del($id)) {
			$this->Session->setFlash('Rule #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
