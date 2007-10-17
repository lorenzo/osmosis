<?php
class ScosController extends ScormAppController {

	var $name = 'Scos';
	var $helpers = array('Html', 'Form' );
	var $uses = array('Sco', 'Scorm');

	function index() {
		$this->Sco->recursive = 0;
		$this->set('scos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Sco.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$sco = $this->Sco->read(null, $id);
		$path = $this->Scorm->field('path', array('id' => $sco['Sco']['scorm_id']));
		$this->set(compact('sco', 'path'));
		$this->layout = 'ajax';
		$this->render('view2');
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Sco->create();
			if ($this->Sco->save($this->data)) {
				$this->Session->setFlash('The Sco has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Sco could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Sco');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Sco->save($this->data)) {
				$this->Session->setFlash('The Sco saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Sco could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sco->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Sco');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Sco->del($id)) {
			$this->Session->setFlash('Sco #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
