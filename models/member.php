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
class Member extends AppModel {
	var $name = 'Member';
	var $displayField = 'full_name';

	var $validate = array(
			// 'name' => array(
			//     'valid' => array(
			//         'rule' => '/.+/',
			//         )
			// ),
			// 'email' => array(
			//     'valid' => array(
			//         'rule' => 'email',
			//         )
			// ),
			// 'country' => array(
			//     'valid' => array(
			//         'rule' => '/.+/',
			//         )
			// ),
			// 'city' => array(
			//     'valid' => array(
			//         'rule' => '/.+/',
			//         )
			// ),
			// 'age' => array(
			//     'number' => array(
			//         'rule' => 'numeric',
			//         )
			// ),
			// 'sex' =>  array(
			//     'valid' => array(
			//         'rule' => '/.+/',
			//         )
			// ),
			// 'role_id' => array(
			//     'valid' => array(
			//         'rule' => '/.+/',
			//         )
			// ),
			'username' =>  array(
			    // 'valid' => array(
			    //     'rule' => '/.+/',
			    // 		        ),
				'isunique' => array(
					'rule' => array('validateUnique', 'username'),
					'required' => true
				)
			),
			// 'password' =>  array(
			//     'valid' => array(
			//         'rule' => '/.+/',
			//         )
			// ),
		);
		
	var $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Course' => array(
			'className' => 'Course',
			'joinTable' => 'courses_members',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'course_id',
			'with' => 'Enrollment',
			'unique' => true
		)
	);
	
    var $actsAs = array('Acl');
    
    function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'username.isunique',
			__('This username is taken',true)
		);
    	// $this->validate['email']['valid']['message'] = __('The email address provided is not correct',true);
    	// $this->validate['country']['valid']['message'] = __('The country name can not be empty',true);
    	// $this->validate['city']['valid']['message'] = __('The city name can not be empty',true);
    	// $this->validate['age']['number']['message'] = __('The age must be a number',true);
    	// $this->validate['sex']['valid']['message'] = __('The sex can not be empty',true);
    	// $this->validate['rol_id']['valid']['message'] = __('The rol_id can not be empty',true);
    	// $this->validate['username']['valid']['message'] = __('The username can not be empty',true);
    	// $this->validate['password']['valid']['message'] = __('The password can not be empty',true);
    	// $this->validate['name']['valid']['message'] = __('The name can not be empty',true);	
		parent::__construct($id,$table,$ds);
    }
    

    function parentNode() {
        if (!$this->id) {
            return null;
        }
        $data = $this->read();
        if (!$data[$this->name]['role_id']){
            return null;
        } else {
            return array('model' => 'Role', 'foreign_key' => $data[$this->name]['role_id']);
        }
    }

	function courses($id) {
		$ids = $this->Enrollment->find('all',
			array(
				'conditions'=> array('member_id' => $id),
				'fields'	=> array('course_id')
			)
		);
		$ids = Set::extract($ids,'{n}.Enrollment.course_id');
		if (empty($ids))
			return array();
		$courses = $this->Course->find('all', array(
			'conditions'=> array('id' => $ids),
			'fields'	=> array('id','code', 'name'),
			'recursive' => -1
			)
		);
		return $courses;
	}
	
	function isOnline($id) {
		$timeout = time() - (Security::inactiveMins() * Configure::read('Session.timeout'));
		return $this->find('first', array('conditions' => array('id' => $id, 'last_seen' => '< ' . $timeout )));
	}
	
}
?>
