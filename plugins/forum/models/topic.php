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
class Topic extends AppModel {

	var $name = 'Topic';
	var $useTable = 'forum_topics';
	var $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'allowEmpty' => false
			)
		),
		'status' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'allowEmpty' => false
			)
		),
		'course_id' => array(
				'required' => array(
					'rule' => array('custom', '/.+/'),
					'allowEmpty' => false
				)
			),
	);
	var $actsAs = array('Bindable', 'Loggable');
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Course' => array(
			'className' => 'Course',
			'foreignKey' => 'course_id',
			'conditions' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Discussion' => array(
			'className' => 'Forum.Discussion',
			'foreignKey' => 'topic_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'sticky desc, created desc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'name.required', __('The name can not be empty',true)
		);
		parent::__construct($id,$table,$ds);
	}
	
	function beforeValidate() {
		parent::beforeValidate();
		if (isset($this->data['Topic']['close'])) {
		 	if ($this->data['Topic']['close']) {
				$this->data['Topic']['status'] = 'locked';
			} else {
				$this->data['Topic']['status'] = 'unlocked';
			}
			unset($this->data['Topic']['close']);
		}
		return true;
	}
	
	function afterFind($results, $primary=false) {
		if ($primary) {
			foreach ($results as $i => $topic) {
				if (!isset($topic['Topic']['status'])) continue;
				$results[$i]['Topic']['close'] = ($topic['Topic']['status'] == 'locked');
			}
		}
		return $results;
	}
	
	function getListSummary($course_id) {
		$this->restrict(
			array(
				'Discussion' => array(
					'Member',
					'Response' => array('Member' => array('id', 'full_name'))
				),
				'Course'
			)
		);
		$this->Discussion->hasMany['Response']['limit'] = 1;
		$this->Discussion->hasMany['Response']['order'] = 'created desc';
		return $this->find('first', array('course_id' => $course_id));
	}
	
	/**
	 * Returns the parent course of the current entity 
	 *
	 * @return mixed Parent Course id or false if not found
	 * @author Joaquín Windmüller
	 **/
	function getParentCourse() {
		return $this->data['Topic']['course_id'];
	}
}
?>
