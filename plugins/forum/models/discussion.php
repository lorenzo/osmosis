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
class Discussion extends AppModel {

	var $name = 'Discussion';
	var $useTable = 'forum_discussions';
	
	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'topic_id' => array('numeric'),
		'member_id' => array('numeric'),
		'title' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'required' => true,
				'allowEmpty' => false
			)
		),
		'status' => array(
			'valid' => array(
				'rule' => array('custom', '/locked|unlocked/'),
				'required' => true
			)
		)
	);
	
	/**
	 * Attached behaviors
	 *
	 * @var array
	 **/
	var $actsAs = array('Visitable', 'Bindable', 'Loggable');

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Discussion BelongsTo Topic
		'Topic' => array(
			'className'		=> 'Forum.Topic',
			'foreignKey'	=> 'topic_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> ''
		),
		// Discussion BelongsTo Member (Creator of the discussion)
		'Member' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'member_id',
			'conditions'	=> '',
			'fields'		=> array('id', 'full_name', 'username'),
			'order'			=> ''
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Discussion HasMany Responses
		'Response' => array(
			'className'		=> 'Forum.Response',
			'foreignKey'	=> 'discussion_id',
			'dependent'		=> true,
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
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
			'title.required', __('Please set a title',true)
		);
		$this->setErrorMessage(
			'status.valid', __('Incorrect status',true)
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
		if (isset($this->data['Discussion']['close'])) {
		 	if ($this->data['Discussion']['close']) {
				$this->data['Discussion']['status'] = 'locked';
			} else {
				$this->data['Discussion']['status'] = 'unlocked';
			}
			unset($this->data['Discussion']['close']);
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
			foreach ($results as $i => $discussion) {
				if (!isset($discussion['Discussion']['status'])) continue;
				$results[$i]['Discussion']['close'] = ($discussion['Discussion']['status'] == 'locked');
			}
		}
		return $results;
	}

	/**
	 * Returns a Discussion data
	 *
	 * @param string $id ID of the discussion
	 * @return mixed Array with data if found of false
	 */
	function getDiscussion($id) {
		$this->contain(
			array(
				'Member',
				'Topic' => array('id', 'name')
			)
		);
		$discussion = $this->find('first', array('conditions' => array('Discussion.id' => $id), 'count_view' => true));
		return $discussion;
	}
	
	/**
	 * Returns the parent course of the current entity 
	 *
	 * @return mixed Parent Course id or false if not found
	 **/
	function getParentCourse() {
		$this->Topic->read(null, $this->data['Discussion']['topic_id']);
		return $this->Topic->getParentCourse();
	}
}
?>