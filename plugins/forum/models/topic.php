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
	
	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
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

	/**
	 * Attached behaviors
	 *
	 * @var array
	 **/
	var $actsAs = array('Bindable', 'Loggable');

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Topic BelongsTo Course (topic of the course's forum)
		'Course' => array(
			'className'		=> 'Course',
			'foreignKey'	=> 'course_id',
			'conditions'	=> '',
			'order'			=> ''
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Topic HasMany Discussions
		'Discussion' => array(
			'className'		=> 'Forum.Discussion',
			'foreignKey'	=> 'topic_id',
			'dependent'		=> true,
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> 'sticky desc, created desc',
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
			'name.required', __('The name can not be empty',true)
		);
		parent::__construct($id,$table,$ds);
	}
	
	/**
	 * Before validate callback
	 *
	 * @see Model::beforeValidate
	 */
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
	
	/**
	 * Adds a field (closed) before returning a search result
	 *
	 * @see Model::afterFind
	 */	
	function afterFind($results, $primary=false) {
		if ($primary) {
			foreach ($results as $i => $topic) {
				if (!isset($topic['Topic']['status'])) continue;
				$results[$i]['Topic']['close'] = ($topic['Topic']['status'] == 'locked');
			}
		}
		return $results;
	}
	
	/**
	 * Returns a list of discussions (each one with the latest response) inside a topic.
	 *
	 * @param string $id Id of a topic
	 * @return mixed Array of data if topic is found or false if not
	 */
	function getListSummary($id) {
		$this->contain(
			array(
				'Course',
				'Discussion' => array(
					'Member',
					'Response(id,created)' => array('Member' => array('id', 'full_name'))
				)
			)
		);
		$this->Discussion->hasMany['Response']['limit'] = 1;
		$this->Discussion->hasMany['Response']['order'] = 'created desc';
		return $this->read(null, $id);
	}
	
	/**
	 * Returns the parent course of the current entity 
	 *
	 * @return mixed Parent Course id or false if not found
	 **/
	function getParentCourse() {
		if (!isset($this->data['Topic']['course_id'])) {
			$this->read();
		}
		return $this->data['Topic']['course_id'];		
	}
	
	/**
	 * Returns true if the topic is locked
	 *
	 * @param string $id 
	 * @return boolean
	 */
	
	function isLocked($id) {
		return $this->find('count',array('conditions' => array('Topic.id' => $id,'Topic.status' => 'locked'),'recursive' => -1)) == 1;
	}
}
?>