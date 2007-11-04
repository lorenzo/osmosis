<?php
class ScormsController extends ScormAppController {

	var $name = 'Scorms';
	var $components = array('Zip');
	var $helpers = array('Html', 'Form', 'Tree', 'Javascript');

	function index() {
		$this->Scorm->recursive = 0;
		$this->set('scorms', $this->paginate());
	}
	
	function toc($id) {
		$this->set('scorm', $this->Scorm->find(array('id' => $id), array('Scorm.*')));
		$this->set('scos', $this->Scorm->Sco->findAllThreaded(array('Sco.scorm_id' => $id), array('Sco.*')));
		$this->plugin = 'scorm';
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Scorm.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->Scorm->recursive = -1;
		$this->set('scorm', $this->Scorm->find(array('id' => $id), array('Scorm.*')));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Scorm->create();

			$uploaded_file = $this->data['Scorm']['file_name'];
			$is_uploaded = is_uploaded_file($uploaded_file['tmp_name']); 
			if ($is_uploaded) {
				$this->data['Scorm']['file_name'] = $uploaded_file['name'];
				// TODO: md5 of zip file
				// Extract the zip file to TMP
				$this->Zip->begin($uploaded_file['tmp_name']);
				$scorm_files_location = TMP.'tests'.DS.'imsmanifests'.DS.'uploads'.DS.$uploaded_file['name'].DS;
				$this->data['Scorm']['path']= str_replace(APP, '', $scorm_files_location);
				if ($this->Zip->extract($scorm_files_location)===false) {
					$this->Session->setFlash('The Scorm file could not be unzipped.');
					return;
				}
				$this->Zip->close();
				// Parse
				if (!$this->Scorm->parseManifest($scorm_files_location)){
					$this->Session->setFlash('The Scorm file could not be parsed.');
					return;
				}
				if ($this->Scorm->save($this->data)){
					$this->Session->setFlash('The Scorm has been saved');
					$this->redirect(array('action'=>'index'), null, true);
				}
			} else {
				$this->Session->setFlash('The Scorm could not be uploaded. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Scorm');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Scorm->save($this->data)) {
				$this->Session->setFlash('The Scorm saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Scorm could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Scorm->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Scorm');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Scorm->del($id)) {
			$this->Session->setFlash('Scorm #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
}
?>
