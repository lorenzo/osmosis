<?php
class AssociationQuestionsController extends AppController {

	var $name = 'AssociationQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssociationQuestion->recursive = 0;
		$this->set('associationQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Association Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('associationQuestion', $this->AssociationQuestion->read(null, $id));
	}

	function add() {
		$quiz = null;
		if (isset($this->passedArgs['quiz'])) {
			$quiz = $this->passedArgs['quiz'];
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->AssociationQuestion->create();
			/*$this->data['Quiz']['Quiz'] = array(
				$this->data['Quiz']['Quiz']
		   	);*/
			if ($this->AssociationQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Association Question has been saved',true));
				//$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Association Question could not be saved. Please, try again.',true));
			}
		}
		$quizzes = $this->AssociationQuestion->Quiz->generateList();
		$this->set(compact('quizzes', 'quiz'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Association Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->AssociationQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Association Question has been saved',true));
				//$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Association Question could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssociationQuestion->read(null, $id);
		}
		$quizzes = $this->AssociationQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Association Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->AssociationQuestion->del($id)) {
			$this->Session->setFlash(__('Association Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
