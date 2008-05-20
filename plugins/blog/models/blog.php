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
class Blog extends BlogAppModel {

	var $name = 'Blog';
	var $useTable = 'blog_blogs';
	var $validate = array(
		'title' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'description' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'member_id' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Post' => array('className' => 'Blog.Post',
								'foreignKey' => 'blog_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'created DESC',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);
	
	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member'
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['title']['Error.empty']['message'] = __('The title can not be empty',true);
			$this->validate['description']['Error.empty']['message'] = __('The description can not be empty',true);
			$this->validate['member_id']['Error.empty']['message'] = __('The member can not be empty',true);
			parent::__construct($id,$table,$ds);
	}
}
?>
