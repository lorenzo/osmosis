<?php
class EntriesController extends WikiAppController {

	var $name = 'Entries';
	var $helpers = array('Html', 'Form', 'Javascript','Wiki' );
	var $components = array('HtmlPurifier','Diff');
	
	function index() {
		$this->Entry->recursive = 0;
		$this->set('entries', $this->paginate());
	}

	function view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid Entry.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$conditions = array('conditions' => array('slug' => $slug));
		if (isset($this->params['named']['wiki_id']))
			$conditions['conditions']['wiki_id'] = $this->params['named']['wiki_id'];
			
		if (isset($this->params['named']['course_id']))
			$conditions['conditions']['course_id'] = $this->params['named']['course_id'];
		
		$entry = $this->Entry->find('first',$conditions);
		$this->pageTitle = $entry['Entry']['title'];
		$this->set('entry', $entry);
	}

	function add() {
		$wiki_id = null;
		if (isset($this->params['named']['wiki_id']))
			$wiki_id = $this->params['named']['wiki_id'];
		elseif (isset($this->params['named']['course_id'])) {
			$wiki_id = $this->Entry->Wiki->field('id',array(
				'conditions' => array('course_id' =>$this->params['named']['course_id']))
			);
		}

			
		if (!$wiki_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Wiki',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Entry->create();
			$this->data['Entry']['member_id'] = $this->Auth->user('id');
			$this->data['Entry']['content'] = $this->HtmlPurifier->purify($this->data['Entry']['content']);
			if ($data = $this->Entry->save($this->data)) {
				$this->Session->setFlash(__('The Entry has been saved',true));
				$this->redirect(array(
					'action'=>'view',
					 $data['Entry']['slug'],
					'wiki_id' => $data['Entry']['wiki_id']));
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
			if ($data = $this->Entry->save($this->data)) {
				$this->Entry->read();
				$this->Session->setFlash(__('The Entry has been saved',true));
				$this->redirect(array(
					'action'=>'view',
					 $this->Entry->data['Entry']['slug'],
					'wiki_id' => $this->Entry->data['Entry']['wiki_id']));
			} else {
				$this->Session->setFlash(__('The Entry could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Entry->read(null, $id);
		}
		$this->pageTitle = sprintf(__('Editing Entry %s',true),$this->data['Entry']['title']);
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
		$this->Entry->read(null,$entry_id);
		$this->redirect(array(
			'action'=>'view',
			 $this->Entry->data['Entry']['slug'],
			'wiki_id' => $this->Entry->data['Entry']['wiki_id']));
	}

}
?>
