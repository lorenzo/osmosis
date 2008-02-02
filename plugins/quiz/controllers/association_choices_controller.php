<?php
class AssociationChoicesController extends AppController {

	var $name = 'AssociationChoices';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssociationChoice->recursive = 0;
		$this->set('associationChoices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Association Choice.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('associationChoice', $this->AssociationChoice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->AssociationChoice->create();
			if ($this->AssociationChoice->save($this->data)) {
				$this->Session->setFlash(__('The Association Choice has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Association Choice could not be saved. Please, try again.',true));
			}
		}
		$associationQuestions = $this->AssociationChoice->AssociationQuestion->generateList();
		$this->set(compact('associationQuestions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Association Choice',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->AssociationChoice->save($this->data)) {
				$this->Session->setFlash(__('The Association Choice has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Association Choice could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssociationChoice->read(null, $id);
		}
		$associationQuestions = $this->AssociationChoice->AssociationQuestion->generateList();
		$this->set(compact('associationQuestions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Association Choice',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->AssociationChoice->del($id)) {
			$this->Session->setFlash(__('Association Choice #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>