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
class Role extends AppModel {

	var $name = 'Role';
	var $displayField = 'role';
	var $validate = null;/*array(
		'parent_id' => VALID_NOT_EMPTY,
		'role' => VALID_NOT_EMPTY,
	);*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Parent' => array('className' => 'Role',
								'foreignKey' => 'parent_id'
								),
	);

	var $hasMany = array(
			'Member' => array('className' => 'Member',
								'foreignKey' => 'role_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);
	
    var $actsAs = array('Acl' => array('type' => 'requester'));

    function parentNode() {
        if (!$this->id) {
            return null;
        }
        $data = $this->read();
        if (!$data[$this->name]['parent_id']){
            return null;
        } else {
            return array('model' => 'Role', 'foreign_key' => $data[$this->name]['parent_id']);
        }
    }

}
?>
