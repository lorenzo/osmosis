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
class Response extends AppModel {

	var $name = 'Response';
	var $useTable = 'forum_responses';
	
	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'content' => array(
			'required' => array(
				'rule' => array('/.+/'),
				'required' => true,
				'allowEmpty' => false
			)
		)
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
		// Response BelongsTo Discussion
		'Discussion' => array(
			'className'		=> 'Forum.Discussion',
			'foreignKey'	=> 'discussion_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
			'counterCache'	=> array('skipUpdates' => false)
		),
		// Response BelongsTo Member (author of the response)
		'Member' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'member_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> ''
		)
	);

	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'content.required',
			__('Please write a response',true)
		);
		parent::__construct($id, $table, $ds);
	}
}
?>