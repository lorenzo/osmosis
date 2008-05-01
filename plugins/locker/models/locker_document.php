<?php
App::import('Core','File');
class LockerDocument extends LockerAppModel {

	var $name = 'LockerDocument';
	var $validate = array(
		'name' => array(
			'max' => array(
				'rule' => array('maxLength',100),
				'allowEmpty' => true
				)
			),
		'file' => array(
			'valid' => array(
				'rule' => array('validFile'),
				'on' => 'create'
				)
			),
		'member_id' => array(
			'valid' => array(
				'rule' => array('custom','/.*/'),
				'allowEmpty' => false,
				'on' => 'create',
				)
			),
		'member_username' => array(
			'valid' => array(
				'rule' => array('custom','/.*/'),
				'allowEmpty' => false,
				'on' => 'create',
				)
			)
	);

	var $belongsTo = array(
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Folder' => array('className' => 'Locker.LockerFolder',
								'foreignKey' => 'folder_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	var $actsAs = array('Bindable');
	
	function validFile($check) {
		extract($check); 
		if (!is_uploaded_file($file['tmp_name']))
			return false;
		return true;
	}
	
	function beforeSave() {
		if (isset($this->data[$this->alias]['file'])) {
			$file = $this->data[$this->alias]['file'];
			$this->data[$this->alias]['size'] = $file['size'];
			$this->data[$this->alias]['type'] = $file['type'];
			unset($this->data[$this->alias]['file']);
			return $this->_saveFile($file);
		}
		if ($this->exists() && isset($this->data[$this->alias]['folder_id'])) {
			$this->restrict(array('Member' => array('username'),'id','file_name','folder_id'));
			$file = $this->findById($this->id);
			if ($file[$this->alias]['folder_id'] != $this->data[$this->alias]['folder_id']) {
				$old = $this->Folder->getDirectory($file[$this->alias]['folder_id'],$file['Member']['username']).DS.$file[$this->alias]['file_name'];
				$new = $this->Folder->getDirectory($this->data[$this->alias]['folder_id'],$file['Member']['username']).DS.$file[$this->alias]['file_name'];
				return is_file($old) && !is_file($new) && rename($old,$new);
			}
		}
		return true;
	}	
	
	private function _saveFile($info) {
		$file = new File($info['tmp_name']);
		$name = $file->safe($info['name']);
		$folder_id = (isset($this->data[$this->alias]['folder_id'])) ? $this->data[$this->alias]['folder_id'] : '';
		$dest = $this->Folder->getDirectory($folder_id,$this->data[$this->alias]['member_username']).DS.$name;
		$this->data[$this->alias]['file_name'] = $name;
		return move_uploaded_file($info['tmp_name'],$dest);
	}
	
	function getFilePath($id,$username = null) {
		$recursive = (empty($username)) ? $this->recursive : -1;
		$file = $this->find('first', array('conditions' => array($this->alias.'.id' => $id),'recursive' => $recursive));
		$username = (isset($first['Member']['username'])) ? $first['Member']['username'] : $username;
		$folder_id = (isset($this->data[$this->alias]['folder_id'])) ? $this->data[$this->alias]['folder_id'] : '';
		$base = $this->Folder->getDirectory($this->data[$this->alias]['folder_id'],$username);
		return $base . DS .$file[$this->name]['file_name'];
	}

}
?>