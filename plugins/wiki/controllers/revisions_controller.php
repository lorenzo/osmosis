<?php
class RevisionsController extends WikiAppController {
	var $name = 'Revisions';
	var $helpers = array('Html','Time');
	var $components = array('Diff');
	
	function history($entry_id) {
		$this->Revision->recursive = 0;
		$this->Revision->Entry->recursive = 0;
		$this->set('entry',$this->Revision->Entry->read(null,$entry_id));
		$this->set('revisions', $this->paginate(array('entry_id'=>$entry_id)));
	}
	
	function diff($entry_id,$revision_id) {
		$this->Revision->Entry->recursive = 0;
		$entry = $this->Revision->Entry->read(null,$entry_id);
		$this->Revision->recursive = -1;
		$revision = $this->Revision->find(array('entry_id'=>$entry_id,'Revision.id'=>$revision_id));
		$diff = $this->Diff->formatted_diff($revision['Revision']['content'],$entry['Entry']['content']);
		$this->set(compact('entry','revision','diff'));
	}
}
?>