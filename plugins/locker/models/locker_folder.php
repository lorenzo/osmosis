<?php
App::import('Core','Folder');
class LockerFolder extends LockerAppModel {

	var $name = 'LockerFolder';
	var $validate = array(
		'name' => array(
			'max' => array(
				'rule' => array('maxLength',20),
				'allowEmpty' => false
				)
			)
	);
	var $actsAs = array(
	'Bindable',
	'Sluggable' => array(
		'label' => 'name', 'slug' => 'folder_name', 'separator' => '_','unique' => false)
		);


	var $belongsTo = array(
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => array('id','username'),
								'order' => ''
			),
			'ParentFolder' => array('className' => 'Locker.LockerFolder',
								'foreignKey' => 'parent_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Document' => array('className' => 'Locker.LockerDocument',
								'foreignKey' => 'folder_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'SubFolder' => array('className' => 'Locker.LockerFolder',
								'foreignKey' => 'parent_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);
	
	function beforeSave() {
		if ($this->exists()) {
			$folderName = $this->slug($this->data[$this->alias]['name']);
			if ($this->_updateDirectoryName($this->id,$folderName)) {
				$this->data[$this->alias]['folder_name'] = $folderName;
				return true;
			}
			return false;
		} else {
			$parent_id = (isset($this->data[$this->alias]['parent_id'])) ? $this->data[$this->alias]['parent_id'] : '';
			$folder =& $this->getFolder($parent_id,$this->Member->field('username',array('id' => $this->data[$this->alias]['member_id'])));
			$exists = is_dir($folder->pwd().DS.$this->slug($this->data[$this->alias]['name'])); 
			return !$exists;
		}
	}
	
	function afterSave($created) {
		if ($created) {
			$this->_createDirectory($this->id);
			return;
		}
	}
	
	function beforeDelete($cascade = true) {
		$this->restrict(array('Member'));
		$info = $this->findById($this->id);
		$folder =& $this->getFolder($this->id,$info['Member']['username']);
		if ($folder->pwd() == $this->baseDirectory($info['Member']['username']))
			return true;
		return $folder->delete();
	}
	
	private function _createDirectory($id) {
		$this->restrict(array(
				'ParentFolder' => array('id','folder_name'),
				'Member'
			)
		);
		$info = $this->findById($id);
		$folder =& $this->getFolder($info[$this->alias]['parent_id'],$info['Member']['username']);
		$new = new Folder($folder->pwd().DS.$info[$this->alias]['folder_name'],true);
		return $new->pwd();
	}
	
	private function _updateDirectoryName($id,$newName) {
		$this->restrict(array('Member'));
		$info = $this->findById($id);
		$folder =& $this->getFolder($id,$info['Member']['username']);
		$path = $folder->pwd();
		$pathParts = explode(DS,$path);
		array_pop($pathParts);
		$path = implode(DS,$pathParts);
		$newPath = $path.DS.$newName;
		return !is_dir($newPath) && rename($folder->pwd(),$newPath);
	}
	
	private function &getFolder($id, $username) {
		if (empty($id))
			return $this->getBaseFolder($username);
		$this->restrict(array('LockerFolder' => array('ParentFolder' => array('id','folder_name'))));
		$info = $this->findById($id);

		$folder =& $this->getFolder($info[$this->alias]['parent_id'],$username);
		$folder->cd($info[$this->alias]['folder_name']);
		return $folder;
	}
	
	function getDirectory($id,$username) {
		return $this->getFolder($id,$username)->pwd();
	}
	
	function &getBaseFolder($username) {
		$f = new Folder(Configure::read('Osmosis.uploads').DS.$username.DS.'locker'.DS,true);
		return $f;
	}
	
	function baseDirectory($username) { 
		return $this->getBaseFolder($username)->pwd();
	}

}
?>