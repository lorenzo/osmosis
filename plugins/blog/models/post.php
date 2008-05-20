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
class Post extends BlogAppModel {

	var $name = 'Post';
	var $actsAs = array(
		'Sluggable' => array('label' => 'title', 'slug' => 'slug', 'overwrite' => false)
	);
	var $useTable = 'blog_posts';
	var $validate = array(
		'title' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'body' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
		'blog_id' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
				),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Blog' => array('className' => 'Blog.Blog',
								'foreignKey' => 'blog_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
								);

	var $hasMany = array(
			'Comment' => array('className' => 'Blog.Comment',
								'foreignKey' => 'post_id',
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
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['title']['Error.empty']['message'] = __('The title can not be empty',true);
			$this->validate['body']['Error.empty']['message'] = __('The body can not be empty',true);
			$this->validate['blog_id']['Error.empty']['message'] = __('The post must belong to a blog',true);
			parent::__construct($id,$table,$ds);
	}

}
?>
