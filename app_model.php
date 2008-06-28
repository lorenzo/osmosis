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
class AppModel extends Model{
	var $actsAs = array('Containable', 'Hookable');
	
	/**
	 * Validation rule to check if a field is unique.cnl
	 *
	 * @param array $data 
	 * @param string $name 
	 * @return void
	 * @author Joaquín Windmüller
	 */
	
	function validateUnique($data, $name) {
		if (!empty($this->id)) {
			$conditions = array('NOT' => array($this->primaryKey => $this->id, $name => $data[$name]));
		} else {
			$conditions = array($name => $data[$name]);
		}
		return !$this->field($this->primaryKey, $conditions);
	}
	
	protected function setErrorMessage($path, $message) {
		Set::insert(&$this->validate, $path . '.message', $message);
	}
	
	/**
	 * Alias for ContainableBehavior::contain
	 *
	 * @param mixed $args 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function restrict($args) {
		$this->contain($args);
		trigger_error(__('Please use "contain" instead of "restrict"', true), E_USER_WARNING);
	}
	
	function beforeFind($queryData) {
		if (isset($queryData['restrict'])) {
			$queryData['contain'] = $queryData['restrict'];
			unset($queryData['restrict']);
			trigger_error(__('Please use "contain" instead of "restrict"', true), E_USER_WARNING);
		}
	}
	
	function isOwner($member,$id) {
		
		if (isset($this->belongsTo) && !empty($this->belongsTo)) {
			$foreign = false;
			foreach($this->belongsTo as $alias => $assoc) {
				if ($alias == 'Member' || $assoc['className'] == 'Member')
					$foreign = $alias;
			}
			
			if (!$foreign)
				return false;
				return $this->find('count',array(
					'conditions' => array(
						$this->alias.'.id' => $id,
						$this->alias.'.'.$this->belongsTo[$foreign]['foreignKey'] => $member 
						)
					)) == 1;
		}
		return false;
	}
	
	/**
	 * Returns the parent course related to this model (assumes $this->id is set)
	 *
	 * @return mixed Parent Course id or false if not found
	 **/
	function getParentCourse() {
		return false;
	}
}
?>