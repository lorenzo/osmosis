<?php
class EntriesController extends WikiAppController {

	var $name = 'Entries';
	var $helpers = array('Html', 'Form', 'Javascript','Wiki' );
	var $components = array('HtmlPurifier','Diff');
	
	function index() {
		$this->Entry->recursive = 0;
		$this->set('entries', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Entry.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('entry', $this->Entry->read(null, $id));
	}

	function add($wiki_id = null) {
		if (!$wiki_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Wiki',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Entry->create();
			$this->data['Entry']['member_id'] = $this->Auth->user('id');
			$this->data['Entry']['content'] = $this->HtmlPurifier->purify($this->data['Entry']['content']);
			if ($this->Entry->save($this->data)) {
				$this->Session->setFlash(__('The Entry has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Entry could not be saved. Please, try again.',true));
			}
		}
		if(!isset($this->data['Entry']['wiki_id'])) {
			$this->data['Entry']['wiki_id'] = $wiki_id;
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Entry',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->data['Entry']['member_id'] = $this->Auth->user('id');
			$this->data['Entry']['content'] = $this->HtmlPurifier->purify($this->data['Entry']['content']);
			if ($this->Entry->save($this->data)) {
				$this->Session->setFlash(__('The Entry has been saved',true));
				$this->redirect(array('action'=>'view', $this->data['Entry']['id']));
			} else {
				$this->Session->setFlash(__('The Entry could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Entry->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Entry',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Entry->del($id)) {
			$this->Session->setFlash(__('Entry deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function restore($entry_id,$revision = null) {
		if($this->Entry->restore($entry_id,$revision)) {
			$this->Session->setFlash(__('Entry revision restored',true));
		}else{
			die;
			$this->Session->setFlash(__('An error occured. The entry revision was not restored',true));
		}
		$this->redirect(array('action'=>'view',$entry_id), null, true);
	}

}
?>
