<?php
uses('Folder');
class ScormsController extends ScormAppController {

	var $name = 'Scorms';
	var $components = array('Zip');
	var $helpers = array('Html', 'Form', 'Tree', 'Javascript');
	var $uses = array('Scorm', 'ScormAttendeeTracking');

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
		$trackings = $this->ScormAttendeeTracking->findAll(
			array(
				'student_id' => ''.$this->Session->read('Member.id'),
				'datamodel_element' => 'cmi__completion_status',
				'value' => 'completed'
			), 
			'sco_id', 'sco_id ASC'
		);
		$trackings = Set::extract($trackings, '{n}.ScormAttendeeTracking.sco_id');
		$scos = $this->Scorm->Sco->findAll(
			array('scorm_id' => $id, 'href IS NOT NULL'),
			null, 'id ASC', null, 1, -1
		);
		$show_sco = array();
		foreach ($scos as $sco) {
			$sco = $sco['Sco'];
			if (in_array($sco['id'], $trackings)) continue;
			$show_sco['id'] = $sco['id']; 
			$show_sco['href'] = $sco['href'];
			break;
		}
		// If no sco was found show first
		if (empty($show_sco)) {
			$show_sco['id'] = $scos[0]['Sco']['id'];
			$show_sco['href'] = $scos[0]['Sco']['href'];
		}
		$this->set('show_sco', $show_sco);
		$this->Scorm->recursive = -1;
		$this->set('scorm', $this->Scorm->find(array('id' => $id), array('Scorm.*')));
	}

	function add() {
		if (!empty($this->data)) {
			//debug($this->data);
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
					$folder = new Folder($scorm_files_location);
					$folder->delete($scorm_files_location);
					$this->Session->setFlash('The Scorm file could not be parsed.');
					return;
				}
				if ($this->Scorm->data['Scorm']['version']!= '2004 3rd Edition'){
				$folder = new Folder($scorm_files_location);
						$folder->delete($scorm_files_location);
						$this->Session->setFlash('The Scorm has not a right version');
				
				}else {
						$this->Scorm->save($this->data);
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
		$this->data = $this->Scorm->find(array('id'=> $id),null,null,null);			
			$uploaded_file = $this->data['Scorm']['file_name'];
			$scorm_files_location = TMP.'tests'.DS.'imsmanifests'.DS.'uploads'.DS.$uploaded_file;
			$folder = new Folder($scorm_files_location);
			$folder->delete($scorm_files_location);
		if ($this->Scorm->del($id)) {			
			$this->Session->setFlash('Scorm #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	
}
?>
