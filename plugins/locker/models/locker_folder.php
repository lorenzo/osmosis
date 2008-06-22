<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
App::import('Core','Folder');
class LockerFolder extends LockerAppModel {

	var $name = 'Folder';
	
	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'name' => array(
			'max' => array(
				'rule' => array('maxLength',20),
				'allowEmpty' => false
			)
		)
	);
	
	/**
	 * Attached behaviors
	 *
	 * @var array
	 **/
	var $actsAs = array(
		'Bindable',
		'Sluggable' => array(
			'label' => 'name', 'slug' => 'folder_name', 'separator' => '_','unique' => false
		)
	);

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Folder BelongsTo Member (Each memeber has a locker)
		'Member' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'member_id',
			'conditions'	=> '',
			'fields'		=> array('id','username', 'full_name'),
			'order'			=> ''
		),
		// Folder BelongsTo Folder (Parent Folder)
		'ParentFolder' => array(
			'className'		=> 'Locker.LockerFolder',
			'foreignKey'	=> 'parent_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> ''
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Folder HasMany Document
		'Document' => array(
			'className'		=> 'Locker.LockerDocument',
			'foreignKey'	=> 'folder_id',
			'dependent'		=> true,
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
			'limit'			=> '',
			'offset'		=> '',
			'exclusive'		=> '',
			'finderQuery'	=> '',
			'counterQuery'	=> ''
		),
		// Folder HasMany Folder (Sub Folders)
		'SubFolder' => array(
			'className'		=> 'Locker.LockerFolder',
			'foreignKey'	=> 'parent_id',
			'dependent'		=> true,
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> 'folder_name ASC',
			'limit'			=> '',
			'offset'		=> '',
			'exclusive'		=> '',
			'finderQuery'	=> '',
			'counterQuery'	=> ''
		)
	);
	
	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'name.max', __('Folder names have a maximum length 20 characters',true)
		);
		parent::__construct($id,$table,$ds);
	}

	/**
	 * BeforeSave callback
	 *
	 * @see Model::beforeSave
	 */
	function beforeSave() {
		if ($this->exists()) {
			$folderName = $this->slug($this->data[$this->alias]['name']);
			if ($this->_updateDirectoryName($this->id, $folderName)) {
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
	
	/**
	 * After Save callback
	 *
	 * @see Model::afterSave
	 */
	function afterSave($created) {
		if ($created) {
			$this->_createDirectory($this->id);
			return;
		}
	}
	
	/**
	 * Before Delete callback
	 *
	 * @see Model::beforeDelete
	 */
	function beforeDelete($cascade = true) {
		$this->contain(array('Member'));
		$info = $this->findById($this->id);
		$folder =& $this->getFolder($this->id,$info['Member']['username']);
		if ($folder->pwd() == $this->baseDirectory($info['Member']['username']))
			return true;
		return $folder->delete();
	}
	
	/**
	 * Returns a the path of the Folder from the root of the Locker
	 *
	 * @param $id string Id of the folder 
	 * @return array with each hop on the path (id and name of the folder)
	 */
	function path($id) {
		$this->recursive = -1;
		$path = array();
		$fields = array('name', 'parent_id', 'id');
		while($id) {
			$conditions = compact('id');
			$data = $this->find('first' , compact('fields', 'conditions'));
			if (!$data) {
				break;
			}
			$id = $data[$this->alias]['parent_id'];
			array_unshift($path, $data[$this->alias]);
		}
		return $path;
	}

	/**
	 * Creates the physical directory for the locker folder
	 *
	 * @param string $id Id of the folder
	 * @return string physical path to the directory
	 */
	private function _createDirectory($id) {
		$this->contain(array(
				'ParentFolder' => array('id','folder_name'),
				'Member' => array('username')
			)
		);
		$info = $this->findById($id);
		$folder =& $this->getFolder($info[$this->alias]['parent_id'],$info['Member']['username']);
		$new = new Folder($folder->pwd().DS.$info[$this->alias]['folder_name'],true);
		return $new->pwd();
	}
	
	/**
	 * Renames the physical directory for the locker folder
	 *
	 * @param string $id Id of the folder
	 * @param string $newName New name to give
	 * @return boolean wether the renaming was successful
	 */
	private function _updateDirectoryName($id, $new_name) {
		$this->contain(array('Member'));
		$info = $this->findById($id);
		$folder =& $this->getFolder($id, $info['Member']['username']);
		$new_path = dirname($folder->pwd()) . DS . $new_name;
		return !is_dir($new_path) && rename($folder->pwd(), $new_path);
	}
	
	/**
	 * Returns a CakePHP Folder (physical) Object of a Locker Folder.
	 *
	 * @param string $id Id of the folder
	 * @param string $username Username of the owner of the Locker
	 * @return Folder the folder referenced by $id or the locker's base if $id is empty
	 */
	private function &getFolder($id, $username) {
		if (empty($id))
			return $this->getBaseFolder($username);

		$this->recursive = -1;
		$info = $this->findById($id);

		$folder =& $this->getFolder($info[$this->alias]['parent_id'], $username);
		$folder->cd($info[$this->alias]['folder_name']);
		return $folder;
	}

	/**
	 * Returns the physical path to the folder
	 *
	 * @param string $id Id of the folder
	 * @param string $username Username of the owner if the Locker
	 * @return string path to the folder
	 */
	function getDirectory($id,$username) {
		return $this->getFolder($id,$username)->pwd();
	}

	/**
	 * Returns a CakePHP Folder Object (physical) to the base directory where the user's locker is placed
	 *
	 * @param string $username Username of the owner of the Locker
	 * @return Folder folder pointing to this users locker
	 */
	function &getBaseFolder($username) {
		$f = new Folder(Configure::read('Osmosis.uploads').DS.$username.DS,true);
		return $f;
	}

	/**
	 * Returns the physical path to the user's Locker
	 *
	 * @param string $username Username of the owner of the locker
	 * @return string physical path to the locker
	 */
	function baseDirectory($username) { 
		return $this->getBaseFolder($username)->pwd();
	}

	/**
	 * Returns the locker (and creates it, if it doesn't exists) of the member
	 *
	 * @param $member_id int Id of the member
	 * @return mixed The parent folder data of the member's locker or false if not found
	 **/
	function userLocker($member_id, $just_id = false) {
		$conditions = array(
			'LockerFolder.member_id' => $member_id,
			'LockerFolder.parent_id' => null
		);
		if ($just_id) {
			$id = $this->field('id', $conditions);
			if (!$id) {
				$parent_folder = $this->createLocker($member_id);
				$id = $parent_folder['LockerFolder']['id'];
			}
			return $id;
		} else {
			$this->contain(
				array(
					'Member' => array('id', 'full_name'),
					'SubFolder'
				)
			);
			$parent_folder = $this->find('first', compact('conditions'));
		}
		
		if (!$parent_folder) {
			$parent_folder = $this->createLocker($member_id);
		}
		return $parent_folder;
	}

	/**
	 * Creates and registers the locker's first folder for a member
	 *
	 * @param $member_id int Id of the member
	 * @return mixed data of the new folder or false on failure
	 **/
	function createLocker($member_id) {
		if ($this->Member->find('count', array('conditions' => array('id' => $member_id)))) {
			$this->create();
			$data = $this->save(array('name' => 'locker', 'member_id' => $member_id));
			$data['LockerFolder']['id'] = $this->id;
			return $data;
		}
		return false;
	}
}
?>