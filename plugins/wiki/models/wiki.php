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
class Wiki extends AppModel {

	var $name = 'Wiki';
	var $useTable = 'wiki_wikis';
	
	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'course_id' => array(
			'required' => array(
				'rule'			=> array('custom', '/.+/'),
				'required'		=> true,
				'allowEmpty'	=> false,
				'on'			=> 'create'
			)
		),
		'name' => array(
			'required' => array(
				'rule'			=> array('custom', '/.+/'),
				'required'		=> true,
				'allowEmpty'	=> false,
				'on'			=> 'create'
			)
		)
	);

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Wiki BelongsTo Course
		'Course' => array(
			'className' => 'Course',
			'foreignKey' => 'course_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Wiki HasMany Entries (Pages)
		'Entry' => array(
			'className' => 'wiki.Entry',
			'foreignKey' => 'wiki_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'updated DESC',
			'limit' => 50,
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'course_id.required', __('No Course ID set',true)
		);
		$this->setErrorMessage(
			'name.required', __('Please set the wikis name',true)
		);
		parent::__construct($id,$table,$ds);
	}
	
	/**
	 * Creates a new empty wiki
	 *
	 * @param int $id Id of the course
	 * @return array data of the wiki
	 **/
	function newWiki($course_id, $member_id) {
		$data = $this->save(
			array(
				'course_id'	=> $course_id,
				'name'		=> __('Wiki', true),
				'description' => ''
			)
		);
		if (!$data) {
			return false;
		}
		$data['Wiki']['id'] = $this->id;
		$entry = $this->Entry->save(
			array(
				'wiki_id'	=> $this->id,
				'member_id'	=> $member_id,
				'title'		=> __('Welcome', true),
				'content'	=> __('<p>Welcome to the wiki, start by editing this message!</p>', true)
			)
		);
		$entry['Entry']['id'] = $this->Entry->id;
		$data['Entry'][] = $entry['Entry'];
		return $data;
	}
	
	/**
	 * Returns the main page of a wiki
	 *
	 * @param string $wiki_id Id of the wiki
	 * @return mixed data of false if not found
	 */
	function mainPage($wiki_id) {
		$conditions = compact('wiki_id');
		$this->Entry->recursive = -1;
		return $this->Entry->find('first', compact('conditions'));
	}
}
?>