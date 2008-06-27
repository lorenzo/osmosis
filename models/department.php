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
class Department extends AppModel {

	var $name = 'Department';

	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'name' => array(
		    'required' => array(
	        	'rule' => array( 'custom','/.+/'),
			),
		),
		'description' => array(
		    'required' => array(
		        'rule' => array('custom','/.+/'),
			)
		)
	);

	/**
	 * HasMany (N-1) relation descriptors
	 *
	 * @var array
	 **/
	var $hasMany = array(
		// Department HasMany Course
		'Course' => array(
			'className'		=> 'Course',
			'foreignKey'	=> 'department_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
			'limit'			=> '',
			'offset'		=> '',
			'dependent'		=> '',
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
			'name.required', __('Please write the name of the Department',true)
		);
		$this->setErrorMessage(
			'description.required', __('Please write a description for the Department',true)
		);
		parent::__construct($id,$table,$ds);
	}
}
?>