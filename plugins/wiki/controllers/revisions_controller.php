<?php
class RevisionsController extends WikiAppController {
	var $name = 'Revisions';
	var $helpers = array('Html','Time','Wiki');
	var $components = array('Diff');
	
	function _setActiveCourse() {
		if (!isset($this->params['named']['course_id']) && isset($this->params['named']['wiki_id'])) {
			$this->activeCourse = $this->Revision->Entry->Wiki->field('course_id',array('id' => $this->params['named']['wiki_id']));
		} else
			parent::_setActiveCourse();
	}
	
	function history($entry_id) {
		$this->Revision->recursive = 0;
		$this->Revision->Entry->recursive = 0;
		$this->set('entry',$this->Revision->Entry->read(null,$entry_id));
		$this->paginate['order'] = 'Revision.created DESC';
		$this->set('revisions', $this->paginate(array('entry_id'=>$entry_id)));
	}
	
	function diff($entry_id,$revision_id) {
		$this->Revision->Entry->recursive = 0;
		$entry = $this->Revision->Entry->read(null,$entry_id);
		$this->Revision->recursive = 0;
		$revision = $this->Revision->find(array('entry_id'=>$entry_id,'Revision.id'=>$revision_id));
		$diff = $this->Diff->formatted_diff($revision['Revision']['content'],$entry['Entry']['content']);
		$this->set(compact('entry','revision','diff'));
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Revision.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('revision', $this->Revision->read(null, $id));
	}
}
?>