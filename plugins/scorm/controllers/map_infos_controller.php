<?php
class MapInfosController extends ScormAppController {

	var $name = 'MapInfos';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->MapInfo->recursive = 0;
		$this->set('mapInfos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Map Info.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('mapInfo', $this->MapInfo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->MapInfo->create();
			if ($this->MapInfo->save($this->data)) {
				$this->Session->setFlash('The Map Info has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Map Info could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Map Info');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->MapInfo->save($this->data)) {
				$this->Session->setFlash('The Map Info saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Map Info could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MapInfo->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Map Info');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->MapInfo->del($id)) {
			$this->Session->setFlash('Map Info #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
