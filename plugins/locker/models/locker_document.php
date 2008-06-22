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
App::import('Core','File');
class LockerDocument extends LockerAppModel {

	var $name = 'LockerDocument';
	var $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'allowEmpty' => false,
				'last' => true
			),
			'max' => array(
				'rule' => array('maxLength', 30),
				'allowEmpty' => false
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
				'required' => false,
				'on' => 'create'
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

	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'name.required', __('Please write a name for this file',true)
		);
		$this->setErrorMessage(
			'name.max', __('Please limit the name to a maximum of 30 characters',true)
		);
		$this->setErrorMessage(
			'file.valid', __('The file is incorrect',true)
		);
		parent::__construct($id,$table,$ds);
	}

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
			$this->contain(array('Member' => array('username')));
			$file = $this->find('first',
				array(
					'fields' => array('id','file_name','folder_id'),
					'conditions' => array('LockerDocument.id' => $this->id)
				)
			);
			if ($file[$this->alias]['folder_id'] != $this->data[$this->alias]['folder_id']) {
				
				$old = $this->Folder->getDirectory($file[$this->alias]['folder_id'], $file['Member']['username']);
				$old .= DS.$file[$this->alias]['file_name'];
				$old = trim($old);
				$new = $this->Folder->getDirectory($this->data[$this->alias]['folder_id'], $file['Member']['username']);
				$new .= DS.$file[$this->alias]['file_name'];
				$new = trim($new);
				return is_file($old) && !is_file($new) && rename($old, $new);
			}
		}
		if ($this->exists() && isset($this->data[$this->alias]['name'])) {
			$this->contain(array('Member' => array('username')));
			$file = $this->find('first',
				array(
					'fields' => array('id','name', 'file_name','folder_id'),
					'conditions' => array('LockerDocument.id' => $this->id)
				)
			);
			if ($file[$this->alias]['name'] != $this->data[$this->alias]['name']) {
				$f = new File($this->data[$this->alias]['name']);
				$this->data[$this->alias]['file_name'] = $f->safe($this->data[$this->alias]['name'], true);
				$old = $this->Folder->getDirectory($file[$this->alias]['folder_id'], $file['Member']['username']);
				$old .= DS.$file[$this->alias]['file_name'];
				$old = trim($old);
				$new = $this->Folder->getDirectory($file[$this->alias]['folder_id'], $file['Member']['username']);
				$new .= DS . $this->data[$this->alias]['file_name'];
				$new = trim($new);
				return is_file($old) && !is_file($new) && rename($old, $new);
			}
		}
		return true;
	}	
	
	private function _saveFile($info) {
		$file = new File($info['tmp_name']);
		$name = $file->safe($info['name']);
		$folder_id = isset($this->data[$this->alias]['folder_id']) ? $this->data[$this->alias]['folder_id'] : '';
		$dest = $this->Folder->getDirectory($folder_id,$this->data[$this->alias]['member_username']).DS.$name;
		$this->data[$this->alias]['file_name'] = $name;
		$this->data[$this->alias]['name'] = $info['name'];
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
	
	/**
	 * Returns a filename without the esxtension
	 *
	 * @param string filename
	 * @return string filename without extension
	 **/
	function removeExtension($file) {
		$file = explode('.', $file);
		$ext = array_pop($file);
		if (count($file)==1) {
			return $file[0];
		}
		return array(implode('.', $file), $ext);
	}
}
?>
