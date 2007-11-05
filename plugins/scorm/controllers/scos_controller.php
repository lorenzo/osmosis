<?php
class ScosController extends ScormAppController {

	var $name = 'Scos';
	var $helpers = array('Html', 'Form', 'Cache' );
	var $uses = array('Sco', 'Scorm');
	var $cacheAction = array('view/' => '1 hour');
	
	function index() {
		$this->Sco->recursive = 0;
		$this->set('scos', $this->paginate());
	}
	
	function api() {
		Configure::write('debug',0);
		$this->RequestHandler->respondAs('js');
	}

	function view($id = null) {
		$params = $this->params['pass'];
		unset($params[0]);
		$path = implode(DS , $params);
		if (!$id) {
			$this->Session->setFlash('Invalid Sco.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$scorm_id = $this->Sco->field('scorm_id', array('id' => $id));
		$path = $this->Scorm->field('path', array('id' => $scorm_id)) . $path;
		$extension = str_replace('.', '', strrchr($path, '.'));
		$this->set('extension', $extension);
		$this->set('path', urldecode($path));
		$this->view = 'Media';
		//$this->render('view2');
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
