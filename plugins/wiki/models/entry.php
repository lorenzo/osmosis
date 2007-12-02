<?php
class Entry extends AppModel {

	var $name = 'Entry';
	var $useTable = 'wiki_entries';
	var $validate = array(
		'wiki_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'member_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'message'=>'Error.empty'),
		),
		'title' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'content' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'message'=>'Error.empty'),
		),
	);

	var $belongsTo = array(
			'Wiki' => array('className' => 'wiki.Wiki',
								'foreignKey' => 'wiki_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

	var $hasMany = array(
			'Revision' => array('className' => 'wiki.Revision',
								'foreignKey' => 'entry_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => true,
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);
	
	var $actsAs = array('Transaction');
	
	function save($data,$validate = true,$fields = array()) {
		$update = false;
		$this->begin();
		if (isset($data['Entry']['id'])) {
			$this->recursive = -1;
			$entry = $this->read(null,$data['Entry']['id']);
			if (!empty($entry)) {
				$update = true;
				if($entry['Entry']['content'] == $data['Entry']['content']) {
					return true;
				}
				$data['Entry']['revision'] = $entry['Entry']['revision'] + 1;
				unset($data['Entry']['wiki_id']);
				unset($data['Entry']['title']);
			}
		}
		$data = $this->__cleanInput($data);
		$this->create();
		if (($result = parent::save($data,$validate,$fields))) {
			$saved = true;
			if($update) {
				$revision['Revision'] = $entry['Entry'];
				unset($revision['Revision']['id']);
				$revision['Revision']['entry_id'] = $entry['Entry']['id'];
				$revision['Revision']['created'] = $entry['Entry']['updated'];
				$this->Revision->create();
				$saved = $this->Revision->save($revision);
			}
			if ($saved) {
				$this->commit();
				return $result;
			} 
		}
		$this->rollback();
		return false;
	}
	
	/**
	 * Creates a new revision with the contents of a previous one
	 *
	 * @param string $id revision id
	 * @param string $revision_number number of revision to restore, if null the most recent is used
	 * @return boolean true if the operation was successful
	 * @author José Lorenzo
	 */
	
	function restore($id,$revision_number = null) {
		$this->recurive = -1;
		$entry = $this->read(null,$id);
		if (!$entry || $entry['Entry']['revision'] == 1 || $entry['Entry']['revision'] == $revision_number) {
			return false;
		}
		if (!$revision_number)
			$revision_number = $entry['Entry']['revision'] - 1;
		$this->Revision->recursive = -1;
		$revision = $this->Revision->find(array('entry_id'=>$id,'revision'=>$revision_number));
		if (!$revision) {
			return false;
		}
		$new_entry['Entry'] = $revision['Revision'];
		$new_entry['Entry']['id'] = $id;
		unset($new_entry['Entry']['created']);
		return $this->save($new_entry);
	}
	
	function __cleanInput($data) {
		uses('Sanitize');
		$cleaner = new Sanitize;
		if(isset($data['Entry']['title'])) {
			$data['Entry']['title'] = $cleaner->html($data['Entry']['title'],true);
		}
		return $data;
	}

}
?>